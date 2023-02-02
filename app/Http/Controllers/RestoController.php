<?php

namespace App\Http\Controllers;

use App\Models\Resto;
use Illuminate\Http\Request;
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
        return Resto::all();
    }

    public function show(Resto $resto) {
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
        return Resto::create(
          $request->validated()
        );
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
}
