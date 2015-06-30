@extends('gsu::app')

@section('css')


    <style>
        .row{
            margin:2px;
        }
        .btn{
            min-width: 80px;
        }
    </style>
@endsection

@section('content')
    @if(View::exists('gsu::varie.cliente-details'))
        @include('gsu::varie.cliente-details')
    @endif

    <br><br>
    <fieldset class="dettaglio_dati">
        <legend align="right"></legend>
        <table border="0" class="tabella dataTable table table-striped table-bordered display no-footer detail">
            <form action="#" method="post" id="form">
                <tr>
                    <td>COD MANUTENZIONE </td>
                    <td class="manutenzione">{{$request['MANUTENZIONE'] or ""}}</td>
                </tr>
                <tr>
                    <td>SERVIZIO</td>
                    <td><input type="text" name="servizio" value="{{$request['SERVIZIO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SERVER</td>
                    <td><input type="text" name="server" value="{{$request['SERVER_'] or ""}}"></td>
                </tr>
                <tr>
                    <td>TIPO ACCOUNT</td>
                    <td><input type="text" name="tipo_account" value="{{$request['TIPO_ACCOUNT'] or ""}}"></td>
                </tr>
                <tr>
                    <td>UTENTE</td>
                    <td><input type="text" name="username" value="{{$request['USERNAME'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                    <td><input type="text" name="password" value="{{$request['PASSWORD'] or ""}}"></td>
                </tr>
                <tr>
                    <td>STATS</td>
                    <td><input type="text" name="stats" value="{{$request['STATS'] or ""}}"></td>
                </tr>
                <tr>
                    <td>E_COMMERCE</td>
                    <td><input type="text" name="e_commerce" value="{{$request['E_COMMERCE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>NEWSLETTER</td>
                    <td><input type="text" name="newsletter" value="{{$request['NEWSLETTER'] or ""}}"></td>
                </tr>
                <tr>
                    <td>NEWS</td>
                    <td><input type="text" name="news" value="{{$request['NEWS'] or ""}}"></td>
                </tr>
                <tr>
                    <td>CALENDARIO</td>
                    <td><input type="text" name="calendario" value="{{$request['CALENDARIO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>BANNER</td>
                    <td><input type="text" name="banner" value="{{$request['BANNER'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ADDRESS</td>
                    <td><input type="text" name="address" value="{{$request['ADDRESS'] or ""}}"></td>
                </tr>
                <tr>
                    <td>DOWNLOAD</td>
                    <td><input type="text" name="download" value="{{$request['DOWNLOAD'] or ""}}"></td>
                </tr>
                <tr>
                    <td>PHP</td>
                    <td><input type="text" name="php" value="{{$request['PHP'] or ""}}"></td>
                </tr>
                <tr>
                    <td>FORUM</td>
                    <td><input type="text" name="forum" value="{{$request['FORUM'] or ""}}"></td>
                </tr>
                <tr>
                    <td>GENERACTION</td>
                    <td><input type="text" name="generaction" value="{{$request['GENERACTION'] or ""}}"></td>
                </tr>
                <tr>
                    <td>FAQ</td>
                    <td><input type="text" name="faq" value="{{$request['FAQ'] or ""}}"></td>
                </tr>
                <tr>
                    <td>IMMOBILIARE</td>
                    <td><input type="text" name="immobiliare" value="{{$request['IMMOBILIARE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>MAGAZINE</td>
                    <td><input type="text" name="magazine" value="{{$request['MAGAZINE'] or ""}}"></td>
                </tr>
                <tr>
                    <td>MOTORE RICERCA</td>
                    <td><input type="text" name="motore_ricerca" value="{{$request['MOTORE_RICERCA'] or ""}}"></td>
                </tr>
                <tr>
                    <td>ON_LINE_USERS</td>
                    <td><input type="text" name="on_line_users" value="{{$request['ON_LINE_USERS'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SMS</td>
                    <td><input type="text" name="sms" value="{{$request['SMS'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SONDAGGIO</td>
                    <td><input type="text" name="sondaggio" value="{{$request['SONDAGGIO'] or ""}}"></td>
                </tr>
                <tr>
                    <td>FOTO_GALLERY</td>
                    <td><input type="text" name="foto_gallery" value="{{$request['FOTO_GALLERY'] or ""}}"></td>
                </tr>
                <tr>
                    <td>LIVE_HELP_MESSENGER</td>
                    <td><input type="text" name="live_help_messenger" value="{{$request['LIVE_HELP_MESSENGER'] or ""}}"></td>
                </tr>
                <tr>
                    <td>SPIDER_MAKER_VERIFIER</td>
                    <td><input type="text" name="spider_maker_verifier" value="{{$request['SPIDER_MAKER_VERIFIER'] or ""}}"></td>
                </tr>
                <tr>
                    <td>TUTTI</td>
                    <td><input type="text" name="tutti" value="{{$request['TUTTI'] or ""}}"></td>
                </tr>

                <tr>
                    <td colspan="4" style="padding-top:20px;">
                        <input type="hidden" id="manutenzione" name="manutenzione" value="{{$request['MANUTENZIONE'] or ""}}">
                        <input type="hidden" id="id_tbl" name="id_tbl" value="{{$request['IDWEBHAT'] or ""}}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="stato_precedente" name="stato_precedente" value="{{ Input::get('eliminati') == 'on' ? 1 : 0 }}">

                            <input type="button" value="INDIETRO" onClick="location.href='{{ URL::previous() }}'" class="btn btn-primary btn-xs">

                    </td>
                </tr>

            </form>
        </table>
        
    <hr>


@endsection


