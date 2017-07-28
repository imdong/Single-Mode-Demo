<?php
/**
 * 核心功能类
 */
class App
{
    // 随机值
    public $rand;

    // 类对象列表
    static $list = [];

    // 初始化
    private function __construct()
    {
        // 生成随机数
        $this->rand = rand(1, 10);

        printf("App init: -%s\n", $this->rand);
    }

    // 静态调用转Class
    public static function __callStatic(string $name, array $arguments = null)
    {
        // 类没创建就 new 一个
        if(!isset(self::$list[$name]) || !(self::$list[$name] instanceof $name)){
            if(!class_exists($name)) return false;
            self::$list[$name] = new $name();
        }

        // 没参数就返回对象 有参数就调用方法返回执行结果
        if(empty($arguments)){
            return self::$list[$name];
        } else {
            $obj = self::$list[$name];
            $fun = $arguments['0'];
            $arg = $arguments['1'] ?? [];
            // 存在方法就调用
            if(method_exists($obj, $fun)){
                return call_user_func_array([$obj, $fun], $arg);
            }
        }
        return false;
    }

    // 追加记录
    public function append(string $app_name, string $mode, int $int): int
    {
        // 保存历史
        Main::init()->list[] = [
            'app'  => $app_name,
            'mode' => $mode,
            'int'  => $int
        ];

        // 生成等式
        Main::init()->formula = sprintf(
            '(%s)%s%s-%s',
            Main::init()->formula,
            $mode,
            $int,
            $this->rand
        );

        // 计算结果
        switch ($mode) {
            case '+':
                Main::init()->i = (Main::init()->i + $int) - $this->rand;
                break;
            case '-':
                Main::init()->i = (Main::init()->i - $int) - $this->rand;
                break;
            case '*':
                Main::init()->i = (Main::init()->i * $int) - $this->rand;
                break;
            case '/':
                Main::init()->i = (Main::init()->i / $int) - $this->rand;
                break;
            default:
            return 0;
                break;
        }
        // 返回计算结果
        return Main::init()->i;
    }
}
