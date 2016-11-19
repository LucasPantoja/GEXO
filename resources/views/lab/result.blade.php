@extends('layout.principal')

@section('content')

<?php $count = 0; ?>

@foreach ($questions as $index => $question)
	<div>
		@if($answers[$index] == 1)
			<p>
				<i class="glyphicon glyphicon-ok" style="color: green"></i> 
				<a href="{{action('QuestionController@Info', $question->id)}}">{{$question->enunciation}}</a>
			</p>
		@else
			<p>
				<i class="glyphicon glyphicon-remove" style="color: red"></i> 
				<a href="{{action('QuestionController@Info', $question->id)}}">{{$question->enunciation}}</a>
			</p>
		@endif
		<p>{!! Html::image(action('QuestionController@Image', $question->id)) !!}</p>
	</div>
	<table class="table table-bordered">
		
			@foreach($alternatives as $alternative)
				@if($alternative->question_id == $question->id)
					<tr class="{{$alternative->answer == 1 ? 'success' : 'danger'}}">
						<td>{{$alternative->text}}</td>
					</tr>
					<?php $count++; ?>
				@endif
				@if($count == 4)
					<?php $count = 0; ?>
					@break
				@endif
			@endforeach
		
	</table>
@endforeach
	
<div align="center">
	<a href="{{action('LabController@PrintResult')}}">
		{!! Form::button('Imprimir', ['class' => 'btn btn-primary']) !!}
	</a>
</div>

@stop