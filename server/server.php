<?php
$database = "bsms";
$username = "root";
$host = "localhost";
$password = "admin1234";

ini_set("display_errors", 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | E_DEPRECATED | E_STRICT);

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
	die("Connection Failed: " . $conn->connect_error());
}

if (!isset($_SESSION)) {
	session_start();
}

$insertDB = function ($tbl, $payload) use ($conn) {
	$wrapQuote = fn($str) => '"' . $str . '"';
	$wrapTicks = fn($str) => "`" . $str . "`";

	$filteredPayload = array_filter($payload);
	$columns = join(", ", array_map($wrapTicks, array_keys($filteredPayload)));
	$values = join(", ", array_map($wrapQuote, array_values($filteredPayload)));

	$status = $conn->query("INSERT INTO `${tbl}` ($columns) VALUES ($values)");

	return [
		"status" => $status,
		"id" => mysqli_insert_id($conn),
	];
};

// if (!isset($_SESSION['username'])) {
// 	header('Location: login.php');
// }

function trimSpaces($str)
{
	return trim(preg_replace("/\s+/", " ", $str));
}

class DB
{
	private $_connection = null;
	private $_table = "";
	private $_select = "SELECT *";
	private $_where = "";
	private $_join = "";
	private $_update = "";
	private $_set = "";
	private $_delete = "";
	private $_from = "";
	private $_insert = "";
	private $_values = "";
	private $_order = "";
	private $_first = "";

	private function _tableNameAlias($table)
	{
		if (is_array($table)) {
			$tableName = array_key_first($table);
			$alias = $table[$tableName];

			return " $tableName AS $alias ";
		}

		return " $table ";
	}

	public function __construct($connection)
	{
		$this->_connection = $connection;
	}

	public function from($table)
	{
		$tableName = $this->_tableNameAlias($table);

		$this->_from = " FROM $tableName ";

		return $this;
	}

	public function select(array $cols)
	{
		$selectArr = [];

		foreach ($cols as $alias => $col) {
			$selectArr[] = "{$col} as {$alias}";
		}

		$select = join(", ", $selectArr);

		if ($this->_select === "SELECT *") {
			$this->_select = " SELECT {$select} ";
		} else {
			$this->_select .= " {$select} ";
		}

		return $this;
	}

	public function first()
	{
		$this->_first = " LIMIT 1 ";

		return $this;
	}

	public function orderBy($col, $order)
	{
		$upperOrder = strtoupper($order);

		if ($this->_order === "") {
			$this->_order = " ORDER BY {$col} {$upperOrder} ";
		} else {
			$this->_order .= ",{$col} {$upperOrder} ";
		}

		return $this;
	}

	public function join($table, $firstCondition, $secondCondition)
	{
		$tableName = $this->_tableNameAlias($table);

		$this->_join .= " INNER JOIN {$tableName} ON {$firstCondition} = {$secondCondition} ";

		return $this;
	}

	public function leftJoin($table, $firstCondition, $secondCondition)
	{
		$tableName = $this->_tableNameAlias($table);

		$this->_join .= " LEFT JOIN {$tableName} ON {$firstCondition} = {$secondCondition} ";

		return $this;
	}

	public function where(string $key, string $valueOrOperand, $value = false)
	{
		if (!$value) {
			if ($this->_where === "") {
				$this->_where = " WHERE {$key} = '{$valueOrOperand}' ";
			} else {
				$this->_where .= " AND {$key} = '{$valueOrOperand}' ";
			}
		} else {
			if ($this->_where === "") {
				$this->_where = " WHERE {$key} {$valueOrOperand} {$value} ";
			} else {
				$this->_where .= " AND {$key} {$valueOrOperand} {$value}";
			}
		}

		return $this;
	}

	public function whereRaw(string $query)
	{
		if ($this->_where === "") {
			$this->_where = " WHERE {$query} ";
		} else {
			$this->_where .= " AND {$query} ";
		}

		return $this;
	}

	public function whereNot(string $key, string $valueOrOperand, $value = false)
	{
		if (!$value) {
			if ($this->_where === "") {
				$this->_where = " WHERE NOT {$key} = '{$valueOrOperand}' ";
			} else {
				$this->_where .= " AND NOT {$key} = '{$valueOrOperand}' ";
			}
		} else {
			if ($this->_where === "") {
				$this->_where = " WHERE NOT {$key} {$valueOrOperand} {$value} ";
			} else {
				$this->_where .= " AND NOT {$key} {$valueOrOperand} {$value}";
			}
		}

		return $this;
	}

	public function whereIn(string $key, array $values)
	{
		$joined_values = join(",", $values);

		if ($this->_where === "") {
			$this->_where = " WHERE IN ($joined_values) ";
		} else {
			$this->_where .= " AND IN ($joined_values) ";
		}

		return $this;
	}

