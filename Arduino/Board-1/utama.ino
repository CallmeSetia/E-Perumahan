// WIFI
#include <WiFi.h>
#include <HTTPClient.h>
#include <time.h>

#include <LiquidCrystal_I2C.h>
LiquidCrystal_I2C lcd(0x27, 16, 2);

#define SSID_WIFI "KASTARA GROUP INDONESIA"
#define PASS_WIFI "KASTARA@2022"

#define DOMAIN "http://192.168.200.204/skripsi"
#define FOLDER "/skripsi"

#define BOARD "1"
#define KEYPADADDR 0x21


int salah = 0;

int Posisi;
int sens = -1;

// Proximity
int pinProx = 32;
int sensorProximity;

// Variable - Keypad
String num1, num2;
boolean present = false;
boolean next = false;
boolean final = false;
int gerbang = 0;
int statusWifi = 1;
TaskHandle_t BacaProx;

String otp_masuk[30] = {
  "957667", "431542", "515052", "348948", "232799", "818261", "738824", "145792", "784946", "965654", "689457", "182411", "850864", "254015", "425744", "830540", "554402", "163118", "416981", "677094", "377931", "281766", "446804", "432169", "201567", "445723", "345007", "174636", "655978"
};
String otp_keluar[30] = {
  "080878", "636221", "678177", "756900", "694686", "749899", "709893", "340690", "057376", "533314", "106986", "138759", "439920", "776913", "999443", "364546", "373625", "477868", "858016", "367403", "543005"
};

int isWarga = 0;
int ModeBoard = 0; // Standby


int id;
int id_enroll;
int id_scan;
int CommandServo;
void setup()
{
  Keypad_Init();
  Timer_Init();
      Servo_Init();
  LCD_Init();

  pinMode(13, OUTPUT);
  pinMode(32, INPUT);

  Fingger_Init();
  Wifi_Init();
  delay(100);
  lcd.clear();
}

void loop()
{
  koneksiWifiChecker();
  KomunikasiKeServer();
      Servo_Handler();
  Keypad_Input();

  // if register warga
  if (ModeBoard == 12) {
    FinggerRegister_Handler(); // Daftar Warga
  }
  else { // If StandBy
    getFingerprintID();

    // If udah daftar dan warga keluar/masuk
    if (isWarga == 1 && ModeBoard == 0) {
      FingerAttendance_Handler();
    }
    else {
      Keypad_Handler();
    }
  }
}
