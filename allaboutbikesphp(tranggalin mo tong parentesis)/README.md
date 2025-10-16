# All About Bikes — Database

This repository expects a MySQL/MariaDB database named `allaboutbikes`. I added a SQL schema file at `db/create_allaboutbikes_schema.sql` that creates the database and the tables the application uses (employee, customer, bike, part, sale, sale_detail, rental, repair).

Quick import instructions (Windows PowerShell):

```powershell
# from the workspace root
# 1) Start your MySQL server (if you use XAMPP, start MySQL from the XAMPP control panel)
# 2) Run the import (you may need to adjust user/password)
mysql -u root -p < .\db\create_allaboutbikes_schema.sql
```

If you prefer phpMyAdmin, open phpMyAdmin, create a new database named `allaboutbikes` (or let the SQL file create it) and import `db/create_allaboutbikes_schema.sql`.

Notes:
- The schema uses InnoDB and UTF8MB4.
- `db/dbconn.php` already connects to database `allaboutbikes` by default. If you keep those credentials, the app should connect after you import.
- I included a small `db/check_db.php` script to verify connection and list expected tables.

If you want, I can also:
- Create sample users with secure password hashes so `adminlogin.php` can be tested immediately.
- Add migrations (incremental SQL) instead of a single dump.
