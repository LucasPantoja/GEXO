@extends('layout.principal')

@section('content')

<div align="center">
	<h3>Formule seu Exercício</h3>
</div>

{!! Form::open(['action' => 'ExercisesController@createExercise2']) !!}
<div class="form-group" align="center">
	<table class="table table-bordered">
		<tr>
			<td width="50" valign="middle">{!! Form::label('field_id', 'Disicplina: ') !!}</td>
			<td>
				{!! Form::select('field_id', $fields, null, 
				['class' => 'form-control']) !!}
			</td>
		</tr>
	</table>
	{!! Form::submit('Gerar Exercicio', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@stop