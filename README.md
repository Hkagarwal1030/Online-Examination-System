# Online-Examination-System
🧠 Online Examination System (PHP + MySQL)
















A complete web-based online examination platform that allows users to register, log in, take exams, and view their results.
Includes user authentication, an MCQ exam module, scoring logic, and a clean UI from your style.css file.

✨ Features
👤 User Module

User Registration (Name, Email, Password)

Secure Login & Logout (Session-based authentication)

Dashboard / Exam navigation

📝 Exam Module

Auto-loaded questions from database

Multiple-choice questions (MCQs)

Clean question layout using .question & .options UI styles

Automatic evaluation upon submission

📊 Result Module

Instant display of correct vs. wrong answers

Styled result box using .result.good and .result.bad classes

Score-based feedback

🗄️ Admin / Database Module

SQL schema for:

users table

questions table

Sample MCQs included

Persistent exam data stored in MySQL

Modular db.php for database connection

📂 Project Structure
/online-exam-system
│── index.php          → Homepage / Login page
│── register.php       → User registration form
│── login.php          → User login handler
│── exam.php           → Loads and displays MCQs
│── submit.php         → Evaluates answers and shows results
│── logout.php         → Ends session
│── db.php             → Database connection
│── sqlp.sql           → Complete database schema & sample questions
│── style.css          → UI styling
│── README.md

🗄️ Database Schema

Your SQL file (sqlp.sql) includes the full setup:


sqlp

Users Table

Stores registered users.

Questions Table

Stores MCQs with options and correct answers.

Sample Questions Included

Math

Programming

HTML fundamentals

To import the database:

Open phpMyAdmin

Create a database named:

online_exam


Import the file:

sqlp.sql

🎨 UI Styling (From style.css)

The project uses a clean container-based layout:


style

Light grey background

White card-style containers

Blue buttons (#2e86de)

Styled question blocks

Result highlighting:

Green box for passing scores

Red box for failing scores

Responsive form controls

⚙️ Configuration

Update database connection in db.php:

$conn = new mysqli("localhost", "root", "", "online_exam");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

🚀 How to Run the Project
1️⃣ Move project to server folder

For XAMPP:

htdocs/online-exam-system/

2️⃣ Start Apache & MySQL
3️⃣ Import the database

Using sqlp.sql.

4️⃣ Open the system in browser:
http://localhost/online-exam-system/

5️⃣ Register → Login → Start Exam → Submit → View Results
🔐 Security Notes

Password hashing recommended (password_hash())

SQL queries should use prepared statements

Sessions already secure login & exam access

📌 Future Enhancements

Admin panel to add/edit/delete questions

Timer-based examination module

Analytics dashboard

Negative marking

Randomized question order

Certificate generation

Mobile-responsive redesign

🤝 Contributing

Contributions are welcome!

Fork the repo

Create a feature branch

Commit changes

Create a Pull Request

📄 License

This project is licensed under the MIT License.
