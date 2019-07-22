<?php

Route::group(['middleware' => ['web']], function () {

    Route::post('check_token', 'Karpovigorok\MonobankStatement\Controllers\MainpageController@check_token');
    Route::get('start', 'Karpovigorok\MonobankStatement\Controllers\MainpageController@start');
    Route::post('statement', 'Karpovigorok\MonobankStatement\Controllers\MainpageController@process_statement');
    Route::get('statement/{uid}', 'Karpovigorok\MonobankStatement\Controllers\MainpageController@statement');
    Route::get('/', 'Karpovigorok\MonobankStatement\Controllers\MainpageController@index');
    Route::get('/forget_xtoken', 'Karpovigorok\MonobankStatement\Controllers\MainpageController@forget_xtoken');
});