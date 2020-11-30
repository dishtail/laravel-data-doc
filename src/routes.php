<?php
    //权限管理
    Route::get('/doc/data_doc', ['as'=>'ddoc','uses'=>'Dishtail\DataDoc\Controllers\DataDocController@index']);
