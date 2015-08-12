import socket
import sys
from xml.dom import minidom
read_data = ""
import serial
import ConfigParser
import time
import subprocess



subprocess.Popen("/usr/share/adafruit/webide/repositories/my-pi-projects/smart_home_pi/cron.py", shell=True)

config = ConfigParser.ConfigParser()
config.read("/usr/share/adafruit/webide/repositories/my-pi-projects/smart_home_pi/config.ini")
config.sections()
node_port = int(config.get('config', 'node_port'))
node_id = config.get('config', 'node_id')
node_ip = config.get('config', 'node_ip')
serial_baud = int(config.get('config', 'serial_baud'))
serial_port = config.get('config', 'serial_port')
serial_timeout = int(config.get('config', 'serial_timeout'))
node_password = config.get('config', 'node_password')
#connect
#ser = serial.Serial('/dev/ttyACM0',  9600, timeout = 3)
#ttyAMA0
ser = serial.Serial('/dev/ttyAMA0', 9600, timeout = 3)
# Create a TCP/IP socket
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
# Bind the socket to the port
server_address = (node_ip, node_port)
print >>sys.stderr, 'starting up on %s port %s' % server_address
sock.bind(server_address)
#udo nano /etc/rc.local
#/usr/share/adafruit/webide/repositories/my-pi-projects/smart_home_pi
# Listen for incoming connections
sock.listen(1)

while True:
    # Wait for a connection
    print >>sys.stderr, 'waiting for a connection'
    connection, client_address = sock.accept()
    
    try:
        print >>sys.stderr, 'connection from', client_address
        
        # Receive the data in small chunks and retransmit it
        while True:
            data = connection.recv(1024)
            #print >>sys.stderr, 'received "%s"' % data
            #if data and "/n" not in data:
            if data:
                #print >>sys.stderr, 'sending data back to the client'
                #connection.sendall(data)
                #read_data = read_data + data
                try:
                    xmldoc = minidom.parseString(data)
                    itemlist = xmldoc.getElementsByTagName('pin')
                    #print len(itemlist)
                    #print itemlist[0].attributes['value'].value
                    for s in itemlist :
                        #first = int(s.attributes['output'].value)*1000
                        #last = int(s.attributes['value'].value)
                        #combined = forst + last
                        if s.attributes['token'].value == node_password:
                            print(s.attributes['output'].value  + " ->" + s.attributes['value'].value )
                            ser.write(s.attributes['output'].value  + "-" + s.attributes['value'].value + '\n')
                #time.sleep(0.1)
                except:
                    pass


    else:
        print >>sys.stderr, 'no more data from', client_address
            break

finally:
    # Clean up the connection
    print read_data
        try:
            xmldoc = minidom.parseString(read_data)
            itemlist = xmldoc.getElementsByTagName('pin')
            #print len(itemlist)
            #print itemlist[0].attributes['value'].value
            for s in itemlist :
                print(s.attributes['output'].value  + " ->" + s.attributes['value'].value )
    except:
        pass
        read_data = ""
        connection.close()