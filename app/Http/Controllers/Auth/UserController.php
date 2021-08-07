<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Get authenticated user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function current(Request $request)
    {
        return response()->json($request->user());
    }

    public function getAllUsers(Request $request)
    {
        $username = $request->get('username', '');
        $email = $request->get('email', '');
        $users = User::where('username', 'like', "%$username%")->where('email', 'like', "%$email%")->get();
        return response()->json([
            "success" => true,
            "users" => $users
        ]);
    }
    public function createUser(Request $request)
    {
        User::create([
            'username'  => $request->username,
            'firstname'  => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'password' => bcrypt($data['password']),
        ]);
        return response()->json([
            "success" => true,
        ]);
    }
    public function updateUser(Request $request)
    {
        $id = $request->id;
        $data = array(
            'username'    => $request->username,
            'email'       => $request->email,
        );
        return User::where('id', $id)->update($data);
    }
    public function updateRole(Request $request)
    {
        $id = $request->id;
        $data = array(
            'role' => $request->role
        );
        return User::where('id', $id)->update($data);
    }
    public function updatePermission(Request $request)
    {
        $id = $request->id;
        $data = array(
            'permission' => $request->permission
        );
        return User::where('id', $id)->update($data);
    }
    public function deleteUser(Request $request)
    {
        $id = $request->id;
        return User::where('id', $id)->delete();
    }
}