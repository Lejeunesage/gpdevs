<?php

namespace App\Http\Controllers;

use App\Models\Colonne;
use App\Models\Equipe;
use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colonnes = Colonne::with('taches')->get()->map(function ($colonne) {
            return [
                'id' => $colonne['id'],
                'titre' => $colonne['titre'],
                'taches' => $colonne['taches']->map(function ($tache) use ($colonne) {
                    $equipe = Equipe::find($tache['equipe_id']);
                    $user = User::find($tache['user_id']);
                    $colonneName = $colonne['titre'] ?? null;

                    return [
                        'id' => $tache['id'],
                        'name' => $tache['name'],
                        'description' => $tache['description'],
                        'equipe_id' => $tache['equipe_id'],
                        'equipe_name' => $equipe ? $equipe->nom : null,
                        'user_id' => $tache['user_id'],
                        'user_name' => $user ? $user->name : null,
                        'date_heure_livraison' => $tache['date_heure_livraison'],
                        'colonne_id' => $tache['colonne_id'],
                        'colonne_name' => $colonneName,
                        'priorite' => $tache['priorite'],
                    ];
                })
            ];
        });

        // dd($colonnes);
        return Inertia::render('Kanban/Index', [
            'colonnes' => $colonnes,
        ]);
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
    public function show(Tache $tache)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tache $tache)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tache $tache)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tache $tache)
    {
        //
    }
}
