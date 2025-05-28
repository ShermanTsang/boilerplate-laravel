# Technology Stack
When observer and answer user's question, should think about the stacks and corresponding versions.
## Develop language
- PHP 8.1.x
## Base framework
- Laravel 8.75
## Admin framework
- DCAT-ADMIN 2.2.2
- Docs url: https://learnku.com/docs/dcat-admin/2.x
  If necessary, you can read the content of the docs.


# Task
Knowing the user's task intenion from prompts is required. If the intenion in the scope of followings, obey the requirements.
## Add new business type
When user's prompt including text `add new business type` or the word meaning to `add new business type`.
### Input
User will provide you the `business name` and `fields`.
- The business can be multiple, if business is `giftItem`,`giftCategory`,`giftCompose` representing there are some links between them.
- `field` name with `*` represent the field is required.
- Think the model related of a field, if a field name is `book_id`, you can look up existing model if there is a model named `Book`, maybe you can link them.
### Step
You must follow the step below to write code, and all existing code files and structures within file stored folder can be learned.:
1. Add Laravel migration file storing to path `/database/migrations`:
    - Do not use `string` type for string field without limited length, use `text` type, according to the best practice of PostgresDB.
      For example:
      ```php
      $table->text('name');
      ```
    - Name the file follow Laravel's rule. For example, `2025_05_28_000001_create_users_table`.
    - Table name should be snake_case, take the plural form of a word. For example, `users`,`book_categories`.
    - `created_at` and `updated_at` is required in normal table except middle table between two models.
2. Add Laravel model storing to path `/app/Models`.
3. Add Dcat-admin repository file storing to path `/app/Admin/Repositories`.
4. Add Dcat-admin controller file storing to path `/app/Admin/Controllers`.
    - In `grid()` function, use `/resources/views/admin/mix.blade.php` as the view to group related fields.
      For example, you can use this view to display time like fields:
      ```php
      $grid->column('datetime')->display(function () {
                return [
                    ["name" => '创建', 'field' => 'created_at', 'type' => 'datetime'],
                    ["name" => '更新', 'field' => 'updated_at', 'type' => 'datetime'],
                    ["name" => '有效开始', 'field' => 'valid_datetime_start', 'type' => 'datetime', 'default' => '长期有效'],
                    ["name" => '有效结束', 'field' => 'valid_datetime_end', 'type' => 'datetime', 'default' => '长期有效'],
                ];
            })->view('admin.grid.mix');
      ```
5. Add Dcat-admin renderable file storing to path `/app/Admin/Renderable`.
6. Define Dcat-admin resource router in file `/app/Admin/routes.php`.
7. Define Dcat-admin lang in derectory `/resources/lang/[lang]/global.php`.
    - Complete `$businessText` and `$fields` according by current business.
    - `$businessText` is a array of business name, for example, `['giftItem', 'giftCategory', 'giftCompose']`.
    - `$fields` is a array of fields, for example, `['id', 'name', 'description', 'price', 'stock', 'category_id', 'created_at', 'updated_at']`.