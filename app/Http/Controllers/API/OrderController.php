<?php

namespace App\Http\Controllers\API;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $orders = Order::whereUserId($request->user()->id)->get();
        return $this->sendResponse($orders, 'Orders retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'user_id' => 'nullable|integer|exists:users,id',
            'phone' => 'nullable|required_if:user_id,null|string',
            'email' => 'nullable|required_if:user_id,null|email',
            'shipment_info' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if ($input['user_id']) {
            $user = User::find($input['user_id']);
            $input['phone'] = $input['phone'] ?? $user->phone;
            $input['email'] = $input['email'] ?? $user->email;
        }

        $cart = Session::get('cart');

        if (empty($cart)) {
            return $this->sendError('Cart is empty.');
        }

        $input['amount'] = 0;
        foreach ($cart as $id => $item) {
            $input['amount'] += $item['quantity']
                * (new Product)->getPriceOf($id);
        }

        $order = new Order();
        $order->fill($input);

        try {
            $order->save();
            $order->products()->attach($cart);
        }
        catch (QueryException $e) {
            return $this->sendError('Database Error.', $e->getMessage());
        }

        Session::forget('cart');

        return $this->sendResponse($order, 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

