<?php
require('src/registration-plate-formatter.php');	
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<title>Licence Registration Plate Formatter</title>
</head>
<body>
	<div class="container">
		<h1>Dutch Registration Plate Formatter</h1>
		<form method="post">
			<input 	type="text" 
					name="registrationPlate" 
					placeholder="nd0001"
					maxlength="6"
			>
		
			<p class="small">
				Input 6 characters (only numbers and letters)
				<?php if(!isset($formattedRegistrationPlate)): ?>
				<span class="error">This combination does not exist or you made a typo, try again.</span>
				<?php endif; ?>
			</p>
			<button type="submit" name="submit" value="submit">Format</button>
		</form>


		<div class="result">
			<?php if(isset($formattedRegistrationPlate) && $formattedRegistrationPlate) : ?>
			<div class="registration-plate">
				<span class="registration-plate-text">
				<?php echo $formattedRegistrationPlate ?>
				</span>
			</div>
			<?php endif;?>
		</div>
	</div>
</body>
</html>