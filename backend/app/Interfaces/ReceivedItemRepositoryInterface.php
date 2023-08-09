<?php

namespace App\Interfaces;

interface ReceivedItemRepositoryInterface
{
    public function store($request);
    public function multipleStore($request);
    public function update($request, $receivedItem);
}
