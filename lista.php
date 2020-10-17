<?php
	$con = null;
	$con = getConnection();		

	function getConnection() {
        global $con; 

		if ($con != null) return $con;

		    $myServer = "192.168.0.11";
		    $myUser = "root";
		    $myPass = "root";
         	    $myDB = "PostgreSQL";


		
		$connectionInfo = array( "Database"=>$myDB, "UID"=>$myUser, "PWD"=>$myPass , "MultipleActiveResultSets"=> false); //MARS
        $conn = sqlsrv_connect( $myServer, $connectionInfo );
        
        

	}
?>

```