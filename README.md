# Voicebot CodeIgniter 3

Ta aplikacja stanowi lekką bazę projektu opartego o CodeIgniter 3. Zawiera przykładowe moduły strony głównej, podstrony "O projekcie" oraz formularz kontaktowy zapisujący dane do tabeli `contact_messages`.

## Wymagania
- PHP 7.4 lub nowszy
- Composer
- Serwer HTTP (np. Apache, Nginx) lub wbudowany serwer PHP
- Baza danych MySQL/MariaDB (opcjonalnie dla formularza kontaktowego)

## Instalacja
1. Zainstaluj zależności frameworka:
   ```bash
   composer install
   ```
2. Skopiuj plik środowiskowy i uzupełnij dane:
   ```bash
   cp .env.example .env
   ```
3. Ustaw prawa zapisu dla katalogów `application/cache` oraz `application/logs`.
4. Utwórz bazę danych i tabelę `contact_messages`:
   ```sql
   CREATE TABLE contact_messages (
       id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255) NOT NULL,
       email VARCHAR(255) NOT NULL,
       message TEXT NOT NULL,
       created_at DATETIME NOT NULL
   );
   ```

## Uruchomienie
Aby szybko uruchomić projekt lokalnie użyj serwera wbudowanego w PHP:
```bash
php -S localhost:8080 -t public/
```

Aplikacja będzie dostępna pod adresem [http://localhost:8080](http://localhost:8080).

## Struktura katalogów
- `public/` – front controller oraz zasoby publiczne
- `application/` – logika aplikacji, konfiguracja oraz widoki
- `vendor/` – pliki frameworka CodeIgniter (tworzone przez Composer)

## Testy
W projekcie dodano PHPUnit jako zależność developerską. Aby uruchomić testy jednostkowe (po ich przygotowaniu) wykonaj:
```bash
./vendor/bin/phpunit
```
