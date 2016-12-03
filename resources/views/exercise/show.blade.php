@extends('layout.principal')

@section('content')

@foreach($exercises as $exercise)
@foreach($questions as $question)
@if($exercise->question_id == $question->id)
	<div>
		<p>Enunciado: {{$question->enunciation}}</p>
		@if($question->image != null)		
  			<p>{!! Html::image(action('QuestionController@Image', $question->id)) !!}</p>
 		@endif
		<div align="right">
		<p>
			Dificuldade: 
				@if($question->level == 0)
					Facil
				@elseif($question->level == 1)
					Intermediario
				@else
					Dificil
				@endif
		</p>
			Provedor: <a href="">{{$question->user->name}}</a>
			</br>
		</div>

		<table class="table table-bordered">
		
			@foreach($alternatives as $alternative)
				@if($alternative->question_id == $question->id)
					<tr>
						<td>{{$alternative->text}}</td>
					</tr>
				@endif
			@endforeach
		
		</table>

	</div>
@endif
@endforeach	
@endforeach

@stop