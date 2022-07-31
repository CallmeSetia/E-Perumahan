#include <Adafruit_Fingerprint.h>
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&Serial2);


void Fingger_Init() {
  // set the data rate for the sensor serial port
  finger.begin(57600);
  delay(5);
  if (finger.verifyPassword()) {
    Serial.println("Found fingerprint sensor!");
  } else {
    Serial.println("Did not find fingerprint sensor :(");
    while (1) {
      delay(1);
    }
  }

}

void BacaFingerprint( void * pvParameters ) {
  Serial.print("Task2 running on core ");
  Serial.println(xPortGetCoreID());
  int sensProx_old;
  for (;;) {
    vTaskDelay(100 / portTICK_PERIOD_MS);
  }
}

uint8_t getFingerprintID() {
  uint8_t p = finger.getImage();
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image taken");

      lcd.setCursor(0, 0);
      lcd.print(" Cek Data             ");
      lcd.setCursor(0, 1);
      lcd.print("   <SCAN>               ");

      break;
    case FINGERPRINT_NOFINGER:
      Serial.println("GET FINGGER PRINT WARGA dan Penjaga : No finger detected");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }
  delay(2000);
  // OK success!

  p = finger.image2Tz();
  switch (p) {
    case FINGERPRINT_OK:

      Serial.println("Image converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }

  // OK converted!
  p = finger.fingerSearch();
  if (p == FINGERPRINT_OK) {
    Serial.println("Found a print match!");

    lcd.setCursor(0, 0);
    lcd.print("  Data Fingger              ");
    lcd.setCursor(0, 1);
    lcd.print("   <Ketemu>              ");
    isWarga = 1;

    //    isWarga = 1;
    delay(2000);
    lcd.clear();

  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_NOTFOUND) {

    Serial.println("Did not find a match");

    lcd.setCursor(0, 0);
    lcd.print(" Data Fingger              ");
    lcd.setCursor(0, 1);
    lcd.print("   <Tidak Ada>              ");
    delay(2000);
    lcd.clear();

    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }

  // found a match!
  Serial.print("Found ID #"); Serial.print(finger.fingerID);
  Serial.print(" with confidence of "); Serial.println(finger.confidence);
  id_scan = finger.fingerID;
  return finger.fingerID;
}

// returns -1 if failed, otherwise returns ID #
int getFingerprintIDez() {

  lcd.setCursor(0, 0);
  lcd.print(" Cek Data             ");
  lcd.setCursor(0, 1);
  lcd.print("   <SCAN>               ");
  uint8_t p = finger.getImage();
  if (p != FINGERPRINT_OK)  return -1;

  p = finger.image2Tz();
  if (p != FINGERPRINT_OK)  return -1;

  p = finger.fingerFastSearch();
  if (p != FINGERPRINT_OK)  return -1;

  // found a match!
  Serial.print("Found ID #"); Serial.print(finger.fingerID);
  Serial.print(" with confidence of "); Serial.println(finger.confidence);
  return finger.fingerID;

}

uint8_t getFingerprintEnroll() {

  int p = -1;
  Serial.print("Waiting for valid finger to enroll as #"); Serial.println(id_enroll);
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
      case FINGERPRINT_OK:
        Serial.println("Image taken");
        break;
      case FINGERPRINT_NOFINGER:

        lcd.setCursor(0, 0);
        lcd.print("Daftar User            ");
        lcd.setCursor(0, 1);
        lcd.print("Letakan Tangan       ");

        Serial.println(".");
        break;
      case FINGERPRINT_PACKETRECIEVEERR:
        Serial.println("Communication error");
        break;
      case FINGERPRINT_IMAGEFAIL:
        Serial.println("Imaging error");
        break;
      default:
        Serial.println("Unknown error");
        break;
    }
  }

  // OK success!

  p = finger.image2Tz(1);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }

  lcd.setCursor(0, 0);
  lcd.print("Lepaskan Tangan                        ");
  lcd.setCursor(0, 1);
  lcd.print("                                 ");

  Serial.println("Remove finger");
  delay(2000);
  p = 0;
  while (p != FINGERPRINT_NOFINGER) {
    p = finger.getImage();
  }
  Serial.print("ID "); Serial.println(id_enroll);
  p = -1;

  lcd.setCursor(0, 0);
  lcd.print("Letakan Tangan");
  lcd.setCursor(0, 1);
  lcd.print("       ");

  Serial.println("Place same finger again");
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
      case FINGERPRINT_OK:

        Serial.println("Image taken");
        break;
      case FINGERPRINT_NOFINGER:
        Serial.print(".");
        break;
      case FINGERPRINT_PACKETRECIEVEERR:
        Serial.println("Communication error");
        break;
      case FINGERPRINT_IMAGEFAIL:
        Serial.println("Imaging error");
        break;
      default:
        Serial.println("Unknown error");
        break;
    }
  }

  // OK success!

  p = finger.image2Tz(2);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image converted");
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }

  // OK converted!
  Serial.print("Creating model for #");  Serial.println(id_enroll);

  p = finger.createModel();
  if (p == FINGERPRINT_OK) {
    Serial.println("Prints matched!");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_ENROLLMISMATCH) {
    Serial.println("Fingerprints did not match");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }

  Serial.print("ID "); Serial.println(id_enroll);
  p = finger.storeModel(id_enroll);

  if (p == FINGERPRINT_OK) {
    lcd.setCursor(0, 0);
    lcd.print("Lepaskan Tangan          ");
    lcd.setCursor(0, 1);
    lcd.print("OK                       ");

    Serial.println("Stored!");
  }
  else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    lcd.setCursor(0, 0);
    lcd.print("Lepaskan Tangan               ");
    lcd.setCursor(0, 1);
    lcd.print("ERROR/GAGAL                    ");
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_BADLOCATION) {
    Serial.println("Could not store in that location");
    return p;
  } else if (p == FINGERPRINT_FLASHERR) {
    Serial.println("Error writing to flash");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }

  return true;
}


