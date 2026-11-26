# AgriConnect — Agriculture Information System

A responsive Core PHP/MySQL mini-project for farmer information, accounts, contact messages and administrator-managed content.

## Requirements

- XAMPP with Apache, MySQL/MariaDB and PHP 8.0+ (PDO MySQL and `mbstring` enabled)
- A modern browser and an internet connection for the Bootstrap stylesheet and sample image URLs (the application itself runs locally)

## Project structure

```text
agriculture-project/
├── admin/
│   ├── inbox.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   └── manage.php
├── assets/
│   ├── css/style.css
│   └── js/app.js
├── config/database.php
├── database/agriculture_db.sql
├── includes/
│   ├── footer.php
│   ├── functions.php
│   └── header.php
├── contact.php
├── crops.php
├── dashboard.php
├── index.php
├── login.php
├── logout.php
├── prices.php
├── register.php
├── resources.php
├── schemes.php
├── setup.php
└── weather.php
```

## Run with XAMPP

1. Copy the project folder into `C:\xampp\htdocs\agriculture-project`.
2. Start **Apache** and **MySQL** from the XAMPP Control Panel.
3. Open `http://localhost/phpmyadmin`, choose **Import**, select `database/agriculture_db.sql`, and run the import. The SQL creates `agriculture_db` and sample records.
4. If your local MySQL credentials differ from XAMPP defaults, edit `config/database.php`. The supplied defaults use host `127.0.0.1`, database `agriculture_db`, username `root`, and an empty password.
5. Visit `http://localhost/agriculture-project/setup.php` once. The first visit creates the local demonstration administrator if one does not already exist. Sign in at `/admin/login.php` with **admin / Admin@123**.
6. Register a farmer at `/register.php`, then sign in at `/login.php`. Admin content changes are shown on the public information pages and farmer dashboard.
7. Remove or disable `setup.php` before exposing the application beyond a local development machine. Change the demonstration administrator password before any shared use.

## Features

- Farmer registration and login with PHP sessions and `password_hash` / `password_verify`
- CSRF tokens on state-changing forms, HTML output escaping and prepared PDO statements
- Farmer dashboard with database-backed counts, latest prices, weather and scheme highlights
- Crop details, market price comparison/history, weather, government schemes and resource pages
- Farmer query and feedback submissions, stored separately and viewable by administrators
- Administrator login and create/read/update/delete management for crops, market prices, weather, schemes and resources
- Administrator views for registered farmers, queries and feedback

## Notes

- Seeded market prices and weather are **illustrative sample data**, not live or official feeds. They should not be used to make financial or farming decisions.
- Scheme eligibility and required documents can change. Sample copy points users to official portals; always confirm current rules with the relevant government office.
- The project intentionally does not collect or store live weather/market API credentials. Admins can update the demonstration content in the admin panel.
- For deployment, use HTTPS, a dedicated least-privilege MySQL account, secure PHP/session settings, backups, reviewed administrator password changes, and remove local setup utilities.
