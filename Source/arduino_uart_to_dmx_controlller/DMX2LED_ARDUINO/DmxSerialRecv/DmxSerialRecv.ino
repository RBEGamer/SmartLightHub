// - - - - -
// DmxSerial - A hardware supported interface to DMX.
// DmxSerialRecv.ino: Sample DMX application for retrieving 3 DMX values:
// address 1 (red) -> PWM Port 9
// address 2 (green) -> PWM Port 6
// address 3 (blue) -> PWM Port 5
// 
// Copyright (c) 2011 by Matthias Hertel, http://www.mathertel.de
// This work is licensed under a BSD style license. See http://www.mathertel.de/License.aspx
// 
// Documentation and samples are available at http://www.mathertel.de/Arduino
// 25.07.2011 creation of the DmxSerial library.
// 10.09.2011 fully control the serial hardware register
//            without using the Arduino Serial (HardwareSerial) class to avoid ISR implementation conflicts.
// 01.12.2011 include file and extension changed to work with the Arduino 1.0 environment
// 28.12.2011 changed to channels 1..3 (RGB) for compatibility with the DmxSerialSend sample.
// 10.05.2012 added some lines to loop to show how to fall back to a default color when no data was received since some time.
// - - - - -

#include <DMXSerial.h>

// Constants for demo program

const int RedPin1 =    9;  // PWM output pin for Red Light.
const int GreenPin1 =  6;  // PWM output pin for Green Light.
const int BluePin1 =   5;  // PWM output pin for Blue Light.

const int BluePin2 = 3;
const int GreenPin2 = 10;
const int RedPin2 = 11;


int vc1;
int vc2;
int vmax1 = 50;
int vmax2 = 50;
int rc1, gc1, bc1;
int rc2, gc2, bc2;

int rs1, gs1, bs1;
int rs2, gs2, bs2;


#define RedDefaultLevel   0
#define GreenDefaultLevel 0
#define BlueDefaultLevel  0

void setup () {
  DMXSerial.init(DMXReceiver);
vc1 = 0;
vc2 = 0;

    rs1 = 0; gs1 = 0; bs1 = 0;
    rs2 = 0; gs2 = 0; bs2 = 0;
    rc1 = 0; gc1 = 0; bc1 = 0;
    rc2 = 0; gc2 = 0; bc2 = 0;
  // set some default values
  DMXSerial.write(1, 0);
  DMXSerial.write(2, 0);
  DMXSerial.write(3, 0);
  DMXSerial.write(4, 0);
  DMXSerial.write(5, 0);
  DMXSerial.write(6, 0);
  
  // enable pwm outputs
  pinMode(RedPin1,   OUTPUT); // sets the digital pin as output
  pinMode(GreenPin1, OUTPUT);
  pinMode(BluePin1,  OUTPUT);
  pinMode(RedPin2,   OUTPUT); // sets the digital pin as output
  pinMode(GreenPin2, OUTPUT);
  pinMode(BluePin2,  OUTPUT);
}


void loop() {
  // Calculate how long no data backet was received
  unsigned long lastPacket = DMXSerial.noDataSince();
  
  if (lastPacket < 10000) {
    // read recent DMX values and set pwm levels 
      rs1 = DMXSerial.read(1);
      gs1 = DMXSerial.read(2);
      bs1 = DMXSerial.read(3);
      vmax1 = DMXSerial.read(4);
      rs2 = DMXSerial.read(5);
      gs2 = DMXSerial.read(6);
      bs2 = DMXSerial.read(7);
      vmax2 = DMXSerial.read(8);




  } else {
    // Show pure red color, when no data was received since 5 seconds or more.

  } // if
  
  
  if(vc1 >= vmax1){
  if(rc1 > rs1){rc1--;}else if(rc1 < rs1){rc1++;}else{rc1 = rs1;}
  if(gc1 > gs1){gc1--;}else if(gc1 < gs1){gc1++;}else{gc1 = gs1;}
  if(bc1 > bs1){bc1--;}else if(bc1 < bs1){bc1++;}else{bc1 = bs1;}
  vc1 = 0;
  }else{
  vc1++;
  }
  
  
   if(vc2 >= vmax2){
  if(rc2 > rs2){rc2--;}else if(rc2 < rs2){rc2++;}else{rc2 = rs2;}
  if(gc2 > gs2){gc2--;}else if(gc2 < gs2){gc2++;}else{gc2 = gs2;}
  if(bc2 > bs2){bc2--;}else if(bc2 < bs2){bc2++;}else{bc2 = bs2;}
    vc2 = 0;
  }else{
  vc2++;
  }
  
    analogWrite(RedPin1,   rc1);
    analogWrite(GreenPin1, gc1);
    analogWrite(BluePin1,  bc1);
    analogWrite(RedPin2,   rc2);
    analogWrite(GreenPin2, gc2);
    analogWrite(BluePin2,  bc2);
    
    
    
}

// End.
