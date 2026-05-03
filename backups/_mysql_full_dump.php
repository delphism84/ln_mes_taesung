<?php
/**
 * CLI full logical backup (mysqldump substitute when mysqldump binary unavailable).
 * Usage: php _mysql_full_dump.php /path/to/out.sql
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('memory_limit', '-1');
set_time_limit(0);

if ($argc < 2) {
	fwrite(STDERR, "Usage: php " . basename(__FILE__) . " <output.sql>\n");
	exit(1);
}
$outfile = $argv[1];

$src = file_get_contents(dirname(__DIR__) . '/connection.php');
function defval($src, $name)
{
	if (!preg_match("/define\\(\\s*['\"]" . preg_quote($name, '/') . "['\"]\\s*,\\s*['\"]([^'\"]*)['\"]\\s*\\)/", $src, $m)) {
		fwrite(STDERR, "Cannot parse define($name) in connection.php\n");
		exit(1);
	}
	return $m[1];
}
$dbhost = defval($src, 'DB_HOST');
$user = defval($src, 'DB_USER');
$pass = defval($src, 'DB_PASSWORD');
$dbname = defval($src, 'DB_NAME');

$host = '127.0.0.1';
$port = 3306;
if (strpos($dbhost, ':') !== false) {
	list($host, $p) = explode(':', $dbhost, 2);
	$port = (int) $p;
} elseif ($dbhost !== 'localhost' && $dbhost !== '127.0.0.1') {
	$host = $dbhost;
}

$m = @mysqli_connect($host, $user, $pass, $dbname, $port);
if (!$m) {
	fwrite(STDERR, mysqli_connect_error() . "\n");
	exit(1);
}
mysqli_set_charset($m, 'utf8');

$fh = fopen($outfile, 'wb');
if (!$fh) {
	fwrite(STDERR, "Cannot open output file\n");
	exit(1);
}

fwrite($fh, "-- Full backup generated " . gmdate('Y-m-d H:i:s') . " UTC\n");
fwrite($fh, "SET NAMES utf8;\n");
fwrite($fh, "SET FOREIGN_KEY_CHECKS=0;\n\n");

$tables = array();
$res = mysqli_query($m, 'SHOW FULL TABLES WHERE Table_type = \'BASE TABLE\'');
while ($res && ($row = mysqli_fetch_row($res))) {
	$tables[] = $row[0];
}
if ($res) {
	mysqli_free_result($res);
}

$views = array();
$res = mysqli_query($m, 'SHOW FULL TABLES WHERE Table_type = \'VIEW\'');
while ($res && ($row = mysqli_fetch_row($res))) {
	$views[] = $row[0];
}
if ($res) {
	mysqli_free_result($res);
}

function esc_val($m, $v)
{
	if ($v === null) {
		return 'NULL';
	}
	return "'" . mysqli_real_escape_string($m, $v) . "'";
}

foreach ($tables as $t) {
	$t = str_replace('`', '``', $t);
	$q = mysqli_query($m, 'SHOW CREATE TABLE `' . $t . '`');
	if (!$q) {
		fwrite(STDERR, mysqli_error($m) . " (SHOW CREATE TABLE `$t`)\n");
		continue;
	}
	$row = mysqli_fetch_row($q);
	mysqli_free_result($q);
	fwrite($fh, "DROP TABLE IF EXISTS `" . $t . "`;\n");
	fwrite($fh, $row[1] . ";\n\n");

	$q = mysqli_query($m, 'SELECT * FROM `' . $t . '`', MYSQLI_USE_RESULT);
	if (!$q) {
		fwrite(STDERR, mysqli_error($m) . " (SELECT * FROM `$t`)\n");
		continue;
	}
	$cols = array();
	$f = mysqli_fetch_fields($q);
	foreach ($f as $field) {
		$cols[] = '`' . str_replace('`', '``', $field->name) . '`';
	}
	$collist = implode(',', $cols);

	$batch = 50;
	$rows = array();
	while ($r = mysqli_fetch_row($q)) {
		$vals = array();
		foreach ($r as $cell) {
			$vals[] = esc_val($m, $cell);
		}
		$rows[] = '(' . implode(',', $vals) . ')';
		if (count($rows) >= $batch) {
			fwrite($fh, 'INSERT INTO `' . $t . '` (' . $collist . ') VALUES ' . implode(",\n", $rows) . ";\n");
			$rows = array();
		}
	}
	mysqli_free_result($q);
	if (count($rows) > 0) {
		fwrite($fh, 'INSERT INTO `' . $t . '` (' . $collist . ') VALUES ' . implode(",\n", $rows) . ";\n");
	}
	fwrite($fh, "\n");
}

foreach ($views as $v) {
	$v = str_replace('`', '``', $v);
	$q = mysqli_query($m, 'SHOW CREATE VIEW `' . $v . '`');
	if (!$q) {
		fwrite(STDERR, mysqli_error($m) . " (SHOW CREATE VIEW `$v`)\n");
		continue;
	}
	$row = mysqli_fetch_row($q);
	mysqli_free_result($q);
	fwrite($fh, "DROP VIEW IF EXISTS `" . $v . "`;\n");
	$sql = $row[1];
	$sql = preg_replace('/DEFINER=`[^`]*`@`[^`]*`\s+/', '', $sql);
	fwrite($fh, $sql . ";\n\n");
}

fwrite($fh, "SET FOREIGN_KEY_CHECKS=1;\n");
fclose($fh);
mysqli_close($m);
echo "Wrote " . $outfile . "\n";
