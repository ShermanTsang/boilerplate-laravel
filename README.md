# Boilerplate for Laravel

## Fetch project

Firstly, we should generate project with my repository named ShermanTsang/Boilerplate-Laravel .
```shell
git clone ShermanTsang/Boilerplate-Laravel
```

## Deploy

- Start your docker daemon
- Compose up from the root of project
```shell
docker compose up --build
```

## Install dcat-admin

You have no need to run `php artisan admin:publish` command, because the project already load with the related files.

```shell
docker compose exec app bash -c "php artisan admin:install"
```

If executing successfully, you can see the logs:
```text
time="2025-05-23T11:18:51+08:00" level=warning msg="D:\\Code\\Boilerplate\\boilerplate-laravel\\docker-compose.yml: the attribute `version` is obsolete, it will be ignored, please remove it to avoid potential confusion"
time="2025-05-23T11:18:51+08:00" level=warning msg="Found orphan containers ([boilerplate-laravel-app-run-bb5312e5f696 boilerplate-laravel-app-run-cb8dc0fbdd20]) for this project. If you removed or renamed this service in your compose file, you can run this command with the --remove-orphans flag to clean it up."
[+] Creating 1/1
 ✔ Container boilerplate-laravel-db  Running                                                                                                                                           0.0s 
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table (11.04ms)
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table (7.00ms)
Migrating: 2016_01_04_173148_create_admin_tables
Migrated:  2016_01_04_173148_create_admin_tables (35.91ms)
Migrating: 2019_08_19_000000_create_failed_jobs_table
Migrated:  2019_08_19_000000_create_failed_jobs_table (9.46ms)
Migrating: 2019_12_14_000001_create_personal_access_tokens_table
Migrated:  2019_12_14_000001_create_personal_access_tokens_table (11.84ms)
Migrating: 2020_09_07_090635_create_admin_settings_table
Migrated:  2020_09_07_090635_create_admin_settings_table (7.22ms)
Migrating: 2020_09_22_015815_create_admin_extensions_table
Migrated:  2020_09_22_015815_create_admin_extensions_table (16.70ms)
Migrating: 2020_11_01_083237_update_admin_menu_table
Migrated:  2020_11_01_083237_update_admin_menu_table (1.86ms)
Database seeding completed successfully.
/www/app/app/Admin directory already exists !
Done.
```

## Generate models

We use a laravel package `reliese/laravel` to generate our models.

```bash
docker compose exec app bash -c "php artisan vendor:publish --tag=reliese-models"
docker compose exec app bash -c "php artisan config:clear"
docker compose exec app bash -c "php artisan code:models"
```

The program will download the model files from the server to your local development directory automatically.

You should check and modify them to apply for your business logics.
