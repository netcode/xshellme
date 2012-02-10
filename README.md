XSHELL ME
===================

XShellMe is a php script that helps you to scan your website searching for 
malicious codes and web shells which can harm your website 
XShellMe published under MIT License <http://www.opensource.org/licenses/mit-license.php>
for more info <http://netcode.me>

Usage
-------

* upload the script to your root directory usually public_html
* run it by call the script via browser or via terminal:

	php xshell.php

* you can change the scan specified directory by modify xshell.php like that: 

	$xshell = new xShellMe();
	$xshell->start('myFolder');
	

