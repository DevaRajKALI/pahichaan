<?php

class Admin {

	private $con;

	public function __construct($con) {
		$this->conn = $con;
	}


	public function getUsersInfo() {
		$sql = "SELECT * FROM users ORDER BY id";
    	$result = $this->conn->query($sql);

    	if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
        		echo "<tr>" . 
        			 "<td>" . $row['id']. "</td>" . 
        			 "<td>" . $row['first_name'] . "</td>" .
        			 "<td>" . $row['last_name'] . "</td>" .
        			 "<td>" . $row['username']. "</td>" .
        			 "<td>" . $row['email']. "</td>" .
        			 "<td>" . $row['signup_date']. "</td>" .
        			 "<td>" . $row['user_closed']. "</td>" .
        			 "<td>" . $row['status']. "</td>" . 
        			 "</tr>";
    		}
		} 
		else {
    		echo "No users!";
		}
	}


	public function getUsersInfoByUsername($target) {
		$sql = "SELECT * FROM users WHERE username='$target'";
    	$result = $this->conn->query($sql);
    	if ($result->num_rows > 0) {
    		while ($row = $result->fetch_assoc()) {
		    	echo "<table border='0.5px'><tr>" .
					"<td>" . $row['id'] . "</td>" .
					"<td>" . $row['first_name'] . "</td>" .
					"<td>" . $row['last_name'] . "</td>" .
					"<td>" . $row['username'] . "</td>" .
					"<td>" . $row['email'] . "</td>" .
					"<td>" . $row['signup_date'] . "</td>" .
					"<td>" . $row['user_closed'] . "</td>" .
					"<td>" . $row['status'] . "</td>" . 
		        	 "</tr> </table>" . "</tr>";
		    }
		}
		else {
			echo "<b>No user with that username</b>";
		}        	 
	}


	public function activeUsersCount() {
		$sql = "SELECT COUNT(user_closed) as _count FROM users WHERE user_closed = 'no'";
		$result = $this->conn->query($sql)->fetch_assoc();
		return $result['_count'];	
	}


	public function blockedUsersCount() {
		$sql = "SELECT COUNT(status) as _count FROM users WHERE status = 'blocked'";
		$result = $this->conn->query($sql)->fetch_assoc();
		return $result['_count'];	
	}


	public function totalUsersCount() {
		$sql = "SELECT COUNT(username) as _count FROM users";
		$result = $this->conn->query($sql)->fetch_assoc();
		return $result['_count'];
	}


	public function blockUser($username) {
		$sql = "UPDATE users SET status = 'blocked' WHERE username = '$username'";
    	$this->conn->query($sql);
	}


	public function unblockUser($username) {
		$sql = "UPDATE users SET status = 'normal' WHERE username = '$username'";
    	$this->conn->query($sql);
	}


	public function showBlockedUsers() {
		$sql = "SELECT id, username, name, email, date_joinedFROM users WHERE status = 'blocked'";
    	$result = $this->conn->query($sql);
    	if ($result->num_rows > 0) {
    		while ($row = $result->fetch_assoc()) {
		    	echo "<table border='1px'> <tr>" .
					"<td>" . $row['id'] . "</td>" .
					"<td>" . $row['first_name'] . "</td>" .
					"<td>" . $row['last_name'] . "</td>" .
					"<td>" . $row['username'] . "</td>" .
					"<td>" . $row['email'] . "</td>" .
					"<td>" . $row['signup_date'] . "</td>" .
					"<td>" . $row['user_closed'] . "</td>" .
					"<td>" . $row['status'] . "</td>" .  
		        	 "</tr> </table>" . "</tr>";
		    }
		}	
	}


	public function deleteUser($username) {
		$sql = "DELETE FROM users WHERE username = '$username'";
    	$this->conn->query($sql);
	} 

}


?>