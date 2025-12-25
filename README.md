# FFW Web

Laravel 12 Anwendung mit Filament 4, PostgreSQL und Redis.

## Requirements

### System Requirements

- **PHP**: 8.2 oder höher (empfohlen: 8.4)
- **Composer**: 2.x
- **Node.js**: 20.x oder höher
- **npm**: 9.x oder höher
- **PostgreSQL**: 15 oder höher (oder Docker)
- **Redis**: 7 oder höher (oder Docker)
- **Docker & Docker Compose** (optional, für Container-basierte Entwicklung)

### PHP Extensions

Die folgenden PHP Extensions müssen installiert sein:

- BCMath
- Ctype
- cURL
- DOM
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PCRE
- PDO
- PDO_PGSQL
- Tokenizer
- XML
- Redis (phpredis)

## Installation

### Option 1: Lokale Installation (ohne Docker)

1. **Repository klonen**
   ```bash
   git clone <repository-url>
   cd ffwweb2
   ```

2. **Composer Dependencies installieren**
   ```bash
   composer install
   ```

3. **Umgebungsvariablen konfigurieren**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **.env Datei anpassen**
   
   Öffne `.env` und passe die folgenden Werte an:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=ffwweb
   DB_USERNAME=postgres
   DB_PASSWORD=dein_passwort
   
   REDIS_HOST=127.0.0.1
   REDIS_PORT=6379
   REDIS_PASSWORD=null
   
   CACHE_STORE=redis
   SESSION_DRIVER=redis
   QUEUE_CONNECTION=redis
   ```

5. **NPM Dependencies installieren**
   ```bash
   npm install
   ```

6. **Datenbank migrieren**
   ```bash
   php artisan migrate
   ```

7. **Optional: Datenbank seeden**
   ```bash
   php artisan db:seed
   ```

8. **Assets kompilieren**
   ```bash
   npm run build
   ```

9. **Storage Link erstellen**
   ```bash
   php artisan storage:link
   ```

10. **Berechtigungen setzen** (Linux/Mac)
    ```bash
    chmod -R 775 storage bootstrap/cache
    chown -R www-data:www-data storage bootstrap/cache
    ```

### Option 2: Docker Installation

1. **Repository klonen**
   ```bash
   git clone <repository-url>
   cd ffwweb2
   ```

2. **Umgebungsvariablen konfigurieren**
   ```bash
   cp .env.example .env
   ```

3. **.env Datei anpassen** (für Docker)
   
   Die Standardwerte in `.env.example` sind bereits für Docker konfiguriert:
   ```env
   DB_HOST=db
   REDIS_HOST=redis
   ```

4. **Docker Container starten**
   ```bash
   docker-compose up -d
   ```

5. **Composer Dependencies installieren** (im Container)
   ```bash
   docker-compose exec app composer install
   ```

6. **Application Key generieren**
   ```bash
   docker-compose exec app php artisan key:generate
   ```

7. **NPM Dependencies installieren** (lokal oder im Container)
   ```bash
   npm install
   ```

8. **Assets kompilieren**
   ```bash
   npm run build
   ```

9. **Datenbank migrieren**
   ```bash
   docker-compose exec app php artisan migrate
   ```

10. **Optional: Datenbank seeden**
    ```bash
    docker-compose exec app php artisan db:seed
    ```

11. **Storage Link erstellen**
    ```bash
    docker-compose exec app php artisan storage:link
    ```

Die Anwendung ist nun unter `http://localhost` erreichbar.

## Entwicklung

### Entwicklungsserver starten

**Ohne Docker:**
```bash
composer run dev
```

Dies startet gleichzeitig:
- Laravel Development Server (`php artisan serve`)
- Queue Worker (`php artisan queue:listen`)
- Vite Dev Server (`npm run dev`)

**Mit Docker:**
```bash
# Vite Dev Server (lokal)
npm run dev

# Queue Worker (im Container)
docker-compose exec app php artisan queue:work
```

### Code Formatting

Laravel Pint für PHP Code:
```bash
vendor/bin/pint --dirty
```

Prettier für Frontend Code:
```bash
npm run format  # Falls konfiguriert
```

### Tests ausführen

```bash
# Alle Tests
php artisan test

# Spezifische Test-Datei
php artisan test tests/Feature/ExampleTest.php

# Mit Filter
php artisan test --filter=testName
```

