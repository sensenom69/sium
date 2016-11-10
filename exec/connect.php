<?php
/*
$server = 'db443415830.db.1and1.com';// your database server
$dbname = 'db443415830';	// your database name
$dbuser = 'dbo443415830';	// your database user name
$dbpasword = 'ivo250an41';			// your database password
//make connection to dbase
$connection = @mysql_connect($server, $dbuser, $dbpasword)
   or die(mysql_error());
 $base_datos = @mysql_select_db($dbname,$connection)
			or die(mysql_error());
@mysql_query("SET NAMES 'utf8'");
*/
$dbname = 'appmusica';	// your database name
$dbuser = 'root';	// your database user name
$dbpasword = '';			// your database password
//make connection to dbase
$connection = @mysql_connect($server, $dbuser, $dbpasword)
   or die(mysql_error());
$base_datos = @mysql_select_db($dbname,$connection)
			or die(mysql_error());
@mysql_query("SET NAMES 'utf8'");

?>