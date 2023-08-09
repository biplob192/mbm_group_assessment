<?php

namespace App\Repositories;

use Exception;
use App\Models\Stock;
use App\Models\Requisition;
use App\Models\RequisitionItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\RequisitionRepositoryInterface;

class RequisitionRepository implements RequisitionRepositoryInterface
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            $requisitions = Requisition::latest()->get();
        } else if ($user->hasRole('Store_Executive')) {
            $requisitions = Requisition::where('is_approved', 1)->where('status', 0)->latest()->get();
        } else if ($user->hasRole('Employee')) {
            $requisitions = Requisition::where('created_by', auth()->user()->id)->latest()->get();
        }

        return $requisitions;
    }


    public function store($request)
    {
        $requisition = new Requisition();
        $requisition->name = $request->requisition_name;
        $requisition->created_by = auth()->user()->id;
        $requisition->save();


        foreach (json_decode($request->requisition_items) as $item) {
            $stock = Stock::where('item_id', $item->id)->first();

            if (!$stock ||  $stock->quantity < $item->quantity) {
                throw new Exception("Insufficient stock for " . $item->id . ".");
            }

            $requisitionItem = new RequisitionItem();
            $requisitionItem->requisition_id    = $requisition->id;
            $requisitionItem->item_id           = $item->id;
            $requisitionItem->quantity          = $item->quantity;
            $requisitionItem->save();
        }

        DB::commit();
        return $requisition;
    }


    public function update($request, $requisitionItem)
    {
        if ($request->requisition_name) {
            $requisitionItem->name   = $request->requisition_name;
        }
        $requisitionItem->created_by = auth()->user()->id;
        $requisitionItem->save();

        // Delete previous RequisitionItem
        RequisitionItem::where('requisition_id', $requisitionItem->id)?->delete();

        foreach (json_decode($request->requisition_items) as $item) {

            $stock = Stock::where('item_id', $item->id)->first();

            if (!$stock ||  $stock->quantity < $item->quantity) {
                throw new Exception("Insufficient stock.");
            }

            $requisitionItem = new RequisitionItem();
            $requisitionItem->requisition_id    = $requisitionItem->id;
            $requisitionItem->item_id           = $item->id;
            $requisitionItem->quantity          = $item->quantity;
            $requisitionItem->save();
        }

        DB::commit();

        return $requisitionItem;
    }


    public function approve($requisitionItem)
    {
        $requisitionItem->is_approved = 1;
        $requisitionItem->save();

        return $requisitionItem;
    }


    public function reject($requisitionItem)
    {
        $requisitionItem->is_approved = 0;
        $requisitionItem->save();

        return $requisitionItem;
    }
}
