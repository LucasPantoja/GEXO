@extends('layout.principal')

@section('content')

@if($questions->count() == 0)
	
	<div align="center">
		<h4>Nao ha Questoes no Banco de Dados</h4>
	</div>

@else

	<h4><i class="glyphicon glyphicon-education"></i> Banco de Questoes</h4>

	<table class="table table-bordered table-striped">
		@foreach ($questions as $question)
			<tr>
				<td width="50">{{$question->field->title}}</td>
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
@endif

@stop