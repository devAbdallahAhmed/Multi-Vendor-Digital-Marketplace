<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Orders\AuthorSalesResource;
use App\Http\Resources\Api\Orders\OrdersResource;
use App\Services\PurchaseItemServices;
use Illuminate\Http\Request;

use App\Traits\ApiResponseTrait;

class OrderController extends Controller
{
    use ApiResponseTrait;

    protected $purchaseItemServices;

    function __construct(PurchaseItemServices $purchaseItemServices)
    {
        $this->purchaseItemServices = $purchaseItemServices;
    }
    public function index()
    {

        $data = $this->purchaseItemServices->getALLPurchase();
        return $this->successResponse(
            'Show All Purchases',
            OrdersResource::collection($data['orders'])
        );
    }

    public function show($id)
    {
        $data = $this->purchaseItemServices->ShowSingleOrder($id);
        return  $this->successResponse('Show Single Item Purchase', $data);
    }

    public function sales()
    {

        $data = $this->purchaseItemServices->salesService();
        if (!$data) {
            return $this->errorResponse('Unauthorized');
        }
        return $this->successResponse('All Author Sales', AuthorSalesResource::collection($data));
    }
}
