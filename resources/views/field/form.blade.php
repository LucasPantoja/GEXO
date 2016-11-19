@extends('layout.principal')

@section('content')

<div class="form-group">
	<table class="table table-bordered table-striped">

		{!! Form::open(['action' => 'FieldController@saveField']) !!}

			<tr><strong>Formulario Disciplina</strong></tr>
			<tr>
				<td style="width: 50px; vertical-align: middle">{!! Form::label('title', 'Disciplina: ') !!}</td>
				<td>

					{!! Form::text('title', null,
					['class' => 'form-control', 'placeholder' => 'Discilina aqui']) !!}

				</td>
			</tr>
	</table>
	
	<div align="center">

		{!! Form::submit('Salvar Disciplina', ['class' => 'btn btn-primary']) !!}

	</div>

		{!! Form::close() !!}

</div>

@stop