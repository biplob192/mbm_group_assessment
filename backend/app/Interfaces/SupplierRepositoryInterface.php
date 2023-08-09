<?php

namespace App\Interfaces;

interface SupplierRepositoryInterface
{
    public function store($request);
    public function update($request, $supplier);
}
