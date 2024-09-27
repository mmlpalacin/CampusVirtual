<h1 class="h1">Clonar Repositorio</h1>

<h4 class="h4">Clonar El Repositorio (solo si no lo has hecho antes)</h4>
git clone https://github.com/usuario/nombre-del-repositorio.git

<h4 class="h4">Navegar al Directorio Del Repositorio</h4>

cd nombre-del-repositorio

<h4 class="h4">Instalar dependencias</h4>
<p> composer install o composer update </p>
<p> php artisan key:generate </p>

<h4 class="h4">Instalar carpeta node</h4>
<p> npm install </p>
<p> npm run build</p>

<h4 class="h4">Modificar archivo .env.example</h4>
<p> renombrar a .env. Si no se encuentra el archivo, crear .env y copiar el siguiente texto</p>
<p>APP_NAME=Laravel</p>
<p>APP_ENV=local</p>
<p>APP_KEY=base64:Mqsd05+mlWxz4WMNBVM74PRl3iq9DU2KfoL8CXDYQU0=</p>
<p>APP_DEBUG=true</p>
<p>APP_TIMEZONE=America/Argentina/Buenos_Aires</p>
<p>APP_URL=http://localhost</p>

<p>APP_LOCALE=es</p>
<p>APP_FALLBACK_LOCALE=es</p>
<p>APP_FAKER_LOCALE=es_AR</p>

<p>APP_MAINTENANCE_DRIVER=file</p>
<p># APP_MAINTENANCE_STORE=database</p>

<p>BCRYPT_ROUNDS=12</p>

<p>LOG_CHANNEL=stack</p>
<p>LOG_STACK=single</p>
<p>LOG_DEPRECATIONS_CHANNEL=null</p>
<p>LOG_LEVEL=debug</p>

<p>DB_CONNECTION=mysql</p>
<p>DB_HOST=127.0.0.1</p>
<p>DB_PORT=3306</p>
<p>DB_DATABASE=campus</p>
<p>DB_USERNAME=root</p>
<p>DB_PASSWORD=</p>

<p>SESSION_DRIVER=database</p>
<p>SESSION_LIFETIME=120</p>
<p>SESSION_ENCRYPT=false</p>
<p>SESSION_PATH=/</p>
<p>SESSION_DOMAIN=null</p>

<p>BROADCAST_CONNECTION=log</p>
<p>FILESYSTEM_DISK=local</p>
<p>QUEUE_CONNECTION=database</p>

<p>CACHE_STORE=database</p>
<p>CACHE_PREFIX=</p>

<p>MEMCACHED_HOST=127.0.0.1</p>

<p>REDIS_CLIENT=phpredis</p>
<p>REDIS_HOST=127.0.0.1</p>
<p>REDIS_PASSWORD=null</p>
<p>REDIS_PORT=6379</p>

<p>MAIL_MAILER=log</p>
<p>MAIL_HOST=127.0.0.1</p>
<p>MAIL_PORT=2525</p>
<p>MAIL_USERNAME=null</p>
<p>MAIL_PASSWORD=null</p>
<p>MAIL_ENCRYPTION=null</p>
<p>MAIL_FROM_ADDRESS="hello@example.com"</p>
<p>MAIL_FROM_NAME="${APP_NAME}"</p>

<p>AWS_ACCESS_KEY_ID=</p>
<p>AWS_SECRET_ACCESS_KEY=</p>
<p>AWS_DEFAULT_REGION=us-east-1</p>
<p>AWS_BUCKET=</p>
<p>AWS_USE_PATH_STYLE_ENDPOINT=false</p>

<p>VITE_APP_NAME="${APP_NAME}"</p>

<h4 class="h4">Linkear storage a public</h4>
php artisan storage:link

<h4 class="h4">Migrar la base de datos</h4>
php artisan migrate --seed

<h4 class="h4">Realizar cambios en los archivos</h4>

<h4 class="h4">Ver página</h4>
php artisan serve

<h1 class="h1">Actualizar Repositorio</h1>
<h4 class="h4">Añadir los Cambios Al Área De Preparación</h4>

git add .

<h4 class="h4">Confirmar los Cambios Con Un Mensaje Descriptivo</h4>
git commit -m "Descripción de los cambios"

<h4 class="h4">Enviar los Cambios Al Repositorio Remoto</h4>
git push origin main


<h1 class="h1">Crear Rama Y Subir Los Proyectos A Esa Rama</h1>

• git checkout -b nombreDeLaRama (crea una nueva rama y te posiciona en ella)


• git branch (para verificar que se creo)


• git add .


• git commit -m "resumen de los archivos o cambios que haces"


• git push origin nombreDeLaRama (sube los archivos a la rama)

<h1 class="h1">Volver Atrás En Los Commits</h1>

git checkout HEAD~1 (o el número de commits que quieras retroceder)

<h1 class="h1">Actualizar Archivo Local</h1>

git pull