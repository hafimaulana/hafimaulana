# Coffee Website - Laravel Project

A comprehensive coffee product management website built with Laravel framework featuring multi-level authentication, product management, and user roles.

## Features

### 🔐 Authentication & Authorization
- **Multi-level Authentication**: Admin and Customer roles
- **Role-based Access Control**: Different permissions for different user types
- **Secure Login/Registration**: Built with Laravel Breeze
- **Profile Management**: Users can update their profile and change passwords

### ☕ Product Management
- **CRUD Operations**: Create, Read, Update, Delete products
- **Image Upload**: Product images with storage management
- **Product Categories**: Different roast levels (Light, Medium, Medium-Dark, Dark)
- **Stock Management**: Track product availability
- **Product Details**: Origin, price, description, and roast level

### 👥 User Management
- **Admin Dashboard**: Overview of products and customers
- **Customer Management**: View, edit, and delete customer accounts
- **Customer Dashboard**: Browse products and manage profile
- **User Statistics**: Track user activity and account information

### 🎨 User Interface
- **Responsive Design**: Works on desktop and mobile devices
- **Modern UI**: Clean and professional design with Tailwind CSS
- **Intuitive Navigation**: Easy-to-use interface for all user types
- **Product Gallery**: Beautiful product display with images

## Technology Stack

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates with Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage with symbolic links

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- MySQL/MariaDB
- Node.js (for asset compilation)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd coffee-website
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file and set your database credentials:
   ```env
   DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=coffee_website
DB_USERNAME=root
DB_PASSWORD=

   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Create storage link**
   ```bash
   php artisan storage:link
   ```

8. **Compile assets**
   ```bash
   npm run build
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

10. **Access the application**
    Open your browser and go to `http://localhost:8000`

## Default Users

After running the seeders, the following default users will be created:

### Admin User
- **Email**: admin@coffee.com
- **Password**: password
- **Role**: Admin

### Customer User
- **Email**: customer@coffee.com
- **Password**: password
- **Role**: Customer

## Project Structure

```
coffee-website/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php
│   │   ├── CustomerController.php
│   │   └── ProductController.php
│   ├── Models/
│   │   ├── Product.php
│   │   ├── Role.php
│   │   └── User.php
│   └── Http/Middleware/
│       └── CheckRole.php
├── database/
│   ├── migrations/
│   │   ├── create_roles_table.php
│   │   ├── create_users_table.php
│   │   └── create_products_table.php
│   └── seeders/
│       ├── RoleSeeder.php
│       ├── ProductSeeder.php
│       └── DatabaseSeeder.php
├── resources/views/
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── customers.blade.php
│   │   └── customer-show.blade.php
│   ├── customer/
│   │   ├── dashboard.blade.php
│   │   └── profile.blade.php
│   ├── products/
│   │   ├── index.blade.php
│   │   ├── show.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── layouts/
│   │   └── app.blade.php
│   └── welcome.blade.php
└── routes/
    └── web.php
```

## Features in Detail

### Admin Features
- **Dashboard**: Overview of total products and customers
- **Product Management**: Full CRUD operations for products
- **Customer Management**: View and manage customer accounts
- **Image Upload**: Handle product images with automatic storage management

### Customer Features
- **Dashboard**: Browse featured products and view statistics
- **Product Browsing**: View all available products with details
- **Profile Management**: Update personal information and change password
- **Product Details**: View comprehensive product information

### Product Features
- **Product Information**: Name, description, origin, roast level, price, stock
- **Image Support**: Product images with fallback for missing images
- **Availability Status**: Stock-based availability tracking
- **Categories**: Organized by roast levels

## Security Features

- **CSRF Protection**: All forms are protected against CSRF attacks
- **Input Validation**: Comprehensive validation for all user inputs
- **File Upload Security**: Secure image upload with type and size validation
- **Role-based Access**: Middleware protection for different user roles
- **Password Hashing**: Secure password storage using Laravel's built-in hashing

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support, email support@coffee-website.com or create an issue in the repository.

---

**Note**: This is a demonstration project for educational purposes. In a production environment, additional security measures and optimizations should be implemented.
