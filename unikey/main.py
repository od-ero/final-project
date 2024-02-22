
print('Microcontrollerslab.com')
openIn = Pin(5, Pin.IN, Pin.PULL_UP)#D1
closeIn = Pin(4, Pin.IN, Pin.PULL_UP)#D2
openOut = Pin(14, Pin.IN, Pin.PULL_UP) #D5
closeOut = Pin(12,Pin.IN, Pin.PULL_UP) #D6
redLed = Pin(0, Pin.OUT)#D3
greenLed = Pin(15, Pin.OUT)#D8
blueLed = Pin(16, Pin.OUT)#D0
relayPin = Pin(13, Pin.OUT)#D7
relayPin.value(1)
redLed.value(1)
greenLed.value(1)
blueLed.value(1)
def lockDoor():
    relayPin.value(1)
    redLed.value(0)
    greenLed.value(1)
    blueLed.value(1)
    sleep(10)
    relayPin.value(1)
    redLed.value(1)
    greenLed.value(1)
    blueLed.value(1)
    sleep(0.1)
def unlockDoor():
    relayPin.value(0)
    redLed.value(1)
    greenLed.value(0)
    blueLed.value(1)
    sleep(10)
    relayPin.value(0)
    redLed.value(1)
    greenLed.value(1)
    blueLed.value(1)
    sleep(0.1)
def noPermission():
    for n in range(1, 10):
        redLed.value(0) #on
        blueLed.value(1) #off
        greenLed.value(1) #off
        sleep(0.15)
        redLed.value(1) #off
        blueLed.value(0) #on
        greenLed.value(1) #off
        sleep(0.15)
        redLed.value(1) #off
        blueLed.value(1) #0ff
        greenLed.value(0) #on
        sleep(0.15)
    redLed.value(1) #off
    blueLed.value(1) #0ff
    greenLed.value(1) #off
    sleep(0.1)
def serverError():
    redLed.value(1) #off
    blueLed.value(0) #0n
    greenLed.value(1) #off
    sleep(10)
    redLed.value(1) #off
    blueLed.value(1) #0n
    greenLed.value(1) #off
    sleep(0.1)

def serverRequests():
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    s.bind(('',80))
    s.listen(5)
    while True:
        print('loop')
        try:
            if gc.mem_free() < 102000:
                gc.collect()
            conn, addr = s.accept()
            conn.settimeout(None)
            print('Received HTTP GET connection request from %s' % str(addr))
            request_orginal = conn.recv(1024)
            conn.settimeout(None)
            request = str(request_orginal)
            print('GET Request Content = %s' % request)
            unlock = request.find('/?led_2_on')
            lock = request.find('/?led_2_off')
            #Check for LED timeout
        
            conn.send('HTTP/1.1 200 OK\n')
            conn.send('Access-Control-Allow-Origin: *\n')
            conn.send('Connection: close\n\n')
            conn.close()
            
            if unlock == 6:
                unlockDoor()
                print('Unlocked')
            if lock == 6:
                lockDoor()
                print('Locked')
        except OSError as e:
            response = e
            conn.close()
            print('Connection closed')
def buttonRequests(pin):
    base_url = 'http://192.168.137.1'
    if not openIn.value():
         res = requests.get(base_url+'/schedule/permissions/check/9/openIn')
         print(res.status_code)
         if res.status_code == 200:
            status = res.json()
            print(status)
            if(status==0):
                 unlockDoor()
                 sleep(0.1)
            elif(status==2):
                noPermission()
            else:
                serverError()
         else:
            serverError()
    if not closeIn.value():
        res = requests.get(base_url+'/schedule/permissions/check/9/closeIn')
        if res.status_code == 200:
            status = res.json()
            print(status)
            if(status==1):
                lockDoor()
                sleep(0.1)
            elif(status==2):
                noPermission()
                sleep(0.1)
            else:
                serverError()
        else:
            serverError()
    if not openOut.value():     # if pressed the push_button
         res = requests.get(base_url+'/schedule/permissions/check/9/openOut')
         print(res.status_code)
         if res.status_code == 200:
            status = res.json()
            print(status)
            if(status==0):
                 unlockDoor()
                 sleep(0.1)
            elif(status==2):
                noPermission()
            else:
                serverError()
         else:
            serverError()
    if not closeOut.value():
        res = requests.get(base_url+'/schedule/permissions/check/9/closeOut')
        print(res.status_code)
        if res.status_code == 200:
            print(res.json())
            status = res.json()
            print(status)
            if(status==1):
                lockDoor()
                sleep(0.1)
            elif(status==2):
                noPermission()
                sleep(0.1)
            else:
                serverError()
        else:
            serverError()
def main():
    base_url = 'http://192.168.137.1'
    state_request = requests.get(base_url+'/door/state/check/9')
    print(state_request.json())
    if state_request.status_code == 200:
        door_state = state_request.json()
        if door_state == 1:
            lockDoor()
        else:
            unlockDoor()
    else:
        serverError()
    openOut.irq(trigger=Pin.IRQ_FALLING, handler=buttonRequests)
    closeOut.irq(trigger=Pin.IRQ_FALLING, handler=buttonRequests)
    openIn.irq(trigger=Pin.IRQ_FALLING, handler=buttonRequests)
    closeIn.irq(trigger=Pin.IRQ_FALLING, handler=buttonRequests)
    serverRequests()
            
if __name__ == "__main__":
    main()
