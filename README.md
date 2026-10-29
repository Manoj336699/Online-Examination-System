# Online Examination System

A web-based Online Examination System developed as part of a BCA project using PHP, MySQL, HTML, CSS, and Bootstrap.

## Project Overview

The Online Examination System provides an interface for administrators to manage students, subjects, examinations, questions, and results. Students can log in, view available examinations, take exams, and check their results.

## Technologies Used

* PHP
* MySQL
* HTML5
* CSS3
* Bootstrap
* JavaScript
* XAMPP
* Visual Studio Code
* Git and GitHub

## Features

### Admin Module

* Admin login and logout
* Admin dashboard
* Student management (Create, Read, Update, Delete)
* Subject management (Create, Read, Update, Delete)
* Examination management
* Question management
* Results management
* Password change functionality

### Student Module

* Student login and logout
* Student dashboard
* View available examinations
* Attempt examinations
* Submit examination answers
* View examination results

## Installation and Setup

1. Install XAMPP.
2. Clone or download this repository into the XAMPP `htdocs` directory.
3. Start Apache and MySQL using the XAMPP Control Panel.
4. Open phpMyAdmin.
5. Create the required MySQL database.
6. Import the project's SQL database file, if provided.
7. Configure the database connection in `includes/db.php`.
8. Open the application in your browser using the appropriate localhost URL.

## Project Directory Structure

```text
OnlineExamSystem/
├── admin/
│   ├── exams/
│   ├── questions/
│   ├── results/
│   ├── students/
│   └── subjects/
├── assets/
├── includes/
├── student/
├── .gitignore
├── README.md
└── index.php
```

## Security Notes

* Do not commit database passwords, API keys, or other sensitive credentials.
* Use password hashing for stored passwords.
* Validate user input and use prepared SQL statements.
* Protect administrative and examination pages with authentication and authorization checks.

## Future Enhancements

* Examination timer
* Automatic result calculation
* Question randomization
* Improved reporting and analytics
* Responsive user interface enhancements

## Author

Manoj336699

## License

No license has been specified. All rights remain with the respective copyright holder unless permission is granted.
