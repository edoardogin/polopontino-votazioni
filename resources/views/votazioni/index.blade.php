@extends('layouts.app')
@section('content')
    <style>
        .form-check {
            margin-bottom: 10px;
        }
    </style>
    <div class="row justify-content-center">
        <div class="container" style="max-width: 700px !important;position: relative; ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="https://polopontino.it">Pagina iniziale</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Elezioni dei rappresentanti</li>
                </ol>
            </nav>

            <h1>Elezioni dei rappresentanti del III anno (2025/2026)</h1>
            <p>Per votare, seleziona i tuoi TRE candidati, alla fine del voto usciranno i risultati in tempo reale. I primi tre studenti con più voti diventeranno rappresentanti. Solo gli studenti del III Anno possono votare!</p>
            <div class="card">
                <div class="card-body" style="padding: 35px 30px;">
                    <form method="POST">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">Seleziona i tre studenti che vorresti come rappresentanti</label>

                            <div class="form-check">
                                <input class="form-check-input candidato-checkbox" type="checkbox" name="candidati[]" value="Amato Alessandro">
                                <label class="form-check-label">
                                    Amato Alessandro
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input candidato-checkbox" type="checkbox" name="candidati[]" value="Cacciola Pasquale">
                                <label class="form-check-label">
                                    Cacciola Pasquale
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input candidato-checkbox" type="checkbox" name="candidati[]" value="Pavoni Francesca">
                                <label class="form-check-label">
                                    Pavoni Francesca
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input candidato-checkbox" type="checkbox" name="candidati[]" value="Pellacchi Francesca">
                                <label class="form-check-label">
                                    Pellacchi Francesca
                                </label>
                            </div>
                        </div>

                        <div class="col-12" style="margin-top: 20px;">
                            <button class="btn btn-primary" id="vota-btn" disabled>Salva e vota</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.candidato-checkbox');
            const votaBtn = document.getElementById('vota-btn');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const checkedCount = document.querySelectorAll('.candidato-checkbox:checked').length;
                    votaBtn.disabled = checkedCount !== 3;
                });
            });
        });
    </script>
@endsection
