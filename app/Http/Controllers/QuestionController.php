<?php

namespace gexo\Http\Controllers;

use Request;
use Image;
use gexo\Question;
use gexo\Field;
use gexo\Alternative;
use gexo\Comment;
use Auth;
use gexo\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{

	public function __construct(){
		$this->middleware('UserVerify', ['except' => ['About']]);
	}

	public function About(){
		return view('question.about');
	}

	public function createQuestion(){
		if (Auth::user()->role == 0) {
			Request::session()->flash('Denied','Para ter acesso a esta área é necessário ter uma conta de Instrutor');
			return redirect()->action('QuestionController@About');	
		}

		$fields = Field::orderBy('title', 'asc')->pluck('title', 'id');

		return view('question.form')->with('fields', $fields);
	}

	public function saveQuestion(QuestionRequest $request){
		$question = new Question($request->all());

		$id = Request::input('field_id');
		$field = Field::find($id);
		$file = $request->file('image');
		$imgPath = public_path('uploads/'.str_random(2).$file->getClientOriginalName());
		
		if ($file != null) {
			if ($file->getClientOriginalExtension() != 'jpg' && $file->getClientOriginalExtension() != 'png') {
				Request::session()->flash('jpg','Imagem necessita ser .jpg ou .png');
				return redirect()->action('QuestionController@createQuestion');
			}
			$img = Image::make($file->getRealPath());
			$img->resize(400, 300)->save($imgPath);
		}

		$question->image = $imgPath;
		$question->field()->associate($field);
		$question->user()->associate(Auth::user());
		$question->save();

		$question = Question::orderBy('id', 'desc')->first();

		return redirect()->action('QuestionController@Info', $question->id);
	}

	public function Show(){
		$questions = Question::all();

		return view('question.show')->with('questions', $questions);
	}

	public function Info($id){
		$question = Question::find($id);

		$alternatives = Alternative::where('question_id', $id)->get();
		$countA = $alternatives->count();
		$exist = $alternatives->where('answer', 1)->first();
		$commentForm = false;
		if ($countA < 4) {
			Request::session()->flash('QuestionVal', 'Questao apenas sera valida se possuir ao menos 4 alternativas e 										ao menos uma Correta. Adicione alternativas Abaixo:');
		}
		if($countA >= 4 && $exist == null){
			Request::session()->flash('QuestionVal2', 'Questao apenas sera valida se possuir ao menos uma  												   Alternativa Correta. Adicione alternativas Corretas Abaixo:');
		}
		if($countA >= 4 && $exist != null){
			$commentForm = true;
		}

		$comments = Comment::where('question_id', $id)->get();

		return view('question.info')->with('question', $question)
									->with('alternatives', $alternatives)->with('countA', $countA)
									->with('comments', $comments)->with('commentForm', $commentForm);;
	}

	public function Image($id){
		$question = Question::find($id);
		$image = Image::make($question->image);
		$img = $image->response();
		return $img;
	}








}