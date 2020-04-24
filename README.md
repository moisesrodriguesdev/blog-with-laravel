

## :computer: Instalação Windows

Clonar o repositório:

```bash
git clone https://github.com/moisesrodriguesdev/blog-with-laravel.git
```

Instalar as dependencias:

```bash
composer install
```

Crie o arquivo database.sqlite dentro da pasta database

Rode as Migrations
```bash
php artisan migrate
```

Rode o servidor:

```bash
php artisan serve
```

Habilitar a visualização das imagens na pasta storage

```bash
php artisan storage:link
```
