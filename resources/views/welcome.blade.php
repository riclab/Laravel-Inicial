@extends('app')

@section('content')

	<div class="container">
    	<div class="row">
			<div class="col-lg-12">
		
				<div class="jumbotron">
				  <h1>Laravel Inicial</h1>
				  <p>{{trans('site.description')}}</p>
				  <p><a class="btn btn-primary btn-lg" href="https://github.com/riclab/Laravel-Inicial"><i class="fa fa-github" aria-hidden="true"></i> {{trans('site.github_button')}}</a></p>
				</div>

			</div>
		</div>     
	</div>
@stop