# 🌊 eventFlow

[![Laravel Version](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

An elegant, robust, and production-ready Event Management System built with **Laravel 11**. `eventFlow` streamlines the entire lifecycle of event organization—from dynamic event creation and real-time capacity tracking to automated attendee ticket generation and secure registration flows.

Designed with clean architecture, strict database integrity, and modern backend practices in mind.

---

## 🚀 Key Features

*   **📅 Full Event Lifecycle Management:** Complete CRUD operations for events with automated status handling (Draft, Active, Finished, Cancelled).
*   **🎟️ Intelligent Ticket Booking:** Real-time seat allocation with strict race-condition prevention (using database transactions).
*   **👥 Attendee & RSVP Tracking:** Seamless user registration for specific events with instant confirmation.
*   **🔍 Advanced Filtering & Search:** Search events by title, filter by date ranges, category, and real-time availability.
*   **🛡️ Robust Security & Validation:** Form requests, strict type-hinting, policy-based authorization, and protected API endpoints.

---

## 🏗️ Architecture & Tech Stack

*   **Backend Framework:** Laravel 11 (PHP 8.2+)
*   **Database:** PostgreSQL / MySQL (Fully relational with optimized indexes and foreign key constraints)
*   **Design Patterns:** Form Requests, Service Layer pattern for decoupling business logic, Eloquent API Resources for standardized JSON outputs.
*   **Authentication:** Laravel Sanctum (Token-based API authentication)

---

## 🛠️ Installation & Setup

Follow these steps to get your local development environment up and running:

### 1. Clone the Repository
```bash
git clone [https://github.com/Dav098/laravel-eventFlow.git](https://github.com/Dav098/laravel-eventFlow.git)
cd laravel-eventFlow
