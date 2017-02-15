<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rover Controls</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Rover Controls</h2>
<?php
// define the GPIO pins for the motor ouptput (Note: PiFace pins start at 200)
$leftpin = 200;
$rightpin = 201;

if (isset($_POST['submit'])) {
	switch ($_POST['submit']) {
		case "go":
			exec("gpio -p write " . $leftpin . " 1");
			exec("gpio -p write " . $rightpin . " 1");
			break;
		case "stop":
			exec("gpio -p write " . $leftpin . " 0");
			exec("gpio -p write " . $rightpin . " 0");
			break;
		case "left":
			exec("gpio -p write " . $leftpin . " 1");
			exec("gpio -p write " . $rightpin . " 0");
			break;
		case "right":
			exec("gpio -p write " . $leftpin . " 0");
			exec("gpio -p write " . $rightpin . " 1");
			break;
	}
    echo '<br />The <b> ' . $_POST['submit'] . '</b> submit button was pressed<br />';
}
// echo '<br />The ' . $_POST['submit'] . ' submit button was pressed<br />';
?>
  <form action="" method="post">
    <div class="form-group">

    <input type="submit"  name="submit" class="btn btn-success" style="width:100%" value="go">
    <button type="submit" name="submit" class="btn btn-info" style="width:49%" value="left">Left</button>
    <button type="submit" name="submit" class="btn btn-info" style="width:49%" value="right">Right</button>
    <button type="submit" name="submit" class="btn btn-danger" style="width:100%" value="stop">Stop</button>
  </form>
</div>

</body>
</html>
