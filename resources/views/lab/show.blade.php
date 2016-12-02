@extends('layout.principal')

@section('content')

<?php $count = 0; ?>

{!! Form::open(['action' => 'UserController@Pointing']) !!}
@foreach ($questions as $question)
	<div>
		<p>{{$question->enunciation}}</p>
		<p>{!! Html::image(action('QuestionController@Image', $question->id)) !!}</p>
		<div align="right">
			Provedor: <a href="">{{$question->user->name}}</a>
			</br>
			<small>Instituto:</small>
		</div>

		{!! Form::hidden('question_level[]', $question->level) !!}

	</div>
	<table class="table table-bordered">
		
			@foreach($alternatives as $alternative)
				@if($alternative->question_id == $question->id)
					<tr>
						<td style="width: 50px">
							<input type="checkbox" name="answer[]" value="{{$alternative->answer}}">
						</td>
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
	{!! Form::submit('Finalizar', ['class' => 'btn btn-success']) !!}
	<a href="{{action('LabController@PrintShow')}}">
		{!! Form::button('Imprimir', ['class' => 'btn btn-primary']) !!}
	</a>
</div>

@stop