<?php

namespace App\Http\Controllers\API;


use App\Http\Services\Filters\ProductFilter;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $filter = new ProductFilter($request);
        $validator = Validator::make($request->all(), $filter->getValidationRules());

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $filter = new ProductFilter($request);
        $products = Product::with('attributes')->filter($filter)->get();

        return $this->sendResponse($products, 'Products retrieved successfully.');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return JsonResponse
     */
    public function show(Product $product)
    {
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse($product, 'Product retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
