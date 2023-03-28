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

    public function update(Request $request, Plante $Plante)
    {
        $this ->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'category_id'=>'required'
        ]);

        $Plante->update([
            'name'=> $request->name,
            'description'=> $request->description,
            'price'=> $request->price,
            'category_id'=> $request->category_id


        ]);
        return response()->json($Plante);
    }
    
    public function destroy(Plante $Plante)
    {
        $Plante->delete();
        return response()->json(
            [
                'message'=>'plante deleted succefully'
            ]
        );
    }

    public function filterByCategory($category)
    {
        
            // Filter by category name
        $plant = Plante::join('categories', 'Plantes.category_id', '=', 'categories.id')
                    ->select('Plantes.*', 'categories.name as category')
                    ->where('categories.name', $category)
                    ->get();
        

       

        return response()->json($plant, 200);
    }
    
   
}
