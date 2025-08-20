# Kaine FC Team Management System

Kaine FC is a Laravel web application designed to manage every aspect of the Kaine FC football team. It provides tools for handling player and staff information, match scheduling and results, attendance tracking, team administration, and detailed reporting.

## Tech Stack

### Backend
- **Framework:** Laravel 10.x
- **PHP Version:** 8.0+
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **API:** RESTful API architecture

### Frontend
- **CSS Framework:** Tailwind CSS
- **JS Build Tool:** Vite
- **JavaScript:** Vanilla JS
- **Icons:** Heroicons
- **Responsive Design:** Mobile-first approach

### Development Tools
- **Version Control:** Git
- **Package Manager:** Composer (PHP), npm (JavaScript)
- **Development Server:** Laravel's built-in server
- **Database Version Control:** Laravel Migrations
- **Seeding:** Laravel Database Seeders

## Project Structure
```
kaineFc/
├── app/                    # Application core code
│   ├── Console/           # Artisan commands
│   ├── Exceptions/        # Error handling
│   ├── Http/             
│   │   ├── Controllers/   # Request handlers
│   │   ├── Middleware/    # HTTP middleware
│   │   └── Requests/      # Form requests
│   ├── Models/            # Eloquent models
│   ├── Providers/         # Service providers
│   └── View/              # View components
├── config/                # Configuration files
├── database/
│   ├── factories/         # Model factories
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── public/                # Publicly accessible files
├── resources/
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript
│   └── views/            # Blade templates
├── routes/                # Application routes
│   ├── web.php           # Web routes
│   └── api.php           # API routes
├── storage/              # Uploaded files, logs, cache
├── tests/                # Automated tests
└── vendor/               # Dependencies
```

## Features

- **Player Management:** Create, update, and view player profiles, contracts, medical info, positions, and team assignments.
- **Staff Management:** Manage staff roles, departments, contact info, qualifications, and employment status.
- **Team Administration:** Organize teams, assign coaches, manage categories, and track team status.
- **Match Scheduling & Results:** Schedule matches, record results, and view summaries and highlights.
- **Attendance Tracking:** Record attendance for players and staff, including check-in/out times and status.
- **Position & Category Management:** Define and manage player positions and categories for better organization.
- **Department Management:** Create and manage team departments for staff and players.
- **Reporting:** Generate reports on player performance, staff attendance, match results, and financials.
- **User Profiles & Authentication:** Secure login, profile management, password updates, and account deletion.
- **Dashboard:** View statistics on players, staff, upcoming and recent matches.

## Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- Node.js & npm
- MySQL or compatible database

### Installation

1. Clone the repository:
   ```powershell
   git clone https://github.com/RWEMAISINGIZWENorbert/kaineFc.git
   ```
2. Install PHP dependencies:
   ```powershell
   composer install
   ```
3. Install frontend dependencies:
   ```powershell
   npm install
   ```
4. Copy `.env.example` to `.env` and configure your environment variables.
5. Generate application key:
   ```powershell
   php artisan key:generate
   ```
6. Run migrations and seeders:
   ```powershell
   php artisan migrate --seed
   ```
7. Start the development server:
   ```powershell
   php artisan serve
   ```

## Usage

- Access the app at `http://localhost:8000`.
- Log in to manage team data, view reports, and update profiles.

## Screenshots

### Authentication
![Authentication Page](screenshots/auth.png)

### Dashboard
![Dashboard](screenshots/dashboard.png)

### Players Management
![Players List](screenshots/players.png)

### Staff Management
![Staff List](screenshots/staff.png)

### Add Player/Staff Form
![Add New Player or Staff](screenshots/add%20player%20or%20staff.png)

## Contributing

Contributions are welcome! Please submit issues or pull requests for improvements.

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
