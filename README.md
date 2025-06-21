# EMS Advanced Developer Challenge: Event Payment Management Feature

This Laravel 11 project implements a full-featured Event Payment Management system for the finance team, enabling management of payment methods for each event and linking these to companies, including VAT settings and new provider request workflows.

---

## 🚀 Features

- Role-based access for Finance users
- Assign payment methods, VAT rates, and companies to events
- Request implementation of new payment providers
- View and update status of payment provider requests (approve/reject)
- RESTful API to expose relevant data
<!-- - Email notifications for configuration updates and request status changes -->
- Clean UI using Bootstrap and AJAX
- Unit and Feature tests for key workflows

---

## 📁 Project Structure & Flow

### 1. Models

- **Event**: name, location, date, description
- **PaymentMethod**: name, type, website
- **Company**: name, bank_account, vat_rate
- **EventPayment**: event ↔ payment method ↔ company + vat_rate
- **PaymentProviderRequest**: new provider request with status tracking

### 2. Controllers

#### 🔹 FinanceController
- `index()` – Finance Dashboard
- `editPayment($eventId)` – Show assignment form
- `updatePayment(Request $request)` – Save event payment config
- `requestPaymentProvider()` – Show provider request form
- `storePaymentProviderRequest()` – Handle new provider request

#### 🔹 EventPaymentController
- `store()` – Create event payment configuration
- `update()` – Update event payment configuration

#### 🔹 PaymentProviderRequestController
- `store()` – Submit new provider request
- `updateStatus()` – Approve/Reject requests

---

### 3. API Endpoints

| Endpoint                         | Method | Description                                  |
|----------------------------------|--------|----------------------------------------------|
| `/api/events`                   | GET    | List events with payment configs             |
| `/api/payment-methods`         | GET    | List all payment methods                     |
| `/api/companies`               | GET    | List all companies                           |
| `/api/payment-provider-requests` | GET  | List provider requests with statuses         |

---

<!-- ### 4. Email Notifications

- Sent to finance team upon successful configuration
- Sent to relevant users on provider request submission and status updates

--- -->

## 🛠️ Setup Instructions

1. **Clone the repository**

   ```bash
   git clone git@github.com:shobhitkashyap/ems-payments.git
   cd ems-payments
