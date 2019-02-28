Generator
==============================
#### 基于 InfyOm Laravel Generator 修改。


 >### 安装到现有的Laravel项目中

1. 将以下包添加到您的composer.json。


```
"require": {
    "infyomlabs/laravel-generator": "5.5.x-dev",
    "laravelcollective/html": "^5.5.0",
    "infyomlabs/adminlte-templates": "5.5.x-dev",
    "doctrine/dbal": "~2.3"
}  
```

2.更新 composer 

添加包后，运行以下命令：


```
composer update
```

3.添加服务提供商

将以下服务提供者添加到您的提供者数组中 config/app.php


```
Collective\Html\HtmlServiceProvider::class,
Laracasts\Flash\FlashServiceProvider::class,
Prettus\Repository\Providers\RepositoryServiceProvider::class,
\InfyOm\Generator\InfyOmGeneratorServiceProvider::class,
\InfyOm\AdminLTETemplates\AdminLTETemplatesServiceProvider::class, 
```
4.添加别名

在别名数组中添加以下别名 config/app.php

```
'Form'      => Collective\Html\FormFacade::class,
'Html'      => Collective\Html\HtmlFacade::class,
'Flash'     => Laracasts\Flash\Flash::class,
```

5.发布

运行以下命令：


```
php artisan vendor:publish
```


---
>###  GUI界面
#### 1.发布布局
    
```
php artisan infyom.publish:layout 
```

此命令生成以下文件，

   1.它将HomeController在controllers目录中发布
 
   2.它将发布视图
 
 
```
 -resources
 ---views
 ------home.blade.php
 ---layouts
 ------app.blade.php
 ------menu.blade.php
 ------sidebar.blade.php
 ---auth
 ------login.blade.php
 ------register.blade.php
 ---passwords
 ------email.blade.php
 ------reset.blade.php
```
3.它将添加以下需要使其工作的路由。


```
Auth::routes();

Route::get('/home', 'HomeController@index'); 
```

#### 2.菜单配置

现在，您必须启用菜单选项config/infyom/laravel_generator.php。使菜单选项为true。


```
'add_on' => [ 'menu' => [ 'enabled' => true ] ] 
```

#### 3.访问

 http://youhost/generator_builder
---
>## 生成器支持功能
- [x] 生成模型(Model)
- [x] 生成前后台控制器（控制器默认增、删、改、查方法）(Controller)
- [x] 生成验证器(Request)
- [x] 生成资源(Resource,Collection)
- [x] 生成路由(Route)
- [x] 生成数据表迁移（Migrate）并创建表
- [x] 生成仓库（Repository）
- [x] Api返回格式

