<?php

namespace App\Http\Controllers;

use App\User;
use App\Lien;
use App\Tag;
use App\Comment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LienRepository;

class GlobalController extends Controller
{
    public function getIndex(){
    	$liens = Lien::paginate(10)->sortByDesc(function($val, $key){
			return $val->likes->sum('val');
		});
		foreach ($liens as $lien) {
			foreach ($lien->likes as $like) {
				if($like->user == Auth::user()){
					$lien->voted = $like->val;
				}
			}
		}
		return view('news.liste', ['news' => $liens]);
    }

    public function getPoster(){
    	$tags = Tag::all();
		return view('news.ajout', ['tags' => $tags]);
    }

    public function getLink(Lien $lien) {
    $comments = Comment::where('lien_id', $lien->id)->where('comment_id', 0)->get();
    	foreach ($lien->likes as $like) {
				if($like->user == Auth::user()){
					$lien->voted = $like->val;
				}
			}
		foreach($comments as $comment){
			foreach ($comment->likes as $like) {
				if($comment->user == Auth::user()){
					$comment->voted = $like->val;
				}
			}
		}
		return view('news.comments', ['comments' => $comments, 'news' => $lien]);
	}


}