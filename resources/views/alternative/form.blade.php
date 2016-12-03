@if($commentForm)

<table class="table table-striped table-bordered">
		<tr><strong>Alternativas</strong></tr>
		@foreach ($alternatives as $alternative)
			<tr class="{{$alternative->answer == 1 ? 'success' : 'danger'}}">
				<td style="width: 100px">Alternativa {{$count}}</td>
				<td>{{$alternative->text}}</td>
			</tr>
			<?php $count++; ?>
		@endforeach
	</table>

@else

{!! Form::open(['action' => 'AlternativeController@saveAlternative']) !!}
{!! Form::hidden('question_id', $question->id) !!}

<div class="form-group">
	<table class="table table-striped table-bordered">
		<tr><strong>Alternativas</strong></tr>
		@foreach ($alternatives as $alternative)
			<tr class="{{$alternative->answer == 1 ? 'success' : 'danger'}}">
				<td style="width: 100px">Alternativa {{$count}}</td>
				<td>{{$alternative->text}}</td>
			</tr>
			<?php $count++; ?>
		@endforeach
		<tr>
			<td style="width: 100px">
				{!! Form::select('answer', ['Errado', 'Correto'], null, 
				['class' => 'form-control']) !!}
			</td>
			<td>
				{!! Form::textarea('text', null,
				['class' => 'form-control', 'placeholder' => 'Alternativa aqui', 'rows' => 2]) !!}
			</td>
		</tr>
	</table>
</div>

<div>
	{!! Form::submit('Adicionar Alternativa', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}
@endif