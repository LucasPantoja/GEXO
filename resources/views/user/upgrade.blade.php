@extends('layout.principal')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-info" align="center">
				<div class="panel-heading">Chave de Upgrade</div>
				<div class="panel-body">
					
					{!! Form::open(['action' => 'UserController@UpAccount']) !!}
					{!! Form::text('key', null,['class' => 'form-control', 'placeholder' => 'chave aqui']) !!}
					</br>
					{!! Form::submit('Upgrade', ['class' => 'btn btn-primary']) !!}

				</div>
			</div>
		</div>
	</div>
</div>

@stop