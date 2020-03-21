#include <WiFi.h>
#include <WiFiClient.h>
#include <WiFiServer.h>
#include "DHTesp.h"

#define DHTpin 23

const char* ssid = "labores";
const char* password = "labores2019";

const char* host = "www.abelhascefet.tech";

DHTesp dht;
WiFiClient client;

void setup()
{
  Serial.begin(115200);
  dht.setup(DHTpin, DHTesp::DHT11);
  Serial.printf("Connecting to %s ", ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(500);
    Serial.print(".");
  }
  Serial.println(" connected");

}


void loop()
{  
  delay(20000);

  float humid= dht.getHumidity();
  float temp = dht.getTemperature();

  if (isnan(humid) || isnan(temp)) {
    Serial.println(F("Failed to read from DHT sensor!"));
  }
                                                                
  Serial.print("Humidade: ");
  Serial.print(humid);
  Serial.print("%  Temperatura: ");
  Serial.print(temp);

  Serial.printf("\n[Connecting to %s ... ", host);
  
  if (client.connect(host, 80))
  {
    Serial.println("connected]");
    
    String param = "?temp=" + String(temp) + "&humid=" + String(humid);

    Serial.println("[Sending a request]");
    Serial.println(param);
    client.print(String("GET /abelhas.php")+ param + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n" +
                 "\r\n"
                );

    Serial.println("[Response:]");
    while (client.connected() || client.available())
    {
      if (client.available())
      {
        String line = client.readStringUntil('\n');
        Serial.println(line);
      }
    }
    client.stop();
    Serial.println("\n[Disconnected]");
  }
  else
  {
    Serial.println("connection failed!]");
    client.stop();
  }
  
}
