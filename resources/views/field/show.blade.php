@extends('layout.principal')

@section('content')

@if($fields->count() == 0)
	
	<div align="center">
		<h4>Nao ha Disciplinas no Banco de Dados</h4>
	</div>

@else

	<h4><i class="glyphicon glyphicon-education"></i> Banco de Disciplinas</h4>

	<table class="table table-bordered table-striped">
		@foreach ($fields as $field)
			<tr>
				<td>{{$field->title}}</td>
			</tr>
		@endforeach
	</table>
@endif

@stop