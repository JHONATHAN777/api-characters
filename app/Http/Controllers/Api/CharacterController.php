<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;







class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get()
    {
        

            $characters = Character::all();
            return $characters;
     
    }

    public function edit($id)
    {

            $character = Character::findOrFail($id);
            return    response()->json($character);

    }

    /**
     * Store a newly created resource in storage.
     */
    

     
     public function create(Request $request)
     {  
         $character =new Character();
         $request->validate([
            
             'name' => 'required',
             'status' => 'required', 
             'species' => 'required',
             'type' => 'required',
             'gender' => 'required',
             'origin' => 'required', 
             'location' => 'required', 
             'image' => 'required|image|mimes:png,svg,avg,jpg|max:1024',
             'episode' => 'required',
             'url' => 'required',
             'created' => 'required'
         ], );

         //CAPTURA EL NOMBRE DEL ARCHIVO
         $filename="";
         

         if($request->hasFile('image')){
            $filename=$request->file('image')->store('post','public');
         }else{
            $filename = null;
         }

         $character->name = $request->name;
         $character->status = $request->status;
         $character->species = $request->species;
         $character->type = $request->type;
         $character->gender = $request->gender;
         $character->origin = $request->origin;
         $character->location = $request->location;
         $character->image = ("/storage/").$filename;
         $character->episode = $request->episode; 
         $character->url = $request->url;
         $character->created = $request->created;
         $result = $character->save();

         if($result){
            
            return $character;
         }else{
            return response()->json(['success' =>false]);
         }

     }

     

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $character = Character::find($id);
        return $character;
    }

    /**
     * Update the specified resource in storage.
     */
    

    // ...

    
    public function update(Request $request, $id)
    {
    $character = Character::findOrFail($id);

    $destination=public_path("storage\\".$character->image);
    $filename="";
    if($request->hasFile('image')){
        if(File::exists($destination)){
            File::delete($destination);
        }

        $filename=$request->file('image')->store('posts','public');
    }else{
        $filename=$request->image;
    }

    // Actualizar los campos del personaje
    $character->name=$request->name;
    $character->status=$request->status;
    $character->species=$request->species;
    $character->type=$request->type;
    $character->gender=$request->gender;
    $character->origin=$request->origin;
    $character->location=$request->location;
    $character->image=$filename;
    $character->episode=$request->episode; 
    $character->url=$request->url;
    $character->created=$request->created;

    // Guardar los cambios en la base de datos
    $result = $character->save();

    if($result){
        return response()->json(['success'=>true]);
    }else{
        return response()->json(['success'=>false]);
    }
}
    
    

 

    

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $character = Character::find($request->id);
    
        if (!$character) {
            return response()->json(['success' => false, 'message' => 'Character not found'], 404);
        }
    
        // Eliminar la imagen asociada si existe
        if ($character->image) {
            Storage::disk('public')->delete($character->image);
        }
    
        $result = $character->delete();
    
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
    
}
