<?php

use App\Vacancy;
use App\User;


// ### SKATI, KAS PIEEJAMI DARBA DEVĒJIEM ###

// vakances pievieno�?anas formas


// vakances datu valid�?cija un pievieno�?ana


// vakances labo�?anas forma

// vakances datu valid�?cija un uzlabo�?ana


//vakances dzē�?ana


// apm�?cības uzdevumu pievieno�?anas forma
Route::get('/task/add/{vacancy}',['middleware' => 'auth:insert_vacancy', function (Vacancy $vacancy, Request $request) {

    return view('task_add',[
        'vacancy' => $vacancy,
        'request' => $request,
    ]);
}]);


// visas darba devēja vakances

// vakances visi pieteikumi


// ### SKATI, KAS PAREDZĒTI KANDIDĀTIEM###


// uzdevumu skats uz kuriem j�?atbild kandid�?tam

// kandid�?ta atbilžu saglab�?�?ana


// ###SKATI KAS PIEEJAMI VISIEM###

// s�?kumlapa




// faila izgū�?anas skats


// ### SKATI, KAS PIEEJAMI VISIEM AUTORIZĒTIEM LIETOTĀJIEM ###
// izlogo�?an�?s
Route::get('/logout',['middleware' => 'auth',  function () {
    Auth::logout();

    return redirect('/');
}]);



















