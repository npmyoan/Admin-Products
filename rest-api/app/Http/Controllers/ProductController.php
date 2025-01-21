<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
* @OA\Info(
*             title="Api Administración de productos",
*             version="1.0",
*             description="Crud de porductos"
* )
*
* @OA\Server(url="http://localhost:8000")
*/
class ProductController extends Controller
{
   /**
     * Products List
     * @OA\Get (
     *     path="/api/products",
     *     tags={"Products"},
     *     @OA\Response(
     *         response=200,
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Monitor"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="number",
     *                         example="23.4"
     *                     ),
     *                     @OA\Property(
     *                         property="availability",
     *                         type="boolean",
     *                         example="true"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2023-02-23T00:09:16.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'data' => $products
        ]);
    }

    /**
     * ADD Products
     * @OA\POST (
     *     path="/api/products",
     *     tags={"Products"},
     *      @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
    *      @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Product's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="price",
     *         in="query",
     *         description="Product's price",
     *         required=true,
     *         @OA\Schema(type="number")
     *     ),

     *     @OA\Response(
     *         response=200,
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Monitor"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="number",
     *                         example="23.4"
     *                     ),
     *                     @OA\Property(
     *                         property="availability",
     *                         type="boolean",
     *                         example="true"
     *                     ),
     *
     *                 )
     *             )
     *         )
     *     )
     * )

     */
    public function store(Request $request)
    {

       $product = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);
        $product = Product::create($product);
        return response()->json([
            'data' => $product,
        ], 201);
    }


 /**
     * Mostrar la información de un producto
     * @OA\Get (
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Monitor"),
     *              @OA\Property(property="price", type="number", example="3.45"),
     *              @OA\Property(property="availability", type="boolean", example="true"),
     *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
     *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="NOT FOUND",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Cliente] #id"),
     *          )
     *      )
     * )
     */
    public function show(Product $product)
    {
        return response()->json([
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $productValidate = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            "availability"=> 'required'
        ]);

        $product = $product->update( $productValidate);
        return response()->json([
            'data' => $product,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }

    public function updateAvailability(Request $request, Product $product)
    {
        $product->availability = !$product->availability;
        $product->save();

        return response()->json([
            'data' => $product,
        ]);
    }
}
