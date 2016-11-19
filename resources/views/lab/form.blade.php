@extends('layout.principal')

@section('content')

<div align="center">
	<h3>Laboratorio</h3>
	<b>Gere sua lista de exercicios</b>
</div>

{!! Form::open(['action' => 'LabController@execLab']) !!}
<div class="form-group" align="center">
	<table class="table">
		<tr>
			<td style="width: 165px">{!! Form::label('quantity', 'Numero de questoes: ') !!}</td>
			<td>
				{!! Form::text('quantity', null, 
				['class' => 'form-control', 'placeholder' => 'Quantidade aqui']) !!}
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
	{!! Form::submit('Gerar Exercicio', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@stop