<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status'=>'success','data'=>Employee::all()],200); 
    }

    
    public function store(Request $request)
    {
        $company = Company::find($request->company_id);
        if(empty($company)){
            return response()->json(['status'=>'company not found'],404);    
        }
        $ValidatedData = $request->validate(['first_name'=>'required|max:255','last_name'=>'required|max:255','company_id'=>'required|max:255','email'=>'email|required|unique:employees,email']);  
        Employee::create($ValidatedData);
        return response()->json(['status'=>'created'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $employee = Employee::find($id);
        if(empty($employee)){
            return response()->json(['status'=>'error'],404);    
        }
        return response()->json(['status'=>'success','data'=>$employee],200);
    }

    
    public function update(Request $request, $id)
    {
        $company = Company::find($request->company_id);
        $employee = Employee::find($id);
        if(empty($company)){
            return response()->json(['status'=>'company not found'],404);    
        }
        if(empty($employee)){
            return response()->json(['status'=>'employee not found'],404);    
        }
        $ValidatedData = $request->validate(['first_name'=>'required|max:255','last_name'=>'required|max:255','company_id'=>'required|max:255','email'=>'email|required|unique:employees,email,'.$employee->id]);  
        $employee->update(['first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email,'company_id'=>$request->company_id]);
        return response()->json(['status'=>'updated'],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if(empty($employee)){
            return response()->json(['status'=>'employee not found'],404);    
        }
        $employee->delete();
        return response()->json(['status'=>'deleted'],200);
    }
}
