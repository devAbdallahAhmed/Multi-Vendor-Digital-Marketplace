# 🚀 Pulse - Enterprise-Grade Multi-Vendor Digital Marketplace

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/MySQL-Advanced-00000F?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/Stripe-Payment-626CD9?style=for-the-badge&logo=Stripe&logoColor=white" alt="Stripe" />
  <a href="https://documenter.getpostman.com/view/36684922/2sBYAuRWMz"><img src="https://img.shields.io/badge/Postman-API_Docs-FF6C37?style=for-the-badge&logo=postman&logoColor=white" alt="Postman API Docs" /></a>
</p>

<p align="center">
  <b>A highly scalable, robust, and feature-rich Multi-Vendor Digital Marketplace built with Laravel.</b><br>
  This platform empowers authors to sell digital products (scripts, themes, audio, video) while providing a seamless purchasing experience for users and comprehensive, data-driven management tools for administrators.
</p>

---

## 📸 Platform Preview

<table align="center">
  <tr>
    <td align="center"><b>🏠 Homepage</b><br><img src="public/docs/homepagee.png" alt="Homepage" width="400"/></td>
    <td align="center"><b>🛍️ Product Page</b><br><img src="public/docs/product-page.png" alt="Product Page" width="400"/></td>
  </tr>
  <tr>
    <td align="center"><b>🛡️ Admin Dashboard (Analytics)</b><br><img src="public/docs/admin-dashboard.png" alt="Admin Dashboard" width="400"/></td>
    <td align="center"><b>👨‍💻 Author/Vendor Inventory</b><br><img src="public/docs/author-items.png" alt="Author Items" width="400"/></td>
  </tr>
  <tr>
    <td align="center"><b>🛒 Dynamic Cart & Checkout</b><br><img src="public/docs/cart-page.png" alt="Cart Page" width="400"/></td>
    <td align="center"><b>💳 Secure Payment Gateway</b><br><img src="public/docs/paymnt-page.png" alt="Payment Page" width="400"/></td>
  </tr>
  <tr>
    <td align="center"><b>📂 Category Management</b><br><img src="public/docs/all-category.png" alt="Categories" width="400"/></td>
    <td align="center"><b>🔌 API Documentation</b><br><img src="public/docs/postman-doc.png" alt="Postman Docs" width="400"/></td>
  </tr>
</table>

---

## 🏗️ Software Architecture & Design Patterns

Built with scalability and maintainability in mind, the backend strictly follows the **Repository** and **Service** patterns. This ensures thin controllers, reusable business logic, and a decoupled data access layer.

```text
📦 Pulse-Marketplace
 ┣ 📂 app
 ┃ ┣ 📂 Http
 ┃ ┃ ┣ 📂 Controllers (Separated: Admin, Frontend, Vendor API logic)
 ┃ ┃ ┗ 📂 Requests (Form Request Validation for robust security)
 ┃ ┣ 📂 Models (Eloquent ORM, Polymorphic Relations, Soft Deletes)
 ┃ ┣ 📂 Repositories (Data Access Layer - abstracts DB queries) 🚀
 ┃ ┣ 📂 Services (Core Business Logic & 3rd Party Integrations) 🚀
 ┃ ┗ 📂 Traits (Reusable behaviors e.g., FileUploadTrait)
 ┣ 📂 database (Migrations, Advanced Seeders, Model Factories)
 ┣ 📂 public/docs (Assets & Readme Screenshots)
 ┗ 📂 routes (Modular routing for Web & RESTful API)
```

---

## 🔌 RESTful API Documentation

The platform's core functionalities are exposed via a highly structured and secure RESTful API, fully documented using Postman.

👉 **[Explore the Complete API Documentation](https://documenter.getpostman.com/view/36684922/2sBYAuRWMz)**

---

## ✨ Enterprise-Grade Features

### 🛡️ Admin & Super-Admin Capabilities
* **Advanced Multi-Auth System:** Secure separation of concerns using guards (Admin, Author, User).
* **Role-Based Access Control (RBAC):** Granular permissions and dynamic role assignment.
* **KYC Verification System:** Built-in identity verification workflow to ensure vendor authenticity.
* **Financial Intelligence Dashboard:** Advanced analytics, revenue tracking, and commission management.
* **Automated Withdrawal Management:** Handle, approve, and process vendor payout requests securely.

### 💼 Vendor (Author) Ecosystem
* **Comprehensive Product Management:** Upload and manage digital items (Images, Videos, Audio, ZIP files) with dynamic preview generation.
* **Real-Time Sales Reports:** Track earnings, commissions, and sales history via a dedicated dashboard.
* **Flexible Withdrawal System:** Request payouts via multiple configured payment gateways seamlessly.

### 🛒 End-User Experience
* **Dynamic Cart System:** AJAX-powered smooth shopping cart logic.
* **Multi-Gateway Checkout:** Secure checkout integration utilizing **Stripe** and **PayPal**.
* **Digital Assets Library:** Detailed transaction history and instant access to downloadable licenses post-purchase.
* **Rating & Review System:** Authenticated ability to rate and review purchased digital items.

---

## 🛠️ Tech Stack & Security

* **Backend Engine:** PHP 8.x, Laravel 11.x
* **Frontend:** Laravel Blade, Bootstrap 5, AJAX/jQuery
* **Database Engine:** MySQL (Leveraging Advanced Joins, Polymorphic Relations, Soft Deletes, Indexing)
* **Performance Optimization:** Redis (Caching), Laravel Queues & Jobs (Background Processing for Mailing & Image tasks)
* **Security Measures:** CSRF Protection, XSS Prevention, Strict Input Validation (Form Requests), Gates & Policies for Authorization, API Rate Limiting.

---

## 🔐 Demo Credentials (Seeded)

Execute the seeders during installation to test the platform instantly with these demo accounts:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@admin.com` | `password` |
| **Vendor** | `vendor@vendor.com` | `password` |
| **User** | `user@user.com` | `password` |

---

## ⚙️ Installation & Setup

Follow these steps to get the project running on your local machine. Each step is separated for easy copying.

**1. Clone the repository:**
```bash
git clone https://github.com/devAbdallahAhmed/Multi-Vendor-Digital-Marketplace.git
```

**2. Navigate to the project directory:**
```bash
cd Multi-Vendor-Digital-Marketplace
```

**3. Install PHP dependencies (Backend):**
```bash
composer install
```

**4. Install NPM dependencies (Frontend):**
```bash
npm install
```

**5. Build frontend assets:**
```bash
npm run build
```

**6. Copy the environment file:**
```bash
cp .env.example .env
```
*(⚠️ Important: Open the `.env` file now and configure your `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, and Stripe API Keys before proceeding)*

**7. Generate application key:**
```bash
php artisan key:generate
```

**8. Run database migrations & seeders:**
```bash
php artisan migrate --seed
```

**9. Link storage (Crucial for images & digital products):**
```bash
php artisan storage:link
```

**10. Start the local development server:**
```bash
php artisan serve
```

> 🌐 **Live Preview:** Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser to view the application.

---
**Engineered with ❤️ by [Abdullah Ahmed](https://github.com/devAbdallahAhmed)**  
*Backend Software Developer | PHP & Laravel Specialist*
