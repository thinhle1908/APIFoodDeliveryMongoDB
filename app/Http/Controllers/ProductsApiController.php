<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use  App\Http\Controllers\CategoryProductController;
use App\Models\Category;
use App\Models\Category_Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

use function Ramsey\Uuid\v1;

class ProductsApiController extends Controller
{
      /**
     * Get all product 
     * @OA\Get (
     *     path="/api/products",
     *     tags={"Product"},
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
    public function index()
    {
        $Products =  Product::where('visible', 1)->get();
        $data_category = [];
        foreach ($Products as $Product) {
            $data_category = $Product->categories;
            $img = $Product->image;
            $image = env('APP_URL') . Storage::url("app/apiDocs/" . $img);
            $Product->image =  $image;
            $Product->categories;
        }
        return response()->json([
            'Product' => $Products,

        ]);
    }
    /**
     * Add Product
     * @OA\Post (
     *     path="/api/products",
     *     tags={"Product"},
     *      security={{ "apiAuth": {} }},
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="image",
     *                     type="file",
     *                ),
     *                 @OA\Property(
     *                  description="name",
     *                     property="product_name",
     *                     type="string",
     *                     example = "ca loc nuong",
     *                ),
     *                 @OA\Property(
     *                     description="name",
     *                     property="price",
     *                     type="number",
     *                     example = 45000,
     *                ),
     *                 @OA\Property(
     *                     description="name",
     *                     property="qty",
     *                     type="number",
     *                     example = "1",
     *                ),
     *                 @OA\Property(
     *                     description="name",
     *                     property="description",
     *                     type="string",
     *                     example = "ca loc nuong la mot mon an thom ngon",
     *                ),
     *                 @OA\Property(
     *                     description="name",
     *                     property="arr_category",
     *                     type="string",
     *                     example = "5,6,9",
     *                ),
     *                 required={"image"}
     *             )
     *         )
     *     ),
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
    public function store(Request $request)
    {

        if (Gate::allows('admin-only', auth()->user())) {
            //Validate input value
            request()->validate([
                'product_name' => 'bail|required|string|max:255',
                'price' => 'bail|required|numeric',
                'image' => 'image|required',
                'qty' => 'required|numeric',
                'description' => 'bail|required|string',
                'arr_category' => 'required|string'
            ]);
            //Move Image to forder and get name image
            $request->file('image')->store('apiDocs');
            $file = $request->file('image');
            $nameimg = $file->hashName();

            //Create product 
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->image = $nameimg;
            $product->description = $request->description;
            $product->qty = $request->qty;
            $product->visible = 1;
             //Save in database
            $product->save();

            $arr_category = $request->input('arr_category');
            $arr_category = explode(',', $arr_category);
            $last_Product = Product::orderBy('product_id', 'desc')->take(1)->get();
            $categoryproductcontroller = new CategoryProductController();
           
            foreach ($arr_category as $key => $value) {
                $categoryproductcontroller->store($request, $product->getKey(), $value);
            }

            

            //Return new product
            return response()->json([
                "product_name" =>   $product->product_name,
                "price" =>   $product->price,
                "image" =>   $product->image,
                "description" =>   $product->description,
                "qty" =>   $product->qty,
            ]);
        } else {
            abort(403);
        }
    }
    /**
     * Update Product
     * @OA\Post (
     *     path="/api/products/{product}",
     *     description="...",
     *     tags={"Product"},
     *      security={{ "apiAuth": {} }},
     *       @OA\Parameter(
     *         name="product",
     *         in="path",
     *         description="product id",
     *         required=true,
     *      ),
     *   @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="image",
     *                     type="file",
     *                ),
     *                 @OA\Property(
     *                  
     *                     property="product_name",
     *                     type="string",
     *                     example = "ca loc nuong",
     *                ),
     *                 @OA\Property(
     *                     
     *                     property="price",
     *                     type="number",
     *                     example = 45000,
     *                ),
     *                 @OA\Property(
     *                     
     *                     property="qty",
     *                     type="number",
     *                     example = "1",
     *                ),
     *                 @OA\Property(
     *                     
     *                     property="description",
     *                     type="string",
     *                     example = "ca loc nuong la mot mon an thom ngon",
     *                ),
     *                 @OA\Property(
     *                     
     *                     property="arr_category",
     *                     type="string",
     *                     example = "5,6,9",
     *                ),
     *                  @OA\Property(
     *                     property="_method",
     *                     type="string",
     *                     example = "PUT",
     *                     
     *                    
     *                ),
     *                 required={"image"}
     *             )
     *         )
     *     ),
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
    public function update($id, Request $request)
    {
        if (Gate::allows('admin-warehouse_staff', auth()->user())) {
            //Validate input value
            request()->validate([
                'product_name' => 'bail|required|string|max:255',
                'price' => 'bail|required|numeric',
                'image' => 'image|required',
                'qty' => 'required|numeric',
                'description' => 'bail|required|string',
                'arr_category' => 'required|string'
            ]);
            //Delete Image
            $oldProduct = Product::find($id);
            $image_path = "../storage/app/apiDocs//" . $oldProduct->image;  // Value is not URL but directory file path
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            //Save image
            $request->file('image')->store('apiDocs');
            $file = $request->file('image');
            $nameimg = $file->hashName();

            //Update categories
            $arr_category = $request->input('arr_category');
            $arr_category = explode(',', $arr_category);
            $categoryproductcontroller = new CategoryProductController();
            $categoryproductcontroller->destroyByID($id, $request);
            foreach ($arr_category as $key => $value) {
                $categoryproductcontroller->store($request, $id, $value);
            }
            //Update product
            $success = $oldProduct->update([
                'product_name' => request('product_name'),
                'price' => request('price'),
                'image' => $nameimg,
                'qty' => request('qty'),
                'description' => request('description'),
            ]);
            return response()->json([
                'success' => $success
            ]);
        } else {
            abort(403);
        }
    }
     /**
     * Delete Product
     * @OA\Delete (
     *     path="/api/products/{product}",
     *     description="...",
     *     tags={"Product"},
     *      security={{ "apiAuth": {} }},
     *       @OA\Parameter(
     *         name="product",
     *         in="path",
     *         description="product id",
     *         required=true,
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="number", example="true"),
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
    public function destroy($id)
    {
        if (Gate::allows('admin-warehouse_staff', auth()->user())) {
            $product = Product::find($id);
            $success = $product->update([
                'visible' => 0
            ]);
            return response()->json([
                'success' => $success
            ]);
        } else {
            abort(403);
        }
    }
      /**
     * Search Product
     * @OA\Get (
     *     path="/api/search",
     *     tags={"Product"},
     * @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         required=true,
     *      ),
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
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $Products = Product::where('product_name', 'like', "%$keyword%")->orWhere('description', 'like', "%$keyword%")->where('visible', 1)->get();
        $data_category = [];
        foreach ($Products as $Product) {
            $data_category = $Product->categories;
            $img = $Product->image;
            $image = file_get_contents(storage_path("app\apiDocs\\" . $img));
            $Product->image =  base64_encode($image);
        }
        return response()->json([
            'Product' => $Products
        ]);
    }
       /**
     * Get product by id
     * @OA\Get (
     *     path="/api/products/{product}",
     *     tags={"Product"},
     * @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *      ),
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
    public function getProductByID(Product $product)
    {


        // foreach ($product->categories as $category) {
        //     var_dump($category->category_name);
        // }
        if ($product->visible == 1) {
            $img = $product->image;
            $image = file_get_contents(storage_path("app\apiDocs\\" . $img));
            //Call categories
            $product->categories;
            $img = $product->image;
            $image = file_get_contents(storage_path("app\apiDocs\\" . $img));
            $product->image =  base64_encode($image);
            return response()->json([
                'product' => $product

            ]);
        } else {
            abort(403);
        }
    }
    public function getImage(Product $product)
    {

        if (Gate::allows('admin-warehouse_staff', auth()->user())) {
            // $url = 'http://127.0.0.1:8000/api/products/image/4'; 
            // $image = file_get_contents(public_path('images/' . $product->image));
            $img = $product->image;
            $image = file_get_contents(public_path("images\\" . $img));
            return [
                'image' => base64_encode($image)
            ];
            //test
            // $img = $product->image; 
            // $image= public_path("images\\".$img);
            // $image.str_replace($image,"/",'\\');
            return response()->json([
                'image' => $image
            ]);
        } else {
            abort(403);
        }
    }
}
