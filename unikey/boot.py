try:
  import usocket as socket
except:
  import socket

from machine import Pin
import network
import machine

import esp
esp.osdebug(None)

import gc
gc.collect()

from time import sleep
import urequests as requests
import uasyncio as asyncio

ssid = 'Great'
password = 'Greatest'

station = network.WLAN(network.STA_IF)

station.active(True)
station.connect(ssid, password)
#while station.isconnected() == False:
 # pass
print('Boot successful')