**Mit Docker:**
```bash
docker-compose exec app php artisan test
```

## Redis Konfiguration

Die Anwendung nutzt Redis für:
- **Cache**: `CACHE_STORE=redis`
- **Sessions**: `SESSION_DRIVER=redis`
- **Queues**: `QUEUE_CONNECTION=redis`

### Redis Datenbanken

- **Database 0**: Standard Redis Connection (Sessions, Queues)
- **Database 1**: Cache (`REDIS_CACHE_DB=1`)

### Redis im Docker Container

Redis läuft im Docker Container mit:
- **Host**: `redis` (im Docker Network) oder `127.0.0.1` (lokal)
- **Port**: `6379`
- **Password**: Optional (in `.env` via `REDIS_PASSWORD`)

### Redis CLI (Docker)

```bash
# Verbindung zum Redis Container
docker-compose exec redis redis-cli

# Mit Passwort
docker-compose exec redis redis-cli -a dein_passwort
```

## Datenbank

### Migrationen

```bash
# Migrationen ausführen
php artisan migrate

# Migrationen mit Seed
php artisan migrate --seed

# Migrationen zurücksetzen
php artisan migrate:rollback

# Alle Migrationen zurücksetzen
php artisan migrate:fresh

# Migrationen zurücksetzen und neu ausführen
php artisan migrate:fresh --seed
```

### Datenbank Seeders

```bash
# Alle Seeders ausführen
php artisan db:seed

# Spezifischen Seeder ausführen
php artisan db:seed --class=EinsatzSeeder
```

## Queue Worker

### Queue Worker starten

```bash
# Development
php artisan queue:work

# Mit Retries
php artisan queue:work --tries=3

# Spezifische Queue
php artisan queue:work --queue=high,default
```

**Mit Docker:**
```bash
docker-compose exec app php artisan queue:work
```

### Failed Jobs

```bash
# Failed Jobs anzeigen
php artisan queue:failed

# Failed Job erneut versuchen
php artisan queue:retry <job-id>

# Alle Failed Jobs erneut versuchen
php artisan queue:retry all

# Failed Job löschen
php artisan queue:forget <job-id>
```

## Filament Admin Panel

Das Filament Admin Panel ist unter `/admin` erreichbar.

### Admin User erstellen

```bash
php artisan make:filament-user
```

## Wichtige Befehle

```bash
# Cache leeren
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimierung für Production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Autoloader optimieren
composer dump-autoload -o
```

## Docker Befehle

```bash
# Container starten
docker-compose up -d

# Container stoppen
docker-compose down

# Container neu bauen
docker-compose build

# Logs anzeigen
docker-compose logs -f

# Logs eines spezifischen Services
docker-compose logs -f app

# In Container einloggen
docker-compose exec app sh

# Datenbank Backup (PostgreSQL)
docker-compose exec db pg_dump -U laravel laravel > backup.sql

# Datenbank Restore
docker-compose exec -T db psql -U laravel laravel < backup.sql
```

## Projektstruktur

```
ffwweb2/
├── app/
│   ├── Filament/          # Filament Admin Panel
│   ├── Http/              # Controller
│   ├── Models/            # Eloquent Models
│   └── Providers/         # Service Providers
├── config/                # Konfigurationsdateien
├── database/
│   ├── factories/         # Model Factories
│   ├── migrations/        # Datenbank Migrationen
│   └── seeders/           # Database Seeders
├── public/                # Öffentliches Verzeichnis
├── resources/
│   ├── css/               # CSS Dateien
│   ├── js/                # JavaScript Dateien
│   └── views/             # Blade Templates
├── routes/                # Route Definitionen
├── storage/               # Logs, Cache, Uploads
├── tests/                 # Tests
└── vendor/                # Composer Dependencies
```

## Troubleshooting

### Permission Errors (Linux/Mac)

```bash
sudo chown -R $USER:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Redis Connection Error

- Prüfe ob Redis läuft: `redis-cli ping`
- Prüfe `.env` Einstellungen: `REDIS_HOST`, `REDIS_PORT`
- Prüfe Docker Container: `docker-compose ps`

### Database Connection Error

- Prüfe ob PostgreSQL läuft
- Prüfe `.env` Einstellungen: `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- Prüfe Docker Container: `docker-compose ps`

### Vite Manifest Error

```bash
npm run build
# oder
npm run dev
```

## License

[MIT License](LICENSE)
