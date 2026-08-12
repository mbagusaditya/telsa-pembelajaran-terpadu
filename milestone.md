# LMS Development Milestones

Roadmap pengembangan Learning Management System (LMS).

> Status:
> - `[ ]` Belum dikerjakan
> - `[-]` Sedang dikerjakan
> - `[x]` Selesai
>
> Prioritas:
> - `P0` Critical / blocking
> - `P1` High
> - `P2` Medium
> - `P3` Low

---

# Phase 0 — Project Foundation

Tujuan: memastikan project dapat dijalankan dan dikembangkan dengan nyaman.

## M0.1 — Development Environment

- [x] Docker setup
- [x] FrankenPHP setup
- [x] PHP 8.4 setup
- [x] Composer setup
- [x] Bun setup
- [x] Vite setup
- [x] MySQL setup
- [x] Redis setup
- [x] Development entrypoint
- [x] Hot reload / watch mode
- [ ] Production Dockerfile
- [ ] Production Docker Compose
- [ ] Health check
- [ ] Environment documentation

## M0.2 — Laravel Foundation

- [x] Laravel installation
- [x] Application configuration
- [x] Database connection
- [ ] Cache configuration
- [ ] Queue configuration
- [ ] Storage configuration
- [ ] Mail configuration
- [ ] Logging strategy
- [ ] Exception handling strategy

## M0.3 — Development Data

- [x] Database schema design
- [ ] Initial migrations
- [ ] Initial models
- [ ] Initial factories
- [ ] Initial seeders
- [ ] Development admin account
- [ ] Development sample users
- [ ] Development sample courses
- [ ] Development sample classes

## M0.4 - Migrations, Seeders, Factories, and Models

- [x] Users
- [x] Admins
- [x] Teachers
- [x] Students
- [x] Majors
- [x] ClassGroups
- [x] Subjects
- [x] CourseOfferings
- [x] Schedules
- [x] Materials
- [ ] Assignments
- [ ] Submissions
- [ ] SubmissionGrades
- [ ] Attachments

---

# Phase 1 — Authentication & Authorization

Tujuan: membangun fondasi identitas dan akses pengguna.

## M1.1 — Authentication

- [ ] Login
- [ ] Logout
- [ ] Registration
- [ ] Email verification
- [ ] Forgot password
- [ ] Reset password
- [ ] Remember me
- [ ] Session management

## M1.2 — User Management

- [ ] User model
- [ ] User profile
- [ ] Profile photo
- [ ] Change password
- [ ] Update profile
- [ ] Account status
- [ ] User search
- [ ] User detail

## M1.3 — Roles & Permissions

- [ ] Role model
- [ ] Permission model
- [ ] Role-permission relationship
- [ ] User-role relationship
- [ ] Authorization policies
- [ ] Admin authorization
- [ ] Teacher authorization
- [ ] Student authorization

### Initial Roles

- [ ] Administrator
- [ ] Teacher
- [ ] Student

---

# Phase 2 — Academic Structure

Tujuan: membangun struktur dasar akademik LMS.

## M2.1 — Academic Year

- [ ] Academic year model
- [ ] Academic year CRUD
- [ ] Active academic year
- [ ] Academic year validation
- [ ] Academic year status

## M2.2 — Classes

- [ ] Class model
- [ ] Class CRUD
- [ ] Class code
- [ ] Class capacity
- [ ] Assign teacher
- [ ] Assign students
- [ ] Class status

## M2.3 — Subjects

- [ ] Subject model
- [ ] Subject CRUD
- [ ] Subject code
- [ ] Subject description
- [ ] Subject status

## M2.4 — Teacher Assignment

- [ ] Assign teacher to subject
- [ ] Assign teacher to class
- [ ] Teacher subject list
- [ ] Teacher class list

---

# Phase 3 — Course Management

Tujuan: memungkinkan teacher membuat dan mengelola materi pembelajaran.

## M3.1 — Courses

- [ ] Course model
- [ ] Course CRUD
- [ ] Course title
- [ ] Course description
- [ ] Course thumbnail
- [ ] Course status
- [ ] Course visibility

## M3.2 — Course Structure

- [ ] Course sections
- [ ] Course ordering
- [ ] Lesson model
- [ ] Lesson CRUD
- [ ] Lesson ordering
- [ ] Lesson visibility

## M3.3 — Learning Materials

- [ ] Text material
- [ ] File material
- [ ] Video material
- [ ] External link material
- [ ] Material download
- [ ] Material preview
- [ ] Material ordering

## M3.4 — Course Enrollment

- [ ] Enroll student
- [ ] Unenroll student
- [ ] Course member list
- [ ] Enrollment status
- [ ] Enrollment date

---

# Phase 4 — Assignment & Submission

Tujuan: membangun sistem tugas dan pengumpulan tugas.

## M4.1 — Assignment

- [ ] Assignment model
- [ ] Assignment CRUD
- [ ] Assignment description
- [ ] Start date
- [ ] Due date
- [ ] Maximum score
- [ ] Attachment support
- [ ] Assignment status

## M4.2 — Submission

- [ ] Submission model
- [ ] Submit assignment
- [ ] Update submission
- [ ] Submission status
- [ ] Submission timestamp
- [ ] Submission file
- [ ] Submission history
- [ ] Late submission detection

## M4.3 — Grading

- [ ] Grade submission
- [ ] Score
- [ ] Feedback
- [ ] Teacher review
- [ ] Revision request
- [ ] Grade history
