<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemCon extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item= Item::all();
        return response()->json(['code'=>200, 'message'=>'data fetched', 'data'=>$item],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'name'=>'required',
            'price'=>'required',
            'uom'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['code'=>422,'errors'=>$validator->errors()],422);
        }
        $data= $request->all();
        Item::create($data);
        return response()->json(['code'=>201, 'message'=>'Inserted Successfully','data'=>$data],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item=Item::find($id);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator= Validator::make($request->all(),[
            'name'=>'required',
            'price'=>'required',
            'uom'=>'required',
        ]);
        $item=Item::find($id);
        if(!$item){
            return response()->json(['message'=>'item not found'],404);
        }
        if($validator->fails()){
            return response()->json(['code'=>422,'errors'=>$validator->errors()],422);
        }
        $item->update($request->all());
        return response()->json(['code'=>200,'message'=>'updated successfully','data'=>$item,],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
