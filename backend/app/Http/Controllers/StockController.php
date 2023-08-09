<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Controllers\BaseController;
use App\Models\Stock;

class StockController extends BaseController
{
    public function index()
    {
        try {
            return $this->sendResponse(Stock::with(['item'])->latest()->get(), 'All stock item data.');
        } catch (Exception $e) {

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }

    // The others function not implemented.
}
