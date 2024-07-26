<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planning;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class PlanningController extends Controller
{


    public function update(Request $request,$id)
    {
        $request->validate([
            'JourDispo' => 'required|date',
            'PDebut' => 'required',
            'PFin' => 'required',
        ]);

        DB::table('plannings')->whereId($id)->update([
            "JourDispo" => $request->JourDispo,
            "PDebut" => $request->PDebut,
            "PFin" => $request->PFin,
        ]);

        return redirect()->route('planning.allPl')->with('success1', 'Planning mis à jour avec succès.');
    }

    public function destroy($id)
    {
        Planning::find($id)->delete();

        return redirect()->route('planning.allPl')->with('success', 'Planning supprimé avec succès.');
    }
}
