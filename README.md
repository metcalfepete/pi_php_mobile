# pi_php_mobile
Use PHP to enable mobile devices to control Raspberry Pi projects

<h2>Goal to this Project</h2>

The goal of this project is to examine some of the pitfalls and issues around creating a mobile browser interface to a Raspberry Pi projects.

This projects contains some examples for:<br>

1) Interfacing to Pi GPIO pins<br>
2) Managing PHP <form> interfacing where there are only buttons<br>
3) Creating a responsive design for PC, tablet and mobile browsers<br>

<h2>Base Apache and PHP Installation</h2>

There are some good installation procedure for installing Apache and PHP on the Raspberry Pi. A minimalist installation would be:<br>
<code>
sudo apt-get install apache2 -y
</code></br>
<code>
sudo apt-get install php5 libapache2-mod-php5 -y
</code></br>
<p>If everything is installed correctly the Apache home directory should be: <b>/var/www/html</b>.</p>
<p>To test that your installation is working open a browser on the Pi and go to: <b>http://localhost</b>. If the default (index.html) page comes up then you've install Apache correctly.</p>

<h2>Testing Raspberry Pi GPIO</h2>
<p>There are a couple different options to access the GPIO pin in PHP:</p>




