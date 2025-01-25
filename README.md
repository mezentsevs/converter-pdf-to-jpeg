# Converter pdf to jpeg

## About 'Converter pdf to jpeg'

This is a converter pdf to jpeg written in and for educational purposes.

Based on tech stack:
- [PHP](https://www.php.net/),
- [Laravel](https://laravel.com/),
- [MySQL](https://www.mysql.com/),
- [ImageMagick](https://imagemagick.org/),
- [TailwindCss](https://tailwindcss.com/),
- [JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript),
- [Docker](https://www.docker.com/),
- [Sail](https://github.com/laravel/sail).

## Getting Started

- Clone the repository:
``` bash
git clone [repository-url]
```

- Change directory to project:
``` bash
cd /path/to/converter-pdf-to-jpeg/
```

- Install php dependencies (temporary ignore ext-imagick if not installed):
``` bash
composer install --ignore-platform-req=ext-imagick
```

- Create .env file:
``` bash
cp .env.example .env
```

- Generate application key:
``` bash
php artisan key:generate
```

- Run Docker Desktop (with wsl - for Windows only)

- Run wsl (for Windows only):
``` bash
wsl
```

- Run Sail:
``` bash
./vendor/bin/sail up
```

- Add new tab in terminal and connect to container:
``` bash
docker exec -it converter-pdf-to-jpeg-laravel.test-1 bash
```

- Install php dependencies:
``` bash
git config --global --add safe.directory /var/www/html
composer install
```

- Run migrations:
``` bash
php artisan migrate
```

- Install node dependencies:
``` bash
npm install
```

- Build project:
``` bash
npm run build
```

- In browser go to welcome page http://localhost/

- Register new user on http://localhost/register (enter your name, email, password)

- Login on http://localhost/login (next time)

That's it! Now you can upload pdf documents, convert to jpeg and download zip archives with sliders.
For example, you can use pdf documents in tests/Dummies/Documents directory for testing. Thank you!

## License

The 'Converter pdf to jpeg' is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
