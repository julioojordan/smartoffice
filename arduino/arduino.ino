#include <ESP8266WiFi.h>
#include <ArduinoJson.h>
#include <cstddef>

const char* ssid     = "POCOPHONE"; //wifi 
const char* password = "tanyaaku"; // wifi password

String user_id = "2"; //user id

const char* host = "192.168.100.231";
//"192.168.42.14" -> sesuaikan ip host

WiFiClient client;
StaticJsonDocument<1000> doc1;
StaticJsonDocument<3000> doc2;
const int httpPort = 80; int count_lock = 0;
String url, room_id;
String lock, lamp, fan, lamp2, fan2, lamp3, fan3;
String status_user = "0";
String status_lock;
String last_status_lock;
String room_type;


bool registered = false;
bool checked = false;

unsigned long timeout;
  
void setup() {
  Serial.begin(9600);
  delay(10);
  
  // We start by connecting to a WiFi network
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  //WiFi.persistent(false);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}


void loop() {
  String data ="";
  bool parse_json = false;
  if(checked == false){
    //get last lock status
    Serial.print("connecting to ");
    Serial.println(host);
  
    if (client.connect(host, httpPort)) {
      url = "/smartoffice/Microcontroller/initializing?user_id="+user_id;
    
      Serial.print("Requesting URL: ");
      Serial.println(url);
    
      // This will send the request to the server
      client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                   "Host: " + host + "\r\n" + 
                   "Content-Type: application/json\r\n"+
                   "Connection: close\r\n\r\n");
    
      // Read all the lines of the reply from server and print them to Serial
      while(client.connected() || client.available()){ // baca karakter 1 per satu untuk dimasukan ke string D sebagai bentuk json nantinya
        if (client.available()){
          char c = client.read();
          if(c == '{') {
            parse_json = true;
          }
          if(parse_json){
            data += c;
          }
        }
      }
      client.stop();
    }else{
      Serial.println("connection failed");
      client.stop();
      return;
    }
    Serial.println(data);
    //Parsing JSON
    if (data != "") {
      DeserializationError error = deserializeJson(doc1, data);
      if (error){
        Serial.print(F("deserializeJson() failed: "));
        Serial.println(error.f_str());
        return;
      }else{ //parsing data success
        Serial.println("Email : " +doc1[0]["email"].as<String>());
        if (doc1[0]["email"].as<String>() == "null" && doc1[0]["name"].as<String>() != "null"){//Unregistered
          registered = false;
          checked = false;
          Serial.println("Please Register Your Account First!");
        }else{
          last_status_lock = doc1["status"].as<String>();
          status_lock = doc1["status"].as<String>();
          room_id = doc1["room_id"].as<String>();
          Serial.println("last_status_lock : " +last_status_lock);
          Serial.println("room_id : " +room_id);
          room_type = doc1["room_type"].as<String>();
          Serial.println("room_type : " +room_type);

          if(room_type == "R1"){ //Registing pin for Normal room
              //pin for lamp
              pinMode(16, OUTPUT); //D0
              digitalWrite(16, HIGH);
            
              //pin for lock
              pinMode(13, OUTPUT); //D7
              digitalWrite(13, LOW);
            
              //pin for fan
              pinMode(0, OUTPUT); //D3
              digitalWrite(4, HIGH);
            
              //pin for PIR sensor
              pinMode(15, INPUT); //D8
          }else if (room_type == "R2"){//Registing pin for Exclusive room
              //pin for lamp
              pinMode(16, OUTPUT); //D0
              digitalWrite(16, HIGH);
              pinMode(5, OUTPUT); //D1
              digitalWrite(5, HIGH);
              
              //pin for lock
              pinMode(13, OUTPUT); //D7
              digitalWrite(13, LOW);
            
              //pin for fan
              pinMode(0, OUTPUT); //D3
              digitalWrite(0, HIGH);
              pinMode(2, OUTPUT); //D4
              digitalWrite(2, HIGH);
            
              //pin for PIR sensor
              pinMode(15, INPUT); //D8
            
          }else if (room_type == "H1"){//Registing pin for Hall
            //pin for lamp
              pinMode(16, OUTPUT); //D0
              digitalWrite(16, HIGH);
              pinMode(5, OUTPUT); //D1
              digitalWrite(5, HIGH);
              pinMode(4, OUTPUT); //D2
              digitalWrite(4, HIGH);
              
              //pin for lock
              pinMode(13, OUTPUT); //D7
              digitalWrite(13, LOW);
            
              //pin for fan
              pinMode(0, OUTPUT); //D3
              digitalWrite(0, HIGH);
              pinMode(2, OUTPUT); //D4
              digitalWrite(2, HIGH);
              pinMode(14, OUTPUT); //D5
              digitalWrite(14, HIGH);
            
              //pin for PIR sensor
              pinMode(15, INPUT); //D8
          }
          
          registered = true;
          checked = true;
        }
        
      }
    }else{
      Serial.println("No Data Loaded !");
    }
    
    Serial.println();
    Serial.println("closing connection");
    Serial.println();
    return;
  }else{
    if (registered == true){ // user already registered their email

      //read PIR
      long motion = digitalRead(15);
      if(motion == HIGH){ // Motion Detected
        Serial.println("Motion Detected!");
        status_user = "1";
      }else{
        status_user = "0";
        Serial.println("No Motion Detected!");
      }


      //check if lock still unlocked and then lock it again after 3 s
      if (last_status_lock != status_lock){
        //lock still open, unlock it
        count_lock++;
        if (count_lock == 8){ // already 1750 ms
          digitalWrite(13,LOW); //lock it
          status_lock = last_status_lock;
          count_lock = 0;
        }
        
      }
      Serial.print("connecting to ");
      Serial.println(host);
      
    
      if (client.connect(host, httpPort)){
        url = "/smartoffice/Microcontroller/read?user_id="+user_id+"&status_user="+status_user+"&room_id="+room_id;
        
        Serial.print("Requesting URL: ");
        Serial.println(url);
      
        // This will send the request to the server
        client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                     "Host: " + host + "\r\n" + 
                     "Content-Type: application/json\r\n"+
                     "Connection: close\r\n\r\n");
      
        // Read all the lines of the reply from server and print them to Serial
        while(client.connected() || client.available()){
          if (client.available()){
            char c2 = client.read();
            if(c2 == '[') {
              parse_json = true;
            }
            if(parse_json){
              data += c2;
            }
          }
        }
        client.stop();
      }else{
        Serial.println("connection failed");
        client.stop();
        return;
     }
     Serial.println(data);
     //parsing JSON
      if (data != "") {
        DeserializationError error = deserializeJson(doc2, data);
        if (error){
          Serial.print(F("deserializeJson() failed: "));
          Serial.println(error.f_str());
          return;
        }else{ // parsing data success
          if(room_type == "R1") {
            lock = doc2[0]["status"].as<String>();
            lamp = doc2[1]["status"].as<String>();
            fan = doc2[2]["status"].as<String>();
            Serial.println("Status lock : " +lock);
            Serial.println("Status lamp : " +lamp);
            Serial.println("Status fan : " +fan);
          }else if (room_type == "R2"){
            lock = doc2[0]["status"].as<String>();
            lamp = doc2[1]["status"].as<String>();
            lamp2 = doc2[2]["status"].as<String>();
            fan = doc2[3]["status"].as<String>();
            fan2 = doc2[4]["status"].as<String>();
            Serial.println("Status lock : " +lock);
            Serial.println("Status lamp 1 : " +lamp);
            Serial.println("Status lamp 2 : " +lamp2);
            Serial.println("Status fan 1: " +fan);
            Serial.println("Status fan 2 : " +fan2);
          }else if (room_type == "H1"){
            lock = doc2[0]["status"].as<String>();
            lamp = doc2[1]["status"].as<String>();
            lamp2 = doc2[2]["status"].as<String>();
            lamp3 = doc2[3]["status"].as<String>();
            fan = doc2[4]["status"].as<String>();
            fan2 = doc2[5]["status"].as<String>();
            fan3 = doc2[6]["status"].as<String>();
            Serial.println("Status lock : " +lock);
            Serial.println("Status lamp 1 : " +lamp);
            Serial.println("Status lamp 2 : " +lamp2);
            Serial.println("Status lamp 3 : " +lamp3);
            Serial.println("Status fan 1: " +fan);
            Serial.println("Status fan 2 : " +fan2);
            Serial.println("Status fan 3 : " +fan3);
          }
        }
      }else{
        Serial.println("No Data Loaded!");
      }

      //turn on/off device here
      if(room_type == "R1") {
        if (lock != last_status_lock){
          digitalWrite(13,HIGH);    //Unlocked
          Serial.println("Unlocked");
          last_status_lock = lock;
        }
  
        if (lamp == "1") {
          digitalWrite(16,LOW);
          Serial.println("Lamp ON");
        }else{
          digitalWrite(16,HIGH);
          Serial.println("Lamp OFF");
        }
  
        if (fan == "1") {
          digitalWrite(0,LOW);
          Serial.println("Fan ON");
        }else{
          digitalWrite(0,HIGH);
          Serial.println("Fan OFF");
        }
      }else if (room_type == "R2"){
        if (lock != last_status_lock){
          digitalWrite(13,HIGH);    //YUnlocked
          Serial.println("Unlocked");
          last_status_lock = lock;
        }
  
        if (lamp == "1") {
          digitalWrite(16,LOW);
          Serial.println("Lamp 1 ON");
        }else{
          digitalWrite(16,HIGH);
          Serial.println("Lamp 1 OFF");
        }

        if (lamp2 == "1") {
          digitalWrite(5,LOW);
          Serial.println("Lamp 2 ON");
        }else{
          digitalWrite(5,HIGH);
          Serial.println("Lamp 2 OFF");
        }
  
        if (fan == "1") {
          digitalWrite(0,LOW);
          Serial.println("Fan 1 ON");
        }else{
          digitalWrite(0,HIGH);
          Serial.println("Fan 1 OFF");
        }

        if (fan2 == "1") {
          digitalWrite(2,LOW);
          Serial.println("Fan 2 ON");
        }else{
          digitalWrite(2,HIGH);
          Serial.println("Fan 2 OFF");
        }
      }else if (room_type == "H1"){
        if (lock != last_status_lock){
          digitalWrite(13,HIGH);    //Unlocked
          Serial.println("Unlocked");
          last_status_lock = lock;
        }
  
        if (lamp == "1") {
          digitalWrite(16,LOW);
          Serial.println("Lamp 1 ON");
        }else{
          digitalWrite(16,HIGH);
          Serial.println("Lamp 1 OFF");
        }

        if (lamp2 == "1") {
          digitalWrite(5,LOW);
          Serial.println("Lamp 2 ON");
        }else{
          digitalWrite(5,HIGH);
          Serial.println("Lamp 2 OFF");
        }

        if (lamp3 == "1") {
          digitalWrite(4,LOW);
          Serial.println("Lamp 3 ON");
        }else{
          digitalWrite(4,HIGH);
          Serial.println("Lamp 3 OFF");
        }
  
        if (fan == "1") {
          digitalWrite(0,LOW);
          Serial.println("Fan 1 ON");
        }else{
          digitalWrite(0,HIGH);
          Serial.println("Fan 1 OFF");
        }

        if (fan2 == "1") {
          digitalWrite(2,LOW);
          Serial.println("Fan 2 ON");
        }else{
          digitalWrite(2,HIGH);
          Serial.println("Fan 2 OFF");
        }

        if (fan3 == "1") {
          digitalWrite(14,LOW);
          Serial.println("Fan 3 ON");
        }else{
          digitalWrite(14,HIGH);
          Serial.println("Fan 3 OFF");
        }
      }
      Serial.println();
      Serial.println("closing connection");
      Serial.println();
      delay(250);
    }else{
      Serial.println("Please Register Your Account First!");
      return;
    }
  }
  
  
}