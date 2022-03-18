#!/usr/bin/env python
import sys
import RPi.GPIO as GPIO
import time
import json
import requests
import paho.mqtt.client as mqtt

sensorpinr = sys.argv[1]
actuatorpinr = sys.argv[2]

print(sensorpinr)
# sensorpin = json.loads(sensorpinr)
# actuatorpin = json.loads(actuatorpinr)
sensorpin = sensorpinr.split(',')
actuatorpin = actuatorpinr.split(',')

GPIO.setmode(GPIO.BCM)
delayt = 1
value = 0
PIR = int(sensorpin[0])
LDR = int(sensorpin[1])
LED = int(actuatorpin[0])

print(PIR)
print(LDR)
print(LED)
# id = sys.argv[1]

GPIO.setup(LDR, GPIO.OUT)
GPIO.setup(LDR, GPIO.IN)
GPIO.setup(PIR, GPIO.IN)
GPIO.setup(LED, GPIO.OUT)
time.sleep(delayt)

broker_address="192.168.137.2"
topic = "Lighting"
client = mqtt.Client("P2", transport='websockets')

print("Connecting to broker ", broker_address)
client.connect(broker_address)

try:

    while True:
        if(GPIO.input(PIR)):
            pironmessage = 'Motion is Detected'
            client.publish("Motion", pironmessage)

            if (GPIO.input(LDR) == GPIO.LOW):
                GPIO.output(LED, False)
                ledonmessage = "Light is OFF"
                client.publish("Lighting", ledonmessage)
            else:
                GPIO.output(LED, True)
                ledoffmessage = 'Light is ON'
                client.publish("Lighting", ledoffmessage)
        else:
            GPIO.output(LED, False)
            piroffmessage = 'No Motion is Detected, Light OFF.'
            client.publish("Motion", piroffmessage)
        time.sleep(2)

except KeyboardInterrupt:
    print "press occured"

except:
    print "other error occured"

finally:
    GPIO.cleanup()
