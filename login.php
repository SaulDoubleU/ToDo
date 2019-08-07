<?php
	include_once("functions.inc.php");
	
	// get user and password from POST
	if( !empty($_POST) ) {
		$username = $_POST['email'];
		$password = $_POST['password'];

		// check if user can login (use function)
		if( canILogin($username, $password) ) {
			session_start();
			$_SESSION['username'] = $username;

			// if ok -> redirect to index.php
			header('Location: index.php');
		}
		else {
			$error = "Login failed";
		}

		

	}

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IMDFlix</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="todoLogin">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Sign In</h2>

				<?php if( isset($error) ): ?>
				<div class="form__error">
					<p>
						Sorry, we can't log you in with that email address and password. Can you try again?
					</p>
				</div>
				<?php endif; ?>

				<div class="email__success" style="display: none">
					<p>
						That email adress is still available.
					</p>
				</div>

				<div class="email__error" style="display: none">
					<p>
						Sorry, that email adress is already in use.
					</p>
				</div>

				<div class="form__field">
					<label for="email">Email</label>
					<input type="text" id="email" name="email">
				</div>
				<div class="form__field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign in" class="btn btn--primary">	
					<input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label>
				</div>
			</form>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script>
		$("#email").on("keyup", function(e) {

			var email = $("#email").val();

			$.ajax({
				method: "POST",
  				url: "ajax/accountAvailable.php",
				data: { email: email },
  				dataType: "JSON"
			}).done(function(res) {
  				if ( res.status == "error" ) {
					$(".email__error").css("display", "block");
					$(".email__success").css("display", "none");
				} else if ( res.status == "success" ) {
					$(".email__error").css("display", "none");
					$(".email__success").css("display", "block");
				}
			});
		});
	</script>
</body>
</html>