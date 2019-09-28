<?php

Route::middleware(['auth', 'view'])->group(function () {
    Route::get('/', 'Controller@index')->name('home');//->middleware('view');
    Route::get('/forcelogout/{id}', 'Controller@forceLogout');
    Route::post('/changepass', 'Controller@changePass');

    Route::prefix('/protocols')->group(function () {
        Route::any('/', 'ProtocolController@index');
        Route::get('/delete/{id}', 'ProtocolController@delete');
        Route::any('/create', 'ProtocolController@create');
        Route::any('/edit/{id}', 'ProtocolController@edit');
        Route::any('/complement/{id}', 'ProtocolController@complement');
        Route::get('/company/select/{company_id}', 'CompanyController@select');
        Route::get('/company/edit/{company_id}', 'CompanyController@edit');
        Route::post('/company', 'CompanyController@create');
        Route::any('/pay/{id}', 'ProtocolController@pay');
    });
    
    Route::prefix('/protocoldoc')->group(function () {
        Route::get('/{id}', 'ProtocolDocController@theIndex');
        Route::get('/delete/{id}', 'ProtocolDocController@delete');
        Route::any('/create/{id}', 'ProtocolDocController@create');
        Route::any('/edit/{id}', 'ProtocolDocController@edit');
    });

    // Reports
    Route::any('/report_compare', 'ReportCompareController@index');
    Route::prefix('/report_company')->group(function () {
        Route::any('/', 'ReportCompanyController@index');
    });
    Route::prefix('/report_protocol')->group(function () {
        Route::any('/', 'ReportProtocolController@index');
    });
    Route::prefix('/report_warranty')->group(function () {
        Route::any('/', 'ReportProtocolController@indexWarranty');
    });
    // Statics
    Route::prefix('/statistics_protocol_type')->group(function () {
        Route::get('/', 'ProtocolTypeController@index');
        Route::get('/delete/{id}', 'ProtocolTypeController@delete');
        Route::any('/create', 'ProtocolTypeController@create');
        Route::any('/edit/{id}', 'ProtocolTypeController@edit');
    });
    Route::prefix('/statistics_certificate_type')->group(function () {
        Route::get('/', 'CertificateTypeController@index');
        Route::get('/delete/{id}', 'CertificateTypeController@delete');
        Route::any('/create', 'CertificateTypeController@create');
        Route::any('/edit/{id}', 'CertificateTypeController@edit');
    });
    Route::prefix('/statistics_city')->group(function () {
        Route::get('/', 'CityController@index');
        Route::get('/delete/{id}', 'CityController@delete');
        Route::any('/create', 'CityController@create');
        Route::any('/edit/{id}', 'CityController@edit');
    });
    Route::prefix('/statistics_province')->group(function () {
        Route::get('/', 'ProvinceController@index');
        Route::get('/delete/{id}', 'ProvinceController@delete');
        Route::any('/create', 'ProvinceController@create');
        Route::any('/edit/{id}', 'ProvinceController@edit');
    });
    Route::prefix('/statistics_Education')->group(function () {
        Route::get('/', 'StaticController@index');
        Route::get('/delete/{id}', 'StaticController@delete');
        Route::any('/create', 'StaticController@create');
        Route::any('/edit/{id}', 'StaticController@edit');
    });
    Route::prefix('/statistics_FormalityStatus')->group(function () {
        Route::get('/', 'StaticController@index');
        Route::get('/delete/{id}', 'StaticController@delete');
        Route::any('/create', 'StaticController@create');
        Route::any('/edit/{id}', 'StaticController@edit');
    });
    Route::prefix('/statistics_FormalityType')->group(function () {
        Route::get('/', 'StaticController@index');
        Route::get('/delete/{id}', 'StaticController@delete');
        Route::any('/create', 'StaticController@create');
        Route::any('/edit/{id}', 'StaticController@edit');
    });
    Route::prefix('/statistics_GiveWay')->group(function () {
        Route::get('/', 'StaticController@index');
        Route::get('/delete/{id}', 'StaticController@delete');
        Route::any('/create', 'StaticController@create');
        Route::any('/edit/{id}', 'StaticController@edit');
    });
    Route::prefix('/statistics_Ownership')->group(function () {
        Route::get('/', 'StaticController@index');
        Route::get('/delete/{id}', 'StaticController@delete');
        Route::any('/create', 'StaticController@create');
        Route::any('/edit/{id}', 'StaticController@edit');
    });
    Route::prefix('/statistics_Service')->group(function () {
        Route::get('/', 'StaticController@index');
        Route::get('/delete/{id}', 'StaticController@delete');
        Route::any('/create', 'StaticController@create');
        Route::any('/edit/{id}', 'StaticController@edit');
    });
    Route::prefix('/statistics_ServicesDesc')->group(function () {
        Route::get('/', 'StaticController@index');
        Route::get('/delete/{id}', 'StaticController@delete');
        Route::any('/create', 'StaticController@create');
        Route::any('/edit/{id}', 'StaticController@edit');
    });
    Route::prefix('/statistics_Transaction')->group(function () {
        Route::get('/', 'StaticController@index');
        Route::get('/delete/{id}', 'StaticController@delete');
        Route::any('/create', 'StaticController@create');
        Route::any('/edit/{id}', 'StaticController@edit');
    });
    Route::prefix('/statistics_Unit')->group(function () {
        Route::get('/', 'StaticController@index');
        Route::get('/delete/{id}', 'StaticController@delete');
        Route::any('/create', 'StaticController@create');
        Route::any('/edit/{id}', 'StaticController@edit');
    });
    Route::prefix('/statistics_WinnerSelectWay')->group(function () {
        Route::get('/', 'StaticController@index');
        Route::get('/delete/{id}', 'StaticController@delete');
        Route::any('/create', 'StaticController@create');
        Route::any('/edit/{id}', 'StaticController@edit');
    });

    /*
    Route::get('/help', 'RequestController@helpMain');
    Route::get('/help/{page}', 'RequestController@helpPage');
    Route::post('/editprofile', 'RequestController@editProfile');
    //---------Resident--------------
    Route::get('/resident', 'ResidentController@index');
    Route::get('/resident_signs', 'ResidentSignController@index');
    Route::get('/resident_coin_trans', 'ResidentCoinTransactionController@index');
    Route::prefix('/resident_catagory')->group(function () {
        Route::get('/', 'ResidentController@catIndex');
        Route::get('/delete/{id}', 'ResidentController@catDelete');
        Route::any('/create', 'ResidentController@catCreate');
        Route::any('/edit/{id}', 'ResidentController@catEdit');
    });
    Route::prefix('/resident_leaderboard')->group(function () {
        Route::get('/', 'ResidentController@leaderBoard');
        Route::get('/accept_privecy', 'ResidentController@acceptPrivecy');
        // Route::any('/create', 'ResidentController@catCreate');
        // Route::any('/edit/{id}', 'ResidentController@catEdit');
    });
    Route::post('/resident_image', 'ResidentController@updateImage');
    Route::get('/resident_activity', 'ResidentController@activityIndex');
    Route::get('/resident_activity/join/{id}', 'ResidentController@activityJoin');    
    Route::get('/resident_tournament', 'ResidentController@tournamentIndex');
    Route::get('/resident_tournament/join/{id}', 'ResidentController@tournamentJoin');
    Route::get('/resident_tournament/leader/{id}', 'ResidentController@tournamentLeader');
    Route::get('/resident_battle', 'ResidentController@battleIndex');
    Route::get('/resident_battle/join/{id}', 'ResidentController@battleJoin');
    //\--------Resident--------------
    //---------WebService--------------
    Route::prefix('/userlevels')->group(function () {
        Route::get('/', 'UserLevelController@index');
        Route::get('/delete/{id}', 'UserLevelController@delete');
        Route::any('/create', 'UserLevelController@create');
        Route::any('/edit/{id}', 'UserLevelController@edit');
    });
    Route::prefix('/user_medalians')->group(function () {
        Route::get('/', 'UserMedalianController@index');
        Route::get('/delete/{id}', 'UserMedalianController@delete');
        Route::any('/create', 'UserMedalianController@create');
        Route::any('/edit/{id}', 'UserMedalianController@edit');
    });
    // Route::prefix('/user_token')->group(function () {
    //     Route::get('/', 'UserTokenController@index');
    // });
    //\--------WebService--------------
    Route::prefix('/req')->group(function () {
        Route::get('/', 'RequestController@index');
        Route::get('/delete/{id}', 'RequestController@requestDelete');
        Route::any('/edit/{id}', 'RequestController@requestEdit');
        Route::any('/permissions/{id}', 'RequestController@permissions');
        Route::any('/permissions_create/{user_id}', 'RequestController@permissionsCreate');
        Route::any('/permissions_edit/{user_id}/{id}', 'RequestController@permissionsEdit');
        Route::get('/permissions_delete/{user_id}/{id}', 'RequestController@permissionsDelete');
        Route::any('/permissions_time/{user_id}/{id}', 'RequestController@permissionsTime');
        Route::any('/permissions_time_edit/{user_propety_times_id}/{user_properties_id}', 'RequestController@permissionsTimeEdit');
        Route::any('/permissions_time_delete/{user_propety_times_id}/{user_properties_id}', 'RequestController@permissionsTimeDelete');
        Route::any('/permissions_time_create/{user_properties_id}', 'RequestController@permissionsTimeCreate');
        Route::any('/catagory/{id}', 'RequestController@catagory');
        Route::any('/catagory_create/{user_id}', 'RequestController@catagoryCreate');
        Route::any('/catagory_edit/{user_id}/{id}', 'RequestController@catagoryEdit');
        Route::get('/catagory_delete/{user_id}/{id}', 'RequestController@catagoryDelete');
    });
    Route::any('/statistics_coin', 'StatisticsController@coins');
    Route::any('/statistics_usage', 'StatisticsController@usages');
    Route::prefix('/activity_groups')->group(function () {
        Route::get('/', 'ActivityController@index');
        Route::get('/delete/{id}', 'ActivityController@delete');
        Route::any('/create', 'ActivityController@create');
        Route::any('/edit/{id}', 'ActivityController@edit');
        Route::get('/reward/{id}', 'ActivityController@reward');
    });
    Route::prefix('/tournamets')->group(function () {
        Route::get('/', 'TournamentController@index');
        Route::get('/delete/{id}', 'TournamentController@delete');
        Route::any('/create', 'TournamentController@create');
        Route::any('/edit/{id}', 'TournamentController@edit');
    });
    Route::prefix('/battle')->group(function () {
        Route::get('/', 'BattleController@index');
        Route::get('/delete/{id}', 'BattleController@delete');
        Route::any('/create', 'BattleController@create');
        Route::any('/edit/{id}', 'BattleController@edit');
    });
    Route::prefix('/fields')->group(function () {
        Route::get('/', 'FieldController@index');
        Route::get('/delete/{id}', 'FieldController@delete');
        Route::any('/create', 'FieldController@create');
        Route::any('/edit/{id}', 'FieldController@edit');
    });
    Route::prefix('/resident_catagories')->group(function () {
        Route::get('/', 'ResidentCatagoryController@index');
        Route::get('/delete/{id}', 'ResidentCatagoryController@delete');
        Route::any('/create', 'ResidentCatagoryController@create');
        Route::any('/edit/{id}', 'ResidentCatagoryController@edit');
    });
    Route::prefix('/levels')->group(function () {
        Route::get('/', 'LevelController@index');
        Route::get('/delete/{id}', 'LevelController@delete');
        Route::any('/create', 'LevelController@create');
        Route::any('/edit/{id}', 'LevelController@edit');
    });
    Route::prefix('/nicknames')->group(function () {
        Route::get('/', 'ResidentNicknameController@index');
        Route::get('/delete/{id}', 'ResidentNicknameController@delete');
        Route::any('/create', 'ResidentNicknameController@create');
        Route::any('/edit/{id}', 'ResidentNicknameController@edit');
    });
    Route::prefix('/sequences')->group(function () {
        Route::get('/', 'SequenceController@index');
        Route::get('/delete/{id}', 'SequenceController@delete');
        Route::any('/create', 'SequenceController@create');
        Route::any('/edit/{id}', 'SequenceController@edit');
        Route::any('/details/{id}', 'SequenceController@detail');
    });
    Route::prefix('/sign')->group(function () {
        Route::get('/', 'SignController@index');
        Route::get('/delete/{id}', 'SignController@delete');
        Route::any('/create', 'SignController@create');
        Route::any('/edit/{id}', 'SignController@edit');
    });
    Route::prefix('/sequence_details')->group(function () {
        Route::get('/delete/{id}/{sequence_id}', 'SequenceController@detailDelete');
        Route::any('/create/{sequence_id}', 'SequenceController@detailCreate');
        Route::any('/edit/{id}/{sequence_id}', 'SequenceController@detailEdit');
    });
    Route::any('/under', 'Controller@under');
    */
});
Route::any('/login', 'Controller@login')->name('login');
// Route::any('/register', 'Controller@register');
// Route::any('/resident_login', 'Controller@rLogin')->name('rlogin');
