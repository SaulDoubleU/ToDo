<?php

	if ( !empty($_POST) ) {
		//email en password opvragen 
		$email = $_POST['email'];
		$password = $_POST['password'];

		//hash opvragen, op basis van email 
		$conn = new PDO("mysql:host=localhost;dbname=todoapp","root","root", null);

		//check of rehash van password gelijk is aan hash uit db
		$statement = $conn->prepare ("SELECT * FROM users where email = :email");//prepare = veilig statement klaarzetten
		$statement->bindParam(":email", $email);
		$result = $statement->execute();

		$user = $statement->fetch(PDO::FETCH_ASSOC); //wij benoemen associatief, array met kolomnamen en niet met nummers

		//ja -> login
		if( password_verify($password, $user['password']) ) {//$user is heel de array en er is enkel de hash nodig die zit in de kolom password
			echo "password klopt";
			session_start();
			$_SESSION['userid'] = $user['id'];
			header('Location: index.php');
		//nee -> error
		} else {
			echo "neeen!";
		}
	}

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TODO App</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="phpLogin">
		<div class="form form--login">
			<form action="" method="post">
				<h2 form__title>Sign In</h2>

				<?php if (isset($error)): ?>
				<div class="form__error">
					<p>
						Sorry, we can't log you in with that email address and password. Can you try again?
					</p>
				</div>
				<?php endif; ?>

				<div class="form__field">
					<label for="Email">Email</label>
					<input type="text" name="email">
				</div>
				<div class="form__field">
					<label for="Password">Password</label>
					<input type="password" name="password">
				</div>

				<div class="form__field">
					<input type="submit" value="Sign in" class="btn btn--primary">	
					<input type="checkbox" id="rememberMe"><label for="rememberMe" class="label__inline">Remember me</label>
				</div>

				<div>
					<p>No account yet?<a href="register.php">Sign up here</a></p>
				</div>
			</form>
		</div>
	</div>
</body>
</html>