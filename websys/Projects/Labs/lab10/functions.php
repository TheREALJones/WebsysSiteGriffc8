<?php

/* USING THE OLD mysql API IS AN ANTI-PATTERN! ONLY FOR REFERENCE */

// function connect($host = 'localhost:/tmp/mysql.sock', $username, $password, $db = null)
function connect($host = 'localhost', $username, $password, $db = null)

{
	$conn = mysqli_connect($host, $username, $password, $db);

	// if ( !$conn ) die('Could not connect.');

	if ( $db ) {
		mysqli_select_db($conn, $db);
	}

	return $conn;
}

function query($query, $conn)
{
	$results = mysqli_query($conn, $query);

	if ( $results ) {
		$rows = array();
		while($row = mysqli_fetch_object($results)) {
			$rows[] = $row;
		}
		return $rows;
	}

	return false;
}

