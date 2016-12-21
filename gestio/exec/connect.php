<?php
/*
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

*/
$server = 'mysql374int.servicios-fusion.es';// your database server
$dbname = 'db1463039_sium';	// your database name
$dbuser = 'u1463039_root';	// your database user name
$dbpasword = ';(eyN9Uc,E4+g|EX';			// your database password
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