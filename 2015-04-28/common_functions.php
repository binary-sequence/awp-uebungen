<?php

require_once('common_constants.php');

function get_assoc_array($mysql_result) {
	$assoc_array = array();

	while ($row = mysql_fetch_assoc($mysql_result)) {
		array_push($assoc_array, $row);
	}

	return $assoc_array;
}

function get_customers($db) {
	$customers = null;

	$sql_select_customers = '
		SELECT *
		FROM customers
		;
	';

	$mysql_result = mysql_query($sql_select_customers, $db);

	$customers = get_assoc_array($mysql_result);

	return $customers;
}

function get_db_connection() {
	$db = mysql_connect(DB_SERVER_ADDRESS, DB_USER, DB_PASSWORD);

	mysql_select_db(DB_DATENBANK, $db);

	return $db;
}

function insert_customer($db, $array_insert_customer) {
	$customerID = false;

	$keys = array_keys($array_insert_customer);
	sort($keys);
	sort($array_insert_customer);

	# Text fields in ''
	foreach ($array_insert_customer as $field_name => $value) {
		if (!is_numeric($value)) {
			$array_insert_customer[$field_name] = "'" . $value . "'";
		}
	}

	# Comma-separated list
	$field_name_list = implode(', ', $keys);
	$values_list = implode(', ', $array_insert_customer);

	$sql_insert_customer = "
		INSERT INTO `customers`
			($field_name_list)
		VALUES
			($values_list)
		;
	";

	$query_ok = mysql_query($sql_insert_customer, $db);

	if (!$query_ok) {
		echo(mysql_error($db));
		echo("<br/>\n<hr/><br/>\n");
		echo($sql_insert_customer);
		die();
	} else {
		$customerID = mysql_insert_id($db);
	}

	return $customerID;
}
