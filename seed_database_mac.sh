#!/bin/bash

MYSQL_USER="root"
MYSQL_PASSWORD=""
MYSQL_HOST="localhost"
MYSQL_PORT="3376"
# Update this path to your XAMPP installation path
XAMPP_PATH="/Applications/XAMPP/xamppfiles"

if ! pgrep -x "mysqld" > /dev/null; then
    sudo $XAMPP_PATH/xampp startmysql
    sleep 5
fi

$XAMPP_PATH/bin/mysql -h $MYSQL_HOST -u $MYSQL_USER --password="$MYSQL_PASSWORD" < database_seed.sql

if [ $? -eq 0 ]; then
    echo "Database seeded successfully!"
else
    echo "Error seeding database. Please check your MySQL connection details."
fi
