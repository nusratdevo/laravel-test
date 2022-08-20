<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
  public function index(Product $product){
    return ReviewResource::collection($product->review);
  }
     public function store (Product $product, RequestReview $request){
      $review = new Review($request->all());
      $product->$reviews()->save($review);
      return response([
         'data'=>new ReviewResource($review)
      ], Response::HTTP_CREATED);
     }

     public function update(Product $produt, Request $request){
        $review->update($request->all());

     }

     public function destroy(Product $product, Review $review){
        $review->delete();
        return response(null, Response::HTTP_NO_CONTENT);
     }
 

}
