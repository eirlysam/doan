@extends('layout')
@section('content')
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@if(session()->has('message'))
		            <div class="alert alert-success">
		                {!! session()->get('message') !!}
		            </div>
		        @elseif(session()->has('error'))
		             <div class="alert alert-danger">
		                {!! session()->get('error') !!}
		            </div>
		        @endif
		        <div class="col-sm-3"></div>
				<div class="col-sm-6 login-form"><!--login form-->
					<h2>Lấy lại mật khẩu</h2>
					<form action="{{url('/recover-pass')}}" method="post">
						@csrf
						<input type="text" name="email_account" placeholder="Nhập email..." />
						
						<button type="submit" class="btn btn-default">Gửi mail</button>
					</form>
				</div><!--/login form-->
				<div class="col-sm-3"></div>
			</div>
		</div>
	</div>
</section><!--/form-->
@endsection