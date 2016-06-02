<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CustomAuthController extends Controller
{

    
    public function __construct()
    {

    }



    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        //izsaukts validators, lietotājvārds, parole ir obligāti
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        //ja neizpildās, atgriež atpakaļ lapā ar ievadītajiem datiem
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        //ja autentifikācija neizpildās, atgriež atpakaļ lapā ar ievadītajiem datiem un kļūdu
        //paziņojumiem
        if (!Auth::attempt(['username' =>$request->input('username'), 'password' => $request->input('password')])) {
            $validator->errors()->add('login', 'No such user or password');
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

         //autentifikācija izpildās, atgriež sākuma lapā kā autorizētu lietotāju
        Log::info('loged in: '.$request->input('username'));
        return redirect('/');

    }

    /**
     * Funkcija apstrādā POST un izveido jaunu lietotāju
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request) {
        
        $validator =  Validator::make($request->all(), [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'type' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect('/register')
                ->withInput()
                ->withErrors($validator);

        } else {

            User::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'type' => $request->input('type'),
            ]);

            return redirect('/');

        }
    }
}
