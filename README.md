# 🚀 Pulse - Multi-Vendor Digital Marketplace Platform

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Stripe](https://img.shields.io/badge/Stripe-626CD9?style=for-the-badge&logo=Stripe&logoColor=white)

A highly scalable, robust, and feature-rich Multi-Vendor Digital Marketplace built with Laravel. This platform allows authors (vendors) to sell digital products (scripts, themes, audio, video) while providing a seamless purchasing experience for users and comprehensive management tools for administrators.

## ✨ Key Features

### 🛡️ Admin Privileges
* **Advanced Multi-Auth:** Secure separation of concerns (Admin, Author, User).
* **Role-Based Access Control (RBAC):** Granular permissions and role management.
* **KYC Verification:** Built-in identity verification system for vendors.
* **Financial Dashboard:** Advanced analytics, revenue tracking, and commission management.
* **Withdrawal Management:** Handle and approve vendor payout requests securely.
* **Newsletter & Mailing:** Integrated queue-based background email dispatching.

### 💼 Vendor (Author) Capabilities
* **Product Management:** Upload and manage digital items (Images, Videos, Audio, Files) with dynamic preview generation.
* **Sales Reports:** Real-time earnings and sales history dashboard.
* **Withdrawal System:** Request payouts via multiple configured payment gateways.
* **Product Analytics:** Track item reviews, ratings, and active sales.

### 🛒 User Experience
* **Dynamic Cart System:** Smooth shopping cart logic.
* **Multiple Payment Gateways:** Seamless checkout using **Stripe**, **PayPal**, and **Razorpay**.
* **Order History & Invoicing:** Detailed transaction history and downloadable licenses.
* **Product Reviews:** Ability to rate and review purchased digital items.

## 🛠️ Tech Stack & Architecture
* **Backend:** PHP 8.x, Laravel 11.x
* **Frontend:** Laravel Blade, Bootstrap 5, AJAX/jQuery
* **Database:** MySQL (Advanced Joins, Polymorphic Relations, Soft Deletes)
* **Performance:** Redis (Caching), Laravel Queues & Jobs (Background Processing)
* **Security:** CSRF Protection, Input Validation, Form Requests, Gates & Policies

## ⚙️ Installation & Setup

Follow these steps to get the project running on your local machine:

**1. Clone the repository**
```bash
git clone [https://github.com/YourUsername/pulse-marketplace.git](https://github.com/YourUsername/pulse-marketplace.git)
cd pulse-marketplace
