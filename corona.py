import re
import requests
import json

from requests import status_codes

korea = "https://api.corona-19.kr/korea/beta/?serviceKey=" # 국내 코로나 발생 동향
vaccine = "https://api.corona-19.kr/korea/vaccine/?serviceKey=" # 예방접종 현황
apikey = "여기에 API키를 입력해주세요." # API 키를 다음 란에 입력해 주세요.

response = requests.get(korea + apikey)
message = response.text
data = json.loads(message)

response2 = requests.get(vaccine + apikey)
message2 = response2.text
data2 = json.loads(message2)

status = response.status_code
status2 = response2.status_code

if status == 200: # 국내 코로나 발생 동향이 정상적으로 불러와졌을경우
    if status2 == 200:
        print("Corona-19-API Python 국내 코로나 발생 동향 예제 코드")
        print("\n")
        print('[',(data["API"]["updateTime"]),']')
        print("\n")
        print('국내 확진자 수:', format(data["korea"]["totalCnt"], ','))
        print('전일대비 확진자 수:', format(data["korea"]["incDec"], ','))
        print('국내 완치자 수:', format(data["korea"]["recCnt"], ','))
        print('국내 사망자 수:', format(data["korea"]["deathCnt"], ','))
        print('국내 치료중 수:', format(data["korea"]["isolCnt"], ','))
        print('국내 코로나 발생률:', format(data["korea"]["qurRate"], ','))
        print("\n")
        print("Corona-19-API Python 국내 예방접종 현황 예제 코드")
        print("\n")
        print('[', (data2["API"]["apiName"]), (data2["API"]["dataTime"]), ']')
        print("\n")
        print('1차 접종 완료 수:', format(data2["korea"]["vaccine_1"]["vaccine_1"], ','))
        print('1차 접종 전일대비: +', format(data2["korea"]["vaccine_1"]["vaccine_1_new"], ','))
        print("\n")
        print('2차 접종 완료 수:', format(data2["korea"]["vaccine_2"]["vaccine_2"], ','))
        print('2차 접종 전일대비: +', format(data2["korea"]["vaccine_2"]["vaccine_2_new"], ','))
else:
    print("정상적으로 처리되지 않았습니다. API 키를 게 입력했는지 확인해주세요.")