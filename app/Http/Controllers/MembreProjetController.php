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
        $idMembres = $request->idMembres;
        $projet_id = $request->projet_id;

        MembreProjet::create([
            'projet_id' =>  $projet_id,
            'user_id' => $idMembres,
            'role' => 'Membre'
        ]);

        // Récupérer les membres du projet
        $membres = User::join('membre_projets', 'users.id', '=', 'membre_projets.user_id')
            ->join('projets', 'membre_projets.projet_id', '=', 'projets.id')
            ->where('projets.id',  $projet_id)
            ->select('users.id', 'users.name')
            ->get();


        // Envoyer une réponse de succès si nécessaire
        return response([
            'membres' => $membres,
            'success' => 'Un membre ajouté avec succès.'
        ]);
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
    public function destroy(Request $request)
    {
        $idMembres = $request->idMembres;
        $projet_id = $request->projet_id;

        // Supprimer le membre du projet
        MembreProjet::where('id', $idMembres)->where('projet_id', $projet_id)->delete();

        // Récupérer les membres du projet
        $membres = User::join('membre_projets', 'users.id', '=', 'membre_projets.user_id')
            ->join('projets', 'membre_projets.projet_id', '=', 'projets.id')
            ->where('projets.id',  $projet_id)
            ->select('users.id', 'users.name')
            ->get();


        // Envoyer une réponse de succès si nécessaire
        return response([
            'membres' => $membres,
            'success' => 'Un membre supprimé avec succès.'
        ]);
    }
}