void FingerAttendance_Handler() {

  getFingerprintID();// Cek ID Fingger Warga, Penjaga
  if (id_scan != 0) {  //  + Server
    int Attendance = Kirim_DataMasukWarga(id_scan);
    if (Attendance == 1) {  // If Warga
      // Kirim Data Masuk Warga => Jam Berapa
      lcd.setCursor(0, 0);
      lcd.print("   MASUK WARGA             ");
      lcd.setCursor(0, 0);
      lcd.print("                         ");
      isWarga = 0;

      Kirim_ServoControl(1);
    }
    else if (Attendance == 2) { // if Penjaga
      // Send Signal To DB

      Kirim_ServoControl(1);

    }

  }
  // Else
  else { // Tidak Ditemukan
    lcd.setCursor(0, 0);
    lcd.print(" Tidak Ditemukan                ");
    lcd.setCursor(0, 0);
    lcd.print(" WARGA/PENJAGA                      ");
    isWarga = 0;
    Kirim_ServoControl(0);
  }
}

void FinggerRegister_Handler() {
  // Daftar Fingger Warga
  if (getFingerprintEnroll() == true) {
    String id_finggerDaftar = String(id_enroll);
    // Request Send ID Fingger ke Server
    if (Kirim_FinggerID(id_finggerDaftar.toInt()) == 1)  {  // if TRUE/Success
      // Send ID Fingger ke Server
      lcd.setCursor(0, 0);
      lcd.print("Berhasil Register              ");
      lcd.setCursor(0, 1);
      lcd.print("                                ");
    }
    else { // else FALSE/Gagal
      lcd.setCursor(0, 0);
      lcd.print("Gagal Register              ");
      lcd.setCursor(0, 1);
      lcd.print("                                ");
      // Remove ID Fingger di FP
      id_enroll = 0;
    }

  } else {// ELSE gagal
    id_enroll = 0;// Remove ID
  }

}
