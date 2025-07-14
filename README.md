<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel Booking System with Dashboard & Calendar

A comprehensive Laravel booking system featuring a modern dashboard with statistics and an interactive event calendar for date selection.

## Features

### 🏠 Dashboard
- **Statistics Overview**: Total bookings, total users, and user's personal booking count
- **Recent Bookings**: Display of the 5 most recent bookings for the current user
- **Quick Actions**: Easy navigation to create new bookings and view all bookings
- **Modern UI**: Beautiful, responsive design with glassmorphism effects

### 📅 Event Calendar
- **Visual Date Selection**: Interactive calendar interface for booking creation
- **Existing Bookings Display**: Shows all booked dates on the calendar
- **Date Validation**: Prevents double-booking by disabling already booked dates
- **Time Selection**: Separate time picker for precise scheduling
- **Calendar Navigation**: Easy month-to-month navigation

### 📋 Booking Management
- **List View**: Traditional list display of all bookings with edit/delete actions
- **Calendar View**: Visual calendar showing all bookings with hover tooltips
- **Statistics Bar**: Quick overview of total, upcoming, and past bookings
- **Responsive Design**: Works seamlessly on desktop and mobile devices

### 🔐 User Authentication
- **User Registration & Login**: Secure authentication system
- **User-Specific Bookings**: Each user can only see and manage their own bookings
- **Authorization**: Proper access control using Laravel policies

## Technical Features

### Backend
- **Laravel 10**: Modern PHP framework with robust features
- **Eloquent ORM**: Clean database interactions with relationships
- **API Endpoints**: RESTful API for calendar data
- **Form Validation**: Comprehensive input validation
- **Database Migrations**: Proper database schema management

### Frontend
- **Vanilla JavaScript**: No external dependencies for calendar functionality
- **CSS Grid & Flexbox**: Modern layout techniques
- **Glassmorphism Design**: Contemporary UI with backdrop blur effects
- **Responsive Design**: Mobile-first approach
- **Interactive Elements**: Hover effects, transitions, and animations

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd laravel5
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. **Start the development server**
   ```bash
   php artisan serve
   ```

## Usage

### Creating a Booking
1. Navigate to the dashboard
2. Click "Create New Booking"
3. Fill in the booking title and description
4. Use the calendar to select a date (booked dates are highlighted in red)
5. Choose a time using the time picker
6. Submit the booking

### Managing Bookings
1. Go to "My Bookings" from the dashboard
2. Toggle between List View and Calendar View
3. Use the calendar to see all your bookings at a glance
4. Edit or delete bookings as needed

### Dashboard Overview
- View total system statistics
- See your recent bookings
- Quick access to all booking functions

## Database Schema

### Users Table
- `id` - Primary key
- `name` - User's full name
- `email` - Unique email address
- `password` - Hashed password
- `created_at`, `updated_at` - Timestamps

### Bookings Table
- `id` - Primary key
- `user_id` - Foreign key to users table
- `title` - Booking title
- `description` - Optional booking description
- `booking_date` - Date and time of the booking
- `created_at`, `updated_at` - Timestamps

## API Endpoints

### GET /api/booking-dates
Returns all booking dates for the authenticated user in JSON format:
```json
[
  {
    "date": "2024-01-15",
    "title": "Meeting with Client",
    "formatted_date": "January 15, 2024 - 2:00 PM"
  }
]
```

## Routes

- `GET /dashboard` - Main dashboard with statistics
- `GET /my-bookings` - User's booking management page
- `GET /make-bookings` - Create new booking form
- `POST /make-bookings` - Store new booking
- `GET /booking/{id}/edit` - Edit booking form
- `POST /booking/{id}/update` - Update booking
- `POST /booking/{id}/delete` - Delete booking
- `GET /api/booking-dates` - API for calendar data

## Customization

### Styling
The application uses custom CSS with modern design principles. You can customize:
- Color scheme in CSS variables
- Background images
- Typography and spacing
- Animation effects

### Calendar Features
The calendar is built with vanilla JavaScript and can be extended with:
- Additional date validation rules
- Custom booking time slots
- Recurring booking options
- Integration with external calendar services

## Security Features

- **CSRF Protection**: All forms include CSRF tokens
- **Authorization**: User-specific data access
- **Input Validation**: Comprehensive form validation
- **SQL Injection Prevention**: Eloquent ORM protection
- **XSS Protection**: Proper output escaping

## Performance Optimizations

- **Eager Loading**: Efficient database queries
- **Caching**: Optional caching for frequently accessed data
- **Minified Assets**: Optimized CSS and JavaScript
- **Database Indexing**: Proper indexes on frequently queried columns

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
