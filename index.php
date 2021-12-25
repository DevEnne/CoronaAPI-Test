<?php /*
굿바이코로나 Corona-19-API 파싱예제 PHP 샘플 코드입니다.
해당 코드를 사용하기 위해서는 Corona-19-API 서비스키(API키)를 발급받은 후 입력란에 key를 입력하거나 $key에 값을 대입해주세요.

https://api.corona-19.kr/
https://github.com/dhlife09/Corona-19-API
https://test2.corona-19.kr/ 에서 본 소스코드를 실행할 수 있습니다.

Copyright 2021 DevEnne & dhlife09. All rights reserved. */

$key = $_POST['apikey'];

if (!empty($key)) {
  $existKey = true;
  $existKey2 = true;
} else {
  $existKey = false;
  $existKey2 = false;
}

if ($existKey) {
  $data = @file_get_contents('https://api.corona-19.kr/korea/beta/?serviceKey='. $key);
  $json = json_decode($data, true);
}

if ($existKey2) {
  $data2 = @file_get_contents('https://api.corona-19.kr/korea/vaccine/?serviceKey='. $key);
  $json2 = json_decode($data2, true);
}
?>

<!DOCTYPE html>
<html lang="kr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, 
  maximum-scale=1.0, minimum-scale=1.0">
    <title>Corona-19-API</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <form method="POST" action="index.php">
            API KEY: <input type="text" name="apikey"/><br/>
            <input type="submit" name="submit"/>
    <form>
    <p> 사용자의 API 값 상태에 대한 결과값입니다. <p>
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
    </table>
    <p> 국내 코로나 발생 동향의 결과값 입니다. </p>
    <table class="type02">
      </tr>
      <tr>
        <th scope="row">업데이트 시간<br>(updateTime)</th>
        <td><?php if($existKey) { echo $json['API']['updateTime']; } ?></td>
      </tr>
      <tr>
        <th scope="row">국내 확진자 수<br>(totalCnt)</th>
        <td><?php if($existKey) { echo number_format($json['korea']['totalCnt']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row">전일대비 확진자 수<br>(incDec)</th>
        <td><?php if($existKey) { echo '+'. number_format($json['korea']['incDec']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row">국내 완치자 수<br>(recCnt)</th>
        <td><?php if($existKey) { echo number_format($json['korea']['recCnt']). "명"; } ?></td>
      <tr>
      </tr>
        <th scope="row">국내 사망자 수<br>(deathCnt)</th>
        <td><?php if($existKey) { echo number_format($json['korea']['deathCnt']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row">국내 치료중 환자 수<br>(isolCnt)</th>
        <td><?php if($existKey) { echo number_format($json['korea']['isolCnt']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row">국내 코로나 발생률<br>(qurRate)</th>
        <td><?php if($existKey) { echo $json['korea']['qurRate']. " %"; } ?></td>
      </tr>
    </table>
    <p> 다음은 각 시도별 발생동향 결과값입니다. (데이터 : 서울)</p>
    <table class="type02">
      </tr>
      <tr>
        <th scope="row">지역 이름</th>
        <td><?php if($existKey) { echo $json['seoul']['countryNm']; } ?></td>
      </tr>
      <tr>
        <th scope="row"><?php if($existKey) { echo $json['seoul']['countryNm']; } ?> 확진자 수</th>
        <td><?php if($existKey) { echo number_format($json['seoul']['totalCnt']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row">전일대비 확진자 수</th>
        <td><?php if($existKey) { echo '+'. number_format($json['seoul']['incDec']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row"><?php if($existKey) { echo $json['seoul']['countryNm']; } ?> 완치자 수</th>
        <td><?php if($existKey) { echo number_format($json['seoul']['recCnt']). "명"; } ?></td>
      <tr>
      </tr>
        <th scope="row"><?php if($existKey) { echo $json['seoul']['countryNm']; } ?> 사망자 수</th>
        <td><?php if($existKey) { echo number_format($json['seoul']['deathCnt']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row"><?php if($existKey) { echo $json['seoul']['countryNm']; } ?> 치료중 환자 수</th>
        <td><?php if($existKey) { echo number_format($json['seoul']['isolCnt']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row"><?php if($existKey) { echo $json['seoul']['countryNm']; } ?> 코로나 발생률</th>
        <td><?php if($existKey) { echo $json['seoul']['qurRate']. " %"; } ?></td>
      </tr>
    </table>
    <p> 다음은 예방접종 현황 결과값입니다.</p>
    <table class="type02">
      </tr>
      <tr>
        <th scope="row">API NAME</th>
        <td><?php if($existKey2) { echo $json2['API']['apiName']; } ?></td>
      </tr>
      <tr>
        <th scope="row">업데이트 시간</th>
        <td><?php if($existKey2) { echo $json2['API']['dataTime']; } ?></td>
      </tr>
      <tr>
        <th scope="row">1차 접종 완료 전체 수<br>(vaccine_1)</th>
        <td><?php if($existKey2) { echo number_format($json2['korea']['vaccine_1']['vaccine_1']). "명"; } ?></td>
      <tr>
      </tr>
        <th scope="row">1차 접종 전일대비<br>(vaccine_1_new)</th>
        <td><?php if($existKey2) { echo number_format($json2['korea']['vaccine_1']['vaccine_1_new']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row">2차 접종 완료 전체 수<br>(vaccine_2)</th>
        <td><?php if($existKey2) { echo number_format($json2['korea']['vaccine_2']['vaccine_2']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row">2차 접종 전일대비<br>(vaccine_2_new)</th>
        <td><?php if($existKey2){ echo number_format($json2['korea']['vaccine_2']['vaccine_2_new']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row">3차 접종 완료 전체 수<br>(vaccine_3)</th>
        <td><?php if($existKey2){ echo number_format($json2['korea']['vaccine_3']['vaccine_3']). "명"; } ?></td>
      </tr>
      <tr>
        <th scope="row">3차 접종 전일대비<br>(vaccine_3_new)</th>
        <td><?php if($existKey2){ echo number_format($json2['korea']['vaccine_3']['vaccine_3_new']). "명"; } ?></td>
      </tr>
    </table>
    <p> API 키가 없으신 경우, <a href = "https://api.corona-19.kr" > Corona-19-API </a> 에서 API 키를 발급해주세요. </p>
  </body>
</html>
