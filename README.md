# ToDo List
Документация API находится по адресу:  /api/documentation

Запросы начинаются с /api/
### Развертывание с помощью Docker: 
1. Переименовать .env.example в .env
2. Сбилдить и поднять проект -  `docker-sompose up` 
3. Войти в контейнер приложения - `docker exec -it todo_app bash`
4. Установить зависимости - `composer i` 
5. Установить ключ приложения -  `php artisan key:generate`
6. Запустить миграцию `php artisan migrate`

### Развертывание без Docker:
1. Переименовать .env.example в .env
2. Вставить свои значения БД в .env
3. Установить зависимости - `composer i`
4. Установить ключ приложения -  `php artisan key:generate`
5. Запустить миграцию `php artisan migrate`
