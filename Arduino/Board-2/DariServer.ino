void Terima_CommandServo() {
  String httpRequestData = String(DOMAIN)
                           + String("/api/board/CommandServo.php");
  if (statusWifi == 1) {
    HTTPClient http;

    //GET methode
    http.begin(httpRequestData);
    int httpResponseCode = http.GET();
    String payload = http.getString();


    if (httpResponseCode == 200) {
      Serial.println(payload);
      String CommandServo_Buff = parseString(payload, "#", 0);

      CommandServo = CommandServo_Buff.toInt();

    }
    http.end();
  }
  else {
    Wifi_Init();
  }
}
