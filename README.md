# Teacher Portal - Full Stack App

A full stack Teacher Management System built with CodeIgniter 4 + ReactJS + MySQL.

## Tech Stack
- **Backend:** CodeIgniter 4 (PHP)
- **Frontend:** ReactJS
- **Database:** MySQL
- **Auth:** Token Based Authentication

## How to Run

### Backend
1. Install XAMPP (PHP 8.1 + MySQL)
2. Install Composer
3. Clone this repo into `C:\xampp\htdocs\teacher-api`
4. Import `database/teacher_db.sql` into phpMyAdmin
5. Run: `php spark serve`
6. Backend runs on: `http://localhost:8080`

### Frontend
1. Install Node.js
2. Clone this repo into `C:\xampp\htdocs\teacher-frontend`
3. Run: `npm install`
4. Run: `npm start`
5. Frontend runs on: `http://localhost:3000`

## API Endpoints
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | /api/register | Register user |
| POST | /api/login | Login user |
| POST | /api/teacher | Add teacher (protected) |
| GET | /api/teachers | Get all teachers (protected) |