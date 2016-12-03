@extends('layout.principal')

@section('content')

	
	<body align="center">
		<h1>GEXO<small><br/>Gerador de Exercícios Online</small></h1>

		@if(Auth::guest())
		<a href="{{action('LabController@createLab')}}"><button class="btn btn-primary">Gerar Exercício</button></a>
		@endif
	</body>

@stop