Technical Test - Todo API & Login Page
- **Frontend**: Halaman login menggunakan HTML, CSS, dan JavaScript sesuai desain Figma.
- **Backend**: REST API menggunakan Laravel untuk membuat data Todo dan export data ke file Excel.

## Teknologi

- HTML
- CSS
- JavaScript
- Laravel
- MySQL
- Laravel Excel

## Fitur

### Frontend
- Responsive Login Page
- Validasi email
- Validasi password (minimal 6 karakter)
- Menyimpan data login ke Local Storage

### Backend
- Menambahkan data Todo
- Export data Todo ke Excel
- Filter berdasarkan:
  - Title
  - Assignee
  - Due Date
  - Time Tracked
  - Status
  - Priority
- Menampilkan summary di bagian bawah file Excel (Total Todo dan Total Time Tracked)

## Menjalankan Project

### Backend

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Akses backend:

```
http://127.0.0.1:8000
```

### Frontend

Buka file `index.html` menggunakan **Live Server** di Visual Studio Code.

## Endpoint menggunakan Postman

### Menambahkan Todo
POST /api/todos

### Export Excel
GET /api/todos/export
Contoh filter:
GET /api/todos/export?title=Laravel
GET /api/todos/export?status=pending
GET /api/todos/export?priority=high

Tutut Bagiawati
