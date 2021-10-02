<?php
include_once("./mysqldump/src/Ifsnop/Mysqldump/Mysqldump.php");

$dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=debtorbook', 'root', '');
$f = date("d-m-Y");
$dump->start("sql_dump/$f.sql");
