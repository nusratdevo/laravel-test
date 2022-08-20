<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\response;
use App\Models\Laracrud;

class LaracrudController extends Controller
{
    public function view(){
        return view('laracrud.index');
    }

    public function data(Request $request){
        $crud = Laracrud::latest()->paginate(5);
        return request::ajax()?
                        response()->json($curd, Response::HTTP_OK)
                        : abort(404);
    }

    public function store(Request $request){
      Laracrud::updateOrCreate(
        ['id'=>$request->id],
        [
            'name'=>$request->name,
            'address'=>$request->address
        ]);

      return response()->json(
        ['success'=>true,
        'message'=>'insert successfully'
        ]
    );
    }

    public function update($id){
     $data = Laracrud::find($id);
     return response()->json(['data'=>$data]);
    }

    public function destroy($id){
    $data = Laracrud::find($id);
    $data->delete();
    return response()->json(['message'=>'deleted successfully']);

    }
}
