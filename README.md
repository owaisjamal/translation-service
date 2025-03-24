Translation Management Service
📌 Overview

The Translation Management Service is a scalable API-driven solution designed to store and manage translations in multiple locales. It supports tagging translations, efficient searching, and exporting translations as JSON for frontend applications. The service follows PSR-12 standards, adheres to SOLID principles, and ensures high performance and security.

🚀 Features

✔ Store translations in multiple locales (e.g., en, fr, es) <br>
✔ Tag translations for context (e.g., mobile, desktop, web) <br>
✔ API endpoints to create, update, view, and search translations <br>
✔ JSON export endpoint for frontend applications like Vue.js <br>
✔ Optimized performance (response time < 200ms) <br>
✔ Handle 100K+ records efficiently <br>
✔ Token-based authentication using Laravel Sanctum <br>
✔ Docker setup for easy deployment <br>
✔ Test coverage <br>

🛠 Installation Guide <br>

1️⃣ Prerequisites

Ensure you have the following installed:

    PHP 8.1+
    Composer
    Docker & Docker Compose
    MySQL 8.0+

Step-by-Step Setup Guide

1️⃣ Clone the Repository

git clone https://github.com/owaisjamal/translation-service.git
cd translation-service

2️⃣ Set Up Environment

setup .env file according to your environment:

Update the database details in .env:

DB_CONNECTION=mysql <br>
DB_HOST=mysql <br> 
DB_PORT=3306 <br>
DB_DATABASE=translation_db <br>
DB_USERNAME=root <br>
DB_PASSWORD=password <br>

3️⃣ Start the Application (Using Docker)

Run the following command to start the containers:

docker compose up <br>

This will set up: <br>
✅ Laravel App (running on http://localhost:8000) <br>
✅ MySQL Database (port 3307) <br>
✅ Redis (port 6380) <br>

To check if containers are running: <br>

docker ps <br>

4️⃣ Install Dependencies

composer install <br>

Run Laravel migrations and seed the database: <br>

php artisan migrate --seed <br>

To generate 100k+ translations for testing scalability, run:

php artisan db:seed --class=TranslationSeeder <br>

5️⃣ Configure Laravel Sanctum (Authentication) <br>

Run:

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider" <br>
php artisan migrate

Generate the application key: <br>

php artisan key:generate

6️⃣ Running the Application

Start the Laravel server manually (if not using Docker): <br>

php artisan serve

Now, your app is available at: <br>
http://localhost:8000
<br>

7️⃣ API Authentication
🔑 User Registration

curl -X POST "http://localhost:8000/api/register" \
     -H "Content-Type: application/json" \
     -d '{"name": "Test User", "email": "test@example.com", "password": "password", "password_confirmation": "password"}'

🔐 User Login (Get Token)

curl -X POST "http://localhost:8000/api/login" \
     -H "Content-Type: application/json" \
     -d '{"email": "test@example.com", "password": "password"}'

This will return a Bearer token. Use this token in future API requests.

🔓 User Logout

curl -X POST "http://localhost:8000/api/logout" \
     -H "Authorization: Bearer {TOKEN}"

8️⃣ API Endpoints
Method	Endpoint	Description	Auth Required <br>
POST	/api/translations	Create a new translation	✅ <br>
PUT	/api/translations/{id}	Update a translation	✅ <br>
GET	/api/translations	Fetch translations (with filters)	✅ <br>
GET	/api/export	Export translations as JSON	✅ <br>
DELETE	/api/translations/{id}	Delete a translation	✅ <br>

Example GET Request (with filters):

curl -X GET "http://localhost:8000/api/translations?locale=en&tag=mobile" \
     -H "Authorization: Bearer {TOKEN}"

9️⃣ Running Tests

To ensure everything is working, run:

php artisan test



🎯 Additional Features

✅ Dockerized Setup (Easier deployment) <br>
✅ High Performance & Scalability <br>
✅ Security Best Practices <br>
