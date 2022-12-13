
# Transactions Challenge
A simple web application for users payment transactions.

# How to Start
1. First, you should create the .env file:
```  
cp .env.example .env  
```  
2. Then run the application via `docker-compose`
```
docker-compose up --build -d
```
3.  Install the packages using composer:
```
docker-compose exec app rm -rf vendor composer.lock
docker-compose exec app composer install
```
4. Generate the  `app:key` and run the migrations and seeders as well:
```
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
```
It is ready and served on port `8000`
```
http://localhost:8000
```

You can login as admin with below credentials:

```
email: admin@info.com
password: 123456
```
