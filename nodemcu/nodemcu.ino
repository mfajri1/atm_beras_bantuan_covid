//libarary rfid
#include <SoftwareSerial.h>
#include <MFRC522.h>
#include <SPI.h>
//library wifi
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>

//Network SSID
const char* ssid = "empty";
const char* password = "makansamba1122";

//pengenal host (server) = IP Address komputer server
const char* host = "192.168.43.118";

//sediakan variabel untuk RFID
#define SDA_PIN 2  //D4
#define RST_PIN 0  //D3

MFRC522 mfrc522(SDA_PIN, RST_PIN);
//untuk software serial
SoftwareSerial mySerial(5, 4); // RX, TX

String arrDataWeb[3];
int indexWeb = 0;

//untuk milis
unsigned long previousMillis = 0;
const long interval = 2000;

WiFiClient client;
int status = WL_IDLE_STATUS;
String text = "";
String minta = "";
void setup() {
  Serial.begin(115200);
  mySerial.begin(9600);

  //setting koneksi wifi
  WiFi.hostname("NodeMCU");
  status = WiFi.begin(ssid, password);
  
  //cek koneksi wifi
  
  if(WiFi.status() != WL_CONNECTED)
  {
    //progress sedang mencari WiFi
    delay(500);
    Serial.print("Couldn't get a wifi connection");
  }else{
    Serial.println("Connected to wifi");
    Serial.println("\nStarting connection...");
    // if you get a connection, report back via serial:
    if (client.connect(host, 80)) {
      Serial.println("connected");
      // Make a HTTP request:
      client.println("GET /search?q=arduino HTTP/1.0");
      client.println();
    }  
  }

  Serial.println("Wifi Connected");
  Serial.println("IP Address : ");
  Serial.println(WiFi.localIP());

  SPI.begin();
  mfrc522.PCD_Init();
  Serial.println("Dekatkan Kartu RFID Anda ke Reader");
  Serial.println();

}

void loop() {
  unsigned long currentMillis = millis(); // baca waktu
  //  proses baca data kiriman dari mega
  if(currentMillis - previousMillis >= interval){
    //  update previousMillis 
    previousMillis = currentMillis;
  
    while(mySerial.available() > 0){
      minta += char(mySerial.read());
    }
    minta.trim();
    Serial.println(minta);
    if(minta == "y"){
      text = "berhasil";
//      Serial.println(text);
    }else{
      text = "tag";
//      Serial.println(text);
      
    }    
  }
  if(! mfrc522.PICC_IsNewCardPresent()){
    return ;
  }
  if(! mfrc522.PICC_ReadCardSerial()){
    return ;
  }
    // Dump debug info about the card; PICC_HaltA() is automatically called
  mfrc522.PICC_DumpToSerial(&(mfrc522.uid));
     
  String RFID = bacaRFID(); 
//  Serial.println(RFID);

  Serial.println(text);
  if(text == "berhasil"){
    //kirim nomor kartu RFID untuk disimpan ke tabel tmprfid
    const int httpPort = 80;
    if(!client.connect(host, httpPort))
    {
      Serial.println("Connection Failed");
      return;
    }
    String Link;
    HTTPClient http;
    Link = "http://192.168.43.118/absensi/kirimkartu.php?nokartu=" + RFID;
    http.begin(Link);

    int httpCode = http.GET();
    String payload = http.getString();
    Serial.println(payload);
 
    if(payload == "ambil"){
      mySerial.write("a");  
    }else if(payload == "habis"){
      mySerial.write("h");
    }

    mySerial.flush();
    text = "";
    mySerial.write("");
    Serial.println("proses Ulang");
    client.stop();
    http.end();
  }else{
    const int httpPort = 80;
    if(!client.connect(host, httpPort))
    {
      Serial.println("Connection Failed");
      return;
    }
    String Link;
    HTTPClient http;
    Link = "http://192.168.43.118/absensi/kirimkartu.php?nokartu=" + RFID;
    http.begin(Link);

    int httpCode = http.GET();
    String payload = http.getString();
    Serial.println(payload);

    if(payload == "ambil"){
      mySerial.write("a");  
    }else if(payload == "habis"){
      mySerial.write("h");
    }
    text = "";
    mySerial.flush();
    Serial.flush();
    mySerial.write("");
    client.stop();
    mySerial.end();
    Serial.println("proses Pertama");
    http.end();
  }
  
  delay(2000);
  

}
String bacaRFID(){
  String IDTAG = "";
  for(byte i=0; i<mfrc522.uid.size; i++)
  {
    IDTAG += mfrc522.uid.uidByte[i];
  }
  return IDTAG;
}

String convertString(String data){
  for(int i = 0; i <= data.length(); i++){
    char delimiter = '-';
    if(data[i] != delimiter){
       arrDataWeb[indexWeb] += data[i];  
    }else{
      indexWeb++;  
    }  
  }

  if(indexWeb == 2){
    Serial.println(arrDataWeb[0]);
    Serial.println(arrDataWeb[1]);
    Serial.println(arrDataWeb[2]);
  }

  arrDataWeb[0] = "";
  arrDataWeb[1] = "";
  arrDataWeb[2] = "";

  
}
