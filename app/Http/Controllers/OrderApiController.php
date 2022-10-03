<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Get order suscess by admin
     * @OA\Get (
     *     path="/api/orders",
     *     tags={"Order"},
     *      security={{ "apiAuth": {} }},
     *       @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="number", example="true"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Error",
     *          @OA\JsonContent(
     *              @OA\Property(property="erros", type="string", example="Forbidden"),
     *          )
     *      )
     * )
     */
    public function getAllOrderByAdmin()
    {
        if (Gate::allows('admin-only', auth()->user())) {
            $orders = Order::where('order_status', 1)->get();
            return response()->json(['orders' => $orders]);
        } else {
            abort(403);
        }
    }
    /**
     * Change order status
     * @OA\Get (
     *     path="/api/change-order-status",
     *     tags={"Order"},
     *      security={{ "apiAuth": {} }},
     *       @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="number", example="true"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Error
     *          @OA\JsonContent(
     *              @OA\Property(property="erros", type="string", example="Forbidden"),
     *          )
     *      )
     * )
     */
    public function changeStatus(Request $request)
    {
        if (Gate::allows('admin-only', auth()->user())) {
            request()->validate([
                'order_id' => 'required',
                'order_status' => 'required|integer|between:1,4'
            ]);
            $order = Order::find( $request->order_id);
            if (!empty($order)) {
                $message = $order->update([
                    'order_status' => $request->order_status
                ]);
                return response()->json(['message' => $message]);
            } else {
                return response()->json(['message' => "ID Not found"]);
            }
        } else {
            abort(403);
        }
    }
}
