# 🏨 Hotel Booking Web

Một **ứng dụng web quản lý đặt phòng khách sạn** giúp người dùng có thể **tìm kiếm phòng, đặt phòng và quản lý dữ liệu khách sạn** — xây dựng với **HTML/CSS/JS frontend, PHP backend và MySQL database**. ([GitHub][1])

---

## 📌 Tính năng

✨ Những tính năng chính của dự án:

* 📋 **Xem danh sách khách sạn & phòng trống**
* 🛏️ **Tìm và đặt phòng**
* 👤 **Quản lý thông tin người dùng**
* 📸 **Upload hình ảnh khách sạn / phòng**
* 🔐 **Admin Panel để quản lý dữ liệu hệ thống** 

---

## 🧠 Công nghệ sử dụng

Dự án được phát triển với các công nghệ sau:

* 🖥️ **Frontend:** HTML, CSS, JavaScript
* ⚙️ **Backend:** PHP
* 🗄️ **Database:** MySQL
* ☁️ **Lưu trữ ảnh:** Firebase Storage (nếu được tích hợp) 

---

## 🚀 Hướng dẫn cài đặt & chạy dự án

### 1. Clone repository

```bash
git clone https://github.com/nga4704/hotel-booking-web.git
cd hotel-booking-web
```

### 2. Thiết lập môi trường

1. **Cài đặt XAMPP / WAMP / LAMP** để chạy server PHP + MySQL
2. **Import database:**

   * Mở phpMyAdmin → tạo database mới (ví dụ: `hotel_booking`)
   * Import file SQL có sẵn trong thư mục `database/` (nếu có)

### 3. Cấu hình kết nối

Mở file cấu hình kết nối database (ví dụ: `config.php` / `db.php`) và chỉnh:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hotel_booking');
```

(*Điều chỉnh theo cấu hình MySQL của bạn*)

### 4. Chạy ứng dụng

* Khởi động Apache + MySQL
* Mở trình duyệt và truy cập:
  `http://localhost/hotel-booking-web`

---

## 🧑‍💻 Tác giả

**nga4704** – người phát triển dự án.

---
