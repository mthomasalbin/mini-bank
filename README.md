# Mini Bank - Laravel 10 Project

## 🏦 About The Project
Mini Bank is a Laravel-based banking system that allows customer management and transactions via web pages and APIs. This project includes authentication, customer transactions, and API security using Laravel Sanctum.

## 🚀 Features
- Customer Management (Add, List, View Transactions)
- Secure Authentication (Admin & Customers)
- Laravel Sanctum API Authentication
- Debit & Credit Transactions with Daily Limits
- Dashboard Overview
- Validation with Toastr Notifications

---

## 🛠️ Installation & Setup

### 1️⃣ Clone the Repository
```sh
git clone https://github.com/mthomasalbin/mini-bank.git
cd mini-bank
git checkout master - Master Branch
```

### 2️⃣ Install Dependencies
```sh
composer install
```

### 3️⃣ Setup Environment File
Copy the `.env.example` file and rename it to `.env`.
```sh
cp .env.example .env
```
Then, open `.env` and configure the database settings:
```env
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

I have attached the database file 'minibank.sql' to this repository, or you can run through migrations and seeders instead.
```

### 4️⃣ Generate Application Key
```sh
php artisan key:generate
```

### 5️⃣ Run Migrations & Seeders
```sh
php artisan migrate --seed
```

### 6️⃣ Serve the Application
```sh
php artisan serve
```
Your application should now be running at **http://127.0.0.1:8000**

---

## 🔐 Authentication Setup
### Laravel Sanctum (API Authentication)
Run the command to publish the Sanctum configuration:
```sh
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

Add Sanctum middleware in `app/Http/Kernel.php`:
```php
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

---

## 📡 API Endpoints
### 1️⃣ Customer Authentication
- **Login API**: `POST /api/login`
- **Logout API**: `POST /api/customer/logout`

### 2️⃣ Transactions
- **Credit Amount**: `POST /api/transactions/credit`
- **Debit Amount**: `POST /api/transactions/debit` (Max 5 transactions per day)

> 📌 **Note**: Pass the Bearer Token in the Authorization header.

---

## 📝 Postman Collection
A Postman collection is included in the repository under `mini_bank.postman_collection.json`. Import it into Postman for quick testing.

---

## 🛑 Troubleshooting
If you face any issues, try the following:
- **Clear Cache**:
  ```sh
  php artisan config:clear
  php artisan cache:clear
  php artisan route:clear
  php artisan view:clear
  ```
- **Run Migrations Again**:
  ```sh
  php artisan migrate:refresh --seed
  ```

---

## 🤝 Contributing
Feel free to fork the repo and submit a pull request with improvements!

---

## 📜 License
This project is open-source and available under the MIT License.

