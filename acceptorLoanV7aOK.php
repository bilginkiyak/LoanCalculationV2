<?php

//   23.03.2016   test with  MySQLi functions   and DEBUG info
//	 2016 * Acceptor 
//	
//	http://localhost/
//
//      http://localhost/PHP2016/acceptorLotto.php?smsID=1&MSISDN=359899866747&msp=87&smsBody=5LF1
//      http://localhost/PHP2016/acceptorLotto.php?smsID=1&MSISDN=359899866747&msp=87&smsBody=1000:USD 
//
//	set error reporting
error_reporting(E_ALL);
$fDBG=1;
//
//	open connection

$link = mysqli_connect("localhost", "root", "", "LoanDB7a");
//$link = mysqli_connect("127.0.0.1", "my_user", "my_password", "my_db");

if (!$link) {
    //
    //	print error and exit()
    echo "-ERR pav LINK MySQL Error: " . mysql_error();
    exit();
}

//
//	select db
//oldpav mysql_select_db("DBlotto");
if (!(mysqli_select_db($link, "LoanDB7a"))) {   //!!!
//	print error and exit()
    echo "-ERR pav no selected DB  MySQL Error: " . mysql_error();
    exit();
}
//bool mysqli_select_db ( mysqli $link , string $dbname )
//
//	get data from _GET
$smsID = $_GET["smsID"];
$MSISDN = $_GET["MSISDN"];
$mobileSP = $_GET["msp"];
$smsBody = $_GET["smsBody"];

//
//	prepare data (delete space and etc.)
$smsBody = str_replace(" ", "", $smsBody);
if($fDBG==1) echo "<br />DBG:test1!!!! smsBody=$smsBody";
//
//	add slashes
$smsID = addslashes($smsID);
$MSISDN = addslashes($MSISDN);
$mobileSP = addslashes($mobileSP);
$smsBody = addslashes($smsBody);

$args =explode(':',$smsBody); // args
$amount = $args [0];
$currencytype = $args [1];
if($fDBG==1)echo "<br />DBG:test2!!!! amount=$amount,  currencytype=$currencytype";  
//
//	search SQL in codes
$selectSQL = "
	SELECT 
		* 
	FROM 
		interest 
	WHERE 
		currencytype =  '$currencytype'
                    ORDER BY dt DESC
                    LIMIT 1
";


//
//	exec SQL
// org $rSelect = mysqli_query($selectSQL);
$rSelect = mysqli_query($link, $selectSQL);

if($fDBG==1)echo "<br />DBG:test55555";

//  check result
if ($rSelect == false) {
    //
    echo "-ERR rSelect == false";
    //	print error and exit()
    echo "-ERR MySQL ***** Error: " . mysqli_error() . "\nSQL: $selectSQL";
    exit();
} else {
  if($fDBG==1)  echo "<br /> DBG:test3!!!!";
    //
    //	get row count
//	$count = mysql_num_rows($rSelect);  
    $NumOfRows = mysqli_num_rows($rSelect);

    if($fDBG==1)echo "<br />DBG:test4!!!!  NumOfRows=$NumOfRows ";
    //
    //	check row count
    if ($NumOfRows == 0) {
        //
        //	print text for invalid code
        echo "+OK Invalid curruncy type.";
        exit();
    }
    if($fDBG==1)echo "<br />DBG:test5!!!! ";
    //
    //	fetch data
    //accoc  array mysql_fetch_array ( resource $result [, int $result_type = MYSQL_BOTH ] )
    while( $row = mysqli_fetch_array($rSelect))  //i-version doesnot exist
      {
    //
         
    //
    //	get data
    $interest = $row['interest'];
    $TotalAmount = $amount*( (100+ $interest)/100);
    $dt=$row['dt'];
   if($fDBG==1) echo "<br />DBG:dt=$dt   TotalAmount=$TotalAmount, interest=$interest, amount=$amount, ";
    if($fDBG==1)echo "<br />";
 
         
   }
   echo "+OK TotalAmount=$TotalAmount, interest=$interest, amount=$amount, ";
         //
   if($fDBG==1) echo "<br />DBG:test E N D  !!!  ";
}

//
//	close connection
mysqli_close($link);
?>