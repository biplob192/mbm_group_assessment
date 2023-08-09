<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Models\ReceivedItem;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ReceivedItemRepositoryInterface;

class ReceivedItemRepository implements ReceivedItemRepositoryInterface
{
    public function store($request)
    {
        $receivedItem           = new ReceivedItem();
        $receivedItem->supplier_id  = $request->supplier_id;
        $receivedItem->item_id      = $request->item_id;
        $receivedItem->quantity     = $request->quantity;
        $receivedItem->stock        = $request->quantity;
        $receivedItem->unit_price   = $request->unit_price;
        $receivedItem->save();


        $previousStock = Stock::where('item_id', $receivedItem->item_id)->first();
        Stock::updateOrCreate(
            [
                'item_id' => $receivedItem->item_id,
            ],
            [
                'quantity'    => $previousStock?->quantity + $receivedItem->quantity,
            ]
        );


        DB::commit();
        return $receivedItem;
    }


    public function multipleStore($request)
    {
        $items = [];

        foreach ($request->received_items as $item) {

            $receivedItem           = new ReceivedItem();
            $receivedItem->supplier_id  = $item['supplier_id'];
            $receivedItem->item_id      = $item['item_id'];
            $receivedItem->quantity     = $item['quantity'];
            $receivedItem->stock        = $item['quantity'];
            $receivedItem->unit_price   = $item['unit_price'];
            $receivedItem->save();


            $previousStock = Stock::where('item_id', $receivedItem->item_id)->first();
            Stock::updateOrCreate(
                [
                    'item_id' => $receivedItem->item_id,
                ],
                [
                    'quantity'    => $previousStock?->quantity + $receivedItem->quantity,
                ]
            );

            $items[] = $receivedItem;
        }


        DB::commit();
        return $items;
    }


    public function update($request, $receivedItem)
    {
        // Stock update
        $newQuantity = $receivedItem->quantity - $request->quantity;
        $previousStock = Stock::where('item_id', $receivedItem->item_id)->first();
        Stock::updateOrCreate(
            [
                'item_id' => $receivedItem->item_id,
            ],
            [
                'quantity'    => $previousStock?->quantity + $newQuantity,
            ]
        );


        // Update received item
        if ($request->supplier_id) {
            $receivedItem->supplier_id   = $request->supplier_id;
        }
        if ($request->item_id) {
            $receivedItem->item_id   = $request->item_id;
        }
        if ($request->quantity) {
            $receivedItem->quantity   = $request->quantity;
            $receivedItem->stock   = $request->quantity;
        }
        if ($request->unit_price) {
            $receivedItem->unit_price   = $request->unit_price;
        }
        $receivedItem->save();


        return $receivedItem;
    }
}
