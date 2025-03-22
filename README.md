# Codeigniter 3 E-Learning

My first Codeigniter 3 project. I made this project because I was inspired by my university's website, so I tried to make my own website with some similarities to my university's website.

## Pre-requisites

Ensure you have the following installed on your system:

- PHP 8.2
- MySQL 8.0
- Apache/Nginx (or any preferred web server)
- Composer (optional, for managing dependencies)

## Installation Guide

1. **Clone the Repository**

    ```sh
    git clone https://github.com/X-Hozmi/E-Learning.git
    cd E-Learning

2. **Configure the Database**

   - Create a new database in MySQL:

        ```mysql
        CREATE DATABASE db_ci3;
    
   - Import the provided SQL file:

        ```sh
        mysql -u root -p db_ci3 < assets/db/db_ci3.sql

3. **Configure .env or application/config/database.php**

   - Update your database credentials:

        ```php
        $db['default'] = array(
            'dsn'   => '',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'db_ci3',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => FALSE,
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );

4. **Set File Permissions (Linux/macOS)**

    ```sh
    chmod -R 777 application/cache application/logs

## Manually Add User to Database

To manually add an admin user to db_ci3.user, run the following SQL query:

```mysql
INSERT INTO user (nama, email, gambar, password, id_role, is_active, date_created) 
VALUES (
    'Admin Name',
    'admin@example.com',
    'default.jpg',
    MD5('password123'), 
    1, 
    1, 
    UNIX_TIMESTAMP(NOW()) * 1000
);

