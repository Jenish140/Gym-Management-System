PROJECT TITLE: GYM Management System

1. PROJECT OVERVIEW

This is a comprehensive, web-based management system designed for fitness centers to digitize their operations. It centralizes critical functions like membership tracking, billing, and communication, directly addressing the risks associated with paper receipts and manual data entry.

Key Features & Constraints:
The system is built using HTML, CSS, JavaScript, PHP, and MySQL. It features a unique Glassmorphic & Neumorphic UI (Dark Theme). All financial reporting and receipts display amounts in Rupees (₹). The backend utilizes PHP for all server-side processing and MySQL for secure data storage.

2. ROLE-BASED ACCESS CONTROL (RBAC)

The system enforces clear separation of data access and responsibilities across its two primary roles: the Admin and the Member.

Admin Access and Responsibilities

The Administrator has full control over the system. This includes the ability to Add, Update, Delete, and Search member records; Assign Packages and Create Bills (Log Payments); Send Notifications to all members; and Export all member data as a CSV report. Admins cannot access the Member Portal.

Member Access and Responsibilities

Members have secure, view-only access to their personal data. They can View their Details, check their current Package Status, review their complete history of Digital Bill Receipts, and read Notifications sent by the admin. Members cannot access the Admin Dashboard or other members' records.

3. PROJECT SETUP & EXECUTION STEPS

To run this project, you need a local server environment (like XAMPP).

A. Environment Setup

Start Services: Open the XAMPP Control Panel and click Start for both the Apache web server and MySQL database.

Project Placement: Place the entire gym-management project folder into the htdocs directory of your XAMPP installation (e.g., C:/xampp/htdocs/).

B. Database Configuration (MySQL)

Access phpMyAdmin: Open your web browser and navigate to http://localhost/phpmyadmin/.

Create Database: Create a new database named gym_db.

Execute SQL: Select the new gym_db and create tables(with correct name).

C. Initial Login & Testing Workflow

Access Project: Open your browser and navigate to: http://localhost/gym-management/

Admin Login: Access the Admin portal at /admin/index.php. Use the default credentials: Username: admin and Password: admin123.

Core Testing Steps:

Admin Task 1 (Add Member): Go to /admin/members.php and add a new member, assigning them an email and password.

Admin Task 2 (Billing): Go to /admin/billing.php to assign a fee package and log an initial payment for that new member.

Admin Task 3 (Notify): Send a test notification from the Admin panel.

Member Verification: Log out of the Admin panel, go to /member/index.php, and log in using the new member's credentials. Verify that the Bill Receipts and Notifications pages show the data you just created.

4. FILE STRUCTURE

The project follows a role-segmented and modular structure:

/admin/: Contains all PHP files for the Administrative functions and dashboard.

/member/: Contains all PHP files for the Member portal and view-only data access.

/css/: Stores the custom styling (style.css) for the application's unique UI.

/js/: Contains client-side JavaScript for animations and interactivity.

config.php: The central file for database connection and session configuration.

index.php: The main public landing page.
