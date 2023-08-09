<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\IssuedItem;
use App\Models\ReceivedItem;
use App\Models\RequisitionItem;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IssueItemRequest;
use App\Http\Controllers\BaseController;
use App\Interfaces\IssueItemRepositoryInterface;

class IssuedItemController extends BaseController
{
    public function __construct(private IssueItemRepositoryInterface $issueItemRepository)
    {
    }

    public function index()
    {
        try {
            return $this->sendResponse(IssuedItem::latest()->get(), 'All issue item data.');
        } catch (Exception $e) {

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }


    public function store(IssueItemRequest $request)
    {
        $requisitionItems = RequisitionItem::where('requisition_id', $request->requisition_id)->get();

        if (!$requisitionItems->isNotEmpty()) {
            return $this->sendError('No record found.');
        }

        try {
            DB::beginTransaction();


            return $this->sendResponse($this->issueItemRepository->store($requisitionItems), 'New requisition item issued successfully.', 201);
        } catch (Exception $e) {

            DB::rollBack();
            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }



    public function show($id)
    {
        if (!$issuedItem = IssuedItem::find($id)) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse($issuedItem, 'Single issueed item data.');
        } catch (Exception $e) {

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }


    public function update(IssueItemRequest $request, $id)
    {
        if (!$issuedItem = IssuedItem::find($id)) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse($this->issueItemRepository->update($request, $issuedItem), 'Issued item update successfully.');
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function destroy($id)
    {
        if (!IssuedItem::find($id)?->delete()) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse('', 'Issued item deleted successfully.');
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }
}
