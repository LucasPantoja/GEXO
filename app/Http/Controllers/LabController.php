<?php

namespace gexo\Http\Controllers;

use gexo\Http\Requests\LabRequest;
use Fireguard\Report\Report;
use Request;
use Response;
use Session;
use Auth;
use gexo\Question;
use gexo\Field;
use gexo\Alternative;

class LabController extends Controller
{
    public function __construct(){
        $this->middleware('UserVerify', ['except' => ['PrintShow', 'PrintResult']]);
    }

    public function createLab(){
    	$fields = Field::orderBy('title', 'asc')->pluck('title', 'id');

		return view('lab.form')->with('fields', $fields);
    }

    public function execLab(LabRequest $request){
        $field_id = Request::input('field_id');
    	$count = Question::where('field_id', $field_id)
                            ->where('valid', 1)
                            ->count();

    	if ($count < $request->quantity) {
    		Request::session()->flash('errorLab', 'A Disciplina escolhida possui apenas '.$count.' Questao(oes) validas');
    		return redirect()->back();
    	}

    	$randomQuestions = Question::where('field_id', Request::input('field_id'))->inRandomOrder()
    															 				  ->take(Request::input('quantity'))
                                                           	 	 				  ->get();

    	$randomAlternatives = Alternative::inRandomOrder()->get();
        
    	Session::put('questions', $randomQuestions);
    	Session::put('alternatives', $randomAlternatives);
    	Session::put('quantity', Request::input('quantity'));

    	return redirect()->action("LabController@showLab");
    }


    public function showLab(){
		return view('lab.show')->with('questions', Session::get('questions'))
    						   ->with('alternatives', Session::get('alternatives'));
    }

    public function Result(){
        $answers = Session::get('answers');
    	$points = Session::get('points');
    	$questions = Session::get('questions');
    	$alternatives = Session::get('alternatives');

    	if (count($answers) == 0) {
    		Request::session()->flash('LabResult', 'Voce deixou de marcar alguma alternativa');
    		return redirect()->back();
    	}
    	if (count($answers) > count($questions)) {
    		Request::session()->flash('LabResult2', 'Voce marcou alternativas a mais');
    		return redirect()->back();
    	}

    	Request::session()->flash('Points', 'Voce ganhou o total de '.$points.' Ponto(s)');

    	return view('lab.result')->with('questions', $questions)
    						     ->with('alternatives', $alternatives)
    						     ->with('answers', $answers);
    }


    public function PrintShow(\Fireguard\Report\Exporters\PdfExporter $exporter){
        $html = view()->make('lab.showPDF')
                        ->with('questions', Session::get('questions'))
                        ->with('alternatives', Session::get('alternatives'))
                        ->render();

        //PDF::SetTitle('Gexo');
        //PDF::AddPage();
        //PDF::writeHTML($html, true, false, true, false, '');

        //return PDF::Output('gexo.pdf');

        $footer = '<div align="center">
            <footer class="footer">
                <p>GEXO - Gerador de Exercicios Online</p>              
            </footer>
        </div>';
        $file = $exporter->generate(new Report($html, null, $footer));

        $headers = [
            'Content-type' => 'application/pdf',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Length' => filesize($file),
            'Accept-Ranges' => 'bytes'
        ];

        return response()->download($file, 'gexo.pdf', $headers);
    }

    public function PrintResult(\Fireguard\Report\Exporters\PdfExporter $exporter){
        $html = view()->make('lab.resultPDF')
                        ->with('questions', Session::get('questions'))
                        ->with('alternatives', Session::get('alternatives'))
                        ->render();
        $footer = '<div align="center">
            <footer class="footer">
                <p>GEXO - Gerador de Exercicios Online</p>              
            </footer>
        </div>';
        $file = $exporter->generate(new Report($html, null, $footer));

        $headers = [
            'Content-type' => 'application/pdf',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Length' => filesize($file),
            'Accept-Ranges' => 'bytes'
        ];

        //mostrar diretamente o arquivo
        //return response()->make(file_get_contents($file), 200, $headers);

        //forçar o download
        return response()->download($file, 'gexoResult.pdf', $headers);
    }

}
