<?php

namespace gexo\Http\Controllers;

use Request;
use gexo\Alternative;
use gexo\Question;
use gexo\Http\Requests\AlternativeRequest;

class AlternativeController extends Controller
{
    public function __construct(){
        $this->middleware('UserVerify');
    }

    public function saveAlternative(AlternativeRequest $request){
    	$alternative = new Alternative($request->all());
    	$id = Request::input('question_id');
    	$question = Question::find($id);
    	$question->alternatives()->save($alternative);

    	if ($question->alternatives()->where('answer', 1)->exists() && $question->alternatives()->count() >= 4) {
    		$question->update(['valid' => 1]);
    	}

    	Request::session()->flash('AlternativeSaved', 'Sua Alternativa Foi Adicionada com Sucesso');
    	return redirect()->back();
    }
}
