<?php

namespace App\Http\Controllers;

use App\Models\Colonne;
use App\Models\MembreProjet;
use App\Models\Projet;
use App\Models\Tache;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;

        $membreProjets = MembreProjet::where('user_id', $id)->get()->toArray();

        $projets = [];

        foreach ($membreProjets as $membreProjet) {
            $projet = Projet::find($membreProjet['projet_id']);

            $created_at = Carbon::parse($membreProjet['created_at'])->locale('fr_FR')->format('d/m/Y  H:i');
            $updated_at = Carbon::parse($membreProjet['updated_at'])->locale('fr_FR')->format('d/m/Y  H:i');

            if ($projet) {
                $projets[] = [
                    'id' => $projet->id,
                    'name' => $projet->name,
                    'role' => $membreProjet['role'],
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ];
            }
        }

        $tachesAssignees = Tache::where('user_id', $id)
            ->get()
            ->transform(function ($tache) {
                $projet = Projet::find($tache->projet_id);
                $tache->nomProjet = $projet ? $projet->name : '';
                return $tache;
            })
            ->toArray();

        // dd($projets, $tachesAssignees);

        return Inertia::render('Dashboard', [
            'projets' => $projets,
            'taches' => $tachesAssignees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Projets/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $users = User::all()->toArray();

        try {
            $id = Auth::user()->id;

            // Vérifier si une équipe avec le même nom existe déjà
            $existingTeam = Projet::where('user_id', $id)
                ->where('name', $request->name)
                ->first();

            if ($existingTeam) {
                // Une équipe avec le même nom existe déjà, envoyer un message d'erreur
                return Inertia::render('Projet/Create', [
                    'error' => 'Un projet existe déja avec le mème nom.'
                ]);
            } else {


                // Créer une nouvelle équipe
                $create_projet = Projet::create([
                    'name' => $request->name,
                    'description' =>  $request->description,
                    'user_id' => $id,
                ]);

                if ($create_projet) {
                    // Associer l'utilisateur à l'équipe en tant que propriétaire
                    MembreProjet::create([
                        'projet_id' => $create_projet->id,
                        'user_id' => $id,
                        'role' => 'Chef de projet'
                    ]);

                    // Création des colonnes par défaut
                    $colonnes = ['A faire', 'En cours', 'Terminé'];

                    foreach ($colonnes as $colonne) {
                        Colonne::create([
                            'projet_id' => $create_projet->id,
                            'titre' => $colonne,
                        ]);
                    }
                }

                return redirect()->route('dashboard');
            }
        } catch (\Throwable $th) {
            // Gérer les exceptions
            dd($th);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $projet = Projet::findOrFail($id);

        // Récupérer les membres du projet avec leur rôle
        $membres = User::join('membre_projets', 'users.id', '=', 'membre_projets.user_id')
            ->join('projets', 'membre_projets.projet_id', '=', 'projets.id')
            ->where('projets.id', $id)
            ->select('users.id', 'users.name', 'membre_projets.role')
            ->get();


        $colonnes = Colonne::where('projet_id', $id)->with('taches')->get()->map(function ($colonne) {
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


        // dd(
        //     $projet,
        //     $membres,
        //     $colonnes
        // );

        return Inertia::render('Projets/Show', [
            'projet' => $projet,
            'membres' => $membres,
            'colonnes' => $colonnes,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projet $projet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projet $projet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        //
    }
}
