<!DOCTYPE html>
<html>
	<head>
	    <link href="/css/app.css" rel="stylesheet">
	    <script src="/js/app.js"></script>
	    <title>GEXO - Gerador de Exercicios Online</title>
	</head>
	<body>
	  <div class="container">
	  	<nav class="navbar navbar-default">
	  		<div class="container-fluid">
	  			<div class="navbar-header">
	  				<a class="navbar-brand" href="{{action('QuestionController@About')}}">GEXO</a>
	  			</div>

		  			@if(Auth::check())

		  			<ul class="nav navbar-nav">
		  				<li><a href="{{action('QuestionController@createQuestion')}}">Cadastrar Questão</a></li>
		  			
		  				<li><a href="{{action('FieldController@createField')}}">Cadastrar Disciplina</a></li>
		  			
		  				<li><a href="{{action('QuestionController@Show')}}">Questoes</a></li>
		  			
		  				<li><a href="{{action('FieldController@Show')}}">Disciplinas</a></li>

		  				<li><a href="{{action('LabController@createLab')}}">Laboratorio</a></li>
		  			</ul>


	  				<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								@if(Auth::user()->avatar)
									{!! Html::image(Auth::user()->avatar, null,
										['style' => 'width: 25px; height: 25px; border-radius: 50%']) !!}
								@else
									<i class="glyphicon glyphicon-user"></i>
								@endif
								{{Auth::user()->name}}
							<b class="caret"></b></a>
							<ul class="dropdown-menu">
							<li>
								<a href="{{action('UserController@Home')}}">
									<i class="glyphicon glyphicon-home"></i> Home
								</a>
							</li>
							<li>
								<a href="{{action('UserController@Rank')}}">
									<i class="glyphicon glyphicon-stats"></i> Rank
								</a>
							</li>
							<li>
								<a href="{{ url('auth/logout') }}">
									<i class="glyphicon glyphicon-log-out"></i> Logout
								</a>
							</li>
							</ul>
						</li>
	  				</ul> 

	  				@else

		  				{!! Form::open(['action' => 'Auth\LoginController@login']) !!}

		  				<ul class="nav navbar-form navbar-right">
		  					<div class="form-group">
		  						{!! Form::text('email', null,
								['class' => 'form-control', 'placeholder' => 'email']) !!}
							
			  					{!! Form::password('password',
								['class' => 'form-control', 'placeholder' => 'senha']) !!}
							</div>
							
							{!! Form::submit('Login', ['class' => 'btn btn-sm']) !!}

		  					{!! Form::close() !!}

		  					<a href="{{action('SocialAuthController@redirect')}}">
		  						{!! Form::button('<i class="fa fa-facebook fa-fw"></i> Facebook', ['class' => 'btn btn-facebook btn-sm']) !!}
		  					</a>

		  					<a href="{{action('Auth\RegisterController@showRegistrationForm')}}">
		  						{!! Form::button('Registrar', ['class' => 'btn btn-sm']) !!}
		  					</a>
		  				</ul>
	  				@endif
	  		</div>
	  	</nav>

	  	@include('errors.errors')

	  	@include('flashes.all')

	    @yield('content')

	    <br/>
	    <br/>
	    <br/>
	    
	    <div align="center">
		    <footer class="footer">
		    	{!! Html::image('Logo/logo.png', null, ['width' => '80', 'height' => '80']) !!}
		    	<p>GEXO - Gerador de Exercicios Online</p>		    	
		    </footer>
	    </div>
	  </div>
	</body>
</html>
