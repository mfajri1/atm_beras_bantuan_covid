#include <Servo.h>
#include <SoftwareSerial.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <HX711.h> //memasukan library HX711
#define DOUT  3 //mendefinisikan pin arduino yang terhubung dengan pin DT module HX711
#define CLK  2 //mendefinisikan pin arduino yang terhubung dengan pin SCK module HX711

HX711 scale(DOUT, CLK);

LiquidCrystal_I2C lcd(0x27, 16, 2);
SoftwareSerial mySerial(10, 11); // RX, TX

Servo servo;
float calibration_factor = 483;

String minta, text;
boolean statuss;

int buzzer = 53;
int led = 8;
void setup() {
  pinMode(buzzer, OUTPUT);
  pinMode(led, OUTPUT);
  Serial.begin(115200);
  mySerial.begin(9600);
  lcd.begin();
  lcd.backlight();
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Selamat Datang");
  lcd.setCursor(1, 1);
  lcd.print("Fedry Mahayasa");
  Serial.println("beras");
  delay(2000);
  lcd.clear();
  lcd.setCursor(3, 0);
  lcd.print("ATM Beras");
  lcd.setCursor(2, 1);
  lcd.print("Bantuan Covid");
  servo.attach(31);
  servo.write(0);
  scale.set_scale();
  scale.tare(); // auto zero / mengenolkan pembacaan berat
  long zero_factor = scale.read_average(); //membaca nilai output sensor saat tidak ada beban
  digitalWrite(led, HIGH);
  digitalWrite(buzzer, HIGH);
  delay(250);
  digitalWrite(buzzer, LOW);
  delay(250);
}


void loop() {

  minta = "";
  while (mySerial.available() > 0) {
    minta = char(mySerial.read());
    Serial.println(minta);
  }

  minta.trim();

  String u = "ulang";
  float unit = 0;
  if (minta == "a") {
    statuss = true;
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Sedang Mengisi");
    delay(1000);
    text = "yaya";
    Serial.println(text);
    while (statuss != false) {
      servo.write(90);
      scale.set_scale(calibration_factor);
      unit = scale.get_units();
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Jumlah = ");
      lcd.print(unit);
      Serial.println(unit, 1);
      delay(250);
      if (unit >= 1000.0) {
        servo.write(0);
        mySerial.write("y");
        lcd.clear();
        lcd.setCursor(0, 0);
        lcd.print("Beras Terisi");
        lcd.setCursor(0, 1);
        lcd.print("Silahkan Di Ambil");
        for (int d = 0; d <= 5; d++) {
          digitalWrite(buzzer, HIGH);
          delay(250);
          digitalWrite(buzzer, LOW);
          delay(250);
        }
        unit = 0;

        lcd.clear();
        lcd.setCursor(0, 0);
        lcd.print("Masukkan Kartu");
        // kosongkan variable minta
        statuss = false;
        delay(500);
      }
    }
  } else if (minta == "h") {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Tidak Bisa Mengambil");
    lcd.setCursor(0, 1);
    lcd.print("Melebihi Batas!!!");
    delay(2000);
    mySerial.write('n');
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Masukkan Kartu");


  }
  minta ="";

}
