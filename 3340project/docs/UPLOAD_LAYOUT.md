# Upload Layout for AC Sneaker

Upload the entire `3340project` folder into `public_html`.

```text
public_html/
└── 3340project/
    ├── admin/                 Admin pages
    ├── assets/
    │   ├── css/               External CSS
    │   ├── images/            Product and site images
    │   ├── js/                External JavaScript
    │   └── media/             Audio files
    ├── config/                Application and database settings
    ├── database/              MySQL import file
    ├── docs/                  Project documentation
    ├── help/                  Help wiki pages
    ├── includes/              Shared header, footer, functions
    ├── index.php              Homepage
    └── other PHP pages
```

No project files need to be uploaded elsewhere for the website to run.

Before testing:
1. Import `database/ac_sneaker.sql` using phpMyAdmin.
2. Enter your MySQL credentials in `config/database.php`.
3. Keep `BASE_URL` as `/3340project` in `config/config.php`.
