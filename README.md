<p align="center" style="display: flex; gap: 50px; margin: 50px auto 50px auto; justify-content: center;">
<a href="https://exposia.nl" target="_blank"><img src="https://rapide.nl/storage/app/media/logos/exposia-logo.svg" width="250" alt="Exposia Logo"></a>
<a href="https://admin.bakku.cloud" target="_blank"><img src="https://admin.bakku.cloud/img/logo-bakku-8285dc3fbbae923c5dd447120ec7e5aa.svg?vsn=d" width="250" alt="Bakku Logo"></a>
</p>

## About BakkuClient
BakkuClient is a simple client for the Bakku API. Easily create a website with the Bakku API.

<hr>

## Features
- [x] Pages
- [x] Components
- [x] Forms
- [x] Caching
- [x] Error handling
- [x] Fully customizable

<hr>

## Usage
First register your website on Bakku. Then generate a api_key for your website.

#### 1. Fill in the BAKKU_SITE_ID and BAKKU_API_KEY in the .env file
```bash
BAKKU_SITE_ID={{YOUR_SITE_ID}}
BAKKU_API_KEY={{YOUR_API_KEY}}
```

#### 2. Create or edit the pages in /resources/views/pages/

#### 3. Create or edit the components in /resources/views/components/, if you need an extra component use
```bash
php artisan make:component {{ComponentName}}
```

<hr>

## Installation

#### 1. Fork the repository

#### 2. Clone the repository
```bash
git clone https://github.com/rapideinternet/{{REPO_NAME}}.git
```

#### 3. Go to the project directory
```bash
cd {{REPO_NAME}}
```

#### 4. Install composer dependencies
```bash
composer install
```

#### 5. Copy the .env.example file and rename it to .env
```bash
cp .env.example .env
```

#### 6. Generate a new application key
```bash
php artisan key:generate
```

#### 7. Run the migrations
```bash
php artisan migrate
```

#### 8. Install npm dependencies
```bash
npm install
```

#### 9. Compile the assets
```bash
npm run build
```

#### 10. Run the application
```bash
php artisan serve
```

<hr>

## License
This client is made by Exposia and is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
