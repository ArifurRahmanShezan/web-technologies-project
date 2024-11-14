# AutoAuto Fleet - Discover, Buy & Sell Vehicles

AutoAuto Fleet is a web-based marketplace designed to streamline the process of discovering, buying, and selling vehicles, including bikes, cars, buses, and trucks. Built with PHP, HTML, CSS, and JavaScript, the platform provides a user-friendly interface for seamless browsing and efficient transaction handling.

## Table of Contents

- [Features](#features)
- [Technologies](#technologies)
- [Installation](#installation)
- [Usage](#usage)
- [Folder Structure](#folder-structure)
- [Contributing](#contributing)
- [License](#license)

## Features

- **Vehicle Listings**: Browse and filter vehicles by type, make, model, and other criteria.
- **User Registration**: Secure sign-up and login for customers, along with account management.
- **Feedback Moderation**: Employees can review and moderate customer feedback to ensure quality.
- **Responsive Design**: Fully optimized for desktop, tablet, and mobile screens.
- **Secure Transactions**: Protects user data with appropriate validation and error handling.

## Technologies

The project utilizes the following technologies:

- **Backend**: PHP
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL (or any other relational database)
- **Server**: XAMPP (or any other PHP-compatible server)

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/autoAutoFleet.git
    ```
2. Start your local server (e.g., XAMPP) and ensure MySQL and Apache are running.
3. Import the database:
   - Go to `phpMyAdmin`, create a new database (e.g., `auto_auto_fleet`), and import the SQL file located in `/db/autoAutoFleet.sql`.
4. Configure the database connection:
   - Update the database configuration in `config.php` with your local credentials.
5. Open your web browser and navigate to `http://localhost/autoAutoFleet`.

## Usage

1. **Customer Registration**: Sign up as a new customer to browse, buy, or sell vehicles.
2. **Employee Moderation**: Employees can log in to manage customer feedback and ensure the marketplace remains reliable.
3. **Vehicle Listings**: Users can view and filter through available vehicles and sellers can post new listings.

## Folder Structure

```plaintext
autoAutoFleet/
├── assets/                # CSS, JavaScript, and image files
├── db/                    # Database SQL scripts
├── includes/              # PHP scripts for core functionalities
├── views/                 # HTML views and templates
├── config.php             # Database configuration file
└── index.php              # Main entry point of the application
