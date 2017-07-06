<?php
/**
 * User: xukaiwen@baixing.com
 */
require('connectDatabase.php');

$file = fopen("./Traffic_2017_by_city_utf_8.csv", "r");
fgetcsv($file);
do {
    $row = fgetcsv($file);

    if ($row[4] < 0 || $row[5] < 0)
        continue;
    if ($row[2]==='未知' || $row[3]==='未知')
        continue;

    $sql = "INSERT INTO `$db_name`.`$db_table` (`transaction_date`, `top_platform`, `sheng_name_cn`, `city_name_cn`," .
        "`page_view`, `user_view`) VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', $row[4], $row[5]);";

    $res = $db->query($sql);;

    if (!$res) {
        printf("%s\r\n", $sql);
        printf("%s\r\n", $db->error);
    }
} while ($row);

fclose($file);