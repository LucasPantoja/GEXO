@extends('layout.principal')

@section('content')

<h1>
	@if(Auth::user()->avatar)
		{!! Html::image(Auth::user()->avatar, null, ['style' => 'width: 70px; height: 70px; border-radius: 50%']) !!}
	@else
		<i class="glyphicon glyphicon-user"></i>
	@endif
	{{Auth::user()->name}}
</h1>
</br>

	<h4>Informacoes Pessoais</h4>
	<li>Nome: {{Auth::user()->name}}</li>
	<li>Email: {{Auth::user()->email}}</li>
	<li>Conta: 
		@if(Auth::user()->role)
			<label style="color: red">Instrutor</label>
		@else
			<label style="color: green">Normal</label>
			<a href="{{action('UserController@Upgrade')}}"><button class="btn-xs btn btn-info">Upgrade</button></a>
		@endif
	</li>

	<li>
		Facebook:
		@if($facebook)	
			<label style="color: green">Sincronizado</label>
		@else
			<a href="{{action('SocialAuthController@redirect')}}">Sincronizar Contas</a>
		@endif
	</li>

	<li>
		Pontos: 
		@if(Auth::user()->total_points == null)
			Voce Ainda nao possui Pontos
		@else
			{{Auth::user()->total_points}}
		@endif
	</li>

	<li>Convite(s):
		@foreach($invites as $invite)
			</br>
			@if($invite->used)
				<label class="label label-danger">{{$invite->key}}</label>
			@else
				<label class="label label-success">{{$invite->key}}</label>
			@endif
		@endforeach
	</li>

	</br>
	
	
	<li>Aptidões :</li>
	<table class="table">
	@foreach($aptidoes as $aptidao)
	<?php $result = intval(($aptidao->points * 100)/Auth::user()->total_points); ?>
		<tr>
			<td align="center" valign="middle" width="50">{{$aptidao->field->title}}</td>
			<td align="center" valign="middle">
				<div class="progress"> 
	  				<div class="progress-bar" role="progressbar" 
	  				aria-valuenow="{{$aptidao->points}}" aria-valuemin="0" aria-valuemax="{{Auth::user()->total_points}}" 
	  				style="width: {{$result}}%">
			    		{{$result}}% 
				  	</div>
				</div>
			</td>
		</tr>
	@endforeach
	</table>

</br>
</br>
</br>

<table = class="table">
	<tr>
		<strong>Exercícios publicados: </strong> 
		<a href="{{{action('ExercisesController@createExercise')}}}">
			<button class="btn btn-info btn-xs">Formular Exercicio</button>
		</a>
	</tr>
	<?php $cod = null;?>
	@foreach ($exercises as $exercise)
	@if($cod != $exercise->cod)
		<tr>
			<td>{{$exercise->title}}</td>
			<td width="50px">{{$exercise->cod}}</td>
			<td style="width: 50px;">
				<a target="_blank" href="{{action('ExercisesController@showExercise', $exercise->cod)}}">
				<i class="glyphicon glyphicon-search"></i></a>
			</td>
		</tr>
		<?php $cod = $exercise->cod; ?>
	@endif
	@endforeach
</table>

</br>

<table = class="table">
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