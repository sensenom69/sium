<?php

$server = 'db460721846.db.1and1.com';// your database server
$dbname = 'db460721846';	// your database name
$dbuser = 'dbo460721846';	// your database user name
$dbpasword = '0891a01m52d';			// your database password
//make connection to dbase
$connection = @mysql_connect($server, $dbuser, $dbpasword)
   or die(mysql_error());
 $base_datos = @mysql_select_db($dbname,$connection)
			or die(mysql_error());
@mysql_query("SET NAMES 'utf8'");

/*
$dbname = 'appmusica';	// your database name
$dbuser = 'root';	// your database user name
$dbpasword = '';			// your database password
//make connection to dbase
$connection = @mysql_connect($server, $dbuser, $dbpasword)
   or die(mysql_error());
$base_datos = @mysql_select_db($dbname,$connection)
			or die(mysql_error());
@mysql_query("SET NAMES 'utf8'");
*/
?>