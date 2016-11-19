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
		@if(Auth::user()->points == null)
			Voce Ainda nao possui Pontos
		@else
			{{Auth::user()->points}}
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
	
	<?php $x = 4; ?>
	<?php $t = 0; ?>
	<li>Aptidões :</li>
	<table class="table">
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
</br>
</br>

<table = class="table">
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