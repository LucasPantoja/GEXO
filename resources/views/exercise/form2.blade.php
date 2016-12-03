@extends('layout.principal')

@section('content')

<?php $count = 0; ?>

{!! Form::open(['action' => 'ExercisesController@saveExercise']) !!}

<div align="center">
	<h4>Nome do Exercício</h4>
	{!! Form::text('title', null, 
	['class' => 'form-control', 'placeholder' => 'Nome aqui', 'style' => 'width: 150px']) !!}
</div>

	<table class="table table-bordered">
			@foreach($questions as $question)
					<tr>
						<td style="width: 50px">
							<input type="checkbox" name="id[]" value="{{$question->id}}">
						</td>
						<td>{{$question->enunciation}}</td>
						<td style="width: 20px;">
							@if($question->valid)
								<i class="glyphicon glyphicon-ok" style="color: green"></i> 
							@else
								<i class="glyphicon glyphicon-remove" style="color: red"></i>
							@endif
						</td>
						<td style="width: 20px;">
							<a target="_blank" href="{{action('QuestionController@Info', $question->id)}}">
							<i class="glyphicon glyphicon-search"></i></a>
						</td>
					</tr>
			@endforeach
		
	</table>

<div align="center">
	{!! Form::submit('Salvar Exercício', ['class' => 'btn btn-success']) !!}
</div>

@stop