<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;
use App\Http\Controllers\BaseController;
use App\Interfaces\SupplierRepositoryInterface;

class SupplierController extends BaseController
{
    public function __construct(private SupplierRepositoryInterface $supplierRepository)
    {
    }

    public function index()
    {
        try {
            return $this->sendResponse(Supplier::latest()->get(), 'All supplier data.');
        } catch (Exception $e) {

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }


    public function store(SupplierRequest $request)
    {
        try {
            return $this->sendResponse($this->supplierRepository->store($request), 'New supplier added successfully.', 201);
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function show($id)
    {
        if (!$supplier = Supplier::find($id)) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse($supplier, 'Single supplier data.');
        } catch (Exception $e) {

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }


    public function update(SupplierRequest $request, $id)
    {
        if (!$supplier = Supplier::find($id)) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse($this->supplierRepository->update($request, $supplier), 'Supplier update successfully.');
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }


    public function destroy($id)
    {
        if (!Supplier::find($id)?->delete()) {
            return $this->sendError('No record found.');
        }

        try {
            return $this->sendResponse('', 'Supplier deleted successfully.');
        } catch (Exception $e) {

            return $this->sendError('Internal server error.', $e->getMessage(), 500);
        }
    }
}
