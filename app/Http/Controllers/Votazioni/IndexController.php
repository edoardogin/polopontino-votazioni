<?php

namespace App\Http\Controllers\Votazioni;

use App\Http\Controllers\Controller;
use App\Models\Votato;
use App\Models\Voto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index() {

        $user = Auth::user();

        if($user->votazione != 1) { // Variabile 1 sta per abilitato alla votazione sul database, dopo aver controllato fosse del III anno nell'elenco
            return redirect('/votazioni/risultati')->with('error', 'Dev\'essere del III Anno per votare.');
        }

        $voti = Votato::where('user', $user->id)->count(); // Tabella divisa da quella del voto, per garantire segretezza del voto
        if ($voti != 0) {
            return redirect('/votazioni/risultati')->with('error', 'Hai già votato!');
        }

        return view('votazioni.index');
    }

    public function carica(Request $request) {
        $user = Auth::user();

        if ($user->votazione != 1) { // Variabile 1 sta per abilitato alla votazione sul database, dopo aver controllato fosse del III anno nell'elenco
            return redirect('/votazioni/risultati')->with('error', 'Dev\'essere del III Anno per votare.');
        }

        $voti = Votato::where('user', $user->id)->count();
        if ($voti != 0) {
            return redirect('/votazioni/risultati')->with('error', 'Hai già votato!');
        }

        $candidati = $request->input('candidati', []);

        if (count($candidati) !== count(array_unique($candidati))) { // Impossibilità di votare due volte lo stesso candidato
            return redirect('/votazioni/risultati')->with('error', 'Non puoi votare due volte lo stesso candidato.');
        }

        Votato::create([
            'user' => $user->id
        ]);

        foreach ($candidati as $candidato) { // Caricamento dei voti indipendenti dall'utente
            Voto::create([
                'voto' => $candidato
            ]);
        }

        return redirect('/votazioni/risultati')->with('success', 'Hai votato con successo!');
    }




    public function risultati() {

        $utentiTotali = Votato::all()->count();

        $risultati = Voto::select('voto', DB::raw('COUNT(voto) as total_voti'))
            ->groupBy('voto')
            ->orderBy('total_voti', 'desc')
            ->get();

        $risultati = $risultati->map(function($voto) {
            return [
                'candidato' => $voto->voto,
                'total_voti' => $voto->total_voti
            ];
        });

        return view('votazioni.risultati', compact('risultati', 'utentiTotali'));
    }
}
