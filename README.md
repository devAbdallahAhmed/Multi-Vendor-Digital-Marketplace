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
