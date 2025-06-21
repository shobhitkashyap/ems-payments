# 📦 EMS Advanced Developer Challenge: Event Payment Management Feature

This Laravel 11 project implements a complete **Event Payment Management System** for the finance team. It allows assigning payment methods, VAT rates, and companies to events, along with the ability to request new payment providers and manage their approval workflow.

---

## 🚀 Features

- 🔐 Role-based access control (Finance users only)
- 🏦 Assign payment methods, VAT rates, and link companies per event
- 🧾 Request new payment providers with approval flow
- 🔁 Approve/Reject provider requests
- 🌐 RESTful API for events, payments, and providers
<!-- - 📧 Email notifications for configurations and requests -->
- 🎨 Clean UI with Bootstrap and AJAX interactions
- ✅ Unit and Feature tests for critical flows

---

## 🧩 Project Structure

### 📄 Models

- **Event** – name, location (enum), date, description
- **PaymentMethod** – name (enum), type (enum), website
- **Company** – name (enum), bank_account, vat_rate
- **EventPayment** – links event ↔ payment_method ↔ company with VAT
- **PaymentProviderRequest** – captures provider name, site, event, company, and request status

### 📂 Controllers

#### `FinanceController`
- `index()` – Show finance dashboard with event list
- `editPayment($eventId)` – Form to manage event payments
- `updatePayment(Request $request)` – Save assignments
- `requestPaymentProvider()` – Show new provider request form
- `storePaymentProviderRequest()` – Submit request

#### `EventPaymentController`
- `store()` – Add payment config to an event
- `update()` – Update existing payment config

#### `PaymentProviderRequestController`
- `store()` – Submit a new provider request
- `updateStatus()` – Approve or reject requests

---

## 📡 API Endpoints

| Endpoint                           | Method | Description                              |
|------------------------------------|--------|------------------------------------------|
| `/api/events`                      | GET    | List events with payment configurations  |
| `/api/payment-methods`            | GET    | List of available payment methods        |
| `/api/companies`                  | GET    | List of companies                        |
| `/api/payment-provider-requests` | GET    | List of provider requests with status    |

---

<!-- 
## 📬 Email Notifications

- Email sent upon successful payment setup
- Email sent when a provider request is submitted or its status changes
 -->

---

## ⚙️ Setup Instructions

### 1. 📥 Clone the repository

```bash
git clone git@github.com:shobhitkashyap/ems-payments.git
cd ems-payments
---

2. 🧰 Install Dependencies
Install PHP and Laravel dependencies:

    composer install
    composer dumpautoload
    php artisan optimize:clear

3. ⚙️ Configure Environment Variables

cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

4. 🗄️ Run Database Migrations and Seeders
Run the following to migrate the database and seed initial data:

php artisan migrate
php artisan db:seed

5. ▶️ Start the Application

php artisan serve