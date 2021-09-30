<?php
require_once('./func.php');
$func = new Func();

//URLパラメータからパスを受け取る
$path = $_REQUEST['path'];
if(strlen($path) < 1)
  exit();

$func->exec($path);