<?php
/**
 * User: xukaiwen@baixing.com
 */
require('sqlVariable.php');

/*  连接数据库  */
$db = new mysqli($db_host, $db_user, $db_password, $db_name) or die ('数据库连接失败！');