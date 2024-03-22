<?php

$prefix = config('wcmspolls_config.prefix');
Route::group(['namespace' => 'Darkpony\WCMSPolls\Http\Controllers', 'prefix' => $prefix, 'middleware' => 'web'], function(){

    $middleware = config('wcmspolls_config.admin_auth');

    $guard = config('wcmspolls_config.admin_guard');
    Route::middleware(["$middleware:$guard"])->group(function () {
        Route::get('/admin/wcms-polldashboard', ['uses' => 'PollManagerController@home', 'as' => 'poll.home']);
        Route::get('/admin/wcms-polls', ['uses' => 'PollManagerController@index', 'as' => 'poll.index']);
        Route::get('/admin/wcms-polls/create', ['uses' => 'PollManagerController@create', 'as' => 'poll.create']);
        Route::get('/admin/wcms-polls/{poll}', ['uses' => 'PollManagerController@edit', 'as' => 'poll.edit']);
        Route::patch('/admin/wcms-polls/{poll}', ['uses' => 'PollManagerController@update', 'as' => 'poll.update']);
        Route::delete('/admin/wcms-polls/{poll}', ['uses' => 'PollManagerController@remove', 'as' => 'poll.remove']);
        Route::patch('/admin/wcms-polls/{poll}/lock', ['uses' => 'PollManagerController@lock', 'as' => 'poll.lock']);
        Route::patch('/admin/wcms-polls/{poll}/unlock', ['uses' => 'PollManagerController@unlock', 'as' => 'poll.unlock']);
        Route::post('/admin/wcms-polls', ['uses' => 'PollManagerController@store', 'as' => 'poll.store']);
    });

    Route::post('/vote/polls/{poll}', 'VoteManagerController@vote')->name('poll.vote');
});
