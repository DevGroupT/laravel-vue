<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use Illuminate\Http\Request;
use DB;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('cities')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Cities::create([
            'name'       => $request->name,
            'state'      => $request->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function filterdata(Request $request)
    {
        if($request->name == '' || $request->id == ''){
            if($request->name == ''){
                return DB::table('cities')->where('state', $request->id)->get();
            }
            if($request->id == ''){
                return DB::table('cities')->where('name', 'like', '%' . $request->name . '%')->get();
            }
        }else{
            return DB::table('cities')->where('name', 'like', '%' . $request->name . '%')->where('state', $request->id)->get();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array(
            'name'      => $request->name,
            'state'     => $request->id,
        );
        return DB::table('cities')->where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return DB::table('cities')->where('id', $id)->delete();
    }
}
