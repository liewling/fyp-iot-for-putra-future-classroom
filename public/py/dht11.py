#!/usr/bin/env python
import sys
import Adafruit_DHT
import requests
import json
import time

time.sleep(5)

pin = sys.argv[1]

while True:
    humidity, temperature = Adafruit_DHT.read_retry(11, pin)
    data = {"field": "Temperature(C)", "value": temperature}
    Hdata = {"field": "Humidity(%)", "value": humidity}
    response = requests.post('https://pure-headland-78653.herokuapp.com/api/resources/sensorData/20',
                             json=data)
    response = requests.post('https://pure-headland-78653.herokuapp.com/api/resources/sensorData/20',
                             json=Hdata)
    print(response.status_code)
    print 'Temp: {0:0.1f} C  Humidity: {1:0.1f} %'.format(temperature, humidity)
