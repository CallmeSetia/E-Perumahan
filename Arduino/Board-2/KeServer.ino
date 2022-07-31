void KomunikasiKeServer() {
  CekModeBoard();
  
//  Terima_CommandServo();
}

void CekModeBoard() {
  String httpRequestData = String(DOMAIN)
                           + String("/api/board/CekModeBoard.php?board=")
                           + String(BOARD);

  if (statusWifi == 1) {
    HTTPClient http;

    //GET methode
    http.begin(httpRequestData);
    int httpResponseCode = http.GET();
    String payload = http.getString();

    if (httpResponseCode == 200) {
      Serial.println(payload);
      String Buff_ModeBoard1 = parseString(payload, "#", 0);
      String Buff_ModeBoard2 = parseString(payload, "#", 1);

      id_enroll = Buff_ModeBoard2.toInt();
      ModeBoard = Buff_ModeBoard1.toInt();
    }
    http.end();
  }
  else Wifi_Init();
}


void CekID_Fingger() {
  String httpRequestData = String(DOMAIN)
                           + String("/api/board/CekModeBoard.php");

  if (statusWifi == 1) {
    HTTPClient http;

    //GET methode
    http.begin(httpRequestData);
    int httpResponseCode = http.GET();
    String payload = http.getString();

    if (httpResponseCode == 200) {
      Serial.println(payload);
      String Buff_ModeBoard = parseString(payload, "#", 0);
      ModeBoard = Buff_ModeBoard.toInt();
    }
    http.end();
  }
  else Wifi_Init();
}


/// KIRIM
int Kirim_FinggerID(int ID_Fingger) {
  int a = 0;
  String httpRequestData = String(DOMAIN)
                           + String("/api/register/warga.php?mode=12&");
  if (BOARD == "1") httpRequestData += String("idFingger1=") + String(ID_Fingger);
  else if (BOARD == "2") httpRequestData += String("idFingger2=") + String(ID_Fingger);

  if (statusWifi == 1) {
    HTTPClient http;

    //GET methode
    http.begin(httpRequestData);
    int httpResponseCode = http.GET();
    String payload = http.getString();

    if (httpResponseCode == 200) {
      Serial.println("Kirim ID FINGGER RESPONSE : " + payload);
      String Buff_Response = parseString(payload, "#", 0);
      a  = Buff_Response.toInt();
    }
    http.end();
  }
  else {
    Wifi_Init();
    a = 0;
  }
  return a;
}

int Kirim_DataMasukWarga(int ID_Fingger) {
  int a = 0;
  String httpRequestData = String(DOMAIN)
                           + String("/api/attendance.php?");
  if (BOARD == "1") httpRequestData += String("idFingger1=") + String(ID_Fingger);
  else if (BOARD == "2") httpRequestData += String("idFingger2=") + String(ID_Fingger);

  if (statusWifi == 1) {
    HTTPClient http;

    //GET methode
    http.begin(httpRequestData);
    int httpResponseCode = http.GET();
    String payload = http.getString();

    if (httpResponseCode == 200) {
      Serial.println("Kirim_DataMasukWarga RESPONSE : " + payload);
      String Buff_Response = parseString(payload, "#", 0);
      a  = Buff_Response.toInt();
    }
    http.end();
  }
  else {
    Wifi_Init();
    a = 0;
  }
  return a;
}


int Kirim_OTP(String otp) {
  int a = 0;
  String httpRequestData = String(DOMAIN)
                           + String("/api/attendance_otp.php")
                           + String("?otp=") + String(otp);

  if (statusWifi == 1) {
    HTTPClient http;

    //GET methode
    http.begin(httpRequestData);

    int httpResponseCode = http.GET();
    String payload = http.getString();
    Serial.println(httpRequestData + String(httpResponseCode));
    if (httpResponseCode == 200) {
      Serial.println("Kirim_OTP RESPONSE : " + payload);
      String Buff_Response = parseString(payload, "#", 0);
      a  = Buff_Response.toInt();
    }
    http.end();
  }
  else {
    Wifi_Init() ;
    a = 0;
  }
  return a;
}


void Kirim_ServoControl(int ctrl) {
  String httpRequestData = String(DOMAIN)
                           + String("/api/board/ServoControl.php")
                           + String("?ServoControl=") + String(ctrl);

  if (statusWifi == 1) {
    HTTPClient http;

    //GET methode
    http.begin(httpRequestData);

    int httpResponseCode = http.GET();
    String payload = http.getString();
    Serial.println(httpRequestData + String(httpResponseCode));
    if (httpResponseCode == 200) {
    }
    http.end();
  }
  else {
    Wifi_Init() ;
  }
}
