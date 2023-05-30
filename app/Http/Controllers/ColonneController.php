<?php

namespace App\Http\Controllers;

use App\Models\Colonne;
use Illuminate\Http\Request;

class ColonneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Colonne $colonne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colonne $colonne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Colonne $colonne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colonne $colonne)
    {
        //
    }
}
