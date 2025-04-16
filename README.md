# 🎓 Student Registration System

A full-stack web application that enables users to register, search, view, and delete student records. This system is built using **PHP**, **MySQL**, **HTML/CSS**, and **JavaScript** to demonstrate CRUD operations with a modern UI and responsive design.

---

## 🚀 Live Demo

*Currently not deployed. You can run it locally using XAMPP or any other local server setup.*

---

## 📌 Features

- 🔐 **Secure Data Handling**: Uses prepared statements and basic validation for safe data storage.
- 📝 **Register Students**: Add new student data with all essential details.
- 📖 **View All Records**: See all registered students in a styled table.
- 🔍 **Search Functionality**: Search for students by ID or name.
- 🗑️ **Delete Students**: Confirmation modal popup before deletion ensures safe data handling.
- ✨ **Responsive UI**: Clean and interactive design using CSS and JavaScript.

---

## 🛠️ Tech Stack

| Frontend   | Backend | Database | Styling  |
|------------|---------|----------|----------|
| HTML5      | PHP     | MySQL    | CSS3     |
| JavaScript |         |          | Modals, Effects |

---

## 📂 Project Structure


---

## 📦 Database Setup

**Database Name:** `student_db`  
**Table Name:** `students`

**Table Schema:**

| Column        | Type         | Description               |
|---------------|--------------|---------------------------|
| student_id    | VARCHAR(50)  | Unique student ID         |
| name          | VARCHAR(100) | Full name of the student  |
| email         | VARCHAR(100) | Student email address     |
| phone         | VARCHAR(15)  | Contact number            |
| course        | VARCHAR(100) | Course enrolled           |
| address       | TEXT         | Home address              |
| date_of_join  | DATE         | Enrollment date           |

---

## 🧪 How to Run Locally

### ✅ Prerequisites
- PHP (>=7.0)
- MySQL
- Local server environment like **XAMPP**, **WAMP**, or **MAMP**

### 🛠 Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/student-registration-system.git
   cd student-registration-system
