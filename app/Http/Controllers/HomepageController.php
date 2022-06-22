<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Like;
use App\Models\Favorite;
use App\Models\Comment;

class HomepageController extends BaseController {
    public function homepage_view() {
        $user_id = Session::get('user_id');
        if(!$user_id) {
            return redirect('/');
        }

        return view('homepage')->with('username', User::find($user_id)->username);
    }

    //functions:   Posts
    public function fetch_allPosts() {
        if(!Session::get('user_id')) 
            return false;

        $user = User::find(Session::get('user_id'));

        $likes = $user->likes;
        $favorites = $user->favorites;

        $recipes_liked = array(); $recipes_fav = array();
        foreach($likes as $l) {
            $recipes_liked[] = $l->pivot->recipe_id;
        }
        foreach($favorites as $f) {
            $recipes_fav[] = $f->pivot->recipe_id;
        }

        if(Session::get('favorite_posts') == 'true') {
            $recipes = Recipe::whereIn('id',$recipes_fav)->get();
        } 
        else {
            $recipes = Recipe::orderBy('id','DESC')->get();       
        }
        Session::forget('favorite_posts');

        $ingredients = Ingredient::all();
        
        foreach($recipes as $rec) {
            $rec['username'] = User::find($rec['user_id'])->username;
            if(in_array($rec['id'],$recipes_liked)) {
                $rec['user_likes'] = 'true';
            } else {
                $rec['user_likes'] = 'false';
            }
            if(in_array($rec['id'],$recipes_fav)) {
                $rec['user_fav'] = 'true';
            } else {
                $rec['user_fav'] = 'false';
            }
        }

        $posts = array('recipes' => $recipes, 'ingredients' => $ingredients);
        return $posts;
    }

    public function fetch_postsByIngredient($name) {
        if(!Session::get('user_id')) 
            return false;

        $user = User::find(Session::get('user_id'));

        $single_ingredient = Ingredient::where('name',$name)->get();

        $ids = array();
        foreach($single_ingredient as $ingr) 
            $ids[] = $ingr->recipe_id;
        
        $recipes = Recipe::whereIn('id', $ids)->orderBy('id','DESC')->get();

        $ingredients = array();
        foreach($recipes as $rec) {
            foreach($rec->ingredients as $ingr) {
                $ingredients[] = $ingr;
            }
        }

        $likes = $user->likes;
        $favorites = $user->favorites;

        $recipes_liked = array(); $recipes_fav = array();
        foreach($likes as $l) {
            $recipes_liked[] = $l->pivot->recipe_id;
        }
        foreach($favorites as $f) {
            $recipes_fav[] = $f->pivot->recipe_id;
        }

        foreach($recipes as $rec) {
            $rec['username'] = User::find($rec['user_id'])->username;
            if(in_array($rec['id'],$recipes_liked)) {
                $rec['user_likes'] = 'true';
            } else {
                $rec['user_likes'] = 'false';
            }
            if(in_array($rec['id'],$recipes_fav)) {
                $rec['user_fav'] = 'true';
            } else {
                $rec['user_fav'] = 'false';
            }
        }

        $posts = array('recipes' => $recipes, 'ingredients' => $ingredients);
        return $posts;
    }

    public function sessionFavorite(){
        if(!Session::get('user_id')) 
            return redirect('/');

        Session::put('favorite_posts','true');
    }

    //functions:   User Info
    public function getUserInfo(){
        if(!Session::get('user_id')) 
            return false;

        $user = User::find(Session::get('user_id'));

        $N_likes = count($user->likes);
        $N_fav = count($user->favorites);
        $N_comm = count($user->comments);

        return array('N_likes' => $N_likes, 'N_fav' => $N_fav, 'N_comm' => $N_comm);
    }

    public function get_pro_gif(){
        if(!Session::get('user_id')) 
            return false;

        return array('pro_gif' => User::find(Session::get('user_id'))->pro_gif);
    }

    //functions:   likes
    public function set_unset_like($type,$recipe_id){
        if(!Session::get('user_id')) 
            return false;

        if($type == 'set') {
            $like = new Like;
            $like->user_id = Session::get('user_id');
            $like->recipe_id = $recipe_id;
            $like->save();
        }
        if($type == 'unset') {
            $like = Like::where('user_id', Session::get('user_id'))
                    ->where('recipe_id', $recipe_id);
            $like->delete();
        }
        return array('quantity' => count(Like::where('recipe_id', $recipe_id)->get()), 'post_id' => $recipe_id);
    }

    //functions:   favorites
    public function set_unset_fav($type,$recipe_id){
        if(!Session::get('user_id')) 
            return false;

        if($type == 'set') {
            $fav = new Favorite;
            $fav->user_id = Session::get('user_id');
            $fav->recipe_id = $recipe_id;
            $fav->save();
        }
        if($type == 'unset') {
            $fav = Favorite::where('user_id', Session::get('user_id'))
                    ->where('recipe_id', $recipe_id);
            $fav->delete();
        }
    }

    //functions:   comments
    public function publish_comment($recipe_id){
        if(!Session::get('user_id')) 
            return false;
        
        $comment = new Comment;
        $comment->user_id = Session::get('user_id');
        $comment->recipe_id = $recipe_id;
        $comment->text = request('textarea');    
        $comment->save();

        return array('quantity' => count(Comment::where('recipe_id', $recipe_id)->get()), 'recipe_id' => $recipe_id);
    }

    public function fetch_allComments($recipe_id){
        if(!Session::get('user_id')) 
            return false;

        $recipe = Recipe::find($recipe_id);
        $comments = Comment::where('recipe_id',$recipe_id)->get();
        foreach($comments as $comm) {
            $comm['username'] = User::find($comm['user_id'])->username;
        }

        return array('user_id' => Session::get('user_id'), 'comments' => $comments);
    }

    public function delete_comment($comment_id,$recipe_id){
        if(!Session::get('user_id')) 
            return false;

        $comment = Comment::find($comment_id);
        if(strcmp($comment->user_id,Session::get('user_id')) == 0) {
            $comment->delete();
            return array('quantity' => count(Comment::where('recipe_id',$recipe_id)->get()),'recipe_id' => $recipe_id);
        } else {
            return 'You are not allowed to delete this comment.';
        }
    }
}

?>