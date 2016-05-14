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

class AnswerController extends Controller
{
    /**
     * Apstrādā un saglabā kandidāta atbildi uz uzdevumu
     * @param Vacancy $vacancy
     * @param Task $task
     * @param Request $request
     * @return mixed
     */
    public function answerSave(Vacancy $vacancy, Task $task, Request $request)
    {
        $this->middleware('auth:apply_for_vacancy');


        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/answer_tasks/'.$vacancy->id.'/'.$task->id)->withInput()->withErrors($validator);
        }

        $application = Application::where('user_id', Auth::id())
            ->where('vacancy_id', $task->vacancy_id)
            ->first();


        $answers = Answer::where('user_id', Auth::id())
            ->where('task_id', $task->id)
            ->where('application_id', $application->id)
            ->get();

        Log::info('pirms skatīt atbildi');
        if (count($answers) > 0) {
            $validator->errors()->add('title', 'Uzdevumam var būt tikai viena atbilde');
            return redirect('/answer_tasks/'.$vacancy->id.'/'.$task->id)
                ->withInput()
                ->withErrors($validator);
        }

        $return = Answer::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'application_id' => $application->id,
            'text' => $request->input('text'),
        ]);

        $file = $request->file('file');

        if ($file) {

            $extension = $file->getClientOriginalExtension();
            if ($extension != 'pdf' && $extension != 'doc' && $extension != 'docx') {
                $validator->errors()->add('file', 'Ir atļauti tikai šādi faila formāti (pdf,doc,docx)');
                return redirect('/answer_tasks/'.$vacancy->id.'/'.$task->id)
                    ->withInput()
                    ->withErrors($validator);
            }

            // uztaisam jauno faila nosaukumu
            $id = $return['id'];
            $hash = md5($id . date('YmdHis') . rand(0, 99999));
            $file_name = 'answer-' . $hash . '.' . $extension;

            Storage::put($file_name, file_get_contents($request->file('file')));

            // updeitoja pieteikumu tabulu ar jauno faila nosaukumu
            Answer::where('id', $id)->update([
                'file' => $file_name,
            ]);
        }

        return redirect('/answer_tasks/'.$vacancy->id.'/'.$task->id);

    }
    
    /**
     * Apstrādā un saglabā darba devēja atzīmi dotajai atbildei
     * @param Vacancy $vacancy
     * @param Application $uapplication
     * @param Request $request
     * @return mixed
     */
    public function saveMark(Vacancy $vacancy, Application $uapplication, Request $request) {

        $this->middleware('auth:insert_vacancy');

        $uapplication = Application::where('vacancy_id',$vacancy->id)->first();

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/applications/'.$vacancy->id.'/'.$uapplication->id.'#answer_'.$request->input('id'))->withInput()->withErrors($validator);
        }

        Answer::where('id', $request->input('id'))->update([
            'note' => $request->input('note'),
            'mark' => $request->input('mark'),
        ]);

        return redirect('/applications/'.$vacancy->id.'/'.$uapplication->id.'#answer_'.$request->input('id'));
    }
}
