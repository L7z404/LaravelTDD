<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'url'=>'required',
            'descripcion'=>'required',
        ]);
        
        $request->user()->repositories()->create($request->all());
        return redirect()->route('repositories.index');
    }
    
    public function update(Request $request, Repository $repository){
        $request->validate([
            'url'=>'required',
            'descripcion'=>'required',
        ]);
        
        $repository->update($request->all());
        
        //dd($repository);
        
        return redirect()->route('repositories.edit', $repository);
    }
    
    public function destroy(Repository $repository){
        
        $repository->delete();
        
        return redirect()->route('repositories.index');
    }
}
