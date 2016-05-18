<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vacancy;
use App\User;
use App\Application;
use App\Task;
use App\Answer;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /*
     * Apmācības uzdevuma labošana, pieejama tikai darba devējam
     */
    public function taskSave(Vacancy $vacancy, Task $task, Request $request)
    {
        $this->middleware('auth:insert_vacancy');

        $validator =  Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect('/task/edit/'.$vacancy->id.'/'.$task->id)->withInput()->withErrors($validator);

        } else {

            Task::where('id',$task->id)->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);

            return redirect('/tasks/'.$vacancy->id);
        }

        Log::info($task);

        return view('task_edit',[
            'vacancy' => $vacancy,
            'task' => $task,
            'request' => $request,
        ]);
    }

    /*
     * Apmācības uzdevuma pievienošana, pieejama tikai darba devējam
     */
    public function add(Vacancy $vacancy, Request $request) {

        $this->middleware('auth:insert_vacancy');

        $validator =  Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect('/task/add/'.$vacancy->id)->withInput()->withErrors($validator);

        } else {

            Task::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'vacancy_id' => $vacancy->id,
            ]);

            return redirect('/tasks/'.$vacancy->id);
        }
    }

    /*
     * Kandidāda atbilžu saraksta skats priekš darba devēja
     */
    public function userTasks(Vacancy $vacancy, Task $task, Request $request) {

        $this->middleware('auth:insert_vacancy');

        $tasks = Task::where('vacancy_id',$vacancy->id)->get();
        $application = Application::where('user_id',Auth::id())->where('vacancy_id',$vacancy->id)->first();

        if (!$task->id) {
            Log::info($task);
            $task = Task::where('vacancy_id',$vacancy->id)->first();
        }

        $answer = Answer::where('user_id',Auth::id())
            ->where('task_id',$task->id)->first();

        return view('answer_tasks',[
            'tasks' => $tasks,
            'vacancy' => $vacancy,
            'application' => $application,
            'request' => $request,
            'answer' => $answer,
            'task' => $task,
        ]);
    }


}
