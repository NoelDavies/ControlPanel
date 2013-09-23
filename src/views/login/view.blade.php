<div class="container">

	<form class="form-signin" method="post">

		{{ Form::token() }}
		<h3 class="form-signin-heading">Please sign in</h3>

		{{ View::make('controlpanel::partials.form-message') }}

		<input type="text" name="username" class="input-block-level" placeholder="Username">
		<input type="password" name="password" class="input-block-level" placeholder="Password">
		<div class="pull-right"><a href="{{ URL::to(Config::get('controlpanel::route.login') . '/forgot-password') }}">{{ Lang::get('controlpanel::admin.forgot-password') }}</a></div>
		<label class="checkbox">
			<input type="checkbox" name="remember-me" value="1"> {{ Lang::get('controlpanel::admin.remember-me') }}
		</label>
		<button class="btn btn-primary" type="submit">{{ Lang::get('controlpanel::admin.sign-in') }}</button>
	</form>

</div> <!-- /container -->