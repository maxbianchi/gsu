@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Recupera Password</div>
				<div class="panel-body">
					@if (isset($message))
						<div class="alert alert-success">
							{{$message}}
						</div>
					@endif

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
                                    <li>Impossibile inviare la password all'indirizzo indicato.</li>
                                    @foreach($errors as $error)
									<li>{{ $error }}</li>
                                    @endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="GET" action="{{ url('/password/email') }}">
                        <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

						<div class="form-group">
							<label class="col-md-4 control-label">Partita IVA / C.F.</label>
							<div class="col-md-6">
								<input type="text" maxlength="16" class="form-control" name="piva" value="{{ old('piva') }}" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Invia Password via e-mail
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
