<?php

namespace App\Http\Controllers;

use App\Models\MembreProjet;
use App\Models\Projet;
use App\Models\Tache;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

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

        return response($projets);
            
    }
}
