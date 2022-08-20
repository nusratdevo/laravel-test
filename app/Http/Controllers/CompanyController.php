<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller 
{
    public function view(){
        return view('company.index');
    }

    public function get_company_data(Request $request){
       $companies = Company::latest()->paginate(5);
       return Request::ajax()? 
                        response()->json($company,Response::HTTP_OK)
                        :abort(404);
    }
     public function Store(Request $request){
        Company::updateOrCreate(
         ['id'=>$request->id],
         ['name'=>$request->name, 'address'=>$request->address]
        );
        return response()->json(
         ['success'=>true, 'message'=>'Data Inserted']
        );
     }
      public function update($id){
        $company = Company::find($id);
        return response()->json(['data'=>$company]);
      }

      public function destroy($id){
        $company = Company::find($id);
        $company->delete();
        return response()->json(['message'=>'Data Deleted']);
      }

}