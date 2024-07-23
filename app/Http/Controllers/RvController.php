<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\models\Categorie;
use App\models\Date;
use App\models\Rv;
use App\models\User;
use App\models\planning;
use App\models\Rodio;
use App\models\Mammo;
use App\models\Echog;
use Illuminate\Support\Facades\DB;

class RvController extends Controller
{


    public function index()
    {
        $categories = Categorie::all();
        return view('index',compact('categories'));
    }

    public function show($id)
    {
        $categorie = Categorie::find($id);
        $motifs = DB::table('motifs')
        ->where('motifs.categorie_id','=',$id)->get();
        return view('rendez-vous.index',compact('motifs','categorie'));
    }

    public function RV($data){
        session(['sharedData' => $data]);
        if($data == 'Radiographie'){
            $allrvs = Rodio::all();
            $RVR = json_encode($allrvs);
            return view('calendar.radio',['jsonList' => $RVR]);
        }
        elseif($data == 'Echographie'){
            $allrvs = Echog::all();
            $RVE = json_encode($allrvs);
            return view('calendar.echo',['jsonList' => $RVE]);
        }
        else{
            $allrvs = Mammo::all();
            $RVM = json_encode($allrvs);
            return view('calendar.mammo',['jsonList' => $RVM]);
        }

    }

    public function ConsultEcho(Request $request)
    {
        $data = session('sharedData');
        $text1 = $request->query('text1');
        $text2 = $request->query('text2');
        $heurRV = Carbon::parse($text2);
        session(['jour' => $text1]);
        session(['heure' => $text2]);
        $H = date("H:i", strtotime($text2));

        $results = DB::table('users')
            ->join('plannings', function ($join) use ($data) {
                $join->on('users.id', '=', 'plannings.IdUser')
                     ->where('users.specialité',$data)
                     ->where('users.role', "Medecin");
            })
            ->select('users.*', 'plannings.*')
            ->get();
        if($results){
                    $tmp = 0;
                    foreach($results as $result){
                        session(['id'=>$result->IdUser]);
                        session(['nom'=>$result->NomComplet]);
                        $start = date("H:i", strtotime($result->PDebut));
                        $end = date("H:i", strtotime($result->PFin));
                        if($H >= $start && $H <= $end && $text1 == $result->JourDispo){
                            $medecin = $result->NomComplet;
                            $consult = $data;
                            $tmp = 1;
                        }

                    }
                    if($tmp == 1 && $data == 'Radiographie'){

                        return view('rendez-vous.radio',compact('consult','medecin','text1','text2'));
                    }
                    elseif($tmp == 1 && $data == 'Mammographie'){

                        return view('rendez-vous.mammo',compact('consult','medecin','text1','text2'));
                    }
                    elseif ($tmp == 1 && $data == 'Echographie') {
                       
                        return view('rendez-vous.echo',compact('consult','medecin','text1','text2'));
                    }
                    return redirect()->route('index')->with('alert1','Il n y a de Médecin disponible pour Cette heure');;


        }
        return redirect()->route('index')->with('alert','Il n y a de Médecin disponible pour Cette consultation');;

    }

    public function PatientAsRvRadio(Request $request){

        $radio = new Rodio;
        $radio->jour = session('jour');
        $radio->heure = session('heure');
        $radio->save();

        $rv = new Rv;
        $rv->motif = session('sharedData');
        $rv->NomPatient = $request->NomPatient;
        $rv->jour = session('jour');
        $rv->heure = session('heure');
        $rv->user_id = session('id');
        $rv->save();
       return view('index',['message'=>'Votre Rendez-vous est enrégistré avec succé'])->with('refresh', true);
    }


    public function PatientAsRvEcho(Request $request){

        $radio = new Rodio;
        $radio->jour = session('jour');
        $radio->heure = session('heure');
        $radio->save();

        $rv = new Rv;
        $rv->motif = session('sharedData');
        $rv->NomPatient = $request->NomPatient;
        $rv->jour = session('jour');
        $rv->heure = session('heure');
        $rv->user_id = session('id');
        $rv->save();
       return view('index',['message'=>'Votre Rendez-vous est enrégistré avec succé'])->with('refresh', true);
    }


    public function PatientAsRvMammo(Request $request){

        $radio = new Rodio;
        $radio->jour = session('jour');
        $radio->heure = session('heure');
        $radio->save();

        $rv = new Rv;
        $rv->motif = session('sharedData');
        $rv->NomPatient = $request->NomPatient;
        $rv->jour = session('jour');
        $rv->heure = session('heure');
        $rv->user_id = session('id');
        $rv->save();
       return view('index',['message'=>'Votre Rendez-vous est enrégistré avec succé'])->with('refresh', true);
    }


}
