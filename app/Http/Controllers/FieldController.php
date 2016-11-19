<?php

namespace gexo\Http\Controllers;

use Request;
use Auth;
use gexo\Field;
use gexo\Http\Requests\FieldRequest;

class FieldController extends Controller
{

	public function __construct(){
		$this->middleware('UserVerify');
	}
	
    public function createField(){
    	if (Auth::user()->role == 0) {
    		Request::session()->flash('Denied','Para ter acesso a esta área é necessário ter uma conta de Instrutor');
    		return redirect()->action('QuestionController@About');
    	}
		return view('field.form');
	}

	public function saveField(FieldRequest $request){
		if (Field::where('title', Request::input('title'))->exists()) {
    		Request::session()->flash('errorField', 'A Disciplina '.Request::input('title').' ja existe no banco de dados');
    		return redirect()->action('FieldController@createField');
    	}

		Field::create($request->all());

		Request::session()->flash('FieldSaved', 'Disciplina Adicionada ao Banco com Sucesso');
		return redirect()->action('FieldController@Show');
	}

	public function Show(){
		$fields = Field::all();
		return view('field.show')->with('fields', $fields);
	}
}
