<?php

namespace App\Http\Controllers;

use App\Models\Resto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('restos', 'name'),
            ],
            'description' => [
                'nullable',
                'string',
                'max:750'
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048'
            ],
            'address' => [
                'string',
                'required',
                'max:750'
            ],
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('resto-image');
        }

        Resto::create($validatedData);
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
