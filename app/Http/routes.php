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


// ### SKATI, KAS PIEEJAMI DARBA DEVĒJIEM ###

// vakances pievieno�?anas formas
Route::get('/vacancy/add',['middleware' => 'auth:insert_vacancy', function () {
    return view('vacancy_add');
}]);

// vakances datu valid�?cija un pievieno�?ana
Route::post('/vacancy/add', 'VacancyController@edit');


// apm�?cības uzdevumu pievieno�?anas forma



// vakances visi pieteikumi
Route::get('/applications/{vacancy}', 'ApplicationController@vacancyApplications');

// vakances visi pieteikumi ar atvērtu konkrētu pieteikumi
Route::get('/applications/{vacancy}/{uapplication}', 'ApplicationController@vacancyApplications');


// vakances pieteik�?an�?s forma
Route::get('/vacancy/{vacancy}/apply',['middleware' => 'auth:apply_for_vacancy', function (Vacancy $vacancy, Request $request) {
    return view('vacancy_apply',[
        'vacancy' => $vacancy,
        'request' => $request,
    ]);

}]);

// ### SKATI, KAS PAREDZĒTI KANDIDĀTIEM###

// pieteikuma formas datu valid�?cija un saglab�?�?ana
Route::post('/vacancy/{vacancy}/apply','VacancyController@apply');

// pieteikuma skats
Route::get('/application/{application}', 'ApplicationController@view');


// ###SKATI KAS PIEEJAMI VISIEM###

// s�?kumlapa
Route::get('/', 'VacancyController@latestVacancies');

// vakances atvērts skats
Route::get('/vacancy/{vacancy}', function (Vacancy $vacancy, Request $request) {

    $application = Application::where('user_id',Auth::id())->where('vacancy_id',$vacancy->id)->first();

    return view('vacancy',[
        'vacancy' => $vacancy,
        'application' => $application,
        'request' => $request,
    ]);
});

// reģistrē�?an�?s forma
Route::get('/register', function () {
    return view('register');
});

// reģistr�?cija datu valid�?cija un saglab�?�?ana
Route::post('/register', 'Auth\CustomAuthController@register');


// autoriz�?cijas datu valid�?cija un lietot�?ja autorizē�?ana
Route::post('/login','Auth\CustomAuthController@authenticate');

// projekta apraksta skats
Route::get('/about', function ( Request $request) {
    return view('about');
});

// faila izgū�?anas skats
Route::get('/file/{file}', function ($file) {

    if (Storage::has($file)) {
        $content = Storage::disk('local')->get($file);

        $type = Storage::mimeType($file);

        $response = Response::make($content);
        $response->header("Content-Type",$type);

        return $response;
    }
});

// ### SKATI, KAS PIEEJAMI VISIEM AUTORIZĒTIEM LIETOTĀJIEM ###
// izlogo�?an�?s
Route::get('/logout',['middleware' => 'auth',  function () {
    Auth::logout();

    return redirect('/');
}]);



















