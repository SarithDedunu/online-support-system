# Laravel Support System

## 📌 Project Overview

This project is a web-based **Support Ticket System** built using Laravel. It allows customers to submit support requests, receive a unique reference number, and track their tickets without requiring user registration.

The system is developed to demonstrate how user requirements (user stories) can be converted into application features while applying core Laravel concepts such as MVC architecture, routing, controllers, models, migrations, and validation.

---

## 🎯 Features

### 👤 Customer Features

* Create a support ticket
* Receive a unique ticket reference number
* View ticket details using the reference
* Track ticket status
* Reply to existing tickets

### 👨‍💻 Support Agent Features

* View all support tickets
* Search tickets by reference
* View customer details and ticket history
* Reply to tickets
* Update ticket status (new, in progress, resolved, closed)

---

## 🌿 Git Workflow

This project follows a **feature branch workflow**:

* `main` → stable base project
* `feature/ticket-creation-and-view`
* `feature/ticket-replies`
* `feature/agent-ticket-management`
* `feature/ticket-status`
* `feature/notifications`

Each feature is developed in a separate branch and merged into the `main` branch.

---

## 🧱 System Design

The application follows the **MVC (Model-View-Controller)** architecture:

* **Model** → Handles database operations (`Ticket`, `TicketReply`)
* **View** → User interface using Blade templates
* **Controller** → Handles business logic and request processing

---

## ⚙️ Installation Guide

### 1. Clone the Repository

```bash id="j0k9dp"
git clone <your-repo-url>
cd support-system
```

### 2. Install Dependencies

```bash id="6p73rd"
composer install
```

### 3. Setup Environment

```bash id="kp8g3x"
cp .env.example .env
```

Update database configuration:

```env id="4qz5o9"
DB_DATABASE=support_system
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash id="6e0cs2"
php artisan key:generate
```

### 5. Run Migrations

```bash id="lzt6zj"
php artisan migrate
```

### 6. Start the Server

```bash id="y9c1xr"
php artisan serve
```

Visit:

```id="0zq79s"
http://127.0.0.1:8000
```

---

## 📚 Learning Objectives

* Convert user stories into application features
* Design and manage database schema using migrations
* Implement CRUD operations in Laravel
* Use routing, controllers, and models effectively
* Apply validation and CSRF protection
* Practice feature-based development using Git branching

---

## 🚀 Future Improvements

* Email notifications for ticket updates
* Support agent authentication system
* Ticket categorization
* File attachments for tickets
* Improved UI using Bootstrap or Tailwind

---

## 👤 Author

* Sarith Dedunu

---
