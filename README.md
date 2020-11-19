1. clone 專案：

```
git clone https://github.com/hdsbook/laravel8-vue-spa-tdd-practice.git
cd laravel8-vue-spa-tdd-practice
```

2. composer, npm, database 初始化

```
composer install && npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
```

3. storage permission setting

```
php aritisan storage:link
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

4. 打包 assets

```
npm run watch
```

5. 運行專案

```
php artisan serve
```
