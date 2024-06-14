# Sistema de Tienda Online (Beta)

Este es un sistema en fase beta que simula una tienda online. Está diseñado para proporcionar una plataforma tanto para usuarios como para administradores, con funcionalidades específicas para cada tipo de usuario.

## Características

### Vista de Usuario
- **Registro de Usuarios**: Los nuevos usuarios pueden registrarse en la plataforma.
- **Agregar Productos al Carrito**: Los usuarios pueden navegar por los productos y añadirlos a su carrito de compras.

### Vista de Administrador
- **Gestión de Productos**: Los administradores pueden agregar, editar y eliminar productos del inventario.
- **Gestión de Usuarios**: Los administradores pueden agregar, editar y eliminar usuarios, incluyendo otros administradores.
- **Gestión de Administradores**: Permite la creación y gestión de cuentas de administrador.

## Tecnologías Utilizadas

- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Base de Datos**: MySQL

## Instalación

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/juanportillo1/appdb.git
   
2. **Configurar la base de datos:**
  - Crear una base de datos MySQL llamada db_productos.
  - Ejecuta una query para agregar las tablas (dbct.txt).

3. **Configurar el entorno:**
   - Asegurarse de tener un servidor local (como XAMPP o WAMP) configurado y ejecutándose.
   - Colocar el proyecto clonado en el directorio raíz del servidor (e.g., htdocs para XAMPP).
     
4. **Actualizar la configuración de la base de datos:**
   - Editar el archivo config/dbct.php con las credenciales de la base de datos:
   ```bash
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'db_productos');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     
5. **Iniciar el servidor:**
   - Navegar a http://localhost/appdb en el navegador para ver la aplicación en acción.
