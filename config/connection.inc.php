<?php
require __DIR__ . '/bootstrap_db.php';

mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('Connect Error');
mysql_select_db(DB_NAME);
mysql_query("set names 'utf8'");
