# Task Manager API

A robust and scalable Task Management System built with **Laravel 11** and **PHP 8.2**. This project provides a comprehensive API for managing tasks, categories, user profiles, and notifications, designed to be consumed by modern frontend applications (Vue, React, or mobile apps).

## 🚀 Key Features

- **User Authentication**: Secure API authentication using **Laravel Sanctum**.
- **Task Management**:
    - Create, Read, Update, and Delete (CRUD) tasks.
    - Prioritize tasks (High, Medium, Low).
    - Mark tasks as favorites.
    - Filter tasks by User or Category.
- **Category System**: Organize tasks into categories for better workflow management.
- **Profile Management**: Update user profiles and manage personal details.
- **Notifications**: Real-time or persistent notifications for task updates and system events.
- **Admin Features**: Endpoints to view all users and tasks (with middleware protection).
- **Log Viewing**: Integrated `opcodesio/log-viewer` for monitoring system logs.

## 🛠️ Technology Stack

- **Backend Framework**: [Laravel 11](https://laravel.com)
- **Language**: PHP ^8.2
- **Database**: MySQL / SQLite (configurable)
- **Authentication**: Laravel Sanctum
- **Frontend Tooling**: Vite, PostCSS, Tailwind CSS (configured for potential frontend integration)
- **Development Tools**:
    - [Laravel Sail](https://laravel.com/docs/sail) (Docker environment)
    - [Laravel Telescope](https://laravel.com/docs/telescope) (Debug assistant)
    - [Pest / PHPUnit](https://pestphp.com) (Testing)

## 📋 Prerequisites

Ensure you have the following installed on your local machine:

- **PHP** >= 8.2
- **Composer**
- **Node.js** & **NPM**
- **Database** (MySQL, MariaDB, or SQLite)

## 🔧 Installation

1.  **Clone the Repository**

    ```bash
    git clone https://github.com/mohammed-bashamkha/Task-Manager.git
    cd Task-Manager
    ```

2.  **Install PHP Dependencies**

    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies**

    ```bash
    npm install
    ```

4.  **Environment Configuration**
    Copy the example environment file and configure your database credentials:

    ```bash
    cp .env.example .env
    ```

    Update `.env` with your database details:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=task_manager
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations**
    Set up the database tables:

    ```bash
    php artisan migrate
    ```

    _(Optional) Seed the database with dummy data:_

    ```bash
    php artisan db:seed
    ```

7.  **Start the Development Server**
    ```bash
    php artisan serve
    ```
    In a separate terminal, run the frontend builder (if applicable):
    ```bash
    npm run dev
    ```

The API will be available at `http://localhost:8000/api`.

## 📖 API Documentation

### Authentication

- `POST /api/register` - Register a new user
- `POST /api/login` - Login and receive a Sanctum token
- `POST /api/logout` - Logout (requires token)

### Tasks

- `GET /api/tasks` - List all tasks for the logged-in user
- `POST /api/tasks` - Create a new task
- `GET /api/tasks/{id}` - Get task details
- `PUT /api/tasks/{id}` - Update a task
- `DELETE /api/tasks/{id}` - Delete a task
- `GET /api/task/ordered` - Get tasks sorted by priority

### Categories

- `GET /api/category` - List categories
- `POST /api/category` - Create a category
- `GET /api/tasks/{taskId}/categories` - Attach a category to a task

### Favorites

- `POST /api/task/{taskId}/favorite` - Add task to favorites
- `DELETE /api/task/{taskId}/favorite` - Remove task from favorites
- `GET /api/task/favorite` - List favorite tasks

## 🧪 Testing

Run the test suite to ensure everything is working correctly:

```bash
php artisan test
```

## 📄 License

This project is open-source and available under the [MIT log-viewer](https://opensource.org/licenses/MIT).
