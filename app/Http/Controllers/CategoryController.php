<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return response()->json($this->categorydata($categories));
    }

    public function categorydata($categories){
        $data = [];

        foreach($categories as $category){

            $data[]=$category->name;
           


        }
        return $data;

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
        $this ->validate($request,[
            'name'=>'required'
        ]);

        $category = Category::create([
            'name'=>$request->name


        ]);
        return response()->json($category);
        // return response()->json([
        //     'status'=>true,
        //     'categ'=>$category
        // ],400);
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        
        $data=$category->name;
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $this ->validate($request,[
            'name'=>'required'
        ]);

        $category->update([
            'name'=>$request->name


        ]);
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->delete();
        return response()->json(
            [
                'message'=>'category deleted succefully'
            ]
        );
    }
}
