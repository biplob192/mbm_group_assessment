<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Controllers\BaseController;
use App\Models\Item;

class ItemController extends BaseController
{
    public function index()
    {
        try {
            return $this->sendResponse(Item::latest()->get(), 'All item data.');
        } catch (Exception $e) {

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }

    // The others function not implemented as we used seeder to store the items.
}
