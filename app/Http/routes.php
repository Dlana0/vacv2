<?php

use App\Vacancy;
use App\User;
use App\Application;
use App\Task;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


// ### SKATI, KAS PIEEJAMI DARBA DEVÄ’JIEM ###

// vakances pievienoÅ?anas formas
Route::get('/vacancy/add',['middleware' => 'auth:insert_vacancy', function () {
    return view('vacancy_add');
}]);

// vakances datu validÄ?cija un pievienoÅ?ana
Route::post('/vacancy/add', 'VacancyController@edit');


// apmÄ?cÄ«bas uzdevumu pievienoÅ?anas forma



// vakances visi pieteikumi
Route::get('/applications/{vacancy}', 'ApplicationController@vacancyApplications');

// vakances visi pieteikumi ar atvÄ“rtu konkrÄ“tu pieteikumi
Route::get('/applications/{vacancy}/{uapplication}', 'ApplicationController@vacancyApplications');


// vakances pieteikÅ?anÄ?s forma
Route::get('/vacancy/{vacancy}/apply',['middleware' => 'auth:apply_for_vacancy', function (Vacancy $vacancy, Request $request) {
    return view('vacancy_apply',[
        'vacancy' => $vacancy,
        'request' => $request,
    ]);

}]);

// ### SKATI, KAS PAREDZÄ’TI KANDIDÄ€TIEM###

// pieteikuma formas datu validÄ?cija un saglabÄ?Å?ana
Route::post('/vacancy/{vacancy}/apply','VacancyController@apply');

// pieteikuma skats
Route::get('/application/{application}', 'ApplicationController@view');


// ###SKATI KAS PIEEJAMI VISIEM###

// sÄ?kumlapa
Route::get('/', 'VacancyController@latestVacancies');

// vakances atvÄ“rts skats
Route::get('/vacancy/{vacancy}', function (Vacancy $vacancy, Request $request) {

    $application = Application::where('user_id',Auth::id())->where('vacancy_id',$vacancy->id)->first();

    return view('vacancy',[
        'vacancy' => $vacancy,
        'application' => $application,
        'request' => $request,
    ]);
});

// reÄ£istrÄ“Å?anÄ?s forma
Route::get('/register', function () {
    return view('register');
});

// reÄ£istrÄ?cija datu validÄ?cija un saglabÄ?Å?ana
Route::post('/register', 'Auth\CustomAuthController@register');


// autorizÄ?cijas datu validÄ?cija un lietotÄ?ja autorizÄ“Å?ana
Route::post('/login','Auth\CustomAuthController@authenticate');

// projekta apraksta skats
Route::get('/about', function ( Request $request) {
    return view('about');
});

// faila izgÅ«Å?anas skats
Route::get('/file/{file}', function ($file) {

    if (Storage::has($file)) {
        $content = Storage::disk('local')->get($file);

        $type = Storage::mimeType($file);

        $response = Response::make($content);
        $response->header("Content-Type",$type);

        return $response;
    }
});

// ### SKATI, KAS PIEEJAMI VISIEM AUTORIZÄ’TIEM LIETOTÄ€JIEM ###
// izlogoÅ?anÄ?s
Route::get('/logout',['middleware' => 'auth',  function () {
    Auth::logout();

    return redirect('/');
}]);



















