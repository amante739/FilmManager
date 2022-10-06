<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles=Role::all();
        return response()->json([
            'status'=>true,
            "message"=>"Genre List",
            "data"=>$roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $role_data=$request->all();

        $validator=Validator::Make($role_data,[
            'name'=>'require'
        ]);
        if($validator->fails()){
            return response->json([
                'status'=>false,
                'message'=>'Invalid Input',
                'error'=>$validator->errors()
            ]);
        }

        $role_data=Genre::Create($role_data);
        return response()->json([
            "status" => true,
            "message" => "Role created successfully.",
            "data" => $role_data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
        if(is_null($role))
        {
            return response()->json([
                'status' => false,
                'message' => 'role not found'
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Genre found',
            'data'=>$role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //

        $role_data=$request->all();

        $validator=Validator::make($role_data,[
            'name'=>'required',
        ]);
        if($validator->fails()){
            
            return response->json([
                'status'=>false,
                'message'=>'Input is invalid',
                'error'=>$validator->errors()
            ]);
        }

        $role->name=$role_data['name'];

        $role->save();
        return response->json([
            'status'=>true,
            'message'=>'role updated',
            'data'=>$role
        ],200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        $role=$role->delete();
       
        return response()->json([
            "status" => true,
            "message" => "role deleted successfully.",
            "data" => $role
        ]);
    }
}
