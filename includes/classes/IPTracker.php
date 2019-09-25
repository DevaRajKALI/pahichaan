<?php

class IPTracker {

	private $con;


	public function __construct($con) {
		$this->conn = $con; 
	}


	public function getIP() {
		$ipaddress = '';

	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];

	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    
	    else
	        $ipaddress = 'UNKNOWN';

	    return $ipaddress;

	}



	public function blockIP() {

		$targetIP = $this::getIP();
	    $date = date("Y-m-d H:i:s");

		$sql = "INSERT INTO blocked_ips (ips, blocked_date) VALUES ('$targetIP', '$date')";
		$this->conn->query($sql);
    }


    
    public function getBlockedIPs() {
    	
    	$ips = array();

    	$sql = "SELECT * FROM blocked_ips ORDER BY id";
    	$result = $this->conn->query($sql);

    	if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
        		array_push($ips, $row['ips']);
    		}
		}
		return $ips; 
    }


    public function getBlockedIPsRow() {
    	$sql = "SELECT * FROM blocked_ips ORDER BY id";
    	$result = $this->conn->query($sql);

    	if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
        		echo "<tr>" . 
        			 "<td>" . $row['id']. "</td>" . 
        			 "<td>" . $row['ips']. "</td>" .
        			 "<td>" . $row['blocked_date']. "</td>" .
        			 "</tr>";
    		}
		} 
    }


    public function unblockIP($targetIP) {
    	$sql = "DELETE FROM blocked_ips WHERE ips = '$targetIP'";
    	$this->conn->query($sql);
    }


}


// ::1
// Its the loopback address in ipv6, equal to 127.0.0.1 in ipv4. 


?>