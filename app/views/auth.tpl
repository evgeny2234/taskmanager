<link href="css/auth.css" rel="stylesheet" type="text/css" />
<div class="container">
<div class="row">
<div class="col-md-offset-3 col-md-6">

<div class="tab" role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">sign in</a></li>
		<li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">sign up</a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content tabs">

		<div role="tabpanel" class="tab-pane fade in active" id="Section1">
			<form class="form-horizontal" action="../mvc/auth/login" method="post">
				<div class="form-group">
					<label for="exampleInputEmail1"></label>
					<input minlength="4" maxlength="18" required="required"  placeholder="Username" name="login" type="text" class="form-control" id="exampleInputEmail1">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1"></label>
					<input minlength="6" maxlength="20" required="required" placeholder="Password" name="password" type="password" class="form-control" id="exampleInputPassword1">
				</div>
				<div class="form-group">
					<div class="main-checkbox">
						<input name="keep_singin" value="1" id="checkbox1" name="check" type="checkbox">
						<label for="checkbox1"></label>
					</div>
					<span class="text">Keep me Signed in</span>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default">Sign in</button>
				</div>
				<div class="form-group forgot-pass">
					<button type="submit" class="btn btn-default">forgot password</button>
				</div>
			</form>

		</div>
		<div role="tabpanel" class="tab-pane fade" id="Section2">
			
			<form class="form-horizontal" method="post" action="../mvc/auth/register" method="post">
				<input type="hidden" name="register_form">
				<div class="form-group">
					<label for="exampleInputEmail1"></label>
					<input minlength="4" maxlength="18" required="required" placeholder="Username" name="username" type="text" class="form-control" id="login_reg">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1"></label>
					<input minlength="10" maxlength="25" required="required" placeholder="Email address" name="email" type="email" class="form-control" id="email_reg">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1"></label>
					<input minlength="6" maxlength="20" required="required" placeholder="Password" name="password" type="password" class="form-control" id="password_reg">
				</div>
				<!-- Добавить confirm пароля -->
				<div class="form-group">
					<button type="submit" class="btn btn-default">Sign up</button>
				</div>
			</form>
		</div>
	</div>
</div>

</div><!-- /.col-md-offset-3 col-md-6 -->
</div><!-- /.row -->
</div><!-- /.container -->