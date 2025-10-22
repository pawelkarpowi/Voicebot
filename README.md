# Mini aplikacja CodeIgniter 3

Ten projekt zawiera odchudzoną implementację podstawowych koncepcji CodeIgnitera 3, która pozwala w prosty sposób uruchomić przykładową aplikację w środowisku ograniczonym do zasobów repozytorium.

## Uruchomienie

1. Upewnij się, że posiadasz PHP w wersji co najmniej 8.1.
2. Uruchom w katalogu projektu wbudowany serwer PHP:
   ```bash
   php -S localhost:8000 -t public
   ```
3. Wejdź na adres [http://localhost:8000](http://localhost:8000) w przeglądarce.

## Struktura katalogów

- `public/` – front controller (`index.php`).
- `system/` – uproszczony „rdzeń” frameworka (router, loader, kontroler bazowy).
- `application/` – kod użytkownika (kontrolery, widoki, konfiguracja).

## Rozszerzanie

Aby dodać nową stronę:

1. Utwórz metodę w istniejącym kontrolerze lub dodaj nowy plik w `application/controllers/` dziedziczący po `CI_Controller`.
2. W razie potrzeby dodaj trasę w `application/config/routes.php`.
3. Przygotuj widok w `application/views/` i wyrenderuj go poprzez `$this->load->view()`.

## Ograniczenia

Implementacja stanowi materiał edukacyjny i nie oferuje pełnej funkcjonalności oryginalnego CodeIgnitera 3. W razie potrzeby łatwo jednak rozbudować ją o kolejne elementy.
