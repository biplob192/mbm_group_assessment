<?php

namespace App\Interfaces;

interface RequisitionRepositoryInterface
{
    public function index();
    public function store($request);
    public function update($request, $requisitionItem);
    public function approve($requisitionItem);
    public function reject($requisitionItem);
}
