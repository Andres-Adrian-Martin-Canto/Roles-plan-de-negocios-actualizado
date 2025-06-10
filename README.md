# 🎓 Proyecto de Titulación

Desarrollado por **Andres Adrian Martin Canto** y **Carlos Daniel Aguilar Poot** como parte del proyecto final de titulación.

---

## 📑 Tabla de Contenidos

- [📦 Requisitos Previos](#-requisitos-previos)
- [🛠️ Instalación del Entorno](#-instalación-del-entorno)
- [📥 Clonar el Repositorio](#-clonar-el-repositorio)
- [⚙️ Instalación del Proyecto](#-instalación-del-proyecto)
- [🔧 Configuración del Entorno](#-configuración-del-entorno)
- [🚀 Uso](#-uso)
- [🙌 Créditos](#-créditos)
- [📄 Licencia](#-licencia)

---

## 📦 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- 🧰 [Git](https://git-scm.com/)
- 🟩 [Node.js y npm](https://nodejs.org/)
- 📦 [Composer](https://getcomposer.org/)
- 💻 Un entorno local como [Laragon](https://laragon.org/) o [XAMPP](https://www.apachefriends.org/index.html)

---

## 🛠️ Instalación del Entorno

### 🔹 Opción 1: Laragon

1. Descarga Laragon desde [aquí](https://laragon.org/download/).
2. Instálalo con la configuración por defecto.
3. Crea una carpeta en `C:\laragon\www` para colocar el proyecto.

### 🔸 Opción 2: XAMPP

1. Descarga XAMPP desde [aquí](https://www.apachefriends.org/index.html).
2. Instálalo con la configuración por defecto.
3. Coloca el proyecto en `C:\xampp\htdocs\proyecto-titulacion`.

---

## 📥 Clonar el Repositorio

```bash
git clone "link-repositorio"
cd Roles-plan-de-negocios-actualizado
```
### Cambiarse a la rama
```bash
git switch "La-rama-que-quieres"
```
## ⚙️ Configuración del Entorno

> 🔧 **Importante:** Antes de ejecutar la aplicación, asegúrate de configurar correctamente el entorno.

### 📄 Paso 1: Copiar el archivo de entorno

Copia el archivo `*.env.example*` y renómbralo a `*.env*`. Este archivo contiene la configuración base para que Laravel funcione correctamente.


### Ejecutar comandos en tu terminal para la instalacion final
```bash
composer install
npm install
php artisan migrate
php artisan db:seed
```

## 🚀 Correr el Sistema

Sigue estos pasos para ejecutar el proyecto en modo desarrollo:

1. 🖥️ Abre una terminal y ejecuta el servidor de Laravel:
```bash
php artisan serve
``` 
2. Luego habre otra pestania de tu terminal y ejecuta esto:
```bash
npm run dev
```
### 📧 **Credenciales del Administrador**

| Campo       | Valor               |
|-------------|---------------------|
| **Correo**  | `admin@gmail.com`   |
| **Contraseña** | `12341234`         |
