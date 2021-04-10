<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\User;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $roles = Role::all();
        return response()->json([
            'roles'=>$roles
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRole(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'role'=>'required'
        ]);

        $data = Role::create([
            'name' => $request['name'],
            'user_id' => Auth::user()->id,
            'role' => $request['role']
        ]);

        return response()->json([
            'data'=>$data,
            'message'=>"success"
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->user_id = $request['user_id'];
        $role->name = $request['name'];
        $role->role = $request['role'];
        $role->save();
        return response()->json([
            'role'=>$role,
            'message'=>"success"
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return response()->json([
            'role'=>$role,
            'message'=>"success"
        ],200);

    }
}
