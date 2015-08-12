
#include <DMXSerial.h>
String readString;

const int max_ch = 512;

void setup() {
  // put your setup code here, to run once:
Serial1.begin(9600);
 DMXSerial.init(DMXController);
 
 
for(int i = 0; i < 255; i++){
  for(int j = 0; j < 255; j++){
 DMXSerial.write(i, j);
 delayMicroseconds(2000);
}


}



}


void loop() {
  while (Serial1.available()) {
    delay(3);  //delay to allow buffer to fill 
    if (Serial1.available() >0) {
      char c = Serial1.read();  //gets one byte from serial buffer
      readString += c; //makes the string readString
    } 
  }

  if (readString.length() >0) {
      //Serial.println(readString); //see what was received

//Serial.print("Set pin :  ");      
//Serial.print( getValue(readString, '-', 0).toInt());
//Serial.print(" -> ");
//Serial.print( getValue(readString, '-', 1).toInt());

//analogWrite(getValue(readString, '-', 0).toInt(),  getValue(readString, '-', 1).toInt());
   DMXSerial.write(getValue(readString, '-', 0).toInt()*, getValue(readString, '-', 1).toInt());

    readString="";
  } 
}

void write_pin(int pin, int value){

  
  
}


String getValue(String data, char separator, int index)
{
  int found = 0;
  int strIndex[] = {
    0, -1  };
  int maxIndex = data.length()-1;
  for(int i=0; i<=maxIndex && found<=index; i++){
    if(data.charAt(i)==separator || i==maxIndex){
      found++;
      strIndex[0] = strIndex[1]+1;
      strIndex[1] = (i == maxIndex) ? i+1 : i;
    }
  }
  return found>index ? data.substring(strIndex[0], strIndex[1]) : "";
}
