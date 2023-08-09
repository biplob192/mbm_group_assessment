<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Interfaces\SupplierRepositoryInterface;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function store($request)
    {
        $supplier           = new Supplier();
        $supplier->name     = $request->name;
        $supplier->email    = $request->email;
        $supplier->phone    = $request->phone;
        $supplier->save();

        return $supplier;
    }


    public function update($request, $supplier)
    {
        if ($request->name) {
            $supplier->name   = $request->name;
        }
        if ($request->email) {
            $supplier->email   = $request->email;
        }
        if ($request->phone) {
            $supplier->phone   = $request->phone;
        }
        $supplier->save();

        return $supplier;
    }
}
