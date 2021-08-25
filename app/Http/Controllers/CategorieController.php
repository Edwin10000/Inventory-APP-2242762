<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }
    function show(){
        $categorieList = Categorie::all();
        return view('categorie/listCategorie',['listCategorie'=>$categorieList]);
    }
    function delete($id){
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect('/categories')->with('message' , 'Categoria borrada');
    }
    function form ($id = null){
        $categorie = new Categorie();
        if ($id != null ) {
            $categorie = Categorie::findOrFail($id);
        }
        return view('categorie/formCategorie', ['categorie' => $categorie]);
    }
    function save(Request $request){

        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:50'
        ]);

        $categorie = new Categorie();
        $message = 'Se ha creado una nueva Categoria';

        if (intval($request->id)>0){
            $categorie = Categorie::findOrFail($request->id);
            $message = 'Se ha Editado la Categoria';
        }

        $categorie->categorie = $request->categorie;

        $categorie->save();
        return redirect('/categories')->with('messa' , $message);

    }
}
