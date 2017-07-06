<?php
/**
 * User: xukaiwen@baixing.com
 */
require('connectDatabase.php');

$sql = "SELECT * FROM `$db_name`.`$db_table` WHERE `city_name_cn`='上海' ORDER BY `transaction_date`;";
$stmt = $db->query($sql);
$date = array();
$datePv = array();
$datePvWap = array();
$datePvWeb = array();
$datePvApp = array();
$dateUv = array();
$dateUvWap = array();
$dateUvWeb = array();
$dateUvApp = array();
$datePvPerUv = array();
while ($row = $stmt->fetch_row()) {
    if ($row[2]==='wap') {
        array_push($date, "\"" . $row[1] . "\"");
        array_push($datePvWap, $row[5]);
        array_push($dateUvWap, $row[6]);
    } elseif ($row[2]==='web') {
        array_push($datePvWeb, $row[5]);
        array_push($dateUvWeb, $row[6]);
    } elseif ($row[2]==='app') {
        array_push($datePvApp, $row[5]);
        array_push($dateUvApp, $row[6]);
    }
}

for ($i=0; $i<count($date); $i++) {
    $datePv[$i] = $datePvApp[$i]+$datePvWap[$i]+$datePvWeb[$i];
    $dateUv[$i] = $dateUvApp[$i]+$dateUvWap[$i]+$dateUvWeb[$i];
    $datePvPerUv[$i] = $datePv[$i]/$dateUv[$i];
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>数据练习</title>
</head>
<body>
<div id="shanghaiPv" style="width: 1600px;height:400px;"></div>
<div id="shanghaiUv" style="width: 1600px;height:400px;"></div>
<div id="shanghaiPvPerUv" style="width: 1600px;height:400px;"></div>
<div id="shanghaiPvDistribution" style="width: 1600px;height:400px;"></div>
<div id="shanghaiUvDistribution" style="width: 1600px;height:400px;"></div>
<script src="echarts.common.min.js"></script>
<script type="text/javascript">
    var shanghaiPvChart = echarts.init(document.getElementById('shanghaiPv'));
    var shanghaiUvChart = echarts.init(document.getElementById('shanghaiUv'));
    var shanghaiPvPerUvChart = echarts.init(document.getElementById('shanghaiPvPerUv'));
    var shanghaiPvDistributionChart = echarts.init(document.getElementById('shanghaiPvDistribution'));
    var shanghaiUvDistributionChart = echarts.init(document.getElementById('shanghaiUvDistribution'));

    var shanghaiPvOption = {
        title: {
            text: '上海pv图'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['pv']
        },
        xAxis: {
            data: <?php echo '[' . implode(',', $date) . ']'; ?>
        },
        yAxis: {},
        series: [{
            name: 'pv',
            type: 'line',
            data: <?php echo '[' . implode(',', $datePv) . ']'; ?>
        }]
    };
    var shanghaiUvOption = {
        title: {
            text: '上海uv图'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['uv']
        },
        xAxis: {
            data: <?php echo '[' . implode(',', $date) . ']'; ?>
        },
        yAxis: {},
        series: [{
            name: 'uv',
            type: 'line',
            data: <?php echo '[' . implode(',', $dateUv) . ']'; ?>
        }]
    };
    var shanghaiPvPerUvOption = {
        title: {
            text: '上海pv/uv图'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['pv/uv']
        },
        xAxis: {
            data: <?php echo '[' . implode(',', $date) . ']'; ?>
        },
        yAxis: {},
        series: [{
            name: 'pv/uv',
            type: 'line',
            data: <?php echo '[' . implode(',', $datePvPerUv) . ']'; ?>
        }]
    };
    var shanghaiPvDistributionOption = {
        title: {
            text: '上海pv平台分布图'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['pv分布']
        },
        xAxis: {
            data: <?php echo '[' . implode(',', $date) . ']'; ?>
        },
        yAxis: {},
        series: [
            {
            name: 'wap',
            type: 'line',
            data: <?php echo '[' . implode(',', $datePvWap) . ']'; ?>
            },
            {
                name: 'web',
                type: 'line',
                data: <?php echo '[' . implode(',', $datePvWeb) . ']'; ?>
            },
            {
                name: 'app',
                type: 'line',
                data: <?php echo '[' . implode(',', $datePvApp) . ']'; ?>
            },
        ]
    };
    var shanghaiUvDistributionOption = {
        title: {
            text: '上海uv平台分布图'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            data: ['uv分布']
        },
        xAxis: {
            data: <?php echo '[' . implode(',', $date) . ']'; ?>
        },
        yAxis: {},
        series: [
            {
                name: 'wap',
                type: 'line',
                data: <?php echo '[' . implode(',', $dateUvWap) . ']'; ?>
            },
            {
                name: 'web',
                type: 'line',
                data: <?php echo '[' . implode(',', $dateUvWeb) . ']'; ?>
            },
            {
                name: 'app',
                type: 'line',
                data: <?php echo '[' . implode(',', $dateUvApp) . ']'; ?>
            },
        ]
    };

    shanghaiPvChart.setOption(shanghaiPvOption);
    shanghaiUvChart.setOption(shanghaiUvOption);
    shanghaiPvDistributionChart.setOption(shanghaiPvDistributionOption);
    shanghaiUvDistributionChart.setOption(shanghaiUvDistributionOption);
    shanghaiPvPerUvChart.setOption(shanghaiPvPerUvOption);
</script>
</body>
</html>