
void LCD_Init() {
   // initialize the LCD
  lcd.begin();
  lcd.backlight();
  
  lcd.setCursor(0, 0);
  lcd.print("-=Tugas Akhir=-");

  lcd.setCursor(0, 1);
  lcd.print("  -=2022=-");

  delay(2000);
  lcd.clear();

}
