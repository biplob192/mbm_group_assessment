<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Requisition;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Http\Requests\RequisitionRequest;
use App\Interfaces\RequisitionRepositoryInterface;

class RequisitionController extends BaseController
{
    public function __construct(private RequisitionRepositoryInterface $requisitionRepository)
    {
    }

    public function index()
    {
        try {
            return $this->sendResponse($this->requisitionRepository->index(), 'All requisition data.');
        } catch (Exception $e) {

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }


    public function store(RequisitionRequest $request)
    {
        try {
            DB::beginTransaction();
            return $this->sendResponse($this->requisitionRepository->store($request), 'New requisition added successfully.', 201);
        } catch (Exception $e) {

            DB::rollBack();
            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function show($id)
    {
        if (!$requisitionItem = Requisition::find($id)) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse($requisitionItem, 'Single requisition data.');
        } catch (Exception $e) {

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }


    public function update(RequisitionRequest $request, $id)
    {
        if (!$requisitionItem = Requisition::find($id)) {
            return $this->sendError('No record found.');
        }

        try {
            DB::beginTransaction();
            return $this->sendResponse($this->requisitionRepository->update($request, $requisitionItem), 'Requisition item update successfully.');
        } catch (Exception $e) {

            DB::rollBack();
            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function destroy($id)
    {
        if (!Requisition::find($id)?->delete()) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse('', 'Requisition item deleted successfully.');
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function approve($id)
    {
        if (!$requisitionItem = Requisition::find($id)) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse($this->requisitionRepository->approve($requisitionItem), 'Requisition approved successfully.');
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function reject($id)
    {
        if (!$requisitionItem = Requisition::find($id)) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse($this->requisitionRepository->reject($requisitionItem), 'Requisition rejected successfully.');
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }
}
