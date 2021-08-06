<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use DB;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('employees')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Employees::create([
            'name'       => $request->name,
            'country'    => $request->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function filterdata(Request $request)
    {
        if($request->name == '' || $request->id == ''){
            if($request->name == ''){
                return DB::table('employees')->where('country', $request->id)->get();
            }
            if($request->id == ''){
                return DB::table('employees')->where('name', 'like', '%' . $request->name . '%')->get();
            }
        }else{
            return DB::table('employees')->where('name', 'like', '%' . $request->name . '%')->where('country', $request->id)->get();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array(
            'name'      => $request->name,
            'country'   => $request->id,
        );
        return DB::table('employees')->where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DB::table('employees')->where('id', $id)->delete();
    }
}
