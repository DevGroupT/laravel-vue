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
            'firstname'         => $request->firstname,
            'lastname'          => $request->lastname,
            'middlename'        => $request->middlename,
            'address'           => $request->address,
            'department_id'     => $request->department_id,
            'city_id'           => $request->city_id,
            'state_id'          => $request->state_id,
            'country_id'        => $request->country_id,
            'zip'               => $request->zip,
            'birthday'          => $request->birthday,
            'date_hired'        => $request->date_hired,
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
        $firstname = $request->get('firstname', '');
        $lastname = $request->get('lastname', '');
        $department_id = $request->get('department_id', '');
        $employees = Employees::where('firstname', 'like', "%$firstname%")->where('lastname', 'like', "%$lastname%");
        if($department_id) {
            $employees = $employees->where('department_id', $department_id);
        }

        return $employees->get();
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
            'firstname'         => $request->firstname,
            'lastname'          => $request->lastname,
            'middlename'        => $request->middlename,
            'address'           => $request->address,
            'department_id'     => $request->department_id,
            'city_id'           => $request->city_id,
            'state_id'          => $request->state_id,
            'country_id'        => $request->country_id,
            'zip'               => $request->zip,
            'birthday'          => $request->birthday,
            'date_hired'        => $request->date_hired,
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
