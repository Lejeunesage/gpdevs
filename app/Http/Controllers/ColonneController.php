<?php

namespace App\Http\Controllers;

use App\Models\Colonne;
use App\Models\Projet;
use App\Models\Tache;
use App\Models\User;
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
        try {
            Colonne::create([
                'projet_id' => $request->projet_id,
                'titre' => $request->titre,
            ]);

            $colonnes = Colonne::where('projet_id', $request->projet_id)->with('taches')->get()->map(function ($colonne) {
                return [
                    'id' => $colonne->id,
                    'titre' => $colonne->titre,
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
                    })
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
    public function destroy(Request $request)
    {


       try {
         // Supprimer les tâches associées à la colonne
         $deleteTaches = Tache::where('colonne_id', $request->colonne_id);
         // dd($deleteTaches);
 
         if ($deleteTaches) {
             $deleteTaches->delete();
         }

         // Supprimer la colonne
        Colonne::findOrFail($request->colonne_id)->delete();
 
         $colonnes = Colonne::where('projet_id', $request->projet_id)->with('taches')->get()->map(function ($colonne) {
             return [
                 'id' => $colonne->id,
                 'titre' => $colonne->titre,
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
                 })
             ];
         });

         return response($colonnes);
 
       } catch (\Throwable $th) {
        dd($th);
       }

    }
}
