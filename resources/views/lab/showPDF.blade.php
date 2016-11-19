<?php $count = 0; 
	  $abcd = array('a', 'b', 'c', 'd');
	  $number = 1;	  
?>
@foreach ($questions as $question)
	<div align="left">
		<p><strong>{{$number}}) {{$question->enunciation}}</strong></p>
		<div align="center">
			<p><img src="{{$question->image}}" width="150" height="150" border="0" /></p>
		</div>
	</div>
	<table>
		
			@foreach($alternatives as $alternative)
				@if($alternative->question_id == $question->id)
					<tr>
						<td>{{$abcd[$count]}}) {{$alternative->text}}</td>
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