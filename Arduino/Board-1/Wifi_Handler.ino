void Wifi_Init() {
  WiFi.mode(WIFI_OFF); //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Connecting to :");
  lcd.setCursor(0, 1);
  lcd.print(SSID_WIFI);

  statusWifi = 1;
  Serial.print("Connecting to ");
  Serial.println(SSID_WIFI);
  WiFi.begin(SSID_WIFI, PASS_WIFI);

  unsigned int counter = 0;
  while (WiFi.status() != WL_CONNECTED) {
    delay(50);
    Serial.print(".");
  }

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Connected-IP:");
  lcd.setCursor(0, 1);
  lcd.print(WiFi.localIP());

  Serial.println("");
  Serial.println("Connected");

  Serial.print("IP address: ");
  Serial.println(WiFi.localIP()); //IP address assigned to your ESP

}

void koneksiWifiChecker() {
  if ((WiFi.status() != WL_CONNECTED)) {
    statusWifi = 0;
   Wifi_Init();
  }
  else if (WiFi.isConnected()) statusWifi = 1;
}
