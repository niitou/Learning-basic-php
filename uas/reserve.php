<?php
	session_start();
	$_SESSION['token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="./asset/style/style.css">
</head>
<body>
    <div class="container container-fluid reservation-container">
	<h1 class="reservation-header">Reservation Table</h1>
	<p class="text-muted reservation-text">Please Fill the form below accurately to enable us serve you better</p>
	<hr>
    <form action="./Modules//process.php" method="post" class="form-control form-control-lg reservation-form">
		<table class="table table-borderless reservation-table">

			<tr>
				<td><label for="required_field" class="required_field">Fullname</label></td>
				<td><input type="text" required name="first_name" id="first_name" class="form-control" placeholder="John" maxlength="16" value=<?php if(isset($_COOKIE['name'])) {$name = preg_split("/\\s/", $_COOKIE['name']); echo($name[0]);}?>><label for="first_name" class="text-muted form-label">First Name</label></td>
				<td><input type="text" required name="last_name" id="last_name" class="form-control" placeholder="Doe" maxlength="16" value=<?php if(isset($_COOKIE['name'])) {$name = preg_split("/\\s/", $_COOKIE['name']); echo($name[1]);}?>><label for="last_name" class="text-muted form-label">Last Name</label></td>
			</tr>

			<tr>
				<td><label for="required_field" class="required_field">Email</label></td>
				<td class="expand"><input required pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,4}$" type="email" name="email" id="email" class="form-control" placeholder="john.doe@email.com" value=<?php if(isset($_COOKIE['email'])) echo($_COOKIE['email'])?>></td>
			</tr>

			<tr>
				<td>Phone Number</td>
				<td class="expand"><input type="text" pattern="[0-9]{10,15}" name="phone" id="phone" class="form-control" maxlength="15" value=<?php if(isset($_COOKIE['phone'])) echo($_COOKIE['phone'])?>></td>
			</tr>

			<tr>
				<td><label for="required_field" class="required_field">Table For</label> </td>
				<td>
					<select name="people" id="peole" class="form-select" required>
						<option value="">Choose People Number</option>
						<option value="2">2</option>
						<option value="4">3 - 4</option>
						<option value="6">5 - 6</option>
						<option value="10">7 - 10</option>
					</select>
				</td>
				<td class="people_label">
					People
				</td>
			</tr>

			<tr>
				<td><label for="required_field" class="required_field">Date</label></td>
				<td class="expand"><input required type="date" name="reser_date" id="reser_date" class="form-control" max="" min="" value=""></td>
			</tr>

			<tr>
				<td><label for="required_field" class="required_field">Time</label></td>
				<td>
					<a class="btn btn-warning" href="javascript:void(0);" id="toggle-lunch">Lunch</a>
				</td>
				<td>
					<a class="btn btn-dark" href="javascript:void(0);" id="toggle-dinner">Dinner</a>
				</td>
			</tr>

			<tr>
				<td></td>
				<td>
					<div class="lunch-block block" id="lunch-block" style="display: none;">
						<input type="radio" name="reser_time" class="reser_time form-check-input" value="10" required checked>
						<label for="radio_10" class="radio_label form-check-label">10:00</label>

						<input type="radio" name="reser_time" class="reser_time form-check-input" value="11">
						<label for="radio_11" class="radio_label form-check-label">11:00</label>
						<br>
						<input type="radio" name="reser_time" class="reser_time form-check-input" value="12">
						<label for="radio_12" class="radio_label form-check-label">12:00</label>

						<input type="radio" name="reser_time" class="reser_time form-check-input" value="13">
						<label for="radio_13" class="radio_label form-check-label">13:00</label>
					</div>
				</td>
				<td>
					<div class="dinner-block block" id="dinner-block" style="display: none;">
							<input type="radio" name="reser_time" class="reser_time form-check-input" value="18">
							<label for="radio_18" class="radio_label form-check-label">18:00</label>

							<input type="radio" name="reser_time" class="reser_time form-check-input" value="19">
							<label for="radio_19" class="radio_label form-check-label">19:00</label>
							<br>
							<input type="radio" name="reser_time" class="reser_time form-check-input" value="20">
							<label for="radio_20" class="radio_label form-check-label">20:00</label>

							<input type="radio" name="reser_time" class="reser_time form-check-input" value="21">
							<label for="radio_21" class="radio_label form-check-label">21:00</label>
						</div>
				</td>
			</tr>

			<tr>
				<td>Notes</td>
				<td colspan="2"><textarea name="reser_notes" id="reser_notes" cols="130" rows="3" class="form-control"><?php if(isset($_COOKIE['notes'])) echo($_COOKIE['notes'])?></textarea></td>
			</tr>
			<tr>
				<td><input type="hidden" name="token" value=<?php echo($_SESSION['token'])?>></td>
				<td>
					<button type="submit" class="btn btn-primary" name="submit">Submit</button>
				</td>
				<td>
					<a href="./index.php" class="btn btn-danger">Cancel</a>
				</td>
			</tr>

		</table>
    </form>
    </div>
    <?php include('./asset/template/footer.php')?> 
	<script src="./asset/js/form.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>