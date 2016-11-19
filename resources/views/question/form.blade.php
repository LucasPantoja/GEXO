@extends('layout.principal')

@section('content')

<div class="form-group">
	<table class="table table-bordered table-striped">


		{!! Form::open(['action' => 'QuestionController@saveQuestion', 'files' => true]) !!}

			<tr><strong>Formulario Questao</strong></tr>
			<tr>
				<td style="width: 50px; vertical-align: middle">{!! Form::label('enunciation', 'Enunciado: ') !!}</td>
				<td>

					{!! Form::textarea('enunciation', null,
					['class' => 'form-control', 'placeholder' => 'Enunciado aqui', 'rows' => 3]) !!}

				</td>
			</tr>
			<tr>
				<td>{!! Form::label('image', 'Imagem(opcional): ') !!}</td>
				<td>
			
					{!! Form::file('image') !!}

				</td>
			</tr>	
			<tr>
				<td>{!! Form::label('level', 'Dificuldade: ') !!}</td>
				<td>

					{!! Form::select('level', ['Facil', 'Intermediario', 'Dificil'], null, 
					['class' => 'form-control']) !!}

				</td>
			</tr>	
			<tr>
				<td>{!! Form::label('field_id', 'Disicplina: ') !!}</td>
				<td>

					{!! Form::select('field_id', $fields, null, 
					['class' => 'form-control']) !!}

				</td>
			</tr>	
	</table>
	
	<div align="center">

		{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}

	</div>

		{!! Form::close() !!}

</div>

@stop