# Laravel EventFlow

A Laravel 12 application for event management and ticket sales.

## Overview

Laravel EventFlow provides:

- user registration and authentication
- user profile management
- event creation and editing for promoters
- public listing of online events
- ticket purchase workflow
- user ticket history

## Key Features

- authenticated user access with Laravel Breeze
- role-based event management for promoters
- event creation, editing, and private event access control
- ticket purchase with availability validation
- user profile editing and account deletion

## Important Files

- `app/Http/Controllers/EventController.php` - event lifecycle management
- `app/Http/Controllers/TicketPurchaseController.php` - ticket purchase and user tickets
- `app/Http/Controllers/ProfileController.php` - profile update and account deletion
- `app/Models/Event.php` - event model
- `app/Models/Ticket.php` - ticket model
- `app/Models/User.php` - user model with role helpers
- `resources/views/events/` - event views
- `resources/views/tickets/` - ticket views
- `resources/views/profile/` - profile view

## Requirements

- PHP ^8.2
- Laravel ^12.0
- Composer
- Node.js / npm
- SQL database (SQLite, MySQL, PostgreSQL)

## Installation

```bash
cd laravel-eventFlow
composer install
cp .env.example .env
php artisan key:generate
```

Update database credentials in `.env`, then run:

```bash
php artisan migrate
npm install
npm run dev
```

## Run

```bash
php artisan serve
```

Open `http://127.0.0.1:8000` in your browser.

## Tests

```bash
php artisan test
```

## Notes

- only promoters can create and edit events
- public event listing shows only events with `is_online = true`
- ticket purchase verifies available ticket quantity
- user roles include `promoter` and `user/promoter`
