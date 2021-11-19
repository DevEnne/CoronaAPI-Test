<?php
$key = $_POST['apikey'];

if (!empty($key)) {
  $existKey = true;
} else {
  $existKey = false;
}

if ($existKey) {
  $data = @file_get_contents('https://raw.githubusercontent.com/dhlife09/Corona-19-API/master/3_beta.json?serviceKey='. $key);
  $json = json_decode($data, true);
}
?>

<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>Corona-19</title>
</head>
<link rel="stylesheet" href="style.css">
<form method="POST" action="index.php">
        API KEY: <input type="text" name="apikey"/><br/>
        <input type="submit" name="submit"/>
<form>
<table class="type02">
  <tr>
    <th scope="row">API Key</th>
    <td><?php if($existKey) { echo $key; } ?>
</td>
  </tr>
  <tr>
    <th scope="row">상태</th>
    <td>
    <?php if($existKey) { echo $json['API']['resultMessage']; } else { echo 'API 키를 입력해주세요.'; } ?>
</td>
  </tr>
  <tr>
    <th scope="row">업데이트 시간</th>
    <td><?php if($existKey) { echo $json['API']['updateTime']; } ?></td>
  </tr>
  <tr>
    <th scope="row">국내 확진자 수</th>
    <td><?php if($existKey) { echo number_format($json['korea']['totalCnt']). "명"; } ?></td>
  </tr>
  <tr>
    <th scope="row">국내 전일대비 확진자 수</th>
    <td><?php if($existKey) { echo '+'. number_format($json['korea']['incDec']). "명"; } ?></td>
  </tr>
  <tr>
    <th scope="row">국내 완치자 수</th>
    <td><?php if($existKey) { echo number_format($json['korea']['recCnt']). "명"; } ?></td>
  </tr>
  <tr>
    <th scope="row">국내 사망자 수</th>
    <td><?php if($existKey) { echo number_format($json['korea']['deathCnt']). "명"; } ?></td>
  </tr>
  <tr>
    <th scope="row">국내 치료중 환자 수</th>
    <td><?php if($existKey) { echo number_format($json['korea']['isolCnt']). "명"; } ?></td>
  </tr>
  <tr>
    <th scope="row">국내 코로나 발생률</th>
    <td><?php if($existKey) { echo $json['korea']['qurRate']. "%"; } ?></td>
  </tr>
</table>
