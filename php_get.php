<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php
require_once 'vendor/autoload.php';

use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\InputPinInterface;
use PiPHP\GPIO\Pin\OutputPinInterface;

// Configure a pin as an input pin and retrieve the value

$buttonPin = $gpio->getOutputPin(27);
$thevalue =  $buttonPin->getValue();
echo "Pin 27 = ";
echo  $thevalue;
?>
</body>
</html>
