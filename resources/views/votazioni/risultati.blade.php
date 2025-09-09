@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="container" style="max-width: 700px !important;position: relative; ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="https://polopontino.it">Pagina iniziale</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Elezioni dei rappresentanti</li>
                </ol>
            </nav>

            <h1 style="margin-bottom: 5px;">Risultati delle elezioni dei rappresentanti del III anno (2025/2026)</h1>
            <p>{{ $utentiTotali }} studenti hanno votato fin'ora</p>

            <div class="card" style="margin-top: 20px">
                <div class="card-body" style="padding: 0px;">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Candidato</th>
                            <th>Numero di voti</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($risultati as $risultato)
                            <tr>
                                <td>{{ $risultato['candidato'] }}</td>
                                <td>{{ $risultato['total_voti'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
