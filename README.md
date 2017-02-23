-* yii2-user
https://github.com/dektrium/yii2-user/blob/master/docs/getting-started.md

-* migrate:
php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations

-* yii2-admin
https://github.com/mdmsoft/yii2-admin/blob/master/docs/guide/configuration.md

-*To use the menu manager (optional), execute the migration here:

> yii migrate --migrationPath=@mdm/admin/migrations

-* If you use database (class 'yii\rbac\DbManager') to save rbac data, execute the migration here:

> yii migrate --migrationPath=@yii/rbac/migrations

-* add fields status, password_token_access (maybe change is > user_id on user table)


