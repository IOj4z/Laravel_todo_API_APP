# Управление событиями API

## Описание
API "Управление событиями" предоставляет возможность управления событиями и задачами, а также аутентификацию пользователей.

## Установка и запуск

1. **Установите зависимости:**
    - Убедитесь, что у вас установлен PHP, Composer, MySQL (или другая база данных, поддерживаемая Laravel).
    - Установите Node.js и npm для управления зависимостями фронтенда (если требуется).

2. **Клонируйте репозиторий:**
    - Склонируйте репозиторий проекта из Git-репозитория на вашем локальном компьютере.

3. **Установите зависимости PHP:**
    - Перейдите в корневую директорию проекта и выполните `composer install` для установки всех зависимостей PHP.

4. **Настройте окружение:**
    - Создайте файл `.env` на основе файла `.env.example` и настройте соединение с базой данных, а также другие параметры окружения.
    - Сгенерируйте ключ приложения, выполнив команду `php artisan key:generate`.

5. **Создайте и заполните базу данных:**
    - Создайте базу данных для проекта.
    - Выполните миграции, запустив `php artisan migrate`, чтобы создать необходимые таблицы в базе данных.

6. **Установите зависимости фронтенда (по желанию):**
    - Если проект использует фронтендную часть (например, Vue.js), перейдите в директорию фронтенда и выполните `npm install` для установки всех зависимостей фронтенда.

7. **Запустите сервер:**
    - Запустите встроенный сервер PHP с помощью команды `php artisan serve`. Приложение будет доступно по адресу `http://localhost:8000`.

8. **Запустите очереди (по желанию):**
    - Если ваше приложение использует очереди Laravel, запустите обработчики очередей с помощью команды `php artisan queue:work`.

9. **Документация API:**
    - Для получения подробной информации о методах и эндпоинтах API обратитесь к файлу storage/api-docs/api-docs.json, который содержит спецификацию API в формате OpenAPI (Swagger).
      


## Документация API

### Регистрация пользователя

- **Метод:** `POST`
- **Путь:** `/api/v1/register`
- **Теги:** `Authentication`
- **Описание:** Регистрирует нового пользователя с указанным именем, адресом электронной почты и паролем.
- **Параметры запроса:**
    - `name` (string, required): Имя пользователя.
    - `email` (string, required, format: email): Адрес электронной почты пользователя.
    - `password` (string, required, format: password): Пароль пользователя.
    - `password_confirmation` (string, required, format: password): Подтверждение пароля пользователя.
- **Ответы:**
    - `201`: Пользователь успешно зарегистрирован.
      ```json
      {
          "user": {
              // Свойства пользователя
          }
      }
      ```
    - `422`: Ошибка валидации.
      ```json
      {
          "message": "The given data was invalid."
      }
      ```

### Управление событиями

#### Создание события

- **Метод:** `POST`
- **Путь:** `/api/v1/events`
- **Теги:** `Events`
- **Описание:** Создает новое событие.
- **Параметры запроса:** См. модель `Event`.
- **Ответы:**
    - `201`: Событие успешно создано.
      ```json
      {
          // Свойства созданного события
      }
      ```

#### Удаление события

- **Метод:** `DELETE`
- **Путь:** `/api/v1/events/{id}`
- **Теги:** `Events`
- **Описание:** Удаляет существующее событие по его ID.
- **Параметры пути:**
    - `id` (integer, required): ID события.
- **Ответы:**
    - `204`: Событие успешно удалено.

### Управление задачами

#### Получение списка задач

- **Метод:** `GET`
- **Путь:** `/api/v1/tasks`
- **Теги:** `Tasks`
- **Описание:** Возвращает список задач.
- **Ответы:**
    - `200`: Успешное выполнение.
      ```json
      {
          // Список задач
      }
      ```

#### Создание новой задачи

- **Метод:** `POST`
- **Путь:** `/api/v1/tasks`
- **Теги:** `Tasks`
- **Описание:** Создает новую задачу.
- **Параметры запроса:** См. модель `Task`.
- **Ответы:**
    - `201`: Задача успешно создана.
      ```json
      {
          // Свойства созданной задачи
      }
      ```

#### Получение информации о задаче

- **Метод:** `GET`
- **Путь:** `/api/v1/tasks/{id}`
- **Теги:** `Tasks`
- **Описание:** Возвращает данные задачи по ее ID.
- **Параметры пути:**
    - `id` (integer, required): ID задачи.
- **Ответы:**
    - `200`: Успешное выполнение.
      ```json
      {
          // Данные задачи
      }
      ```

#### Обновление существующей задачи

- **Метод:** `PUT`
- **Путь:** `/api/v1/tasks/{id}`
- **Теги:** `Tasks`
- **Описание:** Обновляет существующую задачу по ее ID.
- **Параметры пути:**
    - `id` (integer, required): ID задачи.
- **Параметры запроса:** См. модель `Task`.
- **Ответы:**
    - `200`: Задача успешно обновлена.
      ```json
      {
          // Свойства обновленной задачи
      }
      ```

#### Удаление существующей задачи

- **Метод:** `DELETE`
- **Путь:** `/api/v1/tasks/{id}`
- **Теги:** `Tasks`
- **Описание:** Удаляет существующую задачу по ее ID.
- **Параметры пути:**
    - `id` (integer, required): ID задачи.
- **Ответы:**
    - `204`: Задача успешно удалена.

## Лицензия

Этот проект лицензирован под [MIT License](LICENSE).
