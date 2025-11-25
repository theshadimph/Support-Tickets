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
