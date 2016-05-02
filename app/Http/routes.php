<?php

use App\Vacancy;
use App\User;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


// ### SKATI, KAS PIEEJAMI DARBA DEVĒJIEM ###

// vakances pievienošanas formas
Route::get('/vacancy/add',['middleware' => 'auth:insert_vacancy', function () {
    return view('vacancy_add');
}]);


//vakances dzēšana
Route::get('/vacancy/{vacancy}/delete', function (Vacancy $vacancy, Request $request) {

    if ($request->user()->cannot('update_vacancy', $vacancy) && $request->user()->cannot('delete_all')) {
        return redirect('/vacancy/'.$vacancy->id);
    }

    $vacancy->delete();
    return redirect('/');
});

// vakances apmācības uzdevumu skats

// visas darba devēja vakances



// vakances pieteikšanās forma
Route::get('/vacancy/{vacancy}/apply',['middleware' => 'auth:apply_for_vacancy', function (Vacancy $vacancy, Request $request) {
    return view('vacancy_apply',[
        'vacancy' => $vacancy,
        'request' => $request,
    ]);

}]);

// ### SKATI, KAS PAREDZĒTI KANDIDĀTIEM###

// pieteikuma formas datu validācija un saglabāšana
Route::post('/vacancy/{vacancy}/apply','VacancyController@apply');

// pieteikuma skats
Route::get('/application/{application}', 'ApplicationController@view');


// ###SKATI KAS PIEEJAMI VISIEM###

// sākumlapa
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

// reģistrēšanās forma
Route::get('/register', function () {
    return view('register');
});

// reģistrācija datu validācija un saglabāšana
Route::post('/register', 'Auth\CustomAuthController@register');

// meklēšanas skats
Route::post('/search', 'VacancyController@search');

// autorizācijas datu validācija un lietotāja autorizēšana
Route::post('/login','Auth\CustomAuthController@authenticate');

// projekta apraksta skats
Route::get('/about', function ( Request $request) {
    return view('about');
});

// faila izgūšanas skats
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
// izlogošanās
Route::get('/logout',['middleware' => 'auth',  function () {
    Auth::logout();

    return redirect('/');
}]);



















