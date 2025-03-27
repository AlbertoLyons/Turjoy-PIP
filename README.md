# TURJOY

php artisan migrate:fresh --seed

Es un sistema que permite la búsqueda de reservas y la reserva de pasajes en línea de la empresa "Turjoy". Permite al usuario visualizar las rutas de los viajes y reservar pasajes de acuerdo a su fecha y hora, indicando el origen, destino y cantidad de pasajes.

El objetivo de este documento es guiar al usuario en el uso correcto de los requisitos previos e instalación. Además, se busca comprender el funcionamiento del sistema. Para esto, el documento se divide en ciertos puntos
  - Funcionamiento del sistema
  - Instalación de requisitos previos
  - Configuración del guardado de proyecto 
  - Instalacion de dependencias 
  - Configuracion de archivos y migracion de bases de datos

## Funcionamiento del sistema
Este sistema cuenta con una página web en donde existen dos tipos de interacción una para el cliente (usuario) y administrador.
## Usuario
 - Permite reservar pasajes indicando su fecha, hora, origen y destino
 - Visualizar los detalles de la reserva.
 - Ver el precio total.
 - Buscar reservas en base a un código de reserva
 - Descargar comprobante en formato PDF.
## Administrador
 - Permite iniciar sesión mediante un correo y contraseña.
 - Permite cargar las rutas de los viajes indicando los asientos disponibles, el origen, destino y tarifa base de los viajes de Turjoy.
 - Obtener reportes de reservas en donde contiene una tabla mas detallada de las reservas.

## Alcance de la mantención
El mantenimiento del sistema web desarrollado en Laravel y PHP abarca una serie de tareas preventivas y correctivas diseñadas para garantizar su estabilidad, seguridad y rendimiento. Estas tareas pueden ser realizadas por el equipo técnico o administradores de sistemas, siguiendo las mejores prácticas de desarrollo y operación.

Este manual describe detalladamente las tareas que forman parte del mantenimiento preventivo y correctivo del sistema, estableciendo la responsabilidad del equipo encargado de su ejecución y el impacto esperado de cada acción.


## 2. Requisitos previos

1. Cualquier versión de **[Node.js](https://nodejs.org/en)** superior a 10.0, se recomienda >= 20.0.  
2. Visita la web de **[Chocolatey](https://vehikl.com/)** para obtener cualquier versión necesaria o simplemente ejecuta el siguiente comando en PowerShell:  

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))
```  

- Consulta la documentación de **[Laravel](https://laravel.com/docs/12.x/installation#installing-php)** para la instalación de **PHP**, **Laravel** y **Composer**. Para la versión recomendada **PHP 8.1**, usa lo siguiente:  

- En Windows, ejecuta como administrador:  
```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.1'))
```  

- En macOS:  
```bash
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.1)"
```  

- En Linux:  
```bash
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.1)"
```  

3. Para verificar que todo se haya instalado correctamente, usa los siguientes comandos:  
   - `node -v`  
   - `choco -v`  
   - `php -v`  
   - `laravel -v`  
   - `composer -v`
   
## 3. Procedimientos de mantención preventiva

### Actualización periódica de Laravel y sus dependencias mediante
```bash
composer update
```
### Actualización de paquetes frontend con:
```bash
npm update
```
### Limpieza de caché del sistema:
```bash
php artisan cache:clear
config:clear
```

## Copia de seguridad de la base de datos y archivos. 
Las copias de seguridad de la base de datos y los archivos pertenecientes al sistema web serán almacenados en 2 unidades de almacenamiento en modo R.A.I.D nivel 0, cuyas unidades son separadas de la unidad de almacenamiento principal del sistema web. El proposito de almacenar estas copias de seguridad es para garantizar una alta disponibilidad del sistema mediante la redundancia en el almacenamiento. Estas copias de seguridad se realizarán diariamente a las 04:00 AM hora chilena.

## Monitoreo de logs 
Los logs son un registro de eventos que suceden en el sistema web, que incluyen errores, advertencias e información de depuración, incluyendo los detalles y en el tiempo que suceden los eventos. Estos logs se deben de monitorizar cada vez que ocurre un fallo, error o advertencia que ocurre desde la consola del servidor web. Para poder encontrarlos estos se encuentran en la raiz de los archivos del sistema, en la siguiente ruta:
```bash
storage/logs/laravel.log
```
Para poder encontrar un log sobre algún evento que uno este buscando, se recomienda buscar desde la fecha y hora de inicio del log.

## Revisión de consumo de recursos. 
La revisión de consumo de recursos se realiza mediante la terminal de administrador de recursos del sistema operativo en donde se esté ejecutando el sistema web, donde se considera el consumo del CPU, RAM y disco. La revisión del consumo de los recursos es clave para determinar cuando el servidor del sistema está en su máxima capacidad, o como se comporta en un consumo promedio. La tarea en cuestión a observar sería el proceso llamado "Turjoy" o la consola del terminal para poder visualizar el consumo de los recursos.

# 7. Contacto y responsables
## Listado de personas responsables de la mantención.
Las personas responsables a cargo de la mantención del sistema son las personas pertenecientes al equipo de trabajo "Phoophp". Los miembros son los siguientes:

- Francisco Concha
- Nicolas Díaz
- Vicente Figueroa
- Alberto Lyons
- Matías Salas

## Procedimiento para reportar fallos y solicitudes de soporte. 
Para el personal que haya encontrado algún tipo de fallo del sistema web, tiene que realizar un procedimiento para poder reportarlo en un formulario y elevar una solicitud al soporte que serían por los siguientes pasos:

- Describir la serie de pasos que realizó para haberse encontrado con el fallo
- En caso de que se muestre algún mensaje y/o código de error, adjuntarlo en el formulario.
- Describir el Hardware y Sistema Operativo en el que se está ejecutando el sistema y en que plataforma se está ejecutando
- Mencionar la causa del fallo en caso de que lo haya encontrado.
- Juntar todos los datos recopilados y enviarlo mediante un correo electrónico a la dirección de soporte "phoophp@turjoy.cl".

Toda solicitud de soporte serán atendidas las que hayas sido enviadas al correo de soporte.