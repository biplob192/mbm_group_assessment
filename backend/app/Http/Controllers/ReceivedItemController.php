<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\ReceivedItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Http\Requests\MultipleReceivedItemRequest;
use App\Http\Requests\ReceivedItemRequest;
use App\Interfaces\ReceivedItemRepositoryInterface;

class ReceivedItemController extends BaseController
{
    public function __construct(private ReceivedItemRepositoryInterface $receivedItemRepository)
    {
    }

    public function index()
    {
        try {
            return $this->sendResponse(ReceivedItem::latest()->get(), 'All received item data.');
        } catch (Exception $e) {

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }


    public function store(ReceivedItemRequest $request)
    {
        try {
            DB::beginTransaction();
            return $this->sendResponse($this->receivedItemRepository->store($request), 'New received item added successfully.', 201);
        } catch (Exception $e) {

            DB::rollBack();
            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function multipleStore(MultipleReceivedItemRequest $request)
    {
        try {
            DB::beginTransaction();
            return $this->sendResponse($this->receivedItemRepository->multipleStore($request), 'New received items added successfully.', 201);
        } catch (Exception $e) {

            DB::rollBack();
            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function show($id)
    {
        if (!$receivedItem = ReceivedItem::find($id)) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse($receivedItem, 'Single received item data.');
        } catch (Exception $e) {

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }


    public function update(ReceivedItemRequest $request, $id)
    {
        if (!$receivedItem = ReceivedItem::find($id)) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse($this->receivedItemRepository->update($request, $receivedItem), 'Received item update successfully.');
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function destroy($id)
    {
        if (!ReceivedItem::find($id)?->delete()) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse('', 'Received item deleted successfully.');
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }
}
