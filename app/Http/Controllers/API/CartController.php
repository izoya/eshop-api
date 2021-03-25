<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends BaseController
{

    public function addToCart(Request $request): JsonResponse
    {
        $input = $request->all();

        FormRequest::capture();

        $validator = Validator::make($input, [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $cart = session('cart');
        $item = $cart[$input['product_id']] ?? [];

        if (!empty($item)) {
            $item['quantity'] += $input['quantity'];
        } else {
            $item['quantity'] = $input['quantity'];
        }
        $cart[$input['product_id']] = $item;
        session(['cart' => $cart]);

        return $this->sendResponse($cart, 'Product added successfully.');
    }

    public function updateCartItem(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $cart = session('cart');
        if ($input['quantity'] === 0) {
            unset($cart[$input['product_id']]);
        } else {
            $cart[$input['product_id']]['quantity'] = $input['quantity'];
        }
        session(['cart' => $cart]);

        return $this->sendResponse($cart, 'Product updated successfully.');
    }

    public function removeFromCart(int $id): JsonResponse
    {
        if (!is_numeric($id)) {
            return $this->sendError('Validation Error.');
        }

        $cart = session('cart');
        unset($cart[$id]);
        session(['cart' => $cart]);

        return $this->sendResponse($cart, 'Product removed successfully.');
    }
}
