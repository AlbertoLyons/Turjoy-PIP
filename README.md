# TURJOY
## Para levantar el proyecto se deben seguir lo siguientes pasos:

## Requisitos previos:
- PHP 8.1
- Visual Studio Code 1.95.3 o superior
- Composer
- Base de datos MySql/PostgreSql
- Laravel
## Instalación
### 1. Primero debemos abrir la consola de comandos apretando las siguientes teclas y escribir 'cmd':

- "Windows + R" y escribimos 'cmd'

### 2. Ahora debemos crear una carpeta en donde guardar el proyecto, esta carpeta puede estar donde desee el usuario:
```bash
mkdir [NombreDeCarpeta]
```
### 3. Accedemoss a la carpeta.
```bash
cd NombreDeCarpeta
```
### 4. Se debe clonar el repositorio en el lugar deseado por el usuario con el siguiente comando:
```bash
git clone https://github.com/AlbertoLyons/Turjoy-PIP.git
```
### 5. Accedemos a la carpeta creada por el repositorio:
```bash
cd Turjoy-PIP
```
### 6. Ahora debemos restaurar las dependencias del proyecto con el siguiente comando:
```bash
composer install
npm install
```
### 7. Con las dependencias restauradas, abrimos el editor:
```bash
code .
```
### 8. Configurar el .env utilizando el .env.example de ejemplo para una ejecución correcta
### 9. Ejecutar las migraciones de base de datos
```bash
php artisan migrate
```
Posteriormente se ejecuta:
```bash
php artisan db:seed
```
### 10. Finalmente ya en el editor ejecutamos el siguiente comando para ejecutar el proyecto:
```bash
php artissan serve
```
## Estructura del repositorio
- Funciona con una API de tipo REST
- Se utiliza el Framework Laravel de PHP
- Utiliza endpoints para realizar el CRUD de la base de datos
- Se utiliza la ruta "http://127.0.0.1:8000" para acceder al sistema
- Existe una cuenta de acceso de administrador de ejemplo, cuyas credenciales son:
  - Usuario: italo.donoso@ucn.cl 
  - Contraseña: Turjoy91