	public function update(string $table)
	{
		$this->_update = " UPDATE {$table} ";

		return $this;
	}

	public function set(array $cols)
	{
		$updateArr = [];

		foreach ($cols as $col => $value) {
			$updateArr[] = "{$col} = '{$value}'";
		}

		$update = join(", ", $updateArr);

		if ($this->_set === "") {
			$this->_set = " SET {$update} ";
		} else {
			$this->_set .= " {$update} ";
		}

		return $this;
	}

	public function delete($table)
	{
		$this->_delete = " DELETE FROM {$table} ";

		return $this;
	}

	public function insert($table)
	{
		$this->_insert = " INSERT INTO {$table} ";

		return $this;
	}

	public function values(array $payload)
	{
		$wrapQuote = fn($str) => "'" . $str . "'";
		$wrapTicks = fn($str) => "`" . $str . "`";

		$filteredPayload = array_filter($payload);
		$columns = join(", ", array_map($wrapTicks, array_keys($filteredPayload)));
		$values = join(", ", array_map($wrapQuote, array_values($filteredPayload)));

		if ($this->_values === "") {
			$this->_values = " ($columns) VALUES ($values)";
		} else {
			$this->_values .= ", ($values) ";
		}

		return $this;
	}

	public function toString()
	{
		if (!empty($this->_update)) {
			// prettier-ignore
			return trimSpaces(
				join(" ", [
					$this->_update,
					$this->_set,
					$this->_where
				])
			);
		}

		if (!empty($this->_delete)) {
			// prettier-ignore
			return trimSpaces(
				join(" ", [
					$this->_delete,
					$this->_where,
				])
			);
		}

		if (!empty($this->_insert)) {
			// prettier-ignore
			return trimSpaces(
				join(" ", [
					$this->_insert,
					$this->_values,
				])
			);
		}

		if (!empty($this->_select) && !empty($this->_from)) {
			// prettier-ignore
			return trimSpaces(
				join(" ", [
					$this->_select,
					$this->_from,
					$this->_join,
					$this->_where,
					$this->_first,
					$this->_order,
				])
			);
		}
	}

	private function clear()
	{
		$this->_table = "";
		$this->_select = "SELECT *";
		$this->_where = "";
		$this->_update = "";
		$this->_set = "";
		$this->_join = "";
		$this->_delete = "";
		$this->_from = "";
		$this->_insert = "";
		$this->_values = "";
		$this->_order = "";
		$this->_first = "";
	}

	public function exec()
	{
		$result = $this->_connection->query($this->toString());

		if ($this->_insert) {
			$this->clear();
			return [
				"id" => mysqli_insert_id($this->_connection),
				"status" => $result,
			];
		}

		if ($this->_delete || $this->_update) {
			$this->clear();
			return [
				"status" => $result,
			];
		}

		if (!empty($this->_first) && !empty($this->_from)) {
			$this->clear();
			return $result->fetch_assoc();
		}

		if (!empty($this->_select) && !empty($this->_from)) {
			$this->clear();

			$array = [];
			while ($row = $result->fetch_assoc()) {
				$array[] = $row;
			}

			return $array;
		}

		$this->clear();
		return [
			"status" => $result,
		];
	}
}

$db = new DB($conn);

// ==== UPDATE ====
// $string = $db
// 	->update('users')
// 	->where('id', 2)
// 	->set(array(
// 		'id' => '2',
// 		'name' => '3',
// 		'username' => '4',
// 	))
// 	->toString()
// 	;

// ==== SELECT ====
// $string = $db
// 	->from(["users" => "u"])
// 	->where("id", 2)
// 	->orderBy("id", "desc")
// 	->select([
// 		"id" => "2",
// 		"name" => "3",
// 		"username" => "4",
// 	])
// 	->toString();

// ==== SELECT JOIN ====
// $string = $db
// 	->from(["users" => "u"])
// 	->join(["type" => "ut"], "ut.id", "u.id")
// 	->join(["transactions" => "txn"], "txn.id", "u.id")
// 	->where("id", 2)
// 	->orderBy("id", "desc")
// 	->select([
// 		"id" => "2",
// 		"name" => "3",
// 		"username" => "4",
// 	])
// 	->toString();

// ==== DELETE ====
// $string = $db
// 	->delete('users')
// 	->where('id', 2)
// 	->toString()
// 	;

// ==== INSERT ====
// $string = $db
// 	->insert('announcements')
// 	->values(array(
// 		"title" => "title1",
// 		"content" => "content1",
// 	))
// 	->values(array(
// 		"title" => "title2",
// 		"content" => "content2",
// 	))
// 	->exec()
// 	;
