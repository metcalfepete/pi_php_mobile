<!DOCTYPE html>
<html>
<body>

<?php
require_once 'vendor/autoload.php';

use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\InputPinInterface;
use PiPHP\GPIO\Pin\OutputPinInterface;

$gpio = new GPIO();

// Retrieve pin 18 and configure it as an output pin
$pin = $gpio->getOutputPin(4);

// Set the value of the pin high (turn it on)
$pin->setValue(PinInterface::VALUE_HIGH);

echo "Pin 4 set High";
?>

</body>
</html>
