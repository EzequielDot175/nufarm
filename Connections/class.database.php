<?php
/*
*
* MARCO VOEGELI 31.12.2005
* www.voegeli.li
*
* This class provides one central database-connection for
* al your php applications. Define only once your connection
* settings and use it in all your applications.
*
*
*/

  
 class Database
 { // Class : begin
 
 var $host;  		//Hostname, Server
 var $password; 	//Passwort MySQL
 var $user; 		//User MySQL
 var $database; 	//Datenbankname MySQL
 var $link;
 var $query;
 var $result;
 var $rows;
 
 function Database()
 { // Method : begin
 //Konstruktor
 
 
 
 // ********** DIESE WERTE ANPASSEN **************
 // ********** ADJUST THESE VALUES HERE **********
/*$this->host = "localhost";                  //          <<---------
$this->password = "ashley69";           //          <<---------
$this->user = "root";                   //          <<---------
$this->database = "nufarm";*/ 

// $this->host = "localhost";                  //          <<---------
// $this->password = "19735";           //          <<---------
// $this->user = "root";                   //          <<---------
// $this->database = "pnufarm_productosnufarm"; 

$this->host = "localhost";                  //          <<---------
$this->password = "K[^Xc0lsU1T(";           //          <<---------
$this->user = "nmaxx_pnufarm";                   //          <<---------
$this->database = "nmaxx_productosnufarm"; 

/*
$this->host = "localhost";                  //          <<---------
$this->password = "dot1243*";           //          <<---------
$this->user = "wpdot175_dot175";                   //          <<---------
$this->database = "wpdot175_nufarm";

*/          //          <<---------
  $this->rows = 0;
 
 // **********************************************
 // **********************************************
 
 
  
 } // Method : end
 
 function OpenLink()
 { // Method : begin
  $this->link = @mysql_connect($this->host,$this->user,$this->password) or die (print "Class Database: Error while connecting to DB (link)");
 } // Method : end
 
 function SelectDB()
 { // Method : begin
 
 @mysql_select_db($this->database,$this->link) or die (print "Class Database: Error while selecting DB");
  
 } // Method : end
 
 function CloseDB()
 { // Method : begin
 mysql_close();
 } // Method : end
 
 function Query($query)
 { // Method : begin
 $this->OpenLink();
 $this->SelectDB();
 $this->query = $query;
 $this->result = mysql_query($query,$this->link) or die (print "Class Database: Error while executing Query");
 
// $rows=mysql_affected_rows();

if(preg_match('/SELECT/',$query))
{
 $this->rows = mysql_num_rows($this->result);
}
 
 $this->CloseDB();
 } // Method : end	
  
 } // Class : end
 
?>
