<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;

class LogController extends BaseController
{

    public function signup_view() {
        if(Session::get('user_id')) {
            return redirect('userpage');
        }

        $error = Session::get('error');
        Session::forget('error');
        return view('signup')
            ->with('error', $error);
    }

    public function signup_form() {
        if(Session::get('user_id')) {
            return redirect('userpage');
        }

        //Validazione
        if(strlen(request('name')) == 0 || strlen(request('surname')) == 0 ||
            strlen(request('username')) == 0 || strlen(request('password')) == 0 ||
            strlen(request('email')) == 0) {

            Session::put('error','Non lasciare campi vuoti.');
            return redirect('signup')->withInput();
        }
        else if(!preg_match('/[a-zA-Z]{1,15}/', request('name'))) {
            Session::put('error','Nome non valido');
            return redirect('signup')->withInput();
        }
        else if(!preg_match('/[a-zA-Z]{1,15}/', request('surname'))) {
            Session::put('error','Cognome non valido');
            return redirect('signup')->withInput();
        }
        else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/", request('email'))) {
            Session::put('error','Email non valida');
            return redirect('signup')->withInput();
        }
        else if(User::where('email',request('email'))->first()) {
            Session::put('error','Email già utilizzata');
            return redirect('signup')->withInput();
        }
        else if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', request('username'))) {
            Session::put('error','Username non valido');
            return redirect('signup')->withInput();
        }
        else if(User::where('username',request('username'))->first()) {
            Session::put('error','Username già in uso');
            return redirect('signup')->withInput();
        }
        else if(strlen(request('password')) < 8) {
            Session::put('error','Password di almeno 8 caratteri');
            return redirect('signup')->withInput();
        }
        else if(!preg_match('/[a-zA-Z]/', request('password')) ||
                !preg_match('/[0-9]/', request('password')) ||
                !preg_match('/[^\w]/', request('password'))) {
            Session::put('error','La password necessita di almeno un carattere minuscolo, uno maiuscolo, un numero e un carattere speciale');
            return redirect('signup')->withInput();
        }

        //Inserimento nel db e login
        if(Session::get('error', true)) {
            $user = new User;
            $user->username = request('username');
            $user->name = request('name');
            $user->surname = request('surname');
            $user->email = request('email');
            $user->password = password_hash(request('password'),PASSWORD_BCRYPT);
            $user->save();

            Session::put('user_id', $user->id);
            return redirect('userpage');
        }
    }


    public function signin_view() {
        if(Session::get('user_id')) {
            return redirect('userpage');
        }

        $error = Session::get('error');
        Session::forget('error');
        return view('signin')
            ->with('error', $error);
    }

    public function signin_form() {
        if(Session::get('user_id')) {
            return redirect('userpage');
        }

        $user = User::where('username',request('username'))->first();
        if($user == null) {
            Session::put('error','Username inesistente');
            return redirect('signin')->withInput();
        }    
        if(!password_verify(request('password'),$user->password)) {
            Session::put('error','Password errata');
            return redirect('signin')->withInput();
        }
                
        Session::put('user_id',$user->id);
        return redirect('userpage');
    }


    public function logout(){
        Session::flush();
        return redirect('/');
    }
}
