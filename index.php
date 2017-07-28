<?php
// 强制打开报错
ini_set('display_errors','On');
error_reporting(E_ALL);

// 定义根目录
define('ROOT_PATH', dirname(__FILE__) . '/');

// 定义核心目录
define('CORE_ROOT', ROOT_PATH . 'core/');

// 定义应用目录
define('APP_ROOT', ROOT_PATH . 'app/');

// 注册自动加载
spl_autoload_register(function (string $class_name): bool
{
    // 定义可以加载的文件列表
    $class_list = array(
        ROOT_PATH . $class_name . '.class.php',
        CORE_ROOT . $class_name . '.class.php',
        APP_ROOT . $class_name . '.class.php'
    );

    // 遍历列表尝试加载
    foreach ($class_list as $key => $file_name) {
        if(file_exists($file_name)){
            require $file_name;
            return true;
        }
    }

    return false;
});

//**** 正文开始 ****//

    // 创建对象
    $main = Main::init();

    // 启动
    $result = $main->start(['ModeA', 'ModeB']);

    // 输出最终结果
    printf(
        "Result: %s=%s\n",
        Main::get()->formula,
        $result
    );

    // 非法调用不报错
    var_dump(
        App::Test(),                 // = return new Test();
        App::Test('Mode'),           // = return (new Test())->Mode();
        App::Test('Mode', ['*', 10]) // = return (new Test())->Mode('*', 10);
    );
