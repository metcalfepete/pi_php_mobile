<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php
$ret = shell_exec('gpio read 7');
echo "Pin 7 status = " . $ret;
?>
</body>
</html>
