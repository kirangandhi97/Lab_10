<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

# Well Operation Management System

A Laravel-based CRUD application for managing oil well operations in the Oil and Gas industry. This system provides a complete implementation of Create, Read, Update, and Delete functionality using Laravel's Eloquent ORM and Blade templating engine.

## Project Overview

This application allows oil and gas companies to track and maintain data related to their oil wells. It facilitates operations including registration of new wells, listing existing wells, updating production information, and deletion of decommissioned entries.

## Features

- **Well Registration**: Add new wells with detailed information
- **Well Listing**: View all wells with sorting and filtering options
- **Well Details**: View comprehensive information about each well
- **Well Updates**: Modify production or status information
- **Well Deletion**: Remove decommissioned or erroneous entries
- **Advanced Search**: Filter wells by name, status, location, depth, production, and date
- **Data Validation**: Comprehensive form validation with meaningful error messages
- **Responsive UI**: Mobile-friendly interface using Bootstrap 5

## Technical Specifications

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL or compatible database
- Laravel 10.x

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/HP181/Php_Laravel_Lab10.git
   cd Php_Laravel_Lab10

Install dependencies:
```
composer install
```

Copy the .env.example file to .env and configure your database:
```
cp .env.example .env
```

Create well_management database in PhpMyAdmin and edit this variables in .env:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=well_management
DB_USERNAME=
DB_PASSWORD=
```

Generate application key:
```
php artisan key:generate
```

Run migrations to create the database tables:
```
php artisan migrate
````

Start the development server:
```
php artisan serve
```

Access the application at http://localhost:8000

## System Architecture
### MVC Pattern Implementation


The application follows Laravel's MVC architecture:

- Models: Define well data structure and database interactions
- Views: Present data to users through Blade templates
- Controllers: Handle user input and manage application logic

### Database Schema
The wells table contains the following fields:


| Field Name        | Data Type  | Description                                        |
|------------------|-----------|----------------------------------------------------|
| id              | Integer   | Primary key, auto-increment                        |
| well_name       | String    | Unique name or code for the well                  |
| field_location  | String    | Geographical location of the well                 |
| depth_meters    | Integer   | Depth in meters (>0)                              |
| status          | Enum      | Values: Drilling, Producing, Suspended, Decommissioned |
| production_bpd  | Decimal   | Daily production in barrels per day (optional)    |
| commissioned_date | Date    | Date the well became operational                  |
| created_at      | Timestamp | Record creation timestamp                         |
| updated_at      | Timestamp | Record update timestamp                           |



### Routing
The application uses Laravel's resource controller routing:

- GET /wells - Display list of all wells
- GET /wells/create - Show form to create a new well
- POST /wells - Store a newly created well
- GET /wells/{well} - Show details of a specific well
- GET /wells/{well}/edit - Show form to edit a well
- PUT/PATCH /wells/{well} - Update a specific well
- DELETE /wells/{well} - Delete a specific well

## Implementation Details
### Model and Migration
The Well model uses Eloquent ORM to interact with the database, with proper attribute casting and fillable properties.


### Controllers
The WellController implements all standard resource controller methods:

- index(): Lists all wells with filtering options
- create(): Shows the well creation form
- store(): Validates and saves new well data
- show(): Displays detailed well information
- edit(): Shows the well edit form
- update(): Validates and updates well data
- destroy(): Deletes a well record

## Views
### Blade templates with layout inheritance:

Base layout with navigation and common elements
- List view with search and filter functionality
- Create/edit forms with validation feedback
- Detail view with well status information

### Validation
Server-side validation ensures data integrity with custom error messages.


## Best Practices Implemented

- Eloquent ORM: Used for all database operations
- Form Validation: Server-side validation with custom error messages
- Blade Templates: Reusable layout with template inheritance
- Route Organization: Resource routing for RESTful API structure
- Data Integrity: Comprehensive validation rules
- User Experience: Intuitive UI with error feedback
- Code Quality: Follows Laravel conventions and best practices
