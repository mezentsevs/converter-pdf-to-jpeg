# Converter pdf to jpeg

## About 'Converter pdf to jpeg'

This is a converter pdf to jpeg, written in and for educational and demonstrational purposes.

A backend service for converting pdf documents into jpeg images. It handles file upload, validation, and processing. The results are instantly displayed in an in-browser slider for preview, and are also provided as a downloadable archive containing all images and a portable slider for offline use.

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

<img width="1920" height="1200" alt="2025-12-23_13-53-53" src="https://github.com/user-attachments/assets/da9c4489-77f0-44d9-92e5-38518e7668d7" />
<img width="1920" height="1200" alt="2025-12-23_13-56-09" src="https://github.com/user-attachments/assets/a7d3e63e-dad0-4944-a04f-3b1abcc071e1" />
<img width="1920" height="1200" alt="2025-12-23_13-57-52" src="https://github.com/user-attachments/assets/ac933972-b8c8-420a-8e8d-6000bf9c52fa" />
<img width="1920" height="1200" alt="2025-12-23_13-59-34" src="https://github.com/user-attachments/assets/c4e4ec39-a6f4-4238-9e8a-d7c8a8737281" />
<img width="1920" height="1200" alt="2025-12-23_14-02-53" src="https://github.com/user-attachments/assets/13d3e4b0-c0c9-4cae-a938-53eee63a7bd9" />
<img width="1920" height="1200" alt="2025-12-23_14-03-46" src="https://github.com/user-attachments/assets/f455b412-6d0b-41c2-80a1-ce70b555e82c" />
<img width="1920" height="1200" alt="2025-12-23_14-06-12" src="https://github.com/user-attachments/assets/48dfe765-06d6-4ae5-983e-9f7fd547a1fe" />
<img width="1920" height="1200" alt="2025-12-23_14-07-34" src="https://github.com/user-attachments/assets/93f88bdc-1515-41b1-a19a-856ff61b1af8" />
<img width="1920" height="1200" alt="2025-12-23_14-09-27" src="https://github.com/user-attachments/assets/d6fff499-4258-40d8-b0a1-aa736e3ac775" />
<img width="1920" height="1200" alt="2025-12-23_14-10-13" src="https://github.com/user-attachments/assets/70d4d784-d55e-4e7f-b4a3-7dafb970ead8" />
<img width="1920" height="1200" alt="2025-12-23_14-11-47" src="https://github.com/user-attachments/assets/5e1069ab-4b9c-4c5e-9933-ea65700c8dd2" />
<img width="1920" height="1200" alt="2025-12-23_14-12-32" src="https://github.com/user-attachments/assets/d573f395-bd4d-42e4-9c2c-8cb6f66160b9" />
<img width="1920" height="1200" alt="2025-12-23_14-13-43" src="https://github.com/user-attachments/assets/2d0981da-0f9f-4779-a0ad-fbeb9c1edd4c" />
<img width="1920" height="1200" alt="2025-12-23_14-16-27" src="https://github.com/user-attachments/assets/d0416c26-15d3-4305-85ab-f8f3c4e14ed1" />
<img width="1920" height="1200" alt="2025-12-23_14-17-32" src="https://github.com/user-attachments/assets/a4779868-9301-4759-95c2-50a49191d07b" />
<img width="1920" height="1200" alt="2025-12-23_14-18-23" src="https://github.com/user-attachments/assets/e19a7bd9-297a-4a1f-8d0b-5c21cb201d7d" />
<img width="1920" height="1200" alt="2025-12-23_14-19-41" src="https://github.com/user-attachments/assets/b73d00e3-5be5-4d24-b086-4331045adc20" />
<img width="1920" height="1200" alt="2025-12-23_14-20-28" src="https://github.com/user-attachments/assets/bfebbee6-13f5-431d-9108-72e31f35f8bc" />
<img width="1920" height="1200" alt="2025-12-23_14-23-03" src="https://github.com/user-attachments/assets/453c497d-d129-47af-b9d6-ce9a65997897" />
<img width="1920" height="1200" alt="2025-12-23_14-24-22" src="https://github.com/user-attachments/assets/278e532e-c593-48b6-94df-41aa8ed8f18c" />
<img width="1920" height="1200" alt="2025-12-23_14-30-06" src="https://github.com/user-attachments/assets/107a5b9b-b745-4f24-b4f6-6ba973e199e6" />
<img width="1920" height="1200" alt="2025-12-23_14-31-48" src="https://github.com/user-attachments/assets/b913cca5-e222-48b0-a8ff-3d72564d8066" />
<img width="1920" height="1200" alt="2025-12-23_14-33-42" src="https://github.com/user-attachments/assets/b4921d24-43e3-4d24-8ef5-42c26aad2b2d" />
<img width="1920" height="1200" alt="2025-12-23_14-34-29" src="https://github.com/user-attachments/assets/f63ef538-3774-408a-ab2e-00cd48be32fe" />
<img width="1920" height="1200" alt="2025-12-23_14-36-03" src="https://github.com/user-attachments/assets/6b67447c-d00a-44a5-b218-e55038f2ee8b" />
<img width="1920" height="1200" alt="2025-12-23_14-36-57" src="https://github.com/user-attachments/assets/3206670b-5fe3-46aa-824c-ad10aafaacb7" />
<img width="1920" height="1200" alt="2025-12-23_14-37-55" src="https://github.com/user-attachments/assets/e33d9e78-2091-4f68-888f-3910f0a4340c" />
<img width="1920" height="1200" alt="2025-12-23_14-38-32" src="https://github.com/user-attachments/assets/34b5b90a-e8d9-42b4-97a8-ad1cab727e51" />
<img width="1920" height="1200" alt="2025-12-23_14-41-53" src="https://github.com/user-attachments/assets/2d4aa950-9edf-46db-8746-d4426e42d679" />
<img width="1920" height="1200" alt="2025-12-23_14-42-39" src="https://github.com/user-attachments/assets/333c8348-96b4-4e1e-90e9-3cb57d58807a" />
<img width="1920" height="1200" alt="2025-12-23_14-43-41" src="https://github.com/user-attachments/assets/4c7db5be-7594-48a9-a861-d91dbabb3c25" />
<img width="1920" height="1200" alt="2025-12-23_14-44-22" src="https://github.com/user-attachments/assets/4f0f99ef-64f1-4f22-b89e-22b16b137e3b" />

## License

The 'Converter pdf to jpeg' is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Third-Party Licenses
This project uses third-party software components. Their respective licenses can be found in the LICENSE-3rd-party.md file.
