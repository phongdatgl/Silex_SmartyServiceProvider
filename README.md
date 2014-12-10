SmartyServiceProvider
===================

*SmartyServiceProvider* sẽ tạo ra provider cho Silex, sử dụng [Smarty] (http://www.smarty.net) làm template thay thế cho twig

Tham Số
----------

* **smarty.class_path** (string, optional): Path tới thư mục libs của Smarty.

* **smarty.options** (array, optional): Options một số API của [Smarty] (http://www.smarty.net). Xem thêm: [Smarty documentation] (http://www.smarty.net/docs/en/api.variables.tpl)

Dịch Vụ
--------

* **smarty**: Sử dụng ``Smarty`` template enginer. Có tùy chỉnh phù hợp với Silex Application

Cài đặt
-----------
 
Đường dẫn của [Smarty] (http://www.smarty.net) tại ``vendor/Smarty`` . Hãy chắc chắn rằng nó tồn tại:

```php
use Phongdatgl\Smarty\ServiceProvider as SmartyServiceProvider;

define('APP_PATH', '/path/your/project');
$app->register(new SmartyServiceProvider(), array(
          //'smarty.dir' => APP_PATH . '/vendor/Smarty/', //có hoặc không. Không có thì app sẽ mặc định lấy từ vendor
          'smarty.options' => array(
                'template_dir' => APP_PATH . '/views',
                'caching'         => false,
                'force_compile'   => false,
                'use_sub_dirs'    => false)));
```

Sử dụng
-----

Sử dụng trên silex

```php
$app->get('/hello/{name}', function ($name) use ($app) {
	$app['smarty']->assign('name', 'John Doe');
    return $app['smarty']->render('hello.tpl', array('age'=>15));
});
```
