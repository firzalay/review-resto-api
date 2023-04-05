<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRestoRequest;
use App\Http\Requests\UpdateRestoRequest;

class RestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Resto::latest()->get();
    }

    public function show(Resto $resto)
    {
        return $resto;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRestoRequest $request)
    {
        //TODO : Make relationship within resto and user 
        $validatedData = $request->validated();
        $validatedData['image'] = $request->file('image')->store('resto-image','public');
        
        $data = Resto::create($validatedData);

        return response($data);

        
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestoRequest  $request
     * @param  \App\Models\Resto  $resto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestoRequest $request, Resto $resto)
    {
        $resto->update($request->validated());

        return $resto->refresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resto  $resto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resto $resto)
    {

        $resto->delete();

        return $resto;
    }

    public function reviews(Resto $resto)
    {
        return $resto->reviews->load('user');
    }



    
}
