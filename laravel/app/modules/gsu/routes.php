<?php

Route::group(array('module'=>'Gsu','namespace' => 'App\Modules\Gsu\Controllers'), function() {

    //AJAX
    Route::get('/gsu/getclienti', 'GsuController@getclienti');

    //MAIN e DASHBOARD
    Route::get('gsu/index', 'GsuController@index');
    Route::get('gsu/main', 'GsuController@main');
    Route::get('gsu/search', 'GsuController@search');
    Route::get('gsu/anagrafica', 'GsuController@anagrafica');
    Route::get('gsu/logout', 'GsuController@logout');
    Route::get('gsu/getanagrafica', 'GsuController@getanagrafica');

    Route::get('gsu/dashboard',function(){
        return view("gsu::test");
    });

    //DIAL-UP
    Route::get('gsu/dial-up', 'DialUpController@main');
    Route::get('gsu/dial-up/search', 'DialUpController@search');
    Route::get('gsu/dial-up/show', 'DialUpController@show');
    Route::get('gsu/dial-up/edit', 'DialUpController@edit');
    Route::post('gsu/dial-up/save', 'DialUpController@save');
    Route::get('gsu/dial-up/delete', 'DialUpController@delete');

    //ADSL
    Route::get('gsu/adsl', 'AdslController@main');
    Route::get('gsu/adsl/search', 'AdslController@search');
    Route::get('gsu/adsl/show', 'AdslController@show');
    Route::get('gsu/adsl/edit', 'AdslController@edit');
    Route::post('gsu/adsl/save', 'AdslController@save');
    Route::get('gsu/adsl/delete', 'AdslController@delete');

    //DIRECT ACCESS
    Route::get('gsu/direct-access', 'DirectAccessController@main');
    Route::get('gsu/direct-access/search', 'DirectAccessController@search');
    Route::get('gsu/direct-access/show', 'DirectAccessController@show');
    Route::get('gsu/direct-access/edit', 'DirectAccessController@edit');
    Route::post('gsu/direct-access/save', 'DirectAccessController@save');
    Route::get('gsu/direct-access/delete', 'DirectAccessController@delete');

    //LINEA AGGIUNTIVA
    Route::get('gsu/linea-aggiuntiva', 'LineaAggiuntivaController@main');
    Route::get('gsu/linea-aggiuntiva/search', 'LineaAggiuntivaController@search');
    Route::get('gsu/linea-aggiuntiva/show', 'LineaAggiuntivaController@show');
    Route::get('gsu/linea-aggiuntiva/edit', 'LineaAggiuntivaController@edit');
    Route::post('gsu/linea-aggiuntiva/save', 'LineaAggiuntivaController@save');
    Route::get('gsu/linea-aggiuntiva/delete', 'LineaAggiuntivaController@delete');

    //MPLS
    Route::get('gsu/mpls', 'MplsController@main');
    Route::get('gsu/mpls/search', 'MplsController@search');
    Route::get('gsu/mpls/show', 'MplsController@show');
    Route::get('gsu/mpls/edit', 'MplsController@edit');
    Route::post('gsu/mpls/save', 'MplsController@save');
    Route::get('gsu/mpls/delete', 'MplsController@delete');

    //MPLS DIRECT ACCESS
    Route::get('gsu/mpls-direct-access', 'MplsDirectAccessController@main');
    Route::get('gsu/mpls-direct-access/search', 'MplsDirectAccessController@search');
    Route::get('gsu/mpls-direct-access/show', 'MplsDirectAccessController@show');
    Route::get('gsu/mpls-direct-access/edit', 'MplsDirectAccessController@edit');
    Route::post('gsu/mpls-direct-access/save', 'MplsDirectAccessController@save');
    Route::get('gsu/mpls-direct-access/delete', 'MplsDirectAccessController@delete');

    //DOMINI
    Route::get('gsu/domini', 'DominiController@main');
    Route::get('gsu/domini/search', 'DominiController@search');
    Route::get('gsu/domini/show', 'DominiController@show');
    Route::get('gsu/domini/edit', 'DominiController@edit');
    Route::post('gsu/domini/save', 'DominiController@save');
    Route::get('gsu/domini/delete', 'DominiController@delete');

    //HOSTING
    Route::get('gsu/hosting', 'HostingController@main');
    Route::get('gsu/hosting/search', 'HostingController@search');
    Route::get('gsu/hosting/show', 'HostingController@show');
    Route::get('gsu/hosting/edit', 'HostingController@edit');
    Route::post('gsu/hosting/save', 'HostingController@save');
    Route::get('gsu/hosting/delete', 'HostingController@delete');

    //HOUSING
    Route::get('gsu/housing', 'HousingController@main');
    Route::get('gsu/housing/search', 'HousingController@search');
    Route::get('gsu/housing/show', 'HousingController@show');
    Route::get('gsu/housing/edit', 'HousingController@edit');
    Route::post('gsu/housing/save', 'HousingController@save');
    Route::get('gsu/housing/delete', 'HousingController@delete');

    //DATABASE
    Route::get('gsu/database', 'DatabaseController@main');
    Route::get('gsu/database/search', 'DatabaseController@search');
    Route::get('gsu/database/show', 'DatabaseController@show');
    Route::get('gsu/database/edit', 'DatabaseController@edit');
    Route::post('gsu/database/save', 'DatabaseController@save');
    Route::get('gsu/database/delete', 'DatabaseController@delete');

    //WEBMARKETING
    Route::get('gsu/webmarketing', 'WebMarketingController@main');
    Route::get('gsu/webmarketing/search', 'WebMarketingController@search');
    Route::get('gsu/webmarketing/show', 'WebMarketingController@show');
    Route::get('gsu/webmarketing/edit', 'WebMarketingController@edit');
    Route::post('gsu/webmarketing/save', 'WebMarketingController@save');
    Route::get('gsu/webmarketing/delete', 'WebMarketingController@delete');

    //MAIL ARCHIVE
    Route::get('gsu/mailarchive', 'MailArchiveController@main');
    Route::get('gsu/mailarchive/search', 'MailArchiveController@search');
    Route::get('gsu/mailarchive/show', 'MailArchiveController@show');
    Route::get('gsu/mailarchive/edit', 'MailArchiveController@edit');
    Route::post('gsu/mailarchive/save', 'MailArchiveController@save');
    Route::get('gsu/mailarchive/delete', 'MailArchiveController@delete');

    //NOVIRUSNOSPAM
    Route::get('gsu/novirusnospam', 'NoVirusNoSpamController@main');
    Route::get('gsu/novirusnospam/search', 'NoVirusNoSpamController@search');
    Route::get('gsu/novirusnospam/show', 'NoVirusNoSpamController@show');
    Route::get('gsu/novirusnospam/edit', 'NoVirusNoSpamController@edit');
    Route::post('gsu/novirusnospam/save', 'NoVirusNoSpamController@save');
    Route::get('gsu/novirusnospam/delete', 'NoVirusNoSpamController@delete');

    //CASELLE
    Route::get('gsu/caselle', 'CaselleController@main');
    Route::get('gsu/caselle/search', 'CaselleController@search');
    Route::get('gsu/caselle/show', 'CaselleController@show');
    Route::get('gsu/caselle/edit', 'CaselleController@edit');
    Route::post('gsu/caselle/save', 'CaselleController@save');
    Route::get('gsu/caselle/delete', 'CaselleController@delete');

    //CMS
    Route::get('gsu/cms', 'CmsController@main');
    Route::get('gsu/cms/search', 'CmsController@search');
    Route::get('gsu/cms/show', 'CmsController@show');
    Route::get('gsu/cms/edit', 'CmsController@edit');
    Route::post('gsu/cms/save', 'CmsController@save');
    Route::get('gsu/cms/delete', 'CmsController@delete');

    //IP STATICI
    Route::get('gsu/ipstatici', 'IpstaticiController@main');
    Route::get('gsu/ipstatici/search', 'IpstaticiController@search');
    Route::get('gsu/ipstatici/show', 'IpstaticiController@show');
    Route::get('gsu/ipstatici/edit', 'IpstaticiController@edit');
    Route::post('gsu/ipstatici/save', 'IpstaticiController@save');
    Route::get('gsu/ipstatici/delete', 'IpstaticiController@delete');

    //SERVIZI WEB
    Route::get('gsu/servizi-web', 'ServiziWebController@main');
    Route::get('gsu/servizi-web/search', 'ServiziWebController@search');
    Route::get('gsu/servizi-web/show', 'ServiziWebController@show');
    Route::get('gsu/servizi-web/edit', 'ServiziWebController@edit');
    Route::post('gsu/servizi-web/save', 'ServiziWebController@save');
    Route::get('gsu/servizi-web/delete', 'ServiziWebController@delete');

    //URL FILTERING
    Route::get('gsu/url-filtering', 'UrlFilteringController@main');
    Route::get('gsu/url-filtering/search', 'UrlFilteringController@search');
    Route::get('gsu/url-filtering/show', 'UrlFilteringController@show');
    Route::get('gsu/url-filtering/edit', 'UrlFilteringController@edit');
    Route::post('gsu/url-filtering/save', 'UrlFilteringController@save');
    Route::get('gsu/url-filtering/delete', 'UrlFilteringController@delete');

    //APPARATI NETWORKING
    Route::get('gsu/apparati-networking', 'ApparatiNetworkingController@main');
    Route::get('gsu/apparati-networking/search', 'ApparatiNetworkingController@search');
    Route::get('gsu/apparati-networking/show', 'ApparatiNetworkingController@show');
    Route::get('gsu/apparati-networking/edit', 'ApparatiNetworkingController@edit');
    Route::post('gsu/apparati-networking/save', 'ApparatiNetworkingController@save');
    Route::get('gsu/apparati-networking/delete', 'ApparatiNetworkingController@delete');

    //MULTIFUNZIONE
    Route::get('gsu/multifunzione', 'MultifunzioneController@main');
    Route::get('gsu/multifunzione/search', 'MultifunzioneController@search');
    Route::get('gsu/multifunzione/show', 'MultifunzioneController@show');
    Route::get('gsu/multifunzione/edit', 'MultifunzioneController@edit');
    Route::post('gsu/multifunzione/save', 'MultifunzioneController@save');
    Route::get('gsu/multifunzione/delete', 'MultifunzioneController@delete');

    //CENTRALINI
    Route::get('gsu/centralini', 'CentraliniController@main');
    Route::get('gsu/centralini/search', 'CentraliniController@search');
    Route::get('gsu/centralini/show', 'CentraliniController@show');
    Route::get('gsu/centralini/edit', 'CentraliniController@edit');
    Route::post('gsu/centralini/save', 'CentraliniController@save');
    Route::get('gsu/centralini/delete', 'CentraliniController@delete');

    //APPARATI MOBILE
    Route::get('gsu/apparati-mobile', 'ApparatiMobileController@main');
    Route::get('gsu/apparati-mobile/search', 'ApparatiMobileController@search');
    Route::get('gsu/apparati-mobile/show', 'ApparatiMobileController@show');
    Route::get('gsu/apparati-mobile/edit', 'ApparatiMobileController@edit');
    Route::post('gsu/apparati-mobile/save', 'ApparatiMobileController@save');
    Route::get('gsu/apparati-mobile/delete', 'ApparatiMobileController@delete');

    //HARDWARE
    Route::get('gsu/hardware', 'HardwareController@main');
    Route::get('gsu/hardware/search', 'HardwareController@search');
    Route::get('gsu/hardware/show', 'HardwareController@show');
    Route::get('gsu/hardware/edit', 'HardwareController@edit');
    Route::post('gsu/hardware/save', 'HardwareController@save');
    Route::get('gsu/hardware/delete', 'HardwareController@delete');

    //FAX VIRTUALE
    Route::get('gsu/fax-virtuale', 'FaxVirtualeController@main');
    Route::get('gsu/fax-virtuale/search', 'FaxVirtualeController@search');
    Route::get('gsu/fax-virtuale/show', 'FaxVirtualeController@show');
    Route::get('gsu/fax-virtuale/edit', 'FaxVirtualeController@edit');
    Route::post('gsu/fax-virtuale/save', 'FaxVirtualeController@save');
    Route::get('gsu/fax-virtuale/delete', 'FaxVirtualeController@delete');
});