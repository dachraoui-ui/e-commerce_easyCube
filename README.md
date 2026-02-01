# EasyCubi - E-commerce Platform

EasyCubi is a modern e-commerce web application built with Symfony 7 and PHP 8.2+. It provides a complete online shopping experience with user authentication, product management, and shopping cart functionality.

## 🚀 Features

- **User Authentication**: Register, login, and logout functionality with secure password hashing
- **Product Management**: Full CRUD operations for products (Create, Read, Update, Delete)
- **Shopping Cart**: Session-based cart system to add and manage products
- **Product Catalog**: Browse and view all available products
- **Contact Page**: Contact form for customer inquiries
- **Responsive Design**: Mobile-friendly interface using Bootstrap 4

## 🛠️ Technologies Used

- **Backend**: PHP 8.2+, Symfony 7.0
- **Database**: MySQL (default: `db_cube`)
- **ORM**: Doctrine ORM
- **Frontend**: Twig templating, Bootstrap 4, HTML5, CSS3
- **Authentication**: Symfony Security Bundle
- **Other**: Composer (PHP dependency management)

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** >= 8.2 with extensions:
  - `ext-ctype`
  - `ext-iconv`
  - `ext-pdo_mysql`
- **Composer** (PHP dependency manager)
- **MySQL** Server (or MariaDB)
- **Symfony CLI** (optional, but recommended)

## 🔧 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/dachraoui-ui/e-commerce_easyCube.git
cd e-commerce_easyCube
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment Variables

Copy the `.env` file and configure your database connection:

```bash
cp .env .env.local
```

Edit `.env.local` and update the database URL:

```env
DATABASE_URL="mysql://your_username:your_password@127.0.0.1:3306/db_cube"
```

### 4. Create the Database

```bash
# Create the database
php bin/console doctrine:database:create

# Run migrations to create tables
php bin/console doctrine:migrations:migrate
```

### 5. Create the Images Directory

Ensure the images directory exists for product photos:

```bash
mkdir -p public/images
```

## 🏃 Running the Application

### Using Symfony CLI (Recommended)

```bash
symfony server:start
```

The application will be available at `http://127.0.0.1:8000`

### Using PHP Built-in Server

```bash
php -S localhost:8000 -t public
```

### Using Docker (Optional)

The project includes Docker configuration for development with PostgreSQL (note: the default setup uses MySQL, but Docker compose is configured for PostgreSQL):

```bash
docker-compose up -d
```

> **Note**: When using Docker, update your `.env.local` to use the PostgreSQL connection string instead of MySQL.

## 📁 Project Structure

```
e-commerce_easyCube/
├── assets/                 # Frontend assets (JS, CSS)
├── bin/                    # Console commands
├── config/                 # Configuration files
│   ├── packages/           # Bundle configurations
│   ├── routes/             # Route definitions
│   └── services.yaml       # Service definitions
├── migrations/             # Database migrations
├── public/                 # Web root directory
│   ├── images/             # Product images
│   └── index.php           # Application entry point
├── src/
│   ├── Controller/         # Application controllers
│   ├── Entity/             # Doctrine entities
│   ├── Form/               # Form types
│   └── Repository/         # Doctrine repositories
├── templates/              # Twig templates
├── tests/                  # Test files
├── translations/           # Translation files
├── .env                    # Environment variables
├── composer.json           # PHP dependencies
└── symfony.lock            # Symfony recipes lock file
```

## 🛤️ Available Routes

| Route | Path | Description |
|-------|------|-------------|
| Home | `/` | Landing page |
| Products | `/affiche/produit` | View all products |
| Product Management | `/produit` | Admin product list |
| Add Product | `/produit/add` | Add a new product |
| Edit Product | `/produit/edit/{id}` | Edit existing product |
| Delete Product | `/produit/delete/{id}` | Delete a product |
| Cart | `/cart` | View shopping cart |
| Login | `/login` | User login |
| Register | `/register` | User registration |
| Logout | `/logout` | User logout |
| Contact | `/contact` | Contact page |

## 🗄️ Database Schema

### User Entity
- `id` - Primary key
- `email` - User email (unique)
- `roles` - User roles array
- `password` - Hashed password
- `nom` - User name (French for "name")

### Produit (Product) Entity
- `id` - Primary key
- `name` - Product name
- `price` - Product price
- `production_date` - Production date
- `made_in` - Country of origin
- `photo` - Product image filename

## 🔐 Security

The application uses Symfony Security Bundle for authentication:
- Passwords are securely hashed using Symfony's password hasher
- Session-based authentication
- CSRF protection on forms

## 📝 Usage

### Adding Products

1. Navigate to `/produit/add`
2. Fill in the product details (name, price, production date, country of origin)
3. Upload a product image
4. Submit the form

### Shopping

1. Browse products at `/affiche/produit`
2. Add items to your cart
3. View your cart at `/cart`
4. Manage quantities in the cart

### User Account

1. Register at `/register` with your name, email, and password
2. Login at `/login` with your credentials
3. When logged in, your name appears in the navigation bar

## 🧪 Running Tests

```bash
php bin/phpunit
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is proprietary software.

## 👤 Author

- **dachraoui-ui** - [GitHub Profile](https://github.com/dachraoui-ui)
