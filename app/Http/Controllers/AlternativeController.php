<?php

namespace gexo\Http\Controllers;

use Request;
use gexo\Alternative;
use gexo\Question;
use Auth;
use gexo\Points_Fields;
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
        $field_id = $question->field_id;
        $userpoints = Auth::user()->total_points;
        $point_field = Points_Fields::firstOrCreate(['user_id' => Auth::user()->id, 'field_id' => $field_id]);
        $field_point = $point_field->points;

        if ($question->alternatives()->count() < 3) {
            $question->alternatives()->save($alternative);
        }else if ($question->alternatives()->where('answer', 1)->exists() || $alternative->answer == 1) {
            $question->alternatives()->save($alternative);
            $question->update(['valid' => 1]);
            Auth::user()->update(['total_points' => $userpoints + 3]);
            $point_field->update(['points' => $field_point + 3]);
        }

    	Request::session()->flash('AlternativeSaved', 'Sua Alternativa Foi Adicionada com Sucesso');
    	return redirect()->back();
    }
}
