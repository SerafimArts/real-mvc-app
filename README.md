# Real MVC

Это пример того, почему MVC в вебе - это очень плохо. Это **реальное** MVC 
приложение, написанное на PHP по всем заветам дядечек из Xerox.


## Установка

- `cp .env.example .env`
- `composer install`

## Запуск

- `php app.php`
- `cd public && php -S 0.0.0.0:80`

Открыть в браузере `http://localhost`  наслаждаться.

Весь код приложения лежит в `app/`.

### Примечание

Если меняете порт сокет сервера в файле `.env`, то требуется пересборка ассетов:

- `npm run build`

## Лицензия

TL;DR: Ебитесь с этим как хотите.

```
            DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
                    Version 2, December 2004

 Copyright (C) 2020 Nesmeyanov Kirill <nesk@xakep.ru>

 Everyone is permitted to copy and distribute verbatim or modified
 copies of this license document, and changing it is allowed as long
 as the name is changed.

            DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
   TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION

  0. You just DO WHAT THE FUCK YOU WANT TO.
```
