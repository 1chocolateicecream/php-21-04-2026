# PHP Store Management System

A PHP-based application for managing a store database. This project provides a foundation for building store management functionalities with a clean architecture and environment-based configuration.

## Overview

The PHP Store Management System is a lightweight, modular PHP project designed to handle store-related operations with a focus on maintainability and scalability. It follows best practices with separation of concerns through organized directory structures and environment-based configuration.

## Features

- **Database Management**: Easy-to-configure database connectivity
- **Environment Configuration**: Flexible .env-based configuration system
- **Modular Structure**: Organized code separation with public, source, and database directories
- **Scalable Architecture**: Built to grow with your application needs
- **Security-First**: Configuration files excluded from version control

## Project Structure

```
php-21-04-2026/
├── public/              # Public-facing files and entry points
├── src/                 # Application source code
├── db/                  # Database-related files and schemas
├── .env.example         # Example environment configuration
├── .gitignore           # Git ignore rules
└── README.md            # This file
```

### Directory Descriptions

- **public/** - Contains the web-accessible files, such as index.php or assets
- **src/** - Houses the core application logic, classes, and business logic
- **db/** - Stores database migrations, schemas, and seed files

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL/MariaDB 5.7 or higher
- Git

### Setup Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/1chocolateicecream/php-21-04-2026.git
   cd php-21-04-2026
   ```

2. **Configure Environment Variables**
   ```bash
   cp .env.example .env
   ```

3. **Edit Configuration**
   Open `.env` and update the following values:
   ```dotenv
   DB_HOST=localhost      # Your database host
   DB_NAME=store_dev1     # Your database name
   DB_USER=store_app1     # Your database user
   DB_PASS=password       # Your database password
   ```

4. **Create Database** (if not already created)
   ```bash
   mysql -u root -p -e "CREATE DATABASE store_dev1;"
   mysql -u root -p -e "CREATE USER 'store_app1'@'localhost' IDENTIFIED BY 'password';"
   mysql -u root -p -e "GRANT ALL PRIVILEGES ON store_dev1.* TO 'store_app1'@'localhost';"
   ```

5. **Set Up Web Server**
   - Point your web server's document root to the `public/` directory
   - Ensure PHP is configured to run scripts in the public folder

## Configuration

The application uses environment variables stored in the `.env` file:

| Variable | Description | Default |
|----------|-------------|---------|
| `DB_HOST` | Database server hostname | localhost |
| `DB_NAME` | Database name | store_dev1 |
| `DB_USER` | Database username | store_app1 |
| `DB_PASS` | Database password | password |

**Important**: Never commit the `.env` file to version control. Use `.env.example` as a template for new installations.

## Usage

### Running the Application

1. Start your local web server:
   ```bash
   php -S localhost:8000 -t public
   ```

2. Open your browser and navigate to:
   ```
   http://localhost:8000
   ```

3. Begin interacting with the store management system

### Database Access

Connect to the database using the credentials defined in your `.env` file:

```bash
mysql -h DB_HOST -u DB_USER -p DB_NAME
```

## Development

### Project Guidelines

- Follow PSR-12 PHP coding standards
- Use meaningful variable and function names
- Keep the separation of concerns clean
- Test your changes before committing

### Adding Features

1. Create new classes in the `src/` directory
2. Add database migrations in the `db/` directory
3. Update public-facing pages in the `public/` directory

## Security

### Best Practices

- ✅ Keep the `.env` file in `.gitignore` (already configured)
- ✅ Use parameterized queries to prevent SQL injection
- ✅ Validate and sanitize all user inputs
- ✅ Use HTTPS in production
- ✅ Keep PHP and all dependencies updated
- ✅ Never commit sensitive credentials

## Contributing

To contribute to this project:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is open source and available under the MIT License.

## Support

For questions, issues, or suggestions:

- Open an issue on GitHub: [Issues](https://github.com/1chocolateicecream/php-21-04-2026/issues)
- Check existing documentation in this README
- Review the project structure for code organization

---

**Last Updated**: April 23, 2026