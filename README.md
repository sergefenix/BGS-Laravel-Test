### Создать API-приложение для управления участниками мероприятия.

 
- Участник содержит поля имя/фамилия/email и привязан к мероприятию

- Мероприятие содержит поля название/дата проведения/город (для них api не требуется)

## Возможности

- Добавлять/получать/изменять/удалять участников через http запрос

- Фильтрация данных при запросе (возвращать только участников определенного мероприятия)

 
## Требования
- Использование фреймворка laravel (можно использовать любые дополнительные пакеты)

- Доступ к API закрыт напрямую

- Должны быть unit тесты (все покрывать необязательно)

- Формат возвращаемых данных - json

- Мероприятия уже существуют в базе при запуске приложения

- При успешном создании нового участника эмулируется отправка email через очередь (можно писать в лог)

- Участник уникален по email


#Дополнительное задание (необязательно)

- Приложение и его составляющие запускаются внутри docker контейнеров

## Запуск

- composer i
- docker-compose up -d
- composer test