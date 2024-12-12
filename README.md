# Proyecto IE

Este es un proyecto web desarrollado en **PHP** que permite gestionar una inmobiliaria. Incluye la gestión de propiedades, utilizando un servidor local configurado con **XAMPP** y una base de datos administrada mediante **phpMyAdmin**.

---

## 🚀 Características

- Gestión de propiedades: El administrador tiene el CRUD total de las propiedades.
- Visualización de propiedades disponibles para venta o renta.
- Panel de administración con visualización de todas las propiedades.
- Base de datos relacional implementada con **MySQL**.

---

## 🛠 Requisitos

1. **XAMPP** (o cualquier servidor local con soporte para PHP y MySQL).
2. Navegador web moderno.
3. Editor de texto o IDE para modificaciones (opcional).

---

## ⚙️ Instalación

### 1. Clonar el repositorio o descargar los archivos
   ```bash
   git clone https://github.com/Emmanuel/inmobiliaria.git
   ```

### 2. Mover los archivos al servidor local
   Copia la carpeta del proyecto en el directorio `htdocs` de tu instalación de XAMPP. Por ejemplo:
   ```
   C:\xampp\htdocs\inmobiliaria
   ```

### 3. Configurar la base de datos

1. Abre **phpMyAdmin** accediendo a `http://localhost/phpmyadmin`.
2. Crea una base de datos llamada `inmobiliaria` (o el nombre que prefieras).
3. Importa el archivo `database/inmobiliaria.sql` incluido en el proyecto.

### 4. Configurar el archivo de conexión a la base de datos

1. Localiza el archivo `backend/conection.php`.
2. Asegúrate de que las credenciales coincidan con tu configuración local:
   ```php
   <?php
   $host = 'localhost';
   $user = 'root';
   $password = '';
   $database = 'inmobiliaria';

   $conn = new mysqli($host, $user, $password, $database);

   if ($conn->connect_error) {
       die("Conexión fallida: " . $conn->connect_error);
   }
   ?>
   ```

### 5. Iniciar el servidor

1. Abre **XAMPP** y enciende los módulos de **Apache** y **MySQL**.
2. Accede al proyecto desde tu navegador:
   ```
   http://localhost/inmobiliaria
   ```

---



---

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas! Si deseas colaborar:

1. Haz un fork del repositorio.
2. Crea una rama con tu funcionalidad: `git checkout -b feature/nueva-funcionalidad`.
3. Realiza un commit de tus cambios: `git commit -m 'Añadida nueva funcionalidad'`.
4. Envía tus cambios: `git push origin feature/nueva-funcionalidad`.
5. Abre un pull request.



---

¡Gracias por usar este proyecto! 😊
