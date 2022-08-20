<?php


namespace  App\Http\Controllers;
use Symfony\Component\HttpFoundation\response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;


class ProductController extends Controller 
{
   public function __construct(){
      $this->middleware('auth:api')->axcept('index', 'show');
   }

   public function index(){
    return ProductCollection::collection(Product::paginate(5));
   }

   public function store(ProductRequest $request){
    $product = new product;
    $product->name = $request->name;
    $product->detail = $request->description;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->discount = $request->discount;
    $product->save();

    return response([
        'data'=>new ProductResource($product)
    ],Response::HTTP_CREATED);

   }

   public function show( Product $product){
    return new ProductResource($product);
   }
 

public function update(Product $product, Request $request){
    $this->userAuthorized($product);

    $request['detail'] = 
    $request->description;
    unset($request['description']);
    $product->update($request->all());
    return response([
        'data'=>new ProductResource($product)
    ], Response::HTTP_CREATED);

}

public function destroy(Product $product){
    $product->delete();
    return response(nul, Response::HTTP_NO_CONTENT);
}




}