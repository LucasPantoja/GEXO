{!! Form::open(['action' => 'CommentController@postComment']) !!}
{!! Form::hidden('question_id', $question->id) !!}

<div class="form-group">
	<table class="table table-striped table-bordered">
		<tr><strong>Comentarios</strong></tr>
		@foreach ($comments as $comment)
			<tr>
				<td style="width: 100px">Post #{{$countC}}</td>
				<td>
					{{$comment->text}}
					<div class="signature" align="right">
						<b>{{$comment->created_at->diffForHumans()}} - 
						@if($comment->user->avatar)
							<img src="{{$comment->user->avatar}}" style="width:25px; height:25px; border-radius:50%">
						@else
							<i class="glyphicon glyphicon-user"></i>
						@endif
						<a href="{{action('UserController@Visitor', $comment->user->id)}}">{{$comment->user->name}}</a></b>
					</div>
				</td>
			</tr>
			<?php $countC++; ?>
		@endforeach
		<tr>
			<td>Comentario: </td>
			<td>
				{!! Form::textarea('text', null,
				['class' => 'form-control', 'placeholder' => 'Comentario aqui', 'rows' => 2]) !!}
			</td>
		</tr>
	</table>
</div>

<div>
	{!! Form::submit('Adicionar Comentario', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}