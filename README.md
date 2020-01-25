# Real MVC

This is an example of why MVC on the web is so bad. 
This is a **real** MVC application written in PHP according 
to all the precepts of the Xerox "uncles" =)))

The result looks something like this:

![](https://habrastorage.org/webt/4r/9r/2f/4r9r2flpjzzkxwqrcihlvjfz4ym.gif)

## Installation

- `cp .env.example .env`
- `composer install`

## Run

- `php app.php`
- `cd public && php -S 0.0.0.0:80`

Open in browser `http://localhost` and enjoy!

All application code located in `app/`.

### Примечание

If you change the server socket port in the `.env` file, 
then rebuilding an assets is required:

- `npm run build`

## License

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
