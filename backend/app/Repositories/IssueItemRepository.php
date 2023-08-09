<?php

namespace App\Repositories;

use Exception;
use App\Models\Stock;
use App\Models\IssuedItem;
use App\Models\Requisition;
use App\Models\ReceivedItem;
use Illuminate\Support\Facades\DB;
use App\Interfaces\IssueItemRepositoryInterface;

class IssueItemRepository implements IssueItemRepositoryInterface
{
    public function store($requisitionItems)
    {
        foreach ($requisitionItems as $requisitionItem) {
            $this->issueItem($requisitionItem);
        }

        DB::commit();
        return true;
    }


    public function update($request, $issuedItem)
    {
        return true;
        // Code here
    }


    public function issueItem($requisitionItem)
    {
        // Update requisition status
        $requisition = Requisition::find($requisitionItem->requisition_id);
        if ($requisition && $requisition->is_approved) {
            $requisition->status = 1;
            $requisition->save();
        } elseif ($requisition->status) {
            throw new Exception("The requisition is issued already.");
        } else {
            throw new Exception("The requisition not found or is not approved.");
        }


        // Update stock
        $stock = Stock::where('item_id', $requisitionItem->item_id)->first();

        if (!$stock || $stock->quantity < $requisitionItem->quantity) {
            throw new Exception("Insufficient stock for " . $requisitionItem->item_id . ".");
        }

        $stock->quantity = $stock->quantity - $requisitionItem->quantity;
        $stock->save();


        // Update received item and calculate the price according FIFO
        $quantity       = $requisitionItem->quantity;
        $item_id        = $requisitionItem->item_id;
        $total_price    = 0;

        while ($quantity != 0) {
            $receivedItem = ReceivedItem::where('item_id', $item_id)->where('stock', '>', 0)->first();

            if ($receivedItem->stock <= $quantity) {

                $total_price = $total_price + ($receivedItem->unit_price * $receivedItem->stock);

                $quantity = $quantity - $receivedItem->stock;
                $receivedItem->stock = 0;
            } elseif ($receivedItem->stock > $quantity) {

                $total_price = $total_price + ($receivedItem->unit_price * $quantity);

                $receivedItem->stock = $receivedItem->stock - $quantity;
                $quantity = 0;
            }

            $receivedItem->save();
        }


        // Create issue record
        $issueItem = new IssuedItem();
        $issueItem->requisitions_id = $requisitionItem->requisition_id;
        $issueItem->item_id         = $requisitionItem->item_id;
        $issueItem->quantity        = $requisitionItem->quantity;
        $issueItem->total_price     = $total_price;
        $issueItem->save();


        return true;
    }
}
