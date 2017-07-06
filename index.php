<?php
/**
 * User: xukaiwen@baixing.com
 */
require('connectDatabase.php');

$file = fopen("./Traffic_2017_by_city_utf_8.csv", "r");
do {
    $row = fgetcsv($file);
    $sql = "INSERT INTO `$db_name`.`$db_table` (`transaction_date`, `top_platform`, `sheng_name_cn`, `city_name_cn`," .
        "`page_view`, `user_view`) VALUES ('$row[0]', '$row[1]', '$row[2]', '$row[3]', $row[4], $row[5])";
    $db->query($sql);
} while ($row);

$sql = "SELECT * FROM `$db_name`.`$db_table`";
$stmt = $db->query($sql);
for ($i = 0; $i < 100; $i++) {
    $row = $stmt->fetch_row();
    print_r($db->error);
}
fclose($file);