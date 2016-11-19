@extends('layout.principal')

@section('content')

<h1>
	@if($visitor->avatar)
		{!! Html::image($visitor->avatar, null, ['style' => 'width: 70px; height: 70px; border-radius: 50%']) !!}
	@else
		<i class="glyphicon glyphicon-user"></i>
	@endif
	{{$visitor->name}}
</h1>
</br>	

	<li>Conta: 
		@if(Auth::user()->role == 0)
			<label style="color: green">Normal</label>
		@else
			<label style="color: red">Instrutor</label>
		@endif
	</li>

	<li>
		Pontos: 
		@if($visitor->points == null)
			Este usuario ainda nao possui Pontos
		@else
			{{$visitor->points}}
		@endif
	</li>

	<?php $x = 4; ?>
	<?php $t = 0; ?>
	<li>Aptidões :</li>
	<table class="table borderless" width="30px">
	@while($t<3)
	<?php $result = $x*100/1000; ?>
		<tr>
			<td align="center" valign="middle">Java</td>
			<td align="center" valign="middle">
				<div class="progress"> 
	  				<div class="progress-bar" role="progressbar"
	  				aria-valuenow="{{$x}}" aria-valuemin="0" aria-valuemax="1000" style="width: {{$result}}%">
			    		{{$result}}% Complete
				  	</div>
				</div>
			</td>
			<td align="center" valign="center">{{$x}}/1000</td>
		</tr>
		<?php $t++; 
		$x = $x*$x; ?>
	@endwhile
	</table>

</br>

<table = class="table ">
	<tr><strong>Questoes publicadas: </strong></tr>
	@foreach ($questions as $question)
		<tr>
			<td>{{$question->enunciation}}</td>
			<td style="width: 50px;">
				<a href="{{action('QuestionController@Info', $question->id)}}" class="btn btn-info btn-xs">Info</a>
			</td>
		</tr>
	@endforeach
</table>

@stop