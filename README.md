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

<p>To install PHP libraries the recommended approach is to use [Composer](https://getcomposer.org/). It is important to define the PHP/Pi directory. For simple installations everything could be put in the default <i>/var/www/html</i> directory, (to make things a little easier give the Pi user rights to this directory). To install composer:
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
```










