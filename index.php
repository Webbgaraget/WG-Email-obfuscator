<?php
/*
Plugin Name: Webbgaraget E-mail obfuscator
Description: Obfuscates all email addresses in posts
Version: 1.0
Author: Erik Hedberg (erik@webbgaraget.se)
Author URI: http://webbgaraget.se
License: GPL2
*/

/*  Copyright 2011 Erik Hedberg (erik@webbgaraget)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once( 'email-obfuscator.php' );

$obfuscator = new WGEmailObfuscator();
$obfuscator->init();