@extends('layouts.default')
@section('title')
	Home Page
@stop
@section('content')
	<div class="login_panel">
		
		{{Form::open(['url'=>'login', 'method'=>'POST','files'=>true])}}

		   {{Form::text('username')}}
		   {{Form::submit('Submit',['id'=>'submit'])}}
		{{Form::close()}}
		<h2 style="color:rgb(118, 228, 215);;padding: 0 0 20px 0;">Users Login Panel</h2>
		<div>
			<?php 
				$facebook = new Facebook(Config::get('facebook'));
				$params = array(
			        'redirect_uri' => url('http://www.scdn.com'),
			        'scope' => 'email'
			    );
			    $loginUrl = $facebook->getLoginUrl($params);
			 ?>
	 		<a href="{{$loginUrl}}" class="btn">Facebook Login</a>
		</div>
		<div>
			<a href="gauth" class="btn">Sign In Via Google</a>
		</div>
		<div>
			<a href="" class="btn">Sign In Via Twitter</a>
		</div>
		<div>
			
		</div>

	</div>
	
@stop