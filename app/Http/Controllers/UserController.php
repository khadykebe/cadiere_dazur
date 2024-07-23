<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use App\models\Categorie;
use App\models\Planning;
use App\models\Rv;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;




class UserController extends Controller
{
    public function index(){
        $categories = Categorie::all();
        return view('index',compact('categories'));
    }
    public function store(Request $request){
        $request->validate([

            'NomComplet' => 'required',
            'NSS'  => 'required|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'specialité' => 'required',
            'tel' => 'required|unique:users',
            'role'=> 'required',

        ]);

        $user = new User;
        $user->NomComplet = $request->NomComplet;
        $user->NSS = $request->NSS;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->specialité = $request->specialité;
        $user->tel = $request->tel;
        $user->role = $request->role;
        $user->save();
        return  back()->with('message','compte créé avec succé');

    }

    public function AllRv(){
        $rvs = User::with('rv')->get();
        return view('personnel-medical.listeRv',compact('rvs'));
    }

    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
        if ($user != null && Hash::check($request->password, $user->password)) {
            session(['id'=>$user->id]);
            if($user->role == 'Medecin'){
                $rvs = DB::table('rvs')
                ->join('users','users.id','=','rvs.user_id')
                ->where('rvs.user_id',$user->id)->get();
                return view('medecin.listeRV',compact('rvs'));
            }
            else{
                return $this->AllRv();

            }
        } else {
            return back()->with( ["message1" => "Email ou mot de password incorrect."]);
        }
    }

    public function AddPl(Request $request){
        $planning = new Planning;
        $planning->JourDispo = $request->JourDispo;
        $planning->PDebut = $request->PDebut;
        $planning->PFin = $request->PFin;
        $planning->IdUser = session('id');
        $planning->save();

        return  redirect()->route('planning.allPl')->with(["message" => "planning ajouté avec succé"]);
    }



    public function allPl(){

        $pls = DB::table('users')
            ->join('plannings','plannings.IdUser','=','users.id')
            ->where('plannings.IdUser',session('id'))->get();
        return view('medecin.listePl',compact('pls'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'jour' => 'required|date',
            'heure' => 'required',
        ]);

        DB::table('rvs')->whereId($id)->update([
            "jour" => $request->jour,
            "heure" => $request->heure,
        ]);
        return $this->AllRv()->with('success1', 'Rendez-vous mis à jour avec succès.');
    }


    public function destroy($id)
    {
        Rv::find($id)->delete();
        return $this->AllRv()->with('success', 'Rendez-vous supprimé avec succès.');
    }


    public function logout()
    {
        // Auth::logout();
        return redirect()->route('index');
    }
}
