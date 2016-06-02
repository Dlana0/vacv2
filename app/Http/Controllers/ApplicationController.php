<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Vacancy;
use App\Application;
use App\Answer;
use Illuminate\Support\Facades\App;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ApplicationController extends Controller
{
    /*
     * Vakances pieteikumu saraksts, ko redz tikai darba dēvējs
     */
    public function vacancyApplications(Vacancy $vacancy, Request $request, Application $uapplication)
    {
        $this->middleware('auth:insert_vacancy');

        $answers = false;

        $applications = Application::leftJoin('users', 'users.id', '=', 'applications.user_id')
            ->where('vacancy_id',$vacancy->id)
            ->select('users.name', 'applications.created_at','applications.file','applications.id','applications.status')
            ->get();

        $vacancy = Vacancy::where('id',$vacancy->id)->first();

        if (!$uapplication->id) {
            $uapplication = Application::where('vacancy_id',$vacancy->id)->first();
        }

        if (isset($uapplication->id)) {
            $answers = Answer::leftJoin('tasks', 'answers.task_id', '=', 'tasks.id')
                ->where('answers.application_id', $uapplication->id)
                ->select('tasks.title', 'tasks.description', 'answers.text', 'answers.file', 'answers.mark', 'answers.note', 'answers.id as answer_id')
                ->get();
        }

        //atgriež skatu ar saglabātajām mainīgā vērtībām
        return view('applications',[
            'applications' => $applications,
            'vacancy' => $vacancy,
            'request' => $request,
            'uapplication' => $uapplication,
            'answers' => $answers,
        ]);
    }

    /*
     * Kandidāta pieteikumu saraksts
     */
    public function my() {

        $this->middleware('auth:apply_for_vacancy');

        $applications = Application::leftJoin('vacancies', 'applications.vacancy_id', '=', 'vacancies.id')
            ->where('applications.user_id',Auth::id())
            ->where('vacancies.id','!=',' null')
            ->select('vacancies.title', 'vacancies.description','vacancies.duration', 'applications.vacancy_id','applications.id', 'applications.status','applications.created_at')
            ->get();


        return view('my_applications',[
            'applications' => $applications,
        ]);
    }

    /*
     * Kandidāta pievienotā pieteikuma skats
     */
    public function view(Application $application, Request $request) {

        $this->middleware('auth:apply_for_vacancy');

        $vacancy = Vacancy::where('id',$application->vacancy_id)->first();
        return view('application',[
            'application' => $application,
            'vacancy' => $vacancy,
            'request' => $request,
        ]);
    }

    /*
     * Pieteikuma statusa maiņa, kas ir pieejama tikai darba devējam
     */
    public function updateStatus(Application $application, Request $request) {

        $this->middleware('auth:insert_vacancy');

        $vacancy = Vacancy::where('id',$application->vacancy_id)->first();

        //tiek izmainīti application tabulas status rindiņas dati
        Application::where('id',$application->id)->update([
            'status' => $request->input('status'),
        ]);

        return redirect('/applications/'.$vacancy->id.'/'.$application->id);

    }
}
