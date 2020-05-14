# company_admin
企业官网后台接口模板


###composer create-project laravel/laravel=5.6.* companyHyt --prefer-dist
- php artisan key:generate
- php artisan storage:link

### composer require encore/laravel-admin
- php artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"
- php artisan admin:install
- 

### composer require laravel-admin-ext/latlong -vvv

### composer require "overtrue/laravel-lang:~3.0"
- php artisan lang:publish zh-CN

### composer require stevenyangecho/laravel-u-editor
- php artisan vendor:publish
