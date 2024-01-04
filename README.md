# LaundryApp

LaundryApp merupakan sistem aplikasi yang digunakan untuk manajemen operasional bisnis laundry. Aplikasi ini menyediakan fitur-fitur seperti pengelolaan data pelanggan, data paket, data outlet, transaksi dan laporan penghasilan. Terdapat 3 role utama pada aplikasi tersebut, yaitu admin, owner, dan kasir. Dimana setiap role memiliki fungsi yang berbeda-beda.

## Fitur

-   Admin
    -   Kelola data outlet
    -   Kelola data pengguna
    -   Kelola data pelanggan
    -   Melihat laporan penghasilan
-   Owner
    -   Melihat transaksi
    -   Melihat laporan penghasilan
-   Kasir
    -   Kelola data transaksi
    -   Kelola data pelanggan
    -   Kelola data paket
    -   Melihat laporan penghasilan

## Instalasi Local

Download project atau clone repository.
Copy file `.env.example` menjadi `.env`
Ubah nama database pada file `.env` menjadi `db_laundryapp` atau sesuai keinginan

```bash
DB_DATABASE=db_laundryapp
```

Instal project dengan menjalankan command composer instal pada terminal

```bash
composer install
```

Generate key app

```bash
php artisan key:generate
```

Migrate database

```bash
php artisan migrate
```

Jalankan project

```bash
php artisan serve
```

## Credit

[![fikrisuheri](https://img.shields.io/badge/github-000000?style=for-the-badge&logo=github&logoColor=white)](https://github.com/fikrisuheri/phpnative-aplikasi-laundry)
