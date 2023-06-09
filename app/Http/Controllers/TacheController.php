<?php

namespace App\Http\Controllers;

use App\Models\Colonne;
use App\Models\Projet;
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
                    $projet = Projet::find($tache['projet_id']);
                    $user = User::find($tache['user_id']);
                    $colonneName = $colonne['titre'] ?? null;

                    return [
                        'id' => $tache['id'],
                        'name' => $tache['name'],
                        'description' => $tache['description'],
                        'projet_id' => $tache['projet_id'],
                        'projet_name' => $projet ? $projet->nom : null,
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
        // dd($request);

        try {
            Tache::create([
                'name' => $request->name,
                'description' => $request->description,
                'projet_id' => $request->projet_id,
                'user_id' => $request->member,
                'date_heure_livraison' => $request->date_heure_livraison,
                'colonne_id' => $request->colonne_id,
                'priorite' => $request->priority,
            ]);


            $colonnes = Colonne::where('projet_id', $request->projet_id)
            ->with('taches')
            ->orderBy('numero_ordre', 'asc')
            ->get()
            ->map(function ($colonne) {
                return [
                    'id' => $colonne->id,
                    'titre' => $colonne->titre,
                    'numero_ordre' => $colonne->numero_ordre,
                    'taches' => $colonne->taches->map(function ($tache) use ($colonne) {
                        $projet = Projet::find($tache->projet_id);
                        $user = User::find($tache->user_id);
                        $colonneName = $colonne->titre ?? null;
        
                        return [
                            'id' => $tache->id,
                            'name' => $tache->name,
                            'description' => $tache->description,
                            'projet_id' => $tache->projet_id,
                            'projet_name' => $projet ? $projet->nom : null,
                            'user_id' => $tache->user_id,
                            'user_name' => $user ? $user->name : null,
                            'date_heure_livraison' => $tache->date_heure_livraison,
                            'colonne_id' => $tache->colonne_id,
                            'colonne_name' => $colonneName,
                            'priorite' => $tache->priorite,
                        ];
                    }),
                ];
            });

            return response($colonnes);
        } catch (\Throwable $th) {
            dd($th);
        }
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
     * Update the specified resource in storage.
     */
    public function colonneUpdate(Request $request)
    {

        $projet_id = $request->projet_id;
        $tache_id = $request->tache_id;
        $colonne_id = $request->colonne_id;

        // Récupérer la tâche
        $tache = Tache::find($tache_id);


        // Mettre à jour le champ 'colonne_id' de la tâche
        $tache->colonne_id = $colonne_id;
        $tache->save();


        $colonnes = Colonne::where('projet_id', $request->projet_id)
            ->with('taches')
            ->orderBy('numero_ordre', 'asc')
            ->get()
            ->map(function ($colonne) {
                return [
                    'id' => $colonne->id,
                    'titre' => $colonne->titre,
                    'numero_ordre' => $colonne->numero_ordre,
                    'taches' => $colonne->taches->map(function ($tache) use ($colonne) {
                        $projet = Projet::find($tache->projet_id);
                        $user = User::find($tache->user_id);
                        $colonneName = $colonne->titre ?? null;
        
                        return [
                            'id' => $tache->id,
                            'name' => $tache->name,
                            'description' => $tache->description,
                            'projet_id' => $tache->projet_id,
                            'projet_name' => $projet ? $projet->nom : null,
                            'user_id' => $tache->user_id,
                            'user_name' => $user ? $user->name : null,
                            'date_heure_livraison' => $tache->date_heure_livraison,
                            'colonne_id' => $tache->colonne_id,
                            'colonne_name' => $colonneName,
                            'priorite' => $tache->priorite,
                        ];
                    }),
                ];
            });


        return response($colonnes);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            //    dd( $request->id, $request->projet_id);
            // Rechercher la tâche par son ID
            $task = Tache::find($request->id);

            // Supprimer la tâche
            $task->delete();

            $colonnes = Colonne::where('projet_id', $request->projet_id)
            ->with('taches')
            ->orderBy('numero_ordre', 'asc')
            ->get()
            ->map(function ($colonne) {
                return [
                    'id' => $colonne->id,
                    'titre' => $colonne->titre,
                    'numero_ordre' => $colonne->numero_ordre,
                    'taches' => $colonne->taches->map(function ($tache) use ($colonne) {
                        $projet = Projet::find($tache->projet_id);
                        $user = User::find($tache->user_id);
                        $colonneName = $colonne->titre ?? null;
        
                        return [
                            'id' => $tache->id,
                            'name' => $tache->name,
                            'description' => $tache->description,
                            'projet_id' => $tache->projet_id,
                            'projet_name' => $projet ? $projet->nom : null,
                            'user_id' => $tache->user_id,
                            'user_name' => $user ? $user->name : null,
                            'date_heure_livraison' => $tache->date_heure_livraison,
                            'colonne_id' => $tache->colonne_id,
                            'colonne_name' => $colonneName,
                            'priorite' => $tache->priorite,
                        ];
                    }),
                ];
            });

            return response($colonnes);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
