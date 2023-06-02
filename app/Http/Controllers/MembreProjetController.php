<?php

namespace App\Http\Controllers;

use App\Models\MembreProjet;
use App\Models\User;
use Illuminate\Http\Request;

class MembreProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function searchMembers(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $results = User::where('email', 'LIKE', '%' . $searchTerm . '%')
            ->get();

        // dd($results);

        return response()->json($results);
    }


    public function selectMember(Request $request)
    {
        $id = $request->id;

        $results = User::where('id', $id)->get();

        // dd($results);

        return response()->json($results);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MembreProjet $membreProjet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MembreProjet $membreProjet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MembreProjet $membreProjet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MembreProjet $membreProjet)
    {
        //
    }
}
