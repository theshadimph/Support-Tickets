<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
SupportFlow: Modern Role-Based Help Desk System

Overview
SupportFlow is a robust, single-page application built on Laravel designed to streamline customer support and internal incident management. It enforces a clean, efficient three-tiered workflow, ensuring that issues are properly submitted, tracked, assigned, and resolved by the appropriate support staff.

This system is ideal for small to medium teams looking for a centralized platform where managers have full control over delegation and clients have a transparent view of their request progress.
Key Features
The entire system is governed by clear Role-Based Access Control (RBAC), providing distinct experiences for every user type:

1. Client Experience (Submitter)
Easy Submission: Clients can quickly create new tickets, including a detailed description and optional photo attachments to better illustrate the issue.
My Tickets: Clients can only view and track the status of tickets they have personally submitted.
Communication: Clients can participate in the continuous communication thread by posting comments on their active tickets.

2. Employee Experience (Fulfiller)
Assigned Workload: Employees only see tickets that have been explicitly assigned to them by a manager.
Status Management: Employees can update the status of assigned tickets (e.g., to "In Progress" or "Complete").
Collaboration: They can engage with the client and other assigned team members through the comments section.

3. Manager Experience (Administrator)
Full Oversight: Managers have a comprehensive view of all tickets in the system, regardless of status or assignment.
Dynamic Assignment & Reassignment:  On the ticket detail page, managers are provided with a dedicated panel to assign or reassign tickets to one or more employees using a multi-select interface.
Control: Managers can change any ticket's status and have the exclusive ability to permanently delete tickets.
Team Directory: Access to a list of all active support staff (Employees and other Managers) for quick team visibility.

Technical Stack
This project leverages modern PHP and front-end tools for performance and maintainability:
Backend Framework: PHP 8.2+ with Laravel (v10/v11)
Database: Configured for MySQL or SQLite.
Styling: Tailwind CSS for rapid and responsive UI development.
View Layer: Laravel Blade templates.
Core Components: Utilizes custom Blade components (x-form-select, x-form-textarea, etc.) for clean, reusable UI elements.
Security: Implements built-in Laravel Policies for granular control over actions (e.g., deleting a ticket, assigning a ticket).
Data Relationships: Eloquent relationships are heavily utilized for complex associations (e.g., Manager-to-Employee via Pivot Table for ticket assignment).


Getting Started

To run this project locally:
Clone the Repository:
git clone Support-Tickets

Install Dependencies:
composer install
npm install && npm run dev
Configure Environment: Copy .env.example to .env and configure your database settings.

Run Migrations & Seeding:
php artisan migrate --seed
(Seeding is necessary to create initial user roles: Client, Employee, Manager)

Serve the Application:
php artisan serve
Access the application at http://127.0.0.1:8000.
>>>>>>> 2e623dc72ce790efa89ea1d8625c5418c954576b
