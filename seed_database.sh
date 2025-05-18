#!/bin/bash

MYSQL_USER="root"
MYSQL_PASSWORD=""
MYSQL_HOST="localhost"
MYSQL_PORT="3376"
# Update this path to your XAMPP installation path
XAMPP_PATH="C:/xampp"

if ! tasklist | grep -q mysqld; then
  echo "MySQL no está corriendo."
  exit 1
fi

$XAMPP_PATH/mysql/bin/mysql -h $MYSQL_HOST -u $MYSQL_USER --password="$MYSQL_PASSWORD" < database_seed.sql

if [ $? -eq 0 ]; then
    echo "Database seeded successfully!"
else
    echo "Error seeding database. Please check your MySQL connection details."
fi
