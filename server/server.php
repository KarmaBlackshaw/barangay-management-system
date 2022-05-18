<?php
$database	= 'bsms';
$username	= 'root';
$host		= 'localhost';
$password	= 'admin1234';

ini_set('display_errors', 1);
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
	$wrapTicks = fn($str) => '`' . $str . '`';

	$filteredPayload = array_filter($payload);
	$columns = join(", ", array_map($wrapTicks, array_keys($filteredPayload)));
	$values = join(", ", array_map($wrapQuote, array_values($filteredPayload)));

	$status = $conn->query("INSERT INTO `${tbl}` ($columns) VALUES ($values)");

	return array(
		'status' => $status,
		'id' => mysqli_insert_id($conn)
	);
};

// if (!isset($_SESSION['username'])) {
// 	header('Location: login.php');
// }

function trimSpaces ($str) {
	return trim(preg_replace('/\s+/', ' ', $str));
}

class DB {
	private $_connection = null;
	private $_table = '';
	private $_select = '';
	private $_where = '';
	private $_update = '';
	private $_set = '';
	private $_delete = '';
	private $_from = '';
	private $_insert = '';
	private $_values = '';

	public function __construct ($connection) {
		$this->_connection = $connection;
	}

	public function from (string $table) {
		$this->_from = " FROM $table ";
		return $this;
	}

	public function select (array $cols) {
		$selectArr = [];

		foreach ($cols as $alias => $col) {
			$selectArr[] = "{$col} as {$alias}";
		}

		$select = join(", ", $selectArr);

		if ($this->_select === '') {
			$this->_select = " SELECT {$select} ";
		} else {
			$this->_select .= " {$select} ";
		}

		return $this;
	}

	public function where (string $key, string $valueOrOperand, $value = false) {
		if (!$value) {
			if ($this->_where === '') {
				$this->_where = " WHERE {$key} = '{$valueOrOperand}' ";
			} else {
				$this->_where .= " AND {$key} = '{$valueOrOperand}' ";
			}
		} else {
			if ($this->_where === '') {
				$this->_where = " WHERE {$key} {$valueOrOperand} {$value} ";
			} else {
				$this->_where .= " AND {$key} {$valueOrOperand} {$value}";
			}
		}

		return $this;
	}

	public function update (string $table) {
		$this->_update = " UPDATE {$table} ";

		return $this;
	}

	public function set (array $cols) {
		$updateArr = [];

		foreach ($cols as $col => $value) {
			$updateArr[] = "{$col} = '{$value}'";
		}

		$update = join(", ", $updateArr);

		if ($this->_set === '') {
			$this->_set = " SET {$update} ";
		} else {
			$this->_set .= " {$update} ";
		}

		return $this;
	}

	public function delete ($table) {
		$this->_delete = " DELETE FROM {$table} ";

		return $this;
	}

	public function insert ($table) {
		$this->_insert = " INSERT INTO {$table} ";

		return $this;
	}

	public function values (array $payload) {
		$wrapQuote = fn($str) => '"' . $str . '"';
		$wrapTicks = fn($str) => '`' . $str . '`';

		$filteredPayload = array_filter($payload);
		$columns = join(", ", array_map($wrapTicks, array_keys($filteredPayload)));
		$values = join(", ", array_map($wrapQuote, array_values($filteredPayload)));

		if ($this->_values === '') {
			$this->_values = " ($columns) VALUES ($values)";
		} else {
			$this->_values .= ", ($values) ";
		}

		return $this;
	}

	public function toString () {

		if (!empty($this->_update)) {
			return trimSpaces($this->_update . $this->_set . $this->_where);
		}

		if (!empty($this->_select)) {
			return trimSpaces($this->_select . $this->_from . $this->_where);
		}

		if (!empty($this->_delete)) {
			return trimSpaces($this->_delete . $this->_where);
		}

		if (!empty($this->_insert)) {
			return trimSpaces($this->_insert . $this->_values);
		}
	}

	private function clear () {
		$this->_table = '';
		$this->_select = '';
		$this->_where = '';
		$this->_update = '';
		$this->_set = '';
		$this->_delete = '';
		$this->_from = '';
		$this->_insert = '';
		$this->_values = '';
	}

	public function exec () {
		$result = $this
			->_connection
			->query($this->toString());

		if ($this->_select) {
			$this->clear();
			return $result
				->fetch_assoc();
		}

		if ($this->_insert) {
			$this->clear();
			return array(
				'id' => mysqli_insert_id($this->_connection),
				'status' => $result
			);
		}

		$this->clear();
		return array(
			'status' => $result
		);
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
// 	->from('users')
// 	->where('id', 2)
// 	->select(array(
// 		'id' => '2',
// 		'name' => '3',
// 		'username' => '4',
// 	))
// 	->toString()
// 	;

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