<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Requisition;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\BaseController as BaseController;

class RequisitionCanDelete extends BaseController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requisitionItem = Requisition::find($request->route()->id);

        if ($requisitionItem->is_approved) {
            return $this->sendError('Approved requisition cannot be modified.');
        }

        return $next($request);
    }
}
