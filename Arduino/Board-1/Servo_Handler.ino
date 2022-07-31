// Servo ESP
#include <Servo_ESP32.h>
Servo_ESP32 servo1;

void Servo_Init() {
  servo1.attach(33);
  servo1.write(90);
}
void servoBuka() {
  servo1.write(0);
}

void servoTutup() {
  servo1.write(90);
}

void Servo_Handler() {

  if (CommandServo == 1) {
    while (1) {
      gerbang = 1;
      servoBuka(); sensorProximity = digitalRead(32);

      if (sensorProximity == 0) {
        sens = sensorProximity;
        while (1) {
          sensorProximity = digitalRead(32);
          if (sens != sensorProximity) {
            servoTutup();
            sens  = 99;
            break;
          }
          delay(50);
        }
        if (sens == 99) break;
      }
      delay(5);
    }
    Kirim_ServoControl(0);
    lcd.clear();
  }
}
