<p align="center">
    <img src="resources/images/pegawai-logo-lockup.png" alt="Logo" width="400">
</p>

<h1 align="center">Employee Management System</h1>

<p align="center">
    A simple and lightweight employee management web app built with <strong>Laravel</strong> and styled using <strong>Tailwind CSS</strong>.<br>
    Designed for learning purposes and CRUD practice across multiple data entities.
</p>

---

## 🚀 Features Overview

This project manages five main modules, each supporting full CRUD functionality:

| Module | Description |
|---------|-------------|
| **Employees** | Add, edit, view, and delete employee data. Includes detailed profile pages. |
| **Departments** | Manage department information and associate employees with specific departments. |
| **Positions** | Handle company positions or roles for employees. |
| **Attendances** | Track and manage employee attendance records. |
| **Salaries** | Record and update salary information, linked to employee data. |

---

## 🛠️ Technologies Used

- **Laravel** — backend framework for routing, database management, and MVC structure.  
- **Tailwind CSS** — utility-first CSS framework for responsive and modern UI styling.  
- **Vite** — for fast asset bundling and development server.  

---

## ⚙️ Requirements

To run this project properly, make sure you have installed:

- **PHP 8.1+**  
- **Composer**  
- **Node.js** *(for building Tailwind and running frontend assets)*  
  → [Download Node.js here](https://nodejs.org/en/download)  

---

## 🧭 How to Run the Project

1. Clone or pull this repository:
   ```bash
   git clone https://github.com/<your-username>/pegawai.git
   cd pegawai
   ```
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install Node.js dependencies:
   ```bash
   npm install
   ```
4. Run the Laravel development server:
   ```bash
   php artisan serve
   ```
5. In a separate terminal, compile and watch frontend assets:
   ```bash
   npm run dev
   ```
6. Visit your app at [http://localhost:8000](http://localhost:8000)

---

## 🖼️ UI Screenshots

### Welcome Page

<img src="resources/images/pegawai-welcome-page.png" width="400">

### 👥 Employees
**Main Pages**
- **Index Page**

  <img src="resources/images/employees/index.png" width="400">

- **Create Page**

  <img src="resources/images/employees/create.png" width="400">

- **Edit Page**

  <img src="resources/images/employees/edit.png" width="400">

- **Show Page**

  <img src="resources/images/employees/show.png" width="400">

- **Delete (Destroy) Confirmation**

  <img src="resources/images/employees/destroy.png" width="400">

---

### 🏢 Departments
- **Index * Create Page**

  <img src="resources/images/departments/index.png" width="400">

- **Edit Page**

  <img src="resources/images/departments/edit.png" width="400">

- **Delete (Destroy) Confirmation**

  <img src="resources/images/departments/destroy.png" width="400">

---

### 💼 Positions
- **Index & Create Page**

  <img src="resources/images/positions/index.png" width="400">

- **Edit Page**

  <img src="resources/images/positions/edit.png" width="400">

- **Delete (Destroy) Confirmation**

  <img src="resources/images/positions/destroy.png" width="400">

---

### 🕒 Attendances
- **Index Page**

  <img src="resources/images/attendances/index.png" width="400">

- **Edit Page**

  <img src="resources/images/attendances/edit.png" width="400">

- **Delete (Destroy) Confirmation**

  <img src="resources/images/attendances/destroy.png" width="400">

---

### 💰 Salaries
- **Index Page**

  <img src="resources/images/salaries/index.png" width="400">

- **Create Page**

  <img src="resources/images/salaries/create.png" width="400">

- **Edit Page**

  <img src="resources/images/salaries/edit.png" width="400">

- **Delete (Destroy) Confirmation**

  <img src="resources/images/salaries/destroy.png" width="400">

---

## 🧑‍💻 Author
Developed by **Irwin Beyond** as part of the *Framework Programming Workshop* course at EEPIS (PENS).

---

<p align="center">
    <sub>Built with ❤️ using Laravel & Tailwind CSS</sub>
</p>
