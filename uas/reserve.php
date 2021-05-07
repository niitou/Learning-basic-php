<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./asset/style/style.css" type="text/css"> -->
    <style>
        <?php include('./asset/style/style.css')?>
    </style>
</head>
<body>
    <div class="container container-fluid reservation-container">
	<h1 class="reservation-header">Reservation Table</h1>
	<p class="text-muted reservation-text">Please Fill the form below accurately to enable us serve you better</p>
	<hr>
    <form action="./Modules//insert.php" method="post" class="form-control form-control-lg reservation-form">
		<table class="table table-borderless reservation-table">

			<tr>
				<td><label for="required_field" class="required_field">Fullname</label></td>
				<td><input type="text" name="first_name" id="first_name" class="form-control" placeholder="John"><label for="first_name" class="text-muted form-label">First Name</label></td>
				<td><input type="text" name="last_name" id="last_name" class="form-control" placeholder="Doe"><label for="last_name" class="text-muted form-label">Last Name</label></td>
			</tr>

			<tr>
				<td><label for="required_field" class="required_field">Email</label></td>
				<td><input type="email" name="email" id="email" class="form-control" placeholder="john.doe@email.com"></td>
			</tr>

			<tr>
				<td>Phone Number</td>
				<td><input type="text" name="phone" id="phone" class="form-control"></td>
			</tr>

			<tr>
				<td><label for="required_field" class="required_field">Table For</label> </td>
				<td>
					<select name="people" id="peole" class="form-select">
						<option selected>Choose People Number</option>
						<option value="">2</option>
						<option value="">3</option>
						<option value="">4</option>
						<option value="">5</option>
						<option value="">6</option>
					</select>
				</td>
				<td>
					People
				</td>
			</tr>

			<tr>
				<td><label for="required_field" class="required_field">Date</label></td>
				<td><input type="date" name="reser_date" id="reser_date" class="form-control"></td>
			</tr>

			<tr>
				<td><label for="required_field" class="required_field">Time</label></td>
				<td><input type="time" name="early_in" id="early_in" class="form-control"></td>
				<td><input type="time" name="checkout" id="checkout" class="form-control"></td>
			</tr>

			<tr>
				<td>Notes</td>
				<td colspan="2"><textarea name="reser_notes" id="reser_notes" cols="130" rows="3" class="form-control"></textarea></td>
			</tr>

			<tr>
				<td></td>
				<td>
					<button type="submit" class="btn btn-primary">Submit</button>
				</td>
				<td>
					<a href="./index.php" class="btn btn-danger">Cancel</a>
				</td>
			</tr>

		</table>
    </form>
    </div>
    <?php include('./asset/template/footer.php')?> 
    <script>
        <?php include('./asset/js/index.js')?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>