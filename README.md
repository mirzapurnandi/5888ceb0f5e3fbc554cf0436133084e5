# Surplus Indonesia
## _oleh: Mirza Purnandi_

[![N|Solid](https://cldup.com/dTxpPi9lDf.thumb.png)](https://nodesource.com/products/nsolid)
<p><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

Membuat CRUD REST API untuk proses penyimpanan Category, Product dan Image (stok barang). Pembuatan aplikasi ini menggunakan framework Laravel 8 dimana sudah dilengkapi Migration dan Seeder. 

### Required:
- PHP 7.4
- MySQL

## Installer
-   `git clone https://github.com/mirzapurnandi/5888ceb0f5e3fbc554cf0436133084e5.git nama_folder`
-   `cd nama_folder`
-   `composer install`
-   `cp .env-example .env`
-   `php artisan key:generate`
-   `php artisan jwt:secret`
-   `php artisan migrate`
-   `php artisan db:seed`

Ikuti Langkah Berikut:
- Ubah file .env didalam folder "nama_folder"
    ```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=username_database_anda
    DB_PASSWORD=password_database_anda
    ```
- Selesai, Jalankan `php artisan serve` di command

## REST API
Berikut ini list point api
| METHOD | KETERANGAN | URL |
| ------ | ------ | ------ | 
| POST | Login | http://localhost:8000/api/v1/login |
| GET | Category Index | http://localhost:8000/api/v1/category |
| GET | Category View | http://localhost:8000/api/v1/category/1 |
| POST | Category Insert | http://localhost:8000/api/v1/category |
| PUT | Category Update | http://localhost:8000/api/v1/category/3 |
| DELETE | Category Delete | http://localhost:8000/api/v1/category/4 |
| GET | Image Index | http://localhost:8000/api/v1/image |
| GET | Image View | http://localhost:8000/api/v1/image/1 |
| POST | Image Insert | http://localhost:8000/api/v1/image |
| POST | Image Update | http://localhost:8000/api/v1/image/3 |
| DELETE | Image Delete | http://localhost:8000/api/v1/image/4 |
| GET | Product Index | http://localhost:8000/api/v1/product |
| GET | Product View | http://localhost:8000/api/v1/product/1 |
| POST | Product Insert | http://localhost:8000/api/v1/product |
| POST | Product Insert Image | http://localhost:8000/api/v1/product/image |
| POST | Product Update Image | http://localhost:8000/api/v1/product/image |
| PUT | Product Update | http://localhost:8000/api/v1/product/3 |
| DELETE | Product Delete | http://localhost:8000/api/v1/product/4 |

## CARA PENGGUNAAN
Gunakan Postman untuk dapat menjalankan API diatas.
di folder juga sudah di sediakan file .json untuk dapat di import ke dalam postman 
([SurplusMirza.postman_collection.json](https://github.com/mirzapurnandi/5888ceb0f5e3fbc554cf0436133084e5/blob/master/SurplusMirza.postman_collection.json))

### Login
| POST | Login | http://send-mail.test/index.php/login |
| ------ | ------ | ------ | 
```sh
body {
    "email": "admin@admin.com",
    "password": "password"
}
```
gunakan data diatas dikarenakan user tersebut sudah ada di database ketika db:seed.

### Category
```sh
header {
    "Authorization": "Bearer <token>",
    "Accept": "application/json"
}
```
Gunakan Selalu header Accept untuk mendapatkan response berupa Json, lalu gunakan Authorization sebagai kunci masuk. Tempelkan token yang didapatkan setelah login tadi lalu letakan di sebelah Bearer. Ini berlaku untuk semua Rest API Point yang ada di atas, jadi saya tidak akan menulis lagi kodingan diatas dikarenakan sama.

#### Category Index
| GET | Category Index | http://localhost:8000/api/v1/category |
| ------ | ------ | ------ | 
Point ini akan menampilkan semua category yang telah di input.

#### Category View
| GET | Category View | http://localhost:8000/api/v1/category/1 |
| ------ | ------ | ------ | 
Point ini akan menampilkan satu data category yang telah di input.

#### Category Insert
| POST | Category Insert | http://localhost:8000/api/v1/category |
| ------ | ------ | ------ | 
```sh
body {
    "name": "Category 1",
    "enable": true
}
```
Point ini menambahkan data category.

#### Category Update
| PUT | Category Update | http://localhost:8000/api/v1/category/1 |
| ------ | ------ | ------ | 
```sh
body {
    "name": "Category 1 Edit",
    "enable": false
}
```
Point ini memperbaharui data category id = 1.

#### Category Delete
| DELETE | Category Delete | http://localhost:8000/api/v1/category/1 |
| ------ | ------ | ------ | 
Point ini akan menghapus satu data category yang telah di input.
