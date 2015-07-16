@extends('app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery.cookiebar.css') }}" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Cookie Policy Uniweb srl</div>
                    <div class="panel-body">
                        <div id="contenitore">
                            <div id="header">
                                <p style="text-align:right;padding-right:10px;"><a href="javascript:history.back();"><<< INDIETRO</a></p>
                            </div>
                            <div id="cookiecorpo">
                                <p class="cookietitolo">Titolare del trattamento</p>
                                <p class="cookietesto">Titolare del trattamento è  UNIWEB Srl  con sede in Cantù, Via Milano 51.<p>
                                    <br /><br />
                                <p class="cookietesto">
                                    <u>I diritti di cui all'art. 7 D.lg. n. 196/03</u><br />
                                    Ricordiamo che l'interessato ha diritto di ottenere l'indicazione dell'origine dei dati personali; delle finalità e modalità del trattamento; della logica applicata in caso di trattamento effettuato con l'ausilio di strumenti elettronici; degli estremi identificativi del titolare, dei responsabili e dei soggetti o delle categorie di soggetti ai quali i dati personali possono essere comunicati o che possono venirne a conoscenza in qualità di responsabili o incaricati.
                                    <br /><br />
                                    L'interessato ha diritto di ottenere l'aggiornamento, la rettificazione ovvero, quando vi ha interesse, l'integrazione dei dati; la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, compresi quelli di cui non è necessaria la conservazione in relazione agli scopi per i quali i dati sono stati raccolti o successivamente trattati; l'attestazione che le operazioni di cui sopra sono state portate a conoscenza, anche per quanto riguarda il loro contenuto, di coloro ai quali i dati sono stati comunicati o diffusi, eccettuato il caso in cui tale adempimento si rivela impossibile o comporta un impiego di mezzi manifestamente sproporzionato rispetto al diritto tutelato.
                                    <br /><br />
                                    L'interessato ha diritto di opporsi, in tutto o in parte: per motivi legittimi al trattamento dei dati personali che lo riguardano, ancorché pertinenti allo scopo della raccolta; al trattamento di dati personali che lo riguardano a fini di marketing. Il diritto di opposizione dell'interessato al trattamento dei dati per le finalità di marketing effettuato con modalità automatizzate di contatto si estende a quelle tradizionali, restando salva per l'interessato la possibilità di esercitare tale diritto in tutto o in parte, ossia opponendosi, ad esempio, al solo invio di comunicazioni promozionali effettuato tramite strumenti automatizzati.
                                </p>

                                <p class="cookietitolo">Informativa sui Cookie</p>
                                <p class="cookietesto">
                                    <u>Che cosa sono i cookie</u><br />
                                    Il cookie è un piccolo file di testo contenente una certa quantità di informazioni scambiato tra un sito internet ed il tuo terminale (solitamente il browser) ed è normalmente utilizzato dal gestore del sito internet per memorizzare le informazioni necessarie a migliorare la navigazione all'interno del sito ovvero per inviare messaggi pubblicitari in linea con le preferenze manifestate dall'utente nell'ambito della navigazione in rete. Quando si visita di nuovo lo stesso sito o qualunque altro sito il dispositivo dell'utente verifica la presenza di un cookie riconosciuto, in modo da potere leggere le informazioni in esso contenute. I diversi cookie contengono informazioni diverse e sono utilizzati per scopi differenti (navigazione efficiente nelle pagine di un medesimo sito, profilazione al fine di inviare messaggi promozionali mirati, analisi sul numero delle visite al sito).
                                    <br /><br />
                                    Nel corso della navigazione l'utente può ricevere sul suo terminale anche cookie inviati da siti o da web server diversi (c.d. terze parti), sui quali possono risiedere alcuni elementi (ad es. immagini, mappe, suoni, specifici link a pagine di altri domini) presenti sul sito che l'utente sta visitando.
                                    <br /><br />
                                    Più in generale, alcuni cookie (definiti cookie di sessione) sono assegnati al dispositivo dell'utente soltanto per la durata dell'accesso al sito e scadono automaticamente alla chiusura del browser. Altri cookie (definiti persistenti) restano nel dispositivo per un periodo di tempo prolungato.
                                    <br /><br />
                                    Le specifiche finalità delle diverse tipologie di cookie installati in questo sito sono di seguito descritte.
                                    <br /><br />
                                    Puoi disattivare i cookie seguendo le informazioni di seguito riportate.
                                    <br /><br />
                                    <u>Caratteristiche e finalità dei cookie installati dal sito</u><br />
                                    COOKIE TECNICI:<br />
                                    Si tratta di cookie utilizzati specificamente per permettere il corretto funzionamento e la fruizione del nostro sito. I cookie tecnici vengono ad esempio utilizzati per la funzionalità di login dell'utente. Sono erogati principalmente dai server del sito o, nel caso dell'integrazione di servizi esterni come i social network, da terze parti.
                                    <br /><br />
                                    COOKIE DI PROFILAZIONE:<br />
                                    Questo sito non utilizza cookie di profilazione, si invita comunque l'utente a conoscere le informative e per disattivare eventuali cookie di profilazione erogati da terze parti andando sul sito: <a href="www.youronlinechoices.com/it" target="_blank">www.youronlinechoices.com/it</a>
                                    <br /><br />
                                    COOKIE ANALITICI:<br />
                                    Si tratta di cookie utilizzati per analisi statistiche, per migliorare il sito e semplificarne l'utilizzo oltre che per monitorarne il corretto funzionamento. Questo tipo di cookie raccoglie informazioni in forma anonima sull'attività degli utenti nel sito. Questo tipo di cookie viene erogato esclusivamente da terze parti.
                                    <br /><br />
                                    Per le informative e per disattivare i cookie analitici di terze parti vai sul sito: <a href="www.youronlinechoices.com/it" target="_blank">www.youronlinechoices.com/it</a>
                                    <br /><br />
                                    COOKIE DI SOCIAL MEDIA SHARING:<br />
                                    Questi cookie di terza parte vengono utilizzati per integrare alcune diffuse funzionalità dei principali social media e fornirle all'interno del sito. In particolare permettono la registrazione e l'autenticazione sul sito tramite facebook e google connect, la condivisione e i commenti di pagine del sito sui social, abilitano le funzionalità del "mi piace" su Facebook e del "+1" su G+.<br />
                                    Di seguito i link dei più utilizzati social e le rispettive pagine di privacy policy:<br />
                                    - Facebook - social media - <a href="https://www.facebook.com/about/privacy/" target="_blank">privacy policy</a><br />
                                    - Google G+ - social media - <a href="https://www.google.com/intl/it/policies/" target="_blank">privacy policy</a><br />
                                    - Youtube - social media - <a href="https://www.youtube.com/static?template=privacy_guidelines" target="_blank">privacy policy</a><br />
                                    - Twitter - social media - <a href="https://twitter.com/privacy" target="_blank">privacy policy</a><br />
                                    - Linkedin - social media - <a href="http://it.linkedin.com/legal/privacy-policy" target="_blank">privacy policy</a><br />
                                    - Pinterest - social media - <a href="https://about.pinterest.com/it/privacy-policy" target="_blank">privacy policy</a>
                                    <br /><br />

                                    <u>Quali cookie utilizza questo sito</u><br />
                                    Nome: fmalertcookie<br />
                                    Dominio: www.comvar.com<br />
                                    Durata: <br />
                                    Descrizione: questo cookie viene utilizzato per ricordare al sito se l'utente ha già visionato o meno l'informativa breve e se ha già premuto il pulsante "ok" in essa contenuto.
                                    <br /><br />
                                    Nome: cookie di sessione, cambia di volta in volta<br />
                                    Dominio: www.comvar.com<br />
                                    Durata: si cancella automaticamente col termine della sessione di navigazione<br />
                                    Descrizione: questo è un cookie di sessione, e serve per la fruizione del sito.
                                    <br /><br />
                                    Nome: NID, PREF, OGPC<br />
                                    Dominio: Google<br />
                                    Durata: NID 6 mesi, PREF 2 anni, OGPC 1 mese<br />
                                    Descrizione: questi cookies sono usati da Google per memorizzare le preferenze e le informazioni dell'utente ogni volta che visita pagine web contenenti mappe geografiche di Google Maps.

                                    <br /><br />
                                    <u>Come prestare o revocare il consenso</u><br />
                                    Il consenso all'utilizzo dei cookie viene prestato inizialmente cliccando sul tasto "ok" posizionato all'interno dell'informativa breve / banner iniziale.
                                    <br /><br />
                                    L'erogazione di tutti i cookie, sia di prime che di terze parti, è disattivabile intervenendo sulle impostazioni del browser in uso; è bene notare però che questo potrebbe rendere inutilizzabili i siti qualora si bloccassero i cookie indispensabili per l'erogazione delle funzionalità.
                                    <br /><br />
                                    Ogni browser dispone di impostazioni diverse per la disattivazione dei cookie; di seguito proponiamo i collegamenti alle istruzioni per i browser più comuni:<br />
                                    - <a href="http://windows.microsoft.com/it-it/windows7/block-enable-or-allow-cookies" target="_blank">Microsoft Internet Explorer</a><br />
                                    - <a href="https://support.google.com/accounts/answer/61416?hl=it" target="_blank">Google Chrome</a><br />
                                    - <a href="https://support.apple.com/kb/PH19214?locale=it_IT" target="_blank">Apple Safari</a><br />
                                    - <a href="https://support.mozilla.org/it/kb/Attivare%20e%20disattivare%20i%20cookie" target="_blank">Mozilla Firefox</a><br />
                                    - <a href="http://help.opera.com/Windows/10.00/it/cookies.html" target="_blank">Opera</a>
                                </p>

                                <br /><br />

                                <p class="cookietitolo">Data controller</p>
                                <p class="cookietesto">The Data Controller is TETTAMANZI E ERBA SNC  based in Cantù, Via Lombardia 38.<p>
                                    <br /><br />
                                <p class="cookietesto">
                                    <u>The rights under all'art. 7 D.lg. n. 196/03</u><br />
                                    Recall that the person concerned has the right to know the source of personal data; the purposes and methods of treatment; the logic applied in case of treatment with the help of electronic means; the identity of the owner, manager and the persons or categories of persons to whom the data may be communicated or who can learn about them as managers or agents.
                                    <br /><br />
                                    You have the right to obtain updating, rectification or, when interested, integration of data; the cancellation, anonymization or blocking of data processed unlawfully, including data that need not be kept for the purposes for which the data were collected or subsequently processed; certification that the operations mentioned above have been made known, also regarding their content, of those to whom the data was communicated or disclosed except where this proves impossible or involves a means disproportionate to the protected right.
                                    <br /><br />
                                    You have the right to object, in whole or in part: for legitimate reasons to the processing of personal data, pertinent for collection purposes; to the processing of personal data for purposes of marketing. The right to object to the processing of data for the purposes of marketing carried out by automated contact extends to the traditional ones, saves prejudice to the person concerned the opportunity to exercise that right in whole or in part, or in opposition, to example, to only dispatch of promotional communications made through automated tools.
                                </p>

                                <p class="cookietitolo">Information about Cookie</p>
                                <p class="cookietesto">
                                    <u>What are cookie</u><br />
                                    A cookie is a small text file containing a certain amount of information exchanged between a website and your terminal (usually the browser) and is normally used by the operator of the website to store information necessary to improve the navigation within the site or to send advertising messages in line with the preferences expressed by the user in the field of web browsing. When you visit again the same site or any other site on the user's device checks for a cookie recognized, so you can read the information contained therein. The different cookie contains different information and are used for different purposes (efficient navigation in the pages of the same site, profiling in order to send promotional messages targeted analysis on the number of visits to the site).
                                    <br /><br />
                                    During navigation, the user can get on to their terminals also cookies sent by web sites to different servers (so-called third party), which may reside on some elements (eg. Images, maps, sounds, specific links to other pages domains) on the website that the user is visiting.
                                    <br /><br />
                                    More generally, some cookies (called session cookies) are assigned to the user's device for the duration of access to the site and automatically expire at the end of the browser. Other cookies (defined persistent) remain in the device for a prolonged period of time.
                                    <br /><br />
                                    The specific purposes of the different types of cookies installed on this site are described below.
                                    <br /><br />
                                    You can disable cookies by following the information below.
                                    <br /><br />
                                    <u>Characteristics and purposes of cookies installed by the site</u><br />
                                    COOKIE TECHNICAL:<br />
                                    It is used specifically for cookies allow proper operation and use of our site. Cookies are used for example for the technical functionality of the user's login. They are provided mainly by the site server or in the case of the integration of external services such as social networks, by third parties.
                                    <br /><br />
                                    COOKIE PROFILING:<br />
                                    This site does not use cookies profiling, it still invites you to know the information and to disable any cookies profiling provided by third parties going to the website: <a href="http://www.youronlinechoices.com/it" target="_blank">www.youronlinechoices.com/it</a>
                                    <br /><br />
                                    COOKIE  ANALYTICAL:<br />
                                    It is cookie used for statistical analysis, to improve the site and simplify their use as well as for monitoring correct operation. This type of cookie collects anonymous information about user activity on the site. This type of cookie is delivered exclusively by third parties.
                                    <br /><br />
                                    For information and to disable cookies analytical third party go to the website:<a href="http://www.youronlinechoices.com/it" target="_blank">www.youronlinechoices.com/it</a>
                                    <br /><br />
                                    COOKIE OF SOCIAL MEDIA SHARING:<br />
                                    These third-party cookies are used to integrate some common feature of the main social media and provide it within the site. In particular, allowing recording and authentication on the site via google and facebook connect, sharing and comments of the web pages on social, enable the functionality of the "like" on Facebook and "+1" on G +.<br />
                                    Here are the links of the most used social pages and their privacy policy:<br />
                                    Facebook - social media - <a href="https://www.facebook.com/about/privacy/" target="_blank">privacy policy</a><br />
                                    Google G+ - social media - <a href="https://www.google.com/intl/it/policies/" target="_blank">privacy policy</a><br />
                                    Youtube - social media - <a href="https://www.youtube.com/static?template=privacy_guidelines" target="_blank">privacy policy</a><br />
                                    Twitter - social media - <a href="https://twitter.com/privacy" target="_blank">privacy policy</a><br />
                                    Linkedin - social media - <a href="http://it.linkedin.com/legal/privacy-policy" target="_blank">privacy policy</a><br />
                                    Pinterest - social media - <a href="https://about.pinterest.com/it/privacy-policy" target="_blank">privacy policy</a>
                                    <br /><br />

                                    <u>Which cookie using this site</u><br />
                                    Name: fmalertcookie<br />
                                    Domain: www.comvar.com<br />
                                    Duration: <br />
                                    Description: this cookie is used to remember the site if the user has already seen whether or not the information short and if you have already pressed the button "ok" contained therein.
                                    <br /><br />
                                    Name: session cookie, changes from time to time<br />
                                    Domain: www.comvar.com<br />
                                    Duration: it is deleted automatically with the end of browsing session<br />
                                    Description: this is a session cookie, and serves for the use of the site.
                                    <br /><br />
                                    Name: NID, PREF, OGPC<br />
                                    Domain: Google<br />
                                    Duration: NID 6 months, PREF 2 years, OGCP 1 month<br />
                                    Description: This cookie is used by Google to store preferences and user information each time they visit web pages containing geographical maps of Google Maps.
                                    <br /><br />

                                    <u>How to pay or withdraw consent</u><br />
                                    Permission for use of cookies is provided initially by clicking "ok" positioned within the information short / banner Home.
                                    <br /><br />
                                    The delivery of all cookies, both first and third party, can be deactivated by intervening on the settings of your browser; it is worth noting, however, that this could make it unusable sites if you bloccassero cookies are essential for the delivery of functionality.
                                    <br /><br />
                                    Each browser has different settings for disabling cookies; below we offer links to instructions for common browsers:<br />
                                    <a href="http://windows.microsoft.com/it-it/windows7/block-enable-or-allow-cookies" target="_blank">Microsoft Internet Explorer</a><br />
                                    <a href="https://support.google.com/accounts/answer/61416?hl=it" target="_blank">Google Chrome</a><br />
                                    <a href="https://support.apple.com/kb/PH19214?locale=it_IT" target="_blank">Apple Safari</a><br />
                                    <a href="https://support.mozilla.org/it/kb/Attivare%20e%20disattivare%20i%20cookie" target="_blank">Mozilla Firefox</a><br />
                                    <a href="http://help.opera.com/Windows/10.00/it/cookies.html" target="_blank">Opera</a>
                                </p>
                            </div>
                        </div><!-- /contenitore -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript" src="{{ asset('/js/jquery.cookiebar.js') }}"></script>
    <script>
        $(document).ready(function(){
            $.cookieBar({
            });
        });
    </script>

@endsection
