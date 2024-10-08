# Laravel Project

Welcome to the Laravel project! This README will guide you through setting up the project on your local environment. Follow the steps below to get started.

## Prerequisites

Before you begin, ensure you have the following tools installed:

-   **PHP** (>= 8.2)
-   **Composer** (Dependency Manager for PHP)  
    If you don’t have Composer installed, download and install it from [getcomposer.org](https://getcomposer.org/download/).

## Getting Started

1.  **Clone the repository:**

    Clone the repository using the command below:

         git clone https://github.com/tusharnain4578/tabler-admin

2.  **Navigate to the project directory:**

        cd tabler-admin

3.  **Install dependencies:**

    Use Composer to install all the project dependencies:

        composer install

4.  **Set up environment variables:**

    Copy the `.env.example` file to `.env`:

        cp .env.example .env

5.  Then generate the application key:

        php artisan key:generate

6.  **Set up the database:**

    Update your `.env` file with the correct database information (e.g., DB_DATABASE, DB_USERNAME, DB_PASSWORD).

7.  **Run database migrations:**

    Run the migration command to create the database tables:

        php artisan migrate

8.  **Seed the database:**

    Run the database seeders to populate roles/permissions and initial data:

        php artisan db:seed

9.  **Start the development server:**

    Start the development server by running:

        php artisan serve

Your application should now be running at `http://localhost:8000`.

## Additional Commands

-   **Clear application cache:**

## Login Information

After seeding the database, you can use the following credentials to log in:

-   **Username:** `admin`
-   **Password:** `password`
