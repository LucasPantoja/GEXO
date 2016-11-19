<?php

namespace gexo\Http\Controllers;

use Request;
use Auth;
use gexo\Http\Requests\CommentRequest;
use gexo\Comment;
use gexo\Question;

class CommentController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}

	public function postComment(CommentRequest $request){
		$comment = new Comment($request->all());

		$id = Request::input('question_id');
		$question = Question::find($id);

		$comment->question()->associate($question);
		$comment->user()->associate(Auth::user());

		$comment->save();

		Request::session()->flash('CommentPosted', 'Seu Comentario foi postado com Sucesso');
		return redirect()->back();
	}
    
}
