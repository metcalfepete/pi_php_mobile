# PHP for Pi Mobile Controls
Use PHP to enable mobile devices to control Raspberry Pi projects

<h2>Goal to this Project</h2>

The goal of this project is to examine some of the pitfalls and issues around creating a mobile browser interface to a Raspberry Pi projects.

This projects look at:<br>

1. Interfacing PHP to Pi GPIO pins<br>
2. Managing PHP <form> interfacing where there are only buttons<br>
3. Creating a responsive design for PC, tablet and mobile browsers<br>

![alt tag](php_explorerhat.png)

<h2>Base Apache and PHP Installation</h2>

There are some good installation procedure for installing Apache and PHP on the Raspberry Pi. A minimalist installation would be:<br>
```bash
sudo apt-get install apache2 -y
sudo apt-get install php5 libapache2-mod-php5 -y
```
<p>If everything is installed correctly the Apache home directory should be: <b>/var/www/html</b>.</p>
<p>To test that your installation is working open a browser on the Pi and go to: <b>http://localhost</b>. If the default (index.html) page comes up then you've install Apache correctly.</p>

<h2>PHP Interfacing to Pi GPIO</h2>
<p>There are a few to access the GPIO pin in PHP:</p>
* use a PHP library
* shell to the <b>gpio</b> command

<p>Using a PHP library allows for a standard PHP interface, with an object module. From testing we found that the PHP libraries were not as flexible as the standard gpio command. For example you are not able to access PiFace pins (200+).

<h2>Installing PHP GPIO Library</h2>

<p>To install PHP libraries the recommended approach is to use [Composer](https://getcomposer.org/). It is important to define the PHP/Pi directory. For simple installations everything could be put in the default <i>/var/www/html</i> directory, (to make things a little easier give the Pi user rights to this directory). To install composer:</p>

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

php composer-setup.php
php -r "unlink('composer-setup.php');"
```
To install the PIPHP library:

```bash
php composer.phar require piphp/gpio
```


<p>To install the PHP gpio library:

<h2>Using PIPHP Library</h2>
<p>
To use the PIPHP it is important to have the correct path to the <i>vendor/autoload.php</i> file. Below is an example of reading a GPIO pin. It is important to note that the PIPHP library uses BCM pin references and not wPin pin numbers.
```php
<html>
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
```
<p>A simple GPIO set or write example would be:</p>
```php
<html>
<body>
<?php
require_once 'vendor/autoload.php';

use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\InputPinInterface;
use PiPHP\GPIO\Pin\OutputPinInterface;

$gpio = new GPIO();

// Configure an output pin
$pin = $gpio->getOutputPin(4);

// Set the value of the pin high (turn it on)
$pin->setValue(PinInterface::VALUE_HIGH);

echo "Pin 4 set High";
?>

</body>
</html>
```
##GPIO Command Line Utility
<p>The Raspberry Pi <b>gpio</b> command line utility can also be used in PHP. Using the <b>gpio</b> has a few advantages over the PIPHP library:
*support for non-standard pin options (PiFace)
*supports a readall function to check the status of all pins
*you can quickly prototype at the command line
<p>To use the gpio command the PHP <i>shell_exec</i> statement is used. A simple gpio read example is:</p>
```php
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
```
A simple gpio write example would be:
```php
<html>
<head>
</head>
<body>
<?php
exec("gpio write 7 1");
$ret = shell_exec('gpio read 7');
echo "Pin 7 status = " . $ret;
?>
</body>
</html>
```

<h2>Using PiFace Modules</h2>

<p>The PiFace Module is a shield or top that mounts on top of the Raspberry Pi. There are PiFace modules for Pi 1 and for Pi 2/3 hardware. The PiFace module offers a safe mechanism to connect motors and I/O that could potentially damage the Pi hardware. The PiFace has 8 outputs (with LED indication) that are referenced with GPIO pins 200-207. Below is picture of a PiFace module with LEDs 0/1 (GPIO 200/201) set. When using the gpio command with PiFace add the option <b>-p</b>. For example to set the first output on:
```bash
gpio -p write 200 1
```
![alt tag](php_piface.png)

#PHP Forms

<P>For many Pi projects button interfaces are all that is required. In the Web design this is not typical, so it is important to determine which button is pushed. One approach to this problem is to give all the buttons the same name:</p>

```html
<form action="" method="post">
  <input type="submit" name="submit" value="go">
  <input type="submit" name="submit" value="left">
  <input type="submit" name="submit" value="right">
  <input type="submit" name="submit" value="stop">
</form>
```
<P>Then in the PHP code look a single value:
```php
<?php
// define the GPIO pins for the motor ouptput (Note: PiFace pins start at 200)
$leftpin = 24;
$rightpin = 29;

if (isset($_POST['submit'])) {
	switch ($_POST['submit']) {
		case "go":
			exec("gpio write " . $leftpin . " 1");
			exec("gpio write " . $rightpin . " 1");
			break;
		case "stop":
			exec("gpio write " . $leftpin . " 0");
			exec("gpio write " . $rightpin . " 0");
			break;
		case "left":
			exec("gpio write " . $leftpin . " 1");
			exec("gpio write " . $rightpin . " 0");
			break;
		case "right":
			exec("gpio write " . $leftpin . " 0");
			exec("gpio write " . $rightpin . " 1");
			break;
	}
}
?>
```
#Mobile CCS Templates
<p>There are quite a few good mobile templates to choose from. [Bootstrap](http://getbootstrap.com/) is one of the most popular frameworks, and for Pi applications is seems to be a good fit. </P>.








