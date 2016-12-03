@extends('layout.principal')

@section('content')

<?php $count = 1; ?>
<?php $countC = 1; ?>

	<h4><i class="glyphicon glyphicon-education"></i> #{{$question->id}}</h4>

	<table class="table table-bordered table-striped">
		<tr>
			<td style="width: 100px">Enunciado: </td>
			<td>{{$question->enunciation}}</td>
		</tr>
		@if($question->image != null)		
  		<tr>
  			<td style="width: 100px">Imagem: </td>
  			<td>{!! Html::image(action('QuestionController@Image', $question->id)) !!}</td>
  		</tr>
 		@endif
		<tr>
			<td style="width: 100px">Disciplina: </td>
			<td>{{$question->field->title}}</td>
		</tr>
		<tr>
			<td>Dificuldade :</td>
			<td>
				@if($question->level == 0)
					Facil
				@elseif($question->level == 1)
					Intermediario
				@else
					Dificil
				@endif
			</td>
		</tr>
		<tr>
			<td style="width: 100px">Instrutor: </td>
			<td>{!! Html::linkAction('UserController@Visitor', $question->user->name, $question->user->id) !!}</td>
			</tr>
		<tr>
	</table>


	<!-- 		FORMULARIO ALTERNATIVES			-->
	@include('alternative.form')


	</br>
	</br>
	<!-- 		FORMULARIO COMMENTS 			-->
	@if($commentForm)
	@include('comment.form')
	@endif
	
@stop