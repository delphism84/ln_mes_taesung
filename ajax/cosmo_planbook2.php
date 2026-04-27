<?
session_start();

require_once('../connection.php');
require_once('../library/json.php');
require_once('../library/function.php');

$json = new Services_JSON();

extract($_POST);
extract($_GET);

$sql = "
	insert into erp_cosmo_supplyplan (
		fid,
		project_cd,
		project_nm,
		no,
		order_account_cd,
		order_account_nm,
		design_id,
		design_nm,
		sheetmetal_account_cd,
		sheetmetal_account_nm,
		order_dt,
		metal_color,
		delivery_dt,
		a_standard1,
		a_standard2,
		a_structure,
		a_type,
		a_capacity,
		a_conductor,
		a_size,
		a_color,
		b_standard1,
		b_standard2,
		b_structure,
		b_type,
		b_capacity,
		b_conductor,
		b_size,
		b_color
	) values (
		$fid,
		'$project_cd',
		'$project_nm',
		'$no',
		'$order_account_cd',
		'$order_account_nm',
		'$design_id',
		'$design_nm',
		'$sheetmetal_account_cd',
		'$sheetmetal_account_nm',
		'$order_dt',
		'$metal_color',
		'$delivery_dt',
		$a_standard1,
		$a_standard2,
		$a_structure,
		$a_type,
		$a_capacity,
		$a_conductor,
		$a_size,
		$a_color,
		$b_standard1,
		$b_standard2,
		$b_structure,
		$b_type,
		$b_capacity,
		$b_conductor,
		$b_size,
		$b_color
	)
";

query($sql);

$fid = mysql_insert_id();

$item_cd = $_POST['a_item_cd'];
$item_nm = $_POST['a_item_nm'];
$standard1 = $_POST['a_standard1'];
$standard2 = $_POST['a_standard1'];
$standard3 = $_POST['a_standard1'];
$cnt = $_POST['a_cnt'];
$size = $_POST['a_size'];
$memo = $_POST['a_memo'];

$i = 1;

foreach($item_cd as $key => $val) {
	if($item_cd[$key] != "") {
		$sql = "
			insert into erp_cosmo_supplyplan_item (
				fid,
				pid,
				item_cd,
				item_nm,
				standard1,
				standard2,
				standard3,
				cnt,
				size,
				memo
			) valeus (
				$fid,
				$i,
				'$item_cd[$key]',
				'$item_nm[$key]',
				'$standard1[$key]',
				'$standard2[$key]',
				'$standard3[$key]',
				'$cnt[$key]',
				'$size[$key]',
				'$memo[$key]'
			)
		";
		query($sql);
		$i++;
	}
}

$item_cd = $_POST['b_item_cd'];
$item_nm = $_POST['b_item_nm'];
$standard1 = $_POST['b_standard1'];
$standard2 = $_POST['b_standard1'];
$standard3 = $_POST['b_standard1'];
$cnt = $_POST['b_cnt'];
$size = $_POST['b_size'];
$memo = $_POST['b_memo'];

$i = 9;

foreach($item_cd as $key => $val) {
	if($item_cd[$key] != "") {
		$sql = "
			insert into erp_cosmo_supplyplan_item (
				fid,
				pid,
				item_cd,
				item_nm,
				standard1,
				standard2,
				standard3,
				cnt,
				size,
				memo
			) valeus (
				$fid,
				$i,
				'$item_cd[$key]',
				'$item_nm[$key]',
				'$standard1[$key]',
				'$standard2[$key]',
				'$standard3[$key]',
				'$cnt[$key]',
				'$size[$key]',
				'$memo[$key]'
			)
		";
		query($sql);
		$i++;
	}
}

echo "success";
?>