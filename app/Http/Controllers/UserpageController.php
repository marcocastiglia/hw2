<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;

class UserpageController extends BaseController {
    public function userpage_view() {
        $user_id = Session::get('user_id');
        if(!$user_id) {
            return redirect('/');
        }

        return view('userpage')->with('username', User::find($user_id)->username);
    }


    //functions:   GIF profilo
    public function get_pro_gif(){
        if(!Session::get('user_id')) 
            return false;
        
        return ['pro_gif' => User::find(Session::get('user_id'))->pro_gif];
    }

    public function fetch_giphy($q) {
        if(!Session::get('user_id')) 
            return false;

        $apikey_giphy = 'qFHu0yH2PcFWEkDSGyH26AUR6aX6PwCN';
        $endpoint = 'api.giphy.com/v1/gifs/search';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $endpoint.'?apikey='.$apikey_giphy.'&q='.urlencode($q).'&limit=50');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);

        $result_array = array(json_decode($result,true));
        $res = array();
        foreach($result_array[0]['data'] as $elem) {
            if($elem['images']['downsized']['height'] === $elem['images']['downsized']['width']) {
                $res[] = $elem['images']['downsized']['url'];
            }
        }

        return $res;
    }

    public function upload_gif() {
        if(!Session::get('user_id')) 
            return false;

        $user = User::find(Session::get('user_id'));
        $user->pro_gif = request('keyword');
        $user->save();

        return ['pro_gif' => request('keyword')];
    }


    //functions:   Scrivi
    public function search_image_post($query){
        if(!Session::get('user_id')) 
            return false;

        $access_key = 'M5ihkzEt5p-za4CO7Aqks7uBfYY5JOUYXZjyovqly4g';
        $secret_key = 'KfB4otSUFxaY_RonzMTiX-J4OGC0_EtRpEWzMXq_K_E';
        
        $url = 'https://api.unsplash.com/search/photos?client_id='.$access_key.'&per_page=30&order_by=relevant&query='.urlencode($query);
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl , CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        
        $result = array(json_decode($result,true));
        $res = array();
        for($i = 0; $i<count($result[0]['results']); $i++) {
            $res[] = $result[0]['results'][$i]['urls']['small'];
        }
        
        curl_close($curl);
        return $res;
    }

    public function create_post(){
        if(!Session::get('user_id')) 
            return false;

        $recipe = new Recipe;
        $recipe->user_id = Session::get('user_id');
        $recipe->title = request('title');
        $recipe->text = request('textarea');

        if(strlen(request('image_keyword')) != 0 && (strpos(request('image_keyword'),"http://") !== false || strpos(request('image_keyword'),"https://") !== false) ) {
            $recipe->image = request('image_keyword');
        }
        $recipe->save();

        if(count(request('ingredient')) != 0) {
            for($i = 0; $i < count(request('ingredient')); $i++) {
                $ingr = new Ingredient;
                $ingr->name = request('ingredient')[$i];
                $ingr->recipe_id = $recipe->id;
                $ingr->save();
            }
        }
    }


    //functions:   Profilo
    public function fetch_yourPosts(){
        if(!Session::get('user_id')) 
            return false;

        $user = User::find(Session::get('user_id'));
        $recipes = $user->recipes()
                    ->orderBy('id', 'DESC')
                    ->get();
        
        $ingredients = array();       
        foreach ($recipes as $rec) {
            $ingredients[$rec->id] = $rec->ingredients;
        }
        
        return array('recipes' => $recipes, 'ingredients' => $ingredients);

    }

    public function delete_post($id) {
        if(!Session::get('user_id')) 
            return false;

        $recipe = Recipe::find($id);
        if($recipe->user_id == Session::get('user_id')) {
            $recipe->delete();
            return "Recipe ".$id." deleted.";
        } 
        else {
            return "You are not allowed to delete this recipe.";
        }
    }

    //functions:   Modifica
    public function verify_password() {
        if(!Session::get('user_id')) 
            return false;

        $user = User::find(Session::get('user_id'));

        if(password_verify(request('password'), $user->password)) {
            Session::put('password_verified', 'true');
            return 'true';
        } 
        else 
            return 'false';
    }

}
?>