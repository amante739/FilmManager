<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Validator;
use Illuminate\Support\Facades\DB;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $genres=Genre::all();
        return response()->json([
            'status'=>true,
            "message"=>"Genre List",
            "data"=>$genres
        ]);
       /* return response()->json([
            "status" => true,
            "message" => "Genre LIst.",
            "data" => $genres
        ]);*/
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
        $data=$request->all();

        $validator=Validator::make($data,[
            'name'=>'required'
        ]);

        if($validator->fails()){
            return response->json([
                'status'=>false,
                'message'=>'Invalid Input',
                'error'=>$validator->errors()
            ]);
        }

        $genre=Genre::Create($data);
        return response()->json([
            "status" => true,
            "message" => "Genre created successfully.",
            "data" => $genre
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        //
        if(is_null($genre))
        {
            return response()->json([
                'status' => false,
                'message' => 'Genre not found'
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Genre found',
            'data'=>$genre
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, Genre $genre)
    {
        //
        $data=$request->all();

        $validator=Validator::make($data,[
            'name'=>'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Invalid Inputs',
                'error' => $validator->errors()
            ]);      
        }

        $genre->name=$data['name'];
        $genre->save();

        return response()->json([
            "status" => true,
            "message" => "Genre updated successfully.",
            "data" => $genre
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        //
        $genre->delete();
        return response()->json([
            "status" => true,
            "message" => "Genre deleted successfully.",
            "data" => $genre
        ]);
    }
}
