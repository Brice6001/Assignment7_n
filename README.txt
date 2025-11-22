Google-style Mini Social Login System (XAMPP)
-------------------------------------------

How to install (Windows + XAMPP):
1. Extract this project folder into: C:\xampp\htdocs\google_mini_social_project
2. Start Apache and MySQL from XAMPP Control Panel.
3. Open phpMyAdmin (http://localhost/phpmyadmin) and import the SQL file located at /sql/database.sql
   OR run the SQL in the SQL tab.
4. Visit: http://localhost/google_mini_social_project/signin.php
5. Create an account or use sample user: student1 / password123
6. After login you will be redirected to dashboard; use "Open Student CRUD" to access CRUD.

Files included:
- signup.php, signin.php, dashboard.php, google_mock.php, logout.php
- config.php (set DB credentials if different)
- /css/style.css
- /crud (index.php, add.php, edit.php, delete.php, config.php)
- /sql/database.sql
- UI mockups and Assignment 7 PDF included in /assets

Notes:
- This mock Google login does NOT use Google's API. It only simulates a successful login.
- For submission: include UI mockups and one-page report (see report.txt).
