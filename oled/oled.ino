#include "WiFi.h"
#include <HTTPClient.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <PN532_I2C.h>
#include <PN532.h>

#define SCREEN_WIDTH 128
#define SCREEN_HEIGHT 64
#define OLED_RESET -1
Adafruit_SSD1306 display(SCREEN_WIDTH, SCREEN_HEIGHT, &Wire, OLED_RESET);
#define BUZZER_PIN 18

//#define PN532_I2C_ADDRESS (0x48)
PN532_I2C pn532_i2c(Wire);
PN532 nfc(pn532_i2c);

char* ssid              = "absen";
char* password          = "12345678";
char* host              = "saraja.my.id";


void setup() {
  Serial.begin(115200);
  pinMode(BUZZER_PIN, OUTPUT);
  while (!Serial) delay(10); 
  Serial.println("Hello!");
  if (!display.begin(SSD1306_SWITCHCAPVCC, 0x3C)) {
    Serial.println(F("SSD1306 allocation failed"));
    for (;;);
  }
  display.clearDisplay();
  display.setTextSize(2);
  display.setTextColor(SSD1306_WHITE);
  display.setCursor(0,0);
  display.println("Cek Wifi");
  display.setCursor(0,18);
  display.println("...");
  WiFi.begin(ssid, password);
  Serial.println("conecting...");
  while(WiFi.status()!=WL_CONNECTED)
  {
    Serial.print(".");
    delay(500);
  }
  Serial.print("terhubung");
  delay(1000);
  display.clearDisplay();
  nfc.begin();
  uint32_t versiondata = nfc.getFirmwareVersion();
  if (!versiondata) {
    Serial.print("Didn't find PN53x board");
    while (1);
  }
  nfc.SAMConfig();
  Serial.println("Waiting for an NFC tag...");
  display.setTextSize(2);
  display.setTextColor(SSD1306_WHITE);
  display.setCursor(0,0);
  display.println("Silahkan");
  display.setCursor(0,18);
  display.println("Tap Kartu:");
  display.display();
}

void loop() {
  uint8_t success;
  uint8_t uid[] = { 0, 0, 0, 0, 0, 0, 0 };
  uint8_t uidLength;

  success = nfc.readPassiveTargetID(PN532_MIFARE_ISO14443A, uid, &uidLength);
  display.clearDisplay();
  display.setTextSize(2);
  display.setTextColor(SSD1306_WHITE);
  display.setCursor(0,0);
  display.println("Silahkan");
  display.setCursor(0,18);
  display.println("Tap Kartu:");
  display.display();
  if (success) {
    digitalWrite(BUZZER_PIN, HIGH);
    delay(100);
    digitalWrite(BUZZER_PIN, LOW);
    Serial.println("Found an NFC tag!");
    display.clearDisplay();
    display.setTextSize(2);
    display.setTextColor(SSD1306_WHITE);
    display.setCursor(0,0);
    display.println("Status:");
    String idkartu;
    for (uint8_t i=0; i < uidLength; i++) 
    {
      Serial.print("");Serial.print(uid[i], HEX); 
      idkartu += String(uid[i], HEX);
    }
    idkartu.toUpperCase();
    WiFiClient client;
    if(!client.connect(host, 80))
    {
      Serial.println("Conection Failed");
      display.setTextSize(2);
      display.setTextColor(SSD1306_WHITE);
      display.setCursor(0,18);
      display.println("Koneksi\nGagal");
      display.display();
      delay(1000); // Delay 1 detik ketika koneksi gagal
      display.clearDisplay();
      display.setTextSize(2);
      display.setTextColor(SSD1306_WHITE);
      display.setCursor(0,0);
      display.println("Silahkan");
      display.setCursor(0,18);
      display.println("Tap Kartu:");
      display.display();
      return;
    }
    String Link2;
    HTTPClient http;
    Link2 = "https://" + String(host) + "/kirimKartu.php?nokartu=" + idkartu;
    http.begin(Link2);
    int httpCode = http.GET();
    String respon = http.getString();
    Serial.println(respon);
    display.setTextSize(2);
    display.setTextColor(SSD1306_WHITE);
    display.setCursor(0,18);
    display.println(respon);
    display.display();
    http.end();
    delay(500); // Delay 1/2 detik sebelum kembali ke pesan "Silahkan Tap Kartu"
    display.clearDisplay();
    display.setTextSize(2);
    display.setTextColor(SSD1306_WHITE);
    display.setCursor(0,0);
    display.println("Silahkan");
    display.setCursor(0,18);
    display.println("Tap Kartu:");
    display.display();
    display.clearDisplay();
  }
  delay(500);
}
