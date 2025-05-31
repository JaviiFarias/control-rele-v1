#include <WiFi.h>
#include <HTTPClient.h>

const char* ssid = "Chaca444";
const char* password = "javjime002";

const char* apiBaseUrl = "https://soyjavierfarias.com/api";

const int relePin = 14;  // GPIO14 (D5)

unsigned long lastRequestTime = 0;
const unsigned long requestInterval = 2000;  // cada 2 segundos (ajustable)

String estadoAnterior = "";

void setup() {
  Serial.begin(115200);
  pinMode(relePin, OUTPUT);
  digitalWrite(relePin, LOW); // Asumimos LOW = relé apagado

  WiFi.begin(ssid, password);
  Serial.print("Conectando a WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConectado a WiFi");
}

String httpGETRequest(const char* url) {
  HTTPClient http;
  http.begin(url);
  int httpResponseCode = http.GET();

  String payload = "";
  if (httpResponseCode > 0) {
    payload = http.getString();
  } else {
    Serial.print("Error en la petición GET: ");
    Serial.println(httpResponseCode);
  }
  http.end();
  return payload;
}

String getEstado() {
  String url = String(apiBaseUrl) + "/get_estado.php";
  String response = httpGETRequest(url.c_str());
  response.trim();
  return response;
}

void aplicarEstado(String estado) {
  if (estado == "ON") {
    digitalWrite(relePin, HIGH);
    Serial.println("Relé ENCENDIDO");
  } else if (estado == "OFF") {
    digitalWrite(relePin, LOW);
    Serial.println("Relé APAGADO");
  } else {
    Serial.println("Estado desconocido: " + estado);
  }
}

void loop() {
  unsigned long currentMillis = millis();

  if (currentMillis - lastRequestTime >= requestInterval) {
    lastRequestTime = currentMillis;

    String estado = getEstado();

    if (estado != estadoAnterior) {
      Serial.println("Cambio de estado detectado: " + estado);
      aplicarEstado(estado);
      estadoAnterior = estado;
    }
  }

  // Acá podés poner código extra que no bloquee
}
