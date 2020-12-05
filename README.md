## 安装

 1. 安装包文件

	``` bash
	$ composer require dishtail/laravel-data-doc
	```

## 配置

1. 注册 ServiceProvider:
	
	```php
	Dishtail\DataDoc\DataDocServiceProvider::class,
	```

2. 创建配置文件：

	```shell
	php artisan vendor:publish
	```
	
	执行命令后会在 `config` 目录下生成两个文件：
	
	
	
## 使用

安装扩展后，浏览器访问 `[http|https]://[domain]/doc/data_doc`
