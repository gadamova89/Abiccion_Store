# Abicción Store 🚴

Sistema de gestión de tienda de bicicletas con panel de administración, control de categorías, productos y usuarios.

## 📋 Características

- ✅ **Autenticación y roles de usuario** (Admin, Vendedor, Cliente)
- ✅ **Panel de administración** (Dashboard personalizado por rol)
- ✅ **Gestión de productos** (CRUD completo)
- ✅ **Gestión de categorías** (Crear, editar, eliminar)
- ✅ **Control de usuarios** (Clientes y personal)
- ✅ **Carrito de compras** (Integrado en la tienda)
- ✅ **Búsqueda de productos** (Con filtros por categoría)
- ✅ **Integración WhatsApp** (Para contacto directo)
- ✅ **Asistente inteligente** (IA integrada)

## 🛠️ Tecnologías

- **PHP 7.4+** - Backend
- **MySQL** - Base de datos
- **Bootstrap 5** - Framework CSS
- **JavaScript** - Frontend interactivo
- **jQuery** - Manipulación del DOM
- **OpenRouter API** - Para el asistente IA

## 📁 Estructura del Proyecto

```
Abiccion_Store/
├── app/
│   ├── config/          # Configuración general
│   ├── controllers/     # Controladores MVC
│   ├── core/           # Clases core (Router, Database, etc)
│   ├── models/         # Modelos de datos
│   └── views/          # Vistas PHP
├── public/
│   ├── assets/         # CSS, JS, imágenes
│   └── vendor/         # Librerías externas
├── uploads/            # Directorio para subidas
├── .env                # Variables de entorno
└── index.php           # Punto de entrada
```

## ⚙️ Instalación

### 1. Requisitos previos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- XAMPP o servidor local similar
- Composer (opcional)

### 2. Clonar el repositorio

```bash
git clone https://github.com/gadamova89/Abiccion_Store.git
cd Abiccion_Store
```

### 3. Configurar variables de entorno

Copia el archivo `.env.example` a `.env` y completa los valores:

```bash
cp .env.example .env
```

Edita `.env` con tus configuraciones:

```env
API_KEY=tu_openrouter_api_key_aqui
```

### 4. Crear la base de datos

Importa el archivo SQL proporcionado en tu cliente MySQL:

```bash
mysql -u root -p < database.sql
```

### 5. Configurar permisos

Asegúrate de que la carpeta `uploads/` tiene permisos de escritura:

```bash
chmod 755 uploads/
```

### 6. Acceder a la aplicación

```
http://localhost/Abiccion_Store
```

## 👤 Credenciales por defecto

| Rol      | Usuario              | Contraseña  | Acceso       |
| -------- | -------------------- | ----------- | ------------ |
| Admin    | admin@example.com    | admin123    | `/dashboard` |
| Vendedor | vendedor@example.com | vendedor123 | `/dashboard` |
| Cliente  | cliente@example.com  | cliente123  | Home         |

**⚠️ Nota:** Cambia las contraseñas en producción.

## 🔑 Variables de Entorno

Valores necesarios en `.env`:

```env
# API Keys
API_KEY=sk-or-v1-xxxxx           # OpenRouter API Key

# Base de datos (si es necesario)
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=abiccion_store
```

## 📊 Flujo de la aplicación

1. **Usuario accede** → `index.php` (RouterEnrutador)
2. **Router** identifica la ruta y controlador
3. **Controlador** procesa la lógica
4. **Modelo** interactúa con BD
5. **Vista** renderiza la respuesta

## 🚀 Uso

### Para Administradores

- Gestionar categorías y productos
- Controlar usuarios (clientes y personal)
- Ver estadísticas en el dashboard

### Para Vendedores

- Crear y editar sus productos
- Gestionar inventario
- Ver órdenes relacionadas

### Para Clientes

- Navegar catálogo
- Buscar por categoría
- Añadir al carrito
- Contactar vía WhatsApp

## 🔐 Seguridad

- Las credenciales sensibles están en `.env` (nunca se suben a git)
- Contraseñas hasheadas en BD
- SQL Injection prevention con prepared statements
- CSRF protection en formularios

## 📝 API Endpoints

| Método | Ruta          | Descripción           |
| ------ | ------------- | --------------------- |
| GET    | `/`           | Home                  |
| GET    | `/login`      | Página de login       |
| POST   | `/login`      | Procesar login        |
| GET    | `/dashboard`  | Dashboard del usuario |
| GET    | `/productos`  | Listado de productos  |
| POST   | `/productos`  | Crear producto        |
| GET    | `/categorias` | Gestión de categorías |

## 🐛 Solución de problemas

### "No se conecta a la BD"

- Verifica que MySQL esté corriendo
- Comprueba credenciales en `app/config/config.php`
- Confirma que la BD existe

### "API Key no válida"

- Obtén una clave en [OpenRouter](https://openrouter.ai)
- Actualiza `.env` con la clave correcta
- Reinicia la aplicación

### "Permisos de carpeta"

```bash
chmod -R 755 uploads/
chmod -R 755 public/assets/
```

## 📧 Contacto

- **GitHub:** [gadamova89](https://github.com/gadamova89)
- **WhatsApp:** Integrado en la aplicación

## 📄 Licencia

Este proyecto es de uso privado/educativo.

---

**Última actualización:** 2026-09-11
