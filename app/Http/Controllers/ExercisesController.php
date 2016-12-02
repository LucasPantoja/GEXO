<?php

namespace gexo\Http\Controllers;

use Request;
use Auth;
use gexo\Question;
use gexo\Field;
use gexo\Alternative;
use gexo\Exercises;

class ExercisesController extends Controller
{
	public function __construct(){
		$this->middleware('UserVerify');
	}

    public function createExercise(){
    	if (Auth::user()->role == 0) {
			Request::session()->flash('Denied','Para ter acesso a esta área é necessário ter uma conta de Instrutor');
			return redirect()->action('QuestionController@Home');	
		}

		$fields = Field::orderBy('title', 'asc')->pluck('title', 'id');

		return view('exercise.form1')->with('fields', $fields);
    }

    public function createExercise2(){
    	if (Auth::user()->role == 0) {
			Request::session()->flash('Denied','Para ter acesso a esta área é necessário ter uma conta de Instrutor');
			return redirect()->action('QuestionController@Home');	
		}

		$field_id = Request::input('field_id');
		$questions = Question::where('field_id', $field_id)
								->where('valid', 1)->get();

		return view('exercise.form2')->with('questions', $questions);

    }

    public function saveExercise(){
    	if (Auth::user()->role == 0) {
			Request::session()->flash('Denied','Para ter acesso a esta área é necessário ter uma conta de Instrutor');
			return redirect()->action('QuestionController@Home');	
		}

		$title = Request::input('title');
		$count_chars = strlen($title);
		if ($count_chars < 5) {
			dd('Necessita de nome com ao menos 5 caracteres');
		}
		$questions_ids = Request::input('id');
		if (count($questions_ids) == 0 || count($questions_ids) == null) {
			dd('Necessita de ao menos 1 questao');
		}
    	
    	$cod = str_random(5);

    	for ($i=0; $i < count($questions_ids); $i++) { 
    		$exercise = new Exercises();
    		$exercise->cod =$cod;
    		$exercise->question_id = $questions_ids[$i];
    		$exercise->user_id = Auth::user()->id;
    		$exercise->title = $title;
    		$exercise->save();
    	}

    	return redirect()->action('UserController@Home');
    }

    public function showExercise($cod){
    	$exercises = Exercises::where('cod', $cod)->get();
    	$questions = Question::all();
    	$alternatives = Alternative::inRandomOrder()->get();
    	return view('exercise.show')->with('questions', $questions)
    								->with('exercises', $exercises)
    								->with('alternatives', $alternatives);
    }
}
