<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AccountApiController extends Controller
{
      /**
     * Get user by user
     * @OA\Get (
     *     path="/api/user",
     *     tags={"User"},
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
    public function getUserAccount()
    {
        if (Gate::allows('check-login', auth()->user())) {
            return response()->json([
                'user' =>  auth()->user(),

            ]);
        }
        else{
            abort(403);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    /**
     * Update user
     * @OA\Put (
     *     path="/api/user",
     *     tags={"User"},
     *      security={{ "apiAuth": {} }},
     *       @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *      ),
     *      @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=true,
     *      ),
     *      @OA\Parameter(
     *         name="password",
     *         in="query",
     *         required=true,
     *      ),
     *      @OA\Response(
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
    public function update(Request $request)
    {
        $user =  User::find(auth()->user()->id);
        if ($user != 'null') {
            request()->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'password'=>'required|min:6',

            ]);
            $success = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password'=>bcrypt($request->password),
            ]);
            return response()->json([
                'success' => $success

            ]);
        } else {
            abort(403);
        }
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
