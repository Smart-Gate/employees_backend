<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status'=>'success','data'=>Company::all()],200); 
          
    }

  


    public function store(Request $request)
    {
        $ValidatedData = $request->validate(['name'=>'required|max:255']);  
        Company::create($ValidatedData);
        return response()->json(['status'=>'created'],201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        if(empty($company)){
            return response()->json(['status'=>'error'],404);    
        }
        return response()->json(['status'=>'success','data'=>$company],200); 
    }

 

  
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        if(empty($company)){
            return response()->json(['status'=>'error'],404);    
        }
        $ValidatedData = $request->validate(['name'=>'required|max:255']);  
        $company->update(['name'=>$request->name]);
        return response()->json(['status'=>'updated'],201);

    }

 
    public function destroy($id)
    {
        $company = Company::find($id);
        if(empty($company)){
            return response()->json(['status'=>'error'],404);    
        }
        $company->delete();
        return response()->json(['status'=>'deleted'],200);
    }
}
