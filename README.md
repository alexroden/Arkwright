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

The products for this service are imported via a client FTP, meaning that these environment variables need to be set:
```shell script
FTP_SERVER=
FTP_USERNAME=
FTP_PASSWORD=
```
This can then be accessed manually by running:
```shell script
php artisan arkwright:product-upload
```
Else, this command is scheduled to run at 8am every day.

When this command is run, and the csv is not empty, a `_backup_` table is created of yesterday's products (in case of rollback), then the `products` table is truncated, and the new products are inserted into the table.

In order to query this API you will need to set up a user. However, there is a test user within a seeder file, therefore you can query the API with this user by running `php artisan db:seed`.

### Query API
This API is protected by an authentication middleware, which checks for a valid `User-Token` set against a valid user, this token needs to be set in the header of any request.

#### Requests
**Route**

`GET: /api/products`

**Parameters**
You can query this endpoint based on PLU code:

| Param | Value |
| ----------- | ----------- |
| `plu` | `string` |

**Response**

```json
{
    "code": 200,
    "data": [
        {
            "PLU": "AAA",
            "name": "Random product AAA.",
            "sizes": [
                {
                    "SKU": 101,
                    "size": 22
                },
                ...
            ]
        },
        ...  
   ]
}
```

### Tests
This project contains API route tests, which assert against snapshots, and command tests, which assert database insertion. 
These are run through phpunit, therefore to run these tests run the command `phpunit` in your terminal.
