<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\MembreEquipe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $id = Auth::user()->id;

    $membreEquipes = MembreEquipe::where('user_id', $id)->get()->toArray();

    $equipes = [];

    foreach ($membreEquipes as $membreEquipe) {
        $equipe = Equipe::find($membreEquipe['equipe_id']);

        $created_at = Carbon::parse($membreEquipe['created_at'])->locale('fr_FR')->format('d/m/Y  H:i');
        $updated_at = Carbon::parse($membreEquipe['updated_at'])->locale('fr_FR')->format('d/m/Y  H:i');

        if ($equipe) {
            $equipes[] = [
                'id' => $equipe->id,
                'nom' => $equipe->nom,
                'role' => $membreEquipe['role'],
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ];
        }
    }

    // dd($equipes);

    return Inertia::render('Workplace/Index', [
        'equipes' => $equipes,
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Equipes/Create');
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
            $existingTeam = Equipe::where('creer_par', $id)
                ->where('nom', $request->teamName)
                ->first();

            if ($existingTeam) {
                // Une équipe avec le même nom existe déjà, envoyer un message d'erreur
                return response(['error' => 'Une equipe existe déja avec le mème nom.']);
            } else {


                // Créer une nouvelle équipe
                $create_equipe = Equipe::create([
                    'nom' => $request->teamName,
                    'creer_par' => $id,
                ]);

                if ($create_equipe) {
                    // Associer l'utilisateur à l'équipe en tant que propriétaire
                    MembreEquipe::create([
                        'equipe_id' => $create_equipe->id,
                        'user_id' => $id,
                        'role' => 'Proprietaire'
                    ]);
                }

                // Envoyer une réponse de succès si nécessaire
                return response([
                    'users' => $users,
                    'show' => 'true',
                    'equipe_id' => $create_equipe->id,
                    'success' => 'Equipe créer avec succès.'
                ]);
            }
        } catch (\Throwable $th) {
            // Gérer les exceptions
            dd($th);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ajoutMembre(Request $request)
    {
        $idMembres = $request->idMembres;
        $equipe_id = $request->equipe_id;

        foreach ($idMembres as $key => $value) {
            
            MembreEquipe::create([
                'equipe_id' =>  $equipe_id,
                'user_id' => $value,
                'role' => 'Collaborateur'
            ]);
        }
        return Inertia::render('Equipes/Create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipe $equipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipe $equipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipe $equipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipe $equipe)
    {
        //
    }
}
