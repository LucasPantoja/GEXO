@extends('layout.principal')

@section('content')

<div align="center">
	<h4>Imprimir</h4>
	<a href="{{action('LabController@PrintShow')}}"><button class="btn btn-success">Exercício</button></a>
	<a href="{{action('LabController@PrintResult')}}"><button class="btn btn-success">Gabarito</button></a>
</div>

@stop