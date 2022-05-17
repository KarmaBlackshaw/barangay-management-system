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

class DB {
	private $_table = '';
	private $_select = '';
	private $_where = '';

	public function from ($table) {
		$this->_table = $table;
		return $this;
	}

	public function select ($cols) {
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

		echo $this->_select;

		return $this;
	}

	public function where ($key, $valueOrOperand, $value = false) {
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
}

$db = new DB();

$db
	->from('users')
	->where('id', 2)
	->select(array(
		'id' => 'users.id',
		'name' => 'users.name',
		'username' => 'users.username',
	))
	;
// echo '<pre>';
// var_dump($db);
// echo '</pre>';