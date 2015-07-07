@extends('app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registrati al portale Uniweb 4.0</div>
                    <div class="panel-body">
                        @if (!empty($messages))
                            <div class="alert alert-success">
                                {{$messages}}
                            </div>
                        @endif
                        @if (!empty($errors))
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/registrazione/save') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <legend>DATI GENERALI</legend>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Codice Cliente</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="codicecliente" value="{{ old('codicecliente') }}" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Societ&agrave; *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="societa" value="{{ old('societa') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Partita IVA *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="piva" value="{{ old('piva') }}" required maxlength="11">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Codice Fiscale</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="cf" value="{{ old('cf') }}" maxlength="16">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-4 control-label">Indirizzo *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="indirizzo" value="{{ old('indirizzo') }}" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-4 control-label">Citt&agrave; *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="citta" value="{{ old('citta') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Provincia *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="provincia" value="{{ old('provincia') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">CAP *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="cap" value="{{ old('cap') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Telefono *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Fax</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="fax" value="{{ old('fax') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email *</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Sito web</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="sitoweb" value="{{ old('sitoweb') }}">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>SEDE OPERATIVA</legend>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Indirizzo</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="so_indirizzo" value="{{ old('so_indirizzo') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Citt&agrave; *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="so_citta" value="{{ old('so_citta') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Provincia *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="so_provincia" value="{{ old('so_provincia') }}" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-4 control-label">CAP *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="so_cap" value="{{ old('so_cap') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Telefono *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="so_telefono" value="{{ old('so_telefono') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Fax</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="so_fax" value="{{ old('so_fax') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email *</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="so_email" value="{{ old('so_email') }}" required>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>RIFERIMENTO COMMERCIALE</legend>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Nome *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="nome" value="{{ old('co_nome') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Cognome *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="cognome" value="{{ old('co_cognome') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Telefono *</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="co_telefono" value="{{ old('co_telefono') }}" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-4 control-label">Cellulare </label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="co_cellulare" value="{{ old('co_cellulare') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email *</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="co_email" value="{{ old('co_email') }}" required>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        REGISTRATI
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        input[type="text"],
        input[type="email"]{
            max-width: 240px !important;
        }
    </style>

@endsection
