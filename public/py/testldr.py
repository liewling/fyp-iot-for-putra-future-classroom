#!/usr/bin/env python
import RPi.GPIO as GPIO
import time

GPIO.setmode(GPIO.BCM)
delayt = 10
value = 0 
ldr = 27
led = 17 
GPIO.setup(led, GPIO.OUT) 
GPIO.output(led, False)
GPIO.setup(ldr, GPIO.OUT) 
GPIO.output(ldr, False) 
time.sleep(delayt)
GPIO.setup(ldr, GPIO.IN)

def rc_time (ldr):
    count = 0

    GPIO.setup(ldr, GPIO.OUT) 
    GPIO.output(ldr, False) 
    time.sleep(delayt)

    GPIO.setup(ldr, GPIO.IN)
    while (GPIO.input(ldr) == GPIO.LOW):
        count += 1
 
    return count

try:
   
    while True:
        if (GPIO.input(ldr) == GPIO.LOW):
                GPIO.output(led, False)
        else:
                GPIO.output(led, True)
        
except KeyboardInterrupt:
	print "press occured"

except:
	print "other error occured"
	
finally:
    GPIO.cleanup()
