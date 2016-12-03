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
		@if($visitor->total_points == null)
			Este usuario ainda nao possui Pontos
		@else
			{{$visitor->total_points}}
		@endif
	</li>

	<li>Aptidões :</li>
	<table class="table">
	@foreach($aptidoes as $aptidao)
	<?php $result = ($aptidao->points * 100)/$visitor->total_points; ?>
		<tr>
			<td align="center" valign="middle" width="50">{{$aptidao->field->title}}</td>
			<td align="center" valign="middle">
				<div class="progress"> 
	  				<div class="progress-bar" role="progressbar" 
	  				aria-valuenow="{{$aptidao->points}}" aria-valuemin="0" aria-valuemax="{{$visitor->total_points}}" 
	  				style="width: {{$result}}%">
			    		{{$result}}% 
				  	</div>
				</div>
			</td>
		</tr>
	@endforeach
	</table>

</br>

<table = class="table ">
	<tr><strong>Questoes publicadas: </strong></tr>
	@foreach ($questions as $question)
		<tr>
			<td width="50">{{$question->field->title}}</td>
			<td>{{$question->enunciation}}</td>
			<td style="width: 50px;">
				<a target="_blank" href="{{action('QuestionController@Info', $question->id)}}">
				<i class="glyphicon glyphicon-search"></i></a>
			</td>
		</tr>
	@endforeach
</table>

@stop