# Study Abroad Consultancy ERP System

A full-scale ERP and Lead Management System built with **Laravel** and **Livewire** for Study Abroad Consultancy businesses.

This system is designed to manage the complete student lifecycle — from inquiry generation (including Meta Ads leads) to counselor assignment, registration, document management, and application processing.

---

## Project Overview

This ERP system centralizes operations for study abroad agencies by handling:

- Lead capture & tracking
- Counselor assignment workflows
- Inquiry lifecycle management
- Student registration process
- Document storage & verification
- Meta (Facebook) Ads lead tracking
- WhatsApp conversation tracking
- Status history & performance monitoring

The system was built to automate manual processes and increase operational efficiency for high-volume consultancy businesses.

---

## Core Modules

### 1. Inquiry Management Module
- Lead creation & tracking
- Multi-status workflow (Hot, Cold, Dead, Pending, Registered)
- Status history tracking
- Counselor assignment logic
- Previous assignment tracking
- Country, course & budget tracking
- Dual phone support
- Real-time updates via Livewire

---

### 2. Meta Ads & Campaign Tracking
- Meta Lead ID storage
- WhatsApp conversation ID tracking
- Ad ID & Campaign ID mapping
- Campaign country identification (UK, US, AU, etc.)
- Meta sync status management
- Raw JSON lead data storage
- Sync attempt tracking & logging

This allows performance analysis per campaign & country.

---

### 3. Registered Student Module
Once an inquiry converts, it moves into the registration workflow:

- Unique student ID system
- Parent-child inquiry linking
- Passport & personal data management
- Course & intake tracking
- University management
- Counselor re-assignment tracking
- Status change timestamp logging
- Partner & internal notes management

---

### 4. Document Management System

Secure storage of:

- Academic documents (Matric, Intermediate, BS, MS, etc.)
- CV uploads
- Passport scans
- Experience letters
- English test certificates
- Reference letters
- Consent forms
- Additional custom documents (10+ dynamic fields)

---

### 5. Assignment & Workflow Engine

- Role-based assignment
- Status change tracking
- Previous handler tracking
- Assignment timestamps
- Internal notes & history logs

---

## Tech Stack

- **Laravel** (Backend Framework)
- **Livewire** (Reactive UI Components)
- **MySQL** (Relational Database)
- **Tailwind CSS / Bootstrap**
- **Alpine.js / JavaScript**
- RESTful architecture principles

---

## Key Architectural Highlights

- Modular migration structure
- Status tracking with history preservation
- Self-referencing relationships (parent-child registration linking)
- Foreign key integrity enforcement
- Campaign-based analytics support
- Real-time UI updates using Livewire
- Structured document storage paths
- Scalable ERP design pattern

---

## My Role

- Designed complete database architecture
- Built all backend logic & relationships
- Implemented Livewire components
- Developed status workflow engine
- Integrated Meta Ads tracking fields
- Created document upload & management system
- Implemented assignment & tracking logic

---

## Screenshots

(Add screenshots here)

Example:
![Login](public/screenshots/login.png)

![Admin Dashboard](public/screenshots/admin-dashborad.png)
![Admission Agent](public/screenshots/admission-agent.png)
![Admission Manager](public/screenshots/admission-manager.png)
![Assign Inquiries](public/screenshots/assign-inquiries.png)
![Counsellor Dashboard](public/screenshots/counsellor-dashborad.png)
![Daily Report Status](public/screenshots/daily-report-status.png)
![External Agent Dashboard](public/screenshots/externalagent-dashboard.png)
![Hot Leads](public/screenshots/hot.png)
![Import](public/screenshots/import.png)
![Individual Performance](public/screenshots/individual-performance.png)
![Inquiry](public/screenshots/inquiry.png)
![Inquiry Details](public/screenshots/inquiry-details.png)

![Portal Log](public/screenshots/Portal-Log.png)
![Reassign Inquiries](public/screenshots/reassign-inquiries.png)
![Register](public/screenshots/register.png)
![Registered Details](public/screenshots/regisytered-details.png)
![Report](public/screenshots/report.png)
![Roles & Permission](public/screenshots/roles-permission.png)
![Teams Creation](public/screenshots/teams-creation.png)
![Teams Performance](public/screenshots/teams-performance.png)
![Users Page](public/screenshots/users-page.png)


---

## ⚙ Installation Guide

```bash
git clone https://github.com/AhmadAli61/Study-Abroad-Consultancy-ERP-System.git
cd Study-Abroad-Consultancy-ERP-System
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve
