<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class CheckoutApiController extends Controller
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
    /**
     * Checkout
     * @OA\Post (
     *     path="/api/checkout",
     *     tags={"Check Out"},
     *     security={{ "apiAuth": {} }},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="address",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="phone",
     *                          type="number"
     *                      ),
     *                 @OA\Property(
     *                   property="cart",
     *                   type="array",
     *                   @OA\Items(
     *                      @OA\Property(property="id", type="number"),
     *                      @OA\Property(property="qty", type="number"),
     *                      @OA\Property(property="price", type="number"),
     *                      ),
     *    )
     *                 ),
     *                 example={
     *                     "name":"example name",
     *                     "email":"examplecontent1@gmail.com",
     *                     "address":"256,Nguyen Thi Minh Khai",
     *                     "phone":"0123456789",
     *                     "cart":{"0":{"product":{"id":3,"quanlity":1,"price":50000}},"1":{"product":{"id":5,"quanlity":2,"price":40000}},"2":{"product":{"id":6,"quanlity":5,"price":100000}}}
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="message",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="number", example="success"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(
     *              @OA\Property(property="erros", type="string", example="The The email field is required."),
     *          )
     *      )
     * )
     */
    public function store(Request $request)
    {
        if (Gate::allows('check-login', auth()->user())) {
            request()->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'address' => 'required|string|max:255',
                'phone' => 'required|numeric',
                'cart' => 'required|array',
            ]);
            //Calculate total product value
            $totalPrice = 0;
            //Get cart 
            $cart = $request->cart;
            foreach ($cart as $value) {
                $totalPrice += $value['product']['price'];
            }
            //Create order
            $order = new Order();
            $order->customer_stripe_id = -1;
            $order->user_id = auth()->user()->id;
            $order->name = $request->name;
            $order->address = $request->address;
            $order->phone = $request->phone;
            $order->email = $request->email;
            $order->note = '...';
            $order->total = $totalPrice;
            $order->order_status = 1;
            $order->save();
            //Create order details
            foreach ($cart as $value) {
                $order_details = new OrderDetail();
                $order_details->order_id = $order->id;
                $order_details->product_id = $value['product']['id'];
                $order_details->qty = $value['product']['quanlity'];
                $order_details->price = $value['product']['price'];
                $order_details->save();
            }

            //View cart
            // return response()->json([
            //     'cart' =>  $request->cart,

            // ]);
            return response()->json([
                'message' =>  'success',

            ]);
        } else {
            abort(403);
        }
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
}
