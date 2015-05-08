@extends('app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/login_style.css') }}" />
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Portale Uniweb 4.0</div>
				<div class="panel-body">

                                @if (count(Session::get('errors')) > 0)
                                    <div class="alert alert-danger">
                                        {{ Session::get('errors') }}
                                    </div>
                                @endif


					<form method="POST" action="{{ url('/login') }}" class="form-2">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <h1><span class="sign-up">Log in</span> </h1>
                        <p class="float">
                            <label for="login"><i class="icon-user"></i>Username</label>
                            <input type="text" name="username" placeholder="Username or email">
                        </p>
                        <p class="float">
                            <label for="password"><i class="icon-lock"></i>Password</label>
                            <input type="password" name="password" placeholder="Password" class="showpassword">
                        </p>
                        <p class="clearfix">

                            <input type="submit" name="submit" value="Log in">
                        </p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


