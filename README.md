# Arkwright
Headless product API for eCommerce applications.

### Getting Started 
Firstly, you will need to copy the `.env.example` file, and setup your datebase connection:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=arkwright
DB_USERNAME=root
DB_PASSWORD=
```
After this run `php artisan key:generate` to generate an app key in order to run the app.

The products for this service are imported via a client FTP, which is accessed manually by running:
```shell script
php artisan arkwright:product-upload
```
Else, this command is scheduled to run at 8am every day.

When this command is run, and the csv is not empty, a `_backup_` table is created of yesterday's products (in case of rollback), then the `products` table is truncated, and the new products are inserted into the table.
