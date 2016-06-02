<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vacancy;
use App\Application;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VacancyController extends Controller
{
    /*
     * vakances pieteikuma apstrāde, pieejama kandidātiem
     */
    public function apply(Vacancy $vacancy, Request $request)
    {
        $this->middleware('auth:apply_for_vacancy');

        $validator =  Validator::make($request->all(), [
            'education' => 'required',
            'type' => 'required',
            'file' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect('/vacancy/'.$vacancy->id.'/apply')
                ->withInput()
                ->withErrors($validator);
        }

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();


        if ($extension != 'pdf' && $extension != 'doc' && $extension != 'docx') {
            $validator->errors()->add('file', 'Ir atļauti tikai šādi faila formāti (pdf,doc,docx)');
            return redirect('/vacancy/'.$vacancy->id.'/apply')
                ->withInput()
                ->withErrors($validator);
        }

        $applications = Application::where('user_id',Auth::id())
            ->where('vacancy_id',$vacancy->id)
            ->get();

        if (count($applications) > 0) {
            $validator->errors()->add('title', 'Šim lietotājam jau ir izveidots pieteikums vakancei');
            return redirect('/vacancy/'.$vacancy->id.'/apply')
                ->withInput()
                ->withErrors($validator);
        }


        $return = Application::create([
            'user_id' => Auth::id(),
            'vacancy_id' => $vacancy->id,
            'status' => 0,
            'education' => $request->input('education'),
            'comments' => $request->input('comments'),
            'archievments' => $request->input('archievments'),
            'type' => $request->input('type'),
        ]);
        Log:info($return);
        // uztaisam jauno faila nosaukumu
        $id = $return['id'];
        $hash = md5($id.date('YmdHis').rand(0,99999));
        $file_name = 'cv-'.$hash.'.'.$extension;

        Storage::put($file_name, file_get_contents($request->file('file')));


        // updeitoja pieteikumu tabulu ar jauno faila nosaukumu
        Application::where('id',$id)->update([
            'file' => $file_name,
        ]);

        return redirect('/application/'.$id);
    }

    /*
     * vakances datu labošana, pieejama darba devējiem
     */
    public function edit(Request $request, Vacancy $vacancy) {

        $this->middleware('auth:insert_vacancy');

        if(isset($vacancy->id)) {
            $url = '/vacancy/'.$vacancy->id.'/edit';

            if ($request->user()->cannot('update_vacancy', $vacancy)) {
                return redirect('/vacancy/'.$vacancy->id);
            }

        } else {
            $url = '/vacancy/add';
        }

        $validator =  Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required|date',
        ]);

        if ($validator->fails()) {

            return redirect($url)
                ->withInput()
                ->withErrors($validator);

        } else {

            if (isset($vacancy->id)) {
                Vacancy::where('id',$vacancy->id)->update([
                        'title' => $request->input('title'),
                        'description' => $request->input('description'),
                        'requirements' => $request->input('requirements'),
                        'knowledge' => $request->input('knowledge'),
                        'obligations' => $request->input('obligations'),
                        'duration' => $request->input('duration'),
                    ]);

                $return_id = $vacancy->id;

            } else {
                $return = Vacancy::create([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'requirements' => $request->input('requirements'),
                    'knowledge' => $request->input('knowledge'),
                    'obligations' => $request->input('obligations'),
                    'duration' => $request->input('duration'),
                    'user_id' => Auth::id(),
                ]);

                $return_id = $return['id'];
            }

            return redirect('/vacancy/'.$return_id);
        }
    }

    /*
     * meklēšana pieejam visiem
     */
    public function search(Request $request) {

        $vacancies = Vacancy::leftjoin('users','users.id','=','vacancies.user_id')
            ->where('title','LIKE','%'.$request->input('search').'%')
            ->orWhere('description','LIKE','%'.$request->input('search').'%')
            ->orWhere('requirements','LIKE','%'.$request->input('search').'%')
            ->orWhere('knowledge','LIKE','%'.$request->input('search').'%')
            ->orWhere('obligations','LIKE','%'.$request->input('search').'%')
            ->select('users.name','vacancies.title','vacancies.description','vacancies.duration','vacancies.id')
            ->orderBy('vacancies.created_at', 'desc')->get();

        return view('search', [
            'vacancies' => $vacancies,
            'search' => $request->input('search'),
        ]);

    }

    /*
     * jaunākās vakances pieejamas visiem
     */
    public function latestVacancies(Request $request) {
        $vacancies = Vacancy::leftjoin('users','users.id','=','vacancies.user_id')
            ->where('duration','>',date('Y-m-d'))
            ->select('users.name','vacancies.title','vacancies.description','vacancies.duration','vacancies.id')
            ->orderBy('vacancies.created_at', 'asc')->get();
        return view('vacancies', [
            'vacancies' => $vacancies
        ]);
    }
    
    /*
     * Darba devēja pievienoto vakanču saraksts
     */
    public function userVacancies() {

        $this->middleware('auth:insert_vacancy');

        $vacancies = Vacancy::leftjoin('users','users.id','=','vacancies.user_id')
            ->where('user_id','=',Auth::id())
            ->select('users.name','vacancies.title','vacancies.description','vacancies.duration','vacancies.id')
            ->orderBy('vacancies.created_at', 'asc')->get();

        return view('my_vacancies', [
            'vacancies' => $vacancies
        ]);
    }
}
