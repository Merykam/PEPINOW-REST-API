<?php

namespace App\Http\Controllers;
use App\Models\Plante;
use App\Models\Category;
use App\Http\Controllers\CategoryController;

use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index()
    {
        // $Plante=Plante::all();


        $Plante = Plante::select( 'Plantes.name', 'Plantes.description', 'Plantes.price', 'categories.name as categorie')
        	->join('categories', 'categories.id', '=', 'Plantes.category_id')
        	->get();
        return response()->json([
            "result"=>$Plante
        ]);
    }


    public function store(Request $request){
        $category = Category :: findOrFail($request->category_id);
        $plante = $category->plante()->create([

            'name'=> $request->name,
            'description'=> $request->description,
            'price'=> $request->price,
        ]

        );

        return response()->json([
            "result"=>$plante
        ]);
    }


    public function show($id){
        // $plant = Plante :: find($id);
        
        $Plante = Plante::select( 'Plantes.name', 'Plantes.description', 'Plantes.price', 'categories.name as categorie')
        	->join('categories', 'categories.id', '=', 'Plantes.category_id')
            ->where('Plantes.id', '=', $id)
        	->get();

        return response()->json([
            "result"=>$Plante
        ]);
    }
    
    // public function store(Category $Category, Request $request)
    // {
    //     $plante = $Category->plante()->create($request->all());
    //     return response()->json($plante, 201);
    // }

    // public function update(Request $request, Post $post, Comment $comment)
    // {
    //     $comment->update($request->all());
    //     return response()->json($comment);
    // }

    // public function destroy(Post $post, Comment $comment)
    // {
    //     $comment->delete();
    //     return response()->json(null, 204);
    // }
   
}
