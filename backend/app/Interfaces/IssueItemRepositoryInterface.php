<?php

namespace App\Interfaces;

interface IssueItemRepositoryInterface
{
    public function store($requisitionItems);
    public function update($request, $issuedItem);
}
