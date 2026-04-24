# Store Management System (MVC)

A PHP-based Model-View-Controller (MVC) application for managing a store database. This project allows you to view and manage customers and their orders through a clean, organized web interface.

## 🚀 Tech Stack

- **Backend**: PHP 7.4+ (Pure PHP)
- **Database**: MySQL / MariaDB
- **Architecture**: MVC (Model-View-Controller)
- **Frontend**: HTML5, CSS3

## ✨ Features

- **Home Page**: Overview with customer and order statistics.
- **Customer Management**: View a list of customers, including their points and contact details.
- **Order Tracking**: View, create, edit, and delete orders with status filtering.
- **Quick Status Change**: Change order status (new → paid → delivered) directly from the orders table.
- **Order Receipt**: Print-ready receipt/invoice page for any order (`/orders/{id}`).
- **Environment Driven**: Secure configuration using `.env` files.
- **MVC Architecture**: Separated concerns for better maintainability.

## 📂 Project Structure

```
veikals/
├── db/                  # Database scripts and connection logic
│   ├── DB.php           # Database connection class (PDO)
│   └── db.sql           # SQL schema and seed data
├── public/              # Web-accessible entry point
│   ├── index.php        # Main router and controller dispatcher
│   ├── style.css        # Application styles
│   └── images/          # Assets (icons, product images)
├── src/                 # Application source code
│   ├── controllers/     # Request handlers
│   ├── models/          # Data logic and database interaction
│   ├── views/           # UI templates (HTML/PHP)
│   └── Env.php          # Custom .env loader
├── .env.example         # Template for environment variables
└── README.md            # Project documentation
```

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone https://github.com/1chocolateicecream/php-21-04-2026.git
cd veikals
```

### 2. Database Setup
1. Import the database schema:
   ```bash
   mysql -u root -p < db/db.sql
   ```
2. (Optional) If you didn't run the full script, ensure you have a database named `store_dev1`.

### 3. Environment Configuration
Copy the example file and update it with your database credentials:
```bash
cp .env.example .env
```
Edit `.env`:
```dotenv
DB_HOST=localhost
DB_NAME=store_dev1
DB_USER=your_username
DB_PASS=your_password
```

### 4. Run the Application
Start the built-in PHP server:
```bash
php -S localhost:8000 -t public
```

## 🌐 Available Routes

Once the server is running, you can access:

| Route | Description |
|-------|-------------|
| `/` | Home page with stats |
| `/customers` | Customer list |
| `/orders` | Orders list with status filter |
| `/orders/create` | Create new order |
| `/orders/{id}` | Order receipt (print-ready) |
| `/orders/{id}/edit` | Edit order |

## 🔐 Security

- **Environment Variables**: Sensitive data is stored in `.env`, which is excluded from Git via `.gitignore`.
- **Prepared Statements**: The application uses PDO with prepared statements to prevent SQL injection.

## 🎨 Design Inspiration

The color palette is centered around `#39C5BB` — a very particular shade of teal — paired with soft pink accents. Those familiar with the virtual music scene might recognize where it comes from♪

## 📝 License

This project is open source and available under the [MIT License](LICENSE).

---
**Last Updated**: April 24, 2026