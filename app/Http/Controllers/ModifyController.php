<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;

class ModifyController extends BaseController
{
    public function modify_account_view() {
        if(!Session::get('user_id') || !Session::get('password_verified')) {
            return redirect('userpage');
        }

        $user = User::find(Session::get('user_id'));
        $error = Session::get('error');
        Session::forget('error');
        return view('modify_account')
            ->with('error', $error)
            ->with('user', $user);
    }

    public function modify_form() {
        if(!Session::get('user_id') || !Session::get('password_verified')) {
            return redirect('userpage');
        }

        //Validazione
        if(strlen(request('name')) == 0 || strlen(request('surname')) == 0 ||
            strlen(request('username')) == 0 || strlen(request('password')) == 0 ||
            strlen(request('email')) == 0) {

            Session::put('error','Non lasciare campi vuoti.');
            return redirect('modify_account')->withInput();
        }
        else if(!preg_match('/[a-zA-Z]{1,15}/', request('name'))) {
            Session::put('error','Nome non valido');
            return redirect('modify_account')->withInput();
        }
        else if(!preg_match('/[a-zA-Z]{1,15}/', request('surname'))) {
            Session::put('error','Cognome non valido');
            return redirect('modify_account')->withInput();
        }
        else if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/", request('email'))) {
            Session::put('error','Email non valida');
            return redirect('modify_account')->withInput();
        }
        else if(User::where('email',request('email'))->first() && 
                User::where('email',request('email'))->first()->id != Session::get('user_id')) {
            Session::put('error','Email già utilizzata');
            return redirect('modify_account')->withInput();
        }
        else if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', request('username'))) {
            Session::put('error','Username non valido');
            return redirect('modify_account')->withInput();
        }
        else if(User::where('username',request('username'))->first() &&
                User::where('username',request('username'))->first()->id != Session::get('user_id')) {
            Session::put('error','Username già in uso');
            return redirect('modify_account')->withInput();
        }
        else if(strlen(request('password')) < 8) {
            Session::put('error','Password di almeno 8 caratteri');
            return redirect('modify_account')->withInput();
        }
        else if(!preg_match('/[a-zA-Z]/', request('password')) ||
                !preg_match('/[0-9]/', request('password')) ||
                !preg_match('/[^\w]/', request('password'))) {
            Session::put('error','La password necessita di almeno un carattere minuscolo, uno maiuscolo, un numero e un carattere speciale');
            return redirect('modify_account')->withInput();
        }

        //Aggiornamento database
        if(!Session::get('error')) {
            $user = User::find(Session::get('user_id'));
            $user->username = request('username');
            $user->name = request('name');
            $user->surname = request('surname');
            $user->email = request('email');
            $user->password = password_hash(request('password'),PASSWORD_BCRYPT);
            $user->save();

            Session::forget('password_verified');
            return redirect('userpage');
        }
    }

    public function unverify_password(){
        if(!Session::get('user_id') || !Session::get('password_verified')) {
            return redirect('/');
        }

        Session::forget('password_verified');
    }

}

?>