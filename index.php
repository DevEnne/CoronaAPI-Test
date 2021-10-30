<?php
$key = $_POST['apikey'];
if ( ! empty( $key ) ) :
    $data_str = file_get_contents('https://api.corona-19.kr/korea/?serviceKey='. $key);
    $json = json_decode($data_str, true);
endif;
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
</form>
<table class="type02">
  <tr>
    <th scope="row">API Key</th>
    <td><?php echo $key ?></td>
  </tr>
  <tr>
    <th scope="row">상태</th>
    <td><?php
if ( ! empty( $key ) ) {
  echo $json['resultMessage'];
} else {
  $resultMessage = "API키를 입력해주세요.";
  echo $resultMessage;
}
?></td>
  </tr>
  <tr>
    <th scope="row">업데이트 시간</th>
    <td><?php echo $json['updateTime']; ?></td>
  </tr>
</table>


