<?php $count = 0; 
	  $abcd = array('a', 'b', 'c', 'd');
	  $number = 1;	  
?>

@foreach ($questions as $question)
	<div align="left">
		<p><strong>{{$number}}) {{$question->enunciation}}</strong></p>
	</div>
	@if($question->image != null)
		<div align="center">
			<p><img src="{{$question->image}}" width="150" height="150" border="0" /></p>
		</div>
	@endif
	<table class="table table-bordered">
		
			@foreach($alternatives as $alternative)
				@if($alternative->question_id == $question->id)
					<tr>
						@if($alternative->answer == 0)
							<td>{{$abcd[$count]}}) {{$alternative->text}}</td>
						@else
							<td>
								<strong>
									{{$abcd[$count]}}) {{$alternative->text}}
								</strong>
							</td>
						@endif
					</tr>
					<?php $count++; ?>
				@endif
				@if($count == 4)
					<?php $count = 0; ?>
					@break
				@endif
			@endforeach
	</table>
	<?php $number++; ?>
@endforeach