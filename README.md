# Restaurant Website

A restaurant website with menu management features built with PHP, MySQL, and Bootstrap 4.

## Prerequisites

- XAMPP (includes Apache, MySQL, and PHP)
- Web browser
- Text editor

## Installation

1. **Install XAMPP**
   - Download XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
   - Install it following the instructions for your operating system
   - Common installation paths:
     - Windows: `C:\xampp`
     - macOS: `/Applications/XAMPP`
     - Linux: `/opt/lampp`

2. **Clone the Repository**
   ```bash
   cd /path/to/xampp/htdocs
   git clone git@github.com:mfmaite/tecnoinf-php.git
   cd restaurant
   ```

3. **Configure Database Connection**
   - Open `seed_database.sh`
   - Update the MySQL connection settings if needed:
     ```bash
     MYSQL_USER="root"
     MYSQL_PASSWORD=""
     MYSQL_HOST="localhost"
     MYSQL_PORT="3376"
     ```
   - Update the XAMPP path according to your installation:
     ```bash
     XAMPP_PATH="C:/xampp"  # Update this path
     ```

## Database Setup

1. **Start XAMPP Services**
   - Open XAMPP Control Panel
   - Start Apache and MySQL services

2. **Run Database Seed**
   - Make the seed script executable (Unix-based systems):
     ```bash
     chmod +x seed_database.sh
     ```
   - Run the seed script:
     ```bash
     ./seed_database.sh
     ```
   - For Windows Command Prompt:
     ```batch
     bash seed_database.sh
     ```

## Running the Application

1. **Start XAMPP Services**
   - Make sure Apache and MySQL are running in XAMPP Control Panel

2. **Create the .env file**
   - You'll need to create the `.env` file and add the values for the keys detailed on `.env.example`. Reach for help if you don't know how to complete this!

3. **Generate the Vendor folder**
    - To be able to test the emails functionalities, you will need to generate the Vendor folder with the command `composer install`

4. **Access the Website**
   - Open your web browser
   - Visit: `http://localhost/restaurant`
   - Admin panel: `http://localhost/restaurant/admin`


