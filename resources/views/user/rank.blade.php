@extends('layout.principal')

@section('content')
<?php $x= 0?>
<div class="container">
    <div class="row">
    @while($x<6)
        <div class="col-sm-5 col-md-4">
            <div class="panel panel-info" align="center">
                <div class="panel-heading">TOP 5</div>
                <div class="panel-body" align="center">
                    <table class="table table-striped">
					  	<tr>
					  		<td>Rank</td>
					  		<td>Usuario</td>
					  		<td>Pontos</td>
					  	</tr>
					  	@foreach($users as $index => $user)
					  	<tr>
					  		<td>
					  			@if($index + 1 == 1)
					  				{{$index+1}} - 
					  				<i class="glyphicon glyphicon-education" style="color: #ffd700"></i>
					  			@elseif($index + 1 == 2)
					  				{{$index+1}} - 
					  				<i class="glyphicon glyphicon-education" style="color: #a9a9a9"></i>
					  			@elseif($index + 1 == 3)
					  				{{$index+1}} - 
					  				<i class="glyphicon glyphicon-education" style="color: #cd853f"></i>	
					  			@else
					  				{{$index+1}}
					  			@endif
					  		</td>
					  		<td>
					  			<a href="{{action('UserController@Visitor', $user->id)}}">
					  			@if($user->avatar)
					  				{!! Html::image($user->avatar, null,
					  					['style' => 'width: 32px; height: 32px; border-radius: 50%']) !!}
								@endif
								{{$user->name}}
					  			</a>
					  		</td>
					  		<td>{{$user->points}}</td>
					  	</tr>
					  	@endforeach
					</table>
                </div>
            </div>
        </div>
        <?php $x++; ?>
        @endwhile
    </div>
</div>

@stop