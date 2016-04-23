<?php

use App\Vacancy;
use App\User;


// ### SKATI, KAS PIEEJAMI DARBA DEVÄ’JIEM ###

// vakances pievienoÅ?anas formas


// vakances datu validÄ?cija un pievienoÅ?ana


// vakances laboÅ?anas forma

// vakances datu validÄ?cija un uzlaboÅ?ana


//vakances dzÄ“Å?ana


// apmÄ?cÄ«bas uzdevumu pievienoÅ?anas forma
Route::get('/task/add/{vacancy}',['middleware' => 'auth:insert_vacancy', function (Vacancy $vacancy, Request $request) {

    return view('task_add',[
        'vacancy' => $vacancy,
        'request' => $request,
    ]);
}]);


// visas darba devÄ“ja vakances

// vakances visi pieteikumi


// ### SKATI, KAS PAREDZÄ’TI KANDIDÄ€TIEM###


// uzdevumu skats uz kuriem jÄ?atbild kandidÄ?tam

// kandidÄ?ta atbilÅ¾u saglabÄ?Å?ana


// ###SKATI KAS PIEEJAMI VISIEM###

// sÄ?kumlapa




// faila izgÅ«Å?anas skats


// ### SKATI, KAS PIEEJAMI VISIEM AUTORIZÄ’TIEM LIETOTÄ€JIEM ###
// izlogoÅ?anÄ?s
Route::get('/logout',['middleware' => 'auth',  function () {
    Auth::logout();

    return redirect('/');
}]);



















