# Booking API

## Описание
Booking API — это RESTful API на Laravel для управления бронированиями ресурсов.
Проект поддерживает создание, просмотр, удаление и получение списка бронирований.
Сейчас в локальном письма логируются в storage/logs/mail.log, но можно изменить Listener так, 
чтобы отправлять их на реальные email-адреса через SMTP или другие почтовые сервисы.
## Стек технологий
- PHP 8+
- Laravel 11
- MySQL
- Swagger (L5 Swagger)
- PHP Test Feature

## Установка и запуск

### 1. Клонирование репозитория
```bash
git clone
cd Booking_API
```

### 2. Установка зависимостей
```bash
composer install
```

### 3. Создание и настройка файла окружения
Скопируйте `.env.example` в `.env` и настройте параметры подключения к базе данных:
```bash
cp .env.example .env
```

### 4. Генерация ключа приложения
```bash
php artisan key:generate
```

### 5. Настройка базы данных
Создайте базу данных и выполните миграции:
```bash
php artisan migrate --seed
```

### 6. Запуск сервера
```bash
php artisan serve
```
API будет доступно по адресу `http://127.0.0.1:8000`

### 7. Запуск swagger
```bash
php artisan l5-swagger:generate
```

## Использование API

### Swagger-документация
Документация API доступна по адресу:
```
http://127.0.0.1:8000/api/documentation
```

## Тестирование
Запустить тесты можно командой:
```bash
php artisan test
```

