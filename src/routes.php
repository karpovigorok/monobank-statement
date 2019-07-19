<?php

Route::group(['middleware' => ['web']], function () {

    Route::post('check_token', 'Karpovigorok\MonobankAPI\Controllers\MainpageController@check_token');
    Route::get('start', 'Karpovigorok\MonobankAPI\Controllers\MainpageController@start');
    Route::post('statement', 'Karpovigorok\MonobankAPI\Controllers\MainpageController@process_statement');
    Route::get('statement/{uid}', 'Karpovigorok\MonobankAPI\Controllers\MainpageController@statement');
    Route::get('/', 'Karpovigorok\MonobankAPI\Controllers\MainpageController@index');
    Route::get('/forget_xtoken', 'Karpovigorok\MonobankAPI\Controllers\MainpageController@forget_xtoken');
});