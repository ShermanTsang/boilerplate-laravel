# Generate project

Firstly, we should generate project with my repository named ShermanTsang/Boilerplate-Laravel .

# Install DCat-Admin

```bash
php artisan admin:install
```

# Config Laravel Framework

Modify the files in config directory.

# Generate models

We use a laravel package `reliese/laravel` to generate our models.

```bash
php artisan vendor:publish --tag=reliese-models
php artisan config:clear
php artisan code:models
```

Download the model files from the server to your local development directory.

You should check and modify them to apply for your business logics.
