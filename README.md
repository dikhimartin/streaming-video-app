[![Bina Drive Logo](https://raw.githubusercontent.com/dikhimartin/streaming-video-app/main/public/admin_assets/assets/images/logo-full.png)](https://streamingapp.dikhimartin.tech/)



Demo : [https://streamingapp.dikhimartin.tech](https://streamingapp.dikhimartin.tech/)

# Streaming Video App -  (Team Assignment 1)



## Penjelasan

Kami membuat project ini, karena untuk melengkapi satu tugas kelompok di Universitas. Jadi kita diminta untuk membuat suatu website CMS dengan kriteria sebagai berikut :

```
Buatlah aplikasi video streaming menggunakan laravel. Berikut aturannya:
a.	Inputan:
    •	Text Nama File 
    •	Menu upload video.
b.	Menampilkan tampilan list file yang sudah diupload
c.	Jika list pada file video tersebut di klik maka akan play video streaming yang dipilih.
d.	User dapat mengedit nama file atau upload video ulang. 
e.	User dapat menghapus nama file dan video yang telah diupload.

Tech Stack Requirement : 
- Laravel Framework >= 5.6 

source : 20220629154936_TK1-W3-S4-R1
```



Dari kriteria tersebut dapat di definisikan beberapa menu yang ada dalam website, antara lain :

![](https://raw.githubusercontent.com/dikhimartin/streaming-video-app/main/public/images/admin-page.png)



## Cara menjalankan aplikasi

**Tech Stack :**

- **Server Native :**

  - PHP >= 7.1.3

  - OpenSSL PHP Extension

  - PDO PHP Extension

  - Mbstring PHP Extension

  - Tokenizer PHP Extension

  - XML PHP Extension

  - Ctype PHP Extension

  - JSON PHP Extension
  - Composer - https://getcomposer.org

- **Server Container :**

  - Docker Engine https://docs.docker.com/engine/install2.

  - Docker Compose https://docs.docker.com/compose/install

    

**Proses Instalasi Laravel 5.6 (Server Native) :** 

- Setting Environtment

  ```shell
  cp .env.example .env 
  ```

- Install Vendor

  ```shell
  composer install
  ```

- Persiapan

  ```shell
  php artisan key:generate
  ```

  ```shell
  php artisan config:cache
  ```

- Inisialisasi Database

  - SQL

    ```sql
    CREATE DATABASE db_streaming_video_app;
    ```

  - Terminal

    ```shell
    php artisan migrate
    ```

    ```shell
    php artisan db:seed
    ```

- Menjalankan Aplikasi

  ```shell
  php artisan serve
  ```

- Laravel development server started: <http://127.0.0.1:8000>

- Akses Login 

  - Username : superadmin
  - Password  : superadmin

------



### Made with Laravel Framework  5.6

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>



#### Intro

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.