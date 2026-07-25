# Installation Guide

1. Upload the `AC Sneaker_Project` folder to your hosting account, normally inside `public_html`.
2. Rename the folder to a short name such as `solecraft`.
3. Open `config/config.php` and set `BASE_URL` to the uploaded folder path, for example `/3340project`.
4. In phpMyAdmin, create/import the database by importing `database/ac_sneaker.sql`.
5. Open `config/database.php` and replace the database username and password placeholders with your hosting credentials.
6. Confirm that PHP PDO MySQL is enabled.
7. Visit `https://YOUR-NETID.myweb.cs.uwindsor.ca/3340project/index.php`.
8. Log in with the demonstration admin account and immediately change or replace the seed accounts.
9. Test registration, product search, cart, checkout, themes, product editing, user disabling, support requests, and monitoring.

## GitHub repository
Create a new GitHub repository, upload the entire project, and commit changes in logical stages. Do not upload real passwords. Add `config/database.php` to `.gitignore` after creating a safe example configuration.


## Exact University Hosting Layout

Your server layout should be:

```text
public_html/
└── 3340project/
    ├── admin/
    ├── assets/
    ├── config/
    ├── database/
    ├── docs/
    ├── help/
    ├── includes/
    ├── index.php
    ├── shop.php
    └── all other project PHP files
```

Everything inside the supplied `3340project` folder belongs under:

```text
public_html/3340project/
```

Do not place PHP pages in a separate location. The `database` and `docs` folders may remain inside the project for submission and installation reference. For stronger production security, they could be moved outside `public_html`, but keeping them here is acceptable for this classroom project.

Expected live homepage:

```text
https://chen5w.myweb.cs.uwindsor.ca/3340project/index.php
```


## University of Windsor database settings

The project is preconfigured with:

```php
$host = 'localhost';
$dbname = 'chen5w_3340project';
$username = 'chen5w_3340project';
```

For security, the downloadable package does not contain your database password. On the server, edit:

```text
public_html/3340project/config/database.php
```

Replace:

```php
$password = 'PASTE_YOUR_DATABASE_PASSWORD_HERE';
```

with the password shown once when DirectAdmin created the database.

The SQL import file intentionally does not contain `CREATE DATABASE` or `USE` commands. First select `chen5w_3340project` in phpMyAdmin, then import the file.
