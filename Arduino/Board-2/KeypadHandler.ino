#include <Wire.h>
#include <Keypad_I2C.h>
//#include <Keypad.h>        // GDY120705
// Keyppad


const byte ROWS = 4; //four rows
const byte COLS = 4; //four columns
char key;
//define the cymbols on the buttons of the keypads
char hexaKeys[ROWS][COLS] = {
  {'1', '2', '3', 'A'},
  {'4', '5', '6', 'B'},
  {'7', '8', '9', 'C'},
  {'*', '0', '#', 'D'}
};
byte rowPins[ROWS] = {0, 1, 2 , 3}; //connect to the row pinouts of the keypad
byte colPins[COLS] = {4, 5, 6, 7}; //connect to the column pinouts of the keypad

Keypad_I2C customKeypad( makeKeymap(hexaKeys), rowPins, colPins, ROWS, COLS, KEYPADADDR);


void Keypad_Init() {
  Wire.begin( );                // GDY200622
  customKeypad.begin( );        // GDY120705
  Serial.begin(9600);
}

void Keypad_Input() {
  key = customKeypad.getKey();

  if (key != NO_KEY && (key == '1' || key == '2' || key == '3' || key == '4' || key == '5' || key == '6' || key == '7' || key == '8' || key == '9' || key == '0')) // check which key is pressed by checking its integer value
  {
    if (present != true)
    {
      num1 = num1 + key; // storing the value of key pressed in num1
      float numLength = num1.length();

      lcd.setCursor(1, 1); /* decaling the place where the first entry will be displayed*/
      lcd.print(num1); // printing the first number entered
    }
  }
}

void Keypad_Handler() {

  Serial.println("Keypad");
  lcd.setCursor(0, 0);
  lcd.print("Masukan Kode OTP        ");
  lcd.setCursor(0, 1);
  lcd.print(">");

  if (key != NO_KEY && (key == 'C') ) {
    num1 = "";
    lcd.setCursor(1, 1); /* decaling the place where the first entry will be displayed*/
    lcd.print("MENGHAPUS          "); // printing the first number entered
    delay(500);
    lcd.clear();
    lcd.setCursor(0, 1); /* decaling the place where the first entry will be displayed*/
    lcd.print(">"); // printing the first number entered
  }
  else if (key != NO_KEY && (key == 'D') ) {
    boolean cek1 = false;
    boolean cek2 = false;
    for (int i = 0; i < 30; i++ ) {
      if (otp_masuk[i] == num1) {
        cek1 = true;

      }
      else if (otp_keluar[i] == num1) {
        cek2  = true;
      }
    }

    if (num1.length() > 3 && cek1 == true) {
      if (Kirim_OTP(num1) == 1) {

        lcd.clear();
        lcd.setCursor(0, 0); /* decaling the place where the first entry will be displayed*/
        lcd.print(" Silahkan Masuk "); // printing the first number entered
        lcd.setCursor(0, 1); /* decaling the place where the first entry will be displayed*/
        lcd.print(" User Tamu "); // printing the first number entered
        delay(1000);

        Kirim_ServoControl(1);

      }
      else {
        salah += 1;
        lcd.clear();
        lcd.setCursor(0, 0); /* decaling the place where the first entry will be displayed*/
        lcd.print("  Salah OTP             "); // printing the first number entered
        lcd.setCursor(0, 1); /* decaling the place where the first entry will be displayed*/
        lcd.print("                   "); // printing the first number entered
        Kirim_ServoControl(0);
      }
      num1 = "";
    }

    else if (num1.length() > 3 && cek2 == true) {
      if (Kirim_OTP(num1) == 1) {
        lcd.clear();
        lcd.setCursor(0, 0); /* decaling the place where the first entry will be displayed*/
        lcd.print(" Silahkan Keluar "); // printing the first number entered
        lcd.setCursor(0, 1); /* decaling the place where the first entry will be displayed*/
        lcd.print(" User Tamu "); // printing the first number entered
        delay(1000);
        Kirim_ServoControl(1);
      }
      else {
        lcd.clear();
        lcd.setCursor(0, 0); /* decaling the place where the first entry will be displayed*/
        lcd.print("  Salah OTP             "); // printing the first number entered
        lcd.setCursor(0, 1); /* decaling the place where the first entry will be displayed*/
        lcd.print("                   "); // printing the first number entered
        salah += 1;
        delay(1000);
        Kirim_ServoControl(0);
      }



      num1 = "";
    }

    else if (num1.length() > 3 && cek1 == false && cek2 == false) {
      lcd.clear();
      salah += 1;
      lcd.setCursor(0, 0); /* decaling the place where the first entry will be displayed*/
      lcd.print(" Salah OTP               "); // printing the first number entered
      lcd.setCursor(0, 1); /* decaling the place where the first entry will be displayed*/
      lcd.print("                         "); // printing the first number entered

      delay(500);
      lcd.clear();
      Kirim_ServoControl(0);

      num1 = "";
    }
    
    if (salah > 2) {
      lcd.clear();
      lcd.setCursor(0, 0); /* decaling the place where the first entry will be displayed*/
      lcd.print(" SISTEM KEAMANAN"); // printing the first number entered
      lcd.setCursor(0, 1); /* decaling the place where the first entry will be displayed*/
      lcd.print("ADA PEMBOBOLAN"); // printing the first number entered
      Kirim_ServoControl(0);

      digitalWrite(13, HIGH);
      delay(1000);
      digitalWrite(13, LOW);
      delay(1000);

      digitalWrite(13, HIGH);
      delay(1500);
      digitalWrite(13, LOW);
      delay(500);

      digitalWrite(13, HIGH);
      delay(3000);
      digitalWrite(13, LOW);
      //      delay(1500);
      salah = 0;
      lcd.clear();

    }
  }

}
