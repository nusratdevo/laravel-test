<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\str;
use illuminate\support\Corbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\facades\Validator;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::all();
        return response()->json([
         'status'=>200,
         'bloglist'=>$blogs
        ]);
    }

       public function allblogs(){
        $blogs = Blog::where('status', 0)->get();
        return response()->json([
            'status'=>200,
            'bloglists'=>$blogs
        ]);
       }

       public function singleblog($slug){
        $singleblog = Blog::where('slug',$slug )->where('status',0)->first();
        if($singleblog){
            return esponse()->json([
                'status'=>200,
                'singleblog'=>$singleblog
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'blog not found'
            ]);
        }
       }


       public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
             'title'=>'reqired|max:919',
             'slug'=>'required|max:191',
             'body'=>'required',
             'iamge'=>'required|image|mimes:jpeg,jpg,png'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'error'=>$validator->messges
            ]);
        }else{
            $blog = new Blog;
            $blog->title = $data['title'];
            $blog->slug = Str::slug($data['slug'], '-');
            $blog->body = $data['body'];
            $blog->status = $data['status']==true?'1':'0';


            if($request->hasFile('image')){
                $temp_image = $equest-file('image');
                $filename = time(). '.' .$temp_image->getClintOriginalExtention();
                $location = ('blog/'.$filename );
                Image::make($temp_image)->resize(1000, 1600)->save($location);
                $blog->image = $location;

            }
            $blog->save();
            return respone()->json([
                'status'=>200,
                 'blog'=>$blog,
                 'message'=>'Addede successfully'

            ]);
        
        }
       }
}
