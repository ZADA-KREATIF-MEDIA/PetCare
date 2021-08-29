###################
PETCARE - CODEINGNITER
###################

## Cara Installasi

#### platform di bangun menggunakan CI 3.X hal yang perlu di persiapkan adalah.

* Webserver : XAMPP / LARAGON
* Editor Text : Visual Code (Rekomendasi)
* Project Management : Github

### 1. clone repository dengan perintah dengan menggunakan git bash.
```
git clone https://github.com/ZADA-KREATIF-MEDIA/PetCare.git
```

### 2. Buat Database pada phpmyadmin, lalu impor Database pada folder DB  
```
DB/project-petcare.sql
```
### 3. Rubah Konfigurasi DB  **PetCare/application/config/database.php**
```
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => '127.0.0.1',
	'username' => '(sesuaikan dengan komputer anda)',
	'password' => '(sesuaikan dengan komputer anda)',
	'database' => 'project-petcare',
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
```
### 4. Jalankan dengan menggunakan broser
```
localhost/petcare
```
