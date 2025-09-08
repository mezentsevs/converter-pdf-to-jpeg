# Converter pdf to jpeg

## About 'Converter pdf to jpeg'

This is a converter pdf to jpeg, written in and for educational and demonstrational purposes.

Based on tech stack:
- [HTML](https://developer.mozilla.org/en-US/docs/Web/HTML),
- [PHP](https://www.php.net),
- [Laravel](https://laravel.com),
- [Breeze](https://github.com/laravel/breeze),
- [Sanctum](https://github.com/laravel/sanctum),
- [ImageMagick](https://imagemagick.org),
- [MySQL](https://www.mysql.com),
- [JavaScript](https://developer.mozilla.org/en-US/docs/Web/JavaScript),
- [Axios](https://axios-http.com),
- [CSS](https://developer.mozilla.org/en-US/docs/Web/CSS),
- [TailwindCss](https://tailwindcss.com),
- [Docker](https://www.docker.com),
- [Sail](https://github.com/laravel/sail),
- [Swagger](https://swagger.io),
- [Postman](https://www.postman.com),
- [Scribe](https://github.com/knuckleswtf/scribe).

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

- Or you can seed database with test user (name: Test User, email: test@example.com, password: password):
``` bash
php artisan migrate:fresh --seed
```

- Login on http://localhost/login

That's it! Now you can upload pdf documents, convert to jpeg and download zip archives with sliders.
For example, you can use pdf documents in tests/Dummies/Documents directory for testing. Thank you!

## Screenshots

<img width="1920" height="1200" alt="2025-07-31_19-41-35" src="https://github.com/user-attachments/assets/3cca1e8d-2ce5-4ea0-84f9-3c58b2b23a4a" />
<img width="1920" height="1200" alt="2025-07-31_19-42-17" src="https://github.com/user-attachments/assets/9def30a0-ee13-44c2-a827-0d4b1828913b" />
<img width="1920" height="1200" alt="2025-07-31_19-45-50" src="https://github.com/user-attachments/assets/338a849b-cc29-45d3-9c5f-ea2098fb5456" />
<img width="1920" height="1200" alt="2025-07-31_19-46-17" src="https://github.com/user-attachments/assets/e3e493f3-3285-435b-b595-2105f01383d0" />
<img width="1920" height="1200" alt="2025-08-02_09-45-51" src="https://github.com/user-attachments/assets/2e392f03-589c-42e9-a65a-ad9cc0786634" />
<img width="1916" height="1200" alt="2025-08-02_09-52-15" src="https://github.com/user-attachments/assets/34b0aa3a-6220-4d4c-b406-63cc2e3e7157" />
<img width="1920" height="1200" alt="2025-07-31_19-47-10" src="https://github.com/user-attachments/assets/1b163074-86ac-4e32-9d23-517e6f0a2a9b" />
<img width="1920" height="1200" alt="2025-07-31_19-47-15" src="https://github.com/user-attachments/assets/244c50b8-961b-4602-8dca-6a1b78835786" />
<img width="1920" height="1200" alt="2025-07-31_19-48-20" src="https://github.com/user-attachments/assets/efb2409b-3849-47d0-aaab-37e2c9b1b9f8" />
<img width="1920" height="1200" alt="2025-07-31_19-49-10" src="https://github.com/user-attachments/assets/7c78cbaa-6e9a-4eb1-ba90-f1ce27bb4d0f" />
<img width="1920" height="1200" alt="2025-07-31_19-50-01" src="https://github.com/user-attachments/assets/86aba57c-5ca8-490f-9ebc-f367c5d3026f" />
<img width="1920" height="1200" alt="2025-07-31_19-50-34" src="https://github.com/user-attachments/assets/72a3e8a4-0aa8-4190-8467-f6bdd3aeaeee" />
<img width="1920" height="1200" alt="2025-07-31_19-51-56" src="https://github.com/user-attachments/assets/b49d7565-74d4-4060-840c-f402eb51447e" />
<img width="1920" height="1200" alt="2025-07-31_19-52-42" src="https://github.com/user-attachments/assets/4c5c541c-2dae-40f4-9113-399223c2a3b3" />

## License

The 'Converter pdf to jpeg' is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
