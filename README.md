1. clone 專案：

```
git clone https://github.com/hdsbook/laravel8-vue-spa-tdd-practice.git
cd laravel8-vue-spa-tdd-practice
```

2. composer, npm 初始化

```
composer install && npm install
```

3. database 初始化

```shell
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
```

4. storage permission setting

```
php aritisan storage:link
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

5. 打包 assets

```
npm run watch
```

6. 運行專案

```
php artisan serve
```
