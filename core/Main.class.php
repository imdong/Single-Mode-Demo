<?php
/**
 * 主引导程序类
 */
class Main
{
    // 开放自身对象
    static $instance;

    // 计数器
    public $i;

    // 操作历史列表
    public $list = [];

    // 运算公式
    public $formula = '';

    /**
     * 默认初始化
     */
    private function __construct()
    {
        // 赋予随机默认值
        $this->i = rand(1, 10);

        // 设置初始值
        $this->formula = $this->i;

        // 输出默认值
        printf("Main init: %s\n", $this->i);

        // 创建核心类
        App::App();
    }

    // 初始化启动
    public static function init()
    {
        if(self::$instance == null) self::$instance = new self();
        return self::$instance;
    }

    // 获取自身对象
    public static function get()
    {
        return self::init();
    }

    // 启动运行
    public function start(array $app_list): int
    {
        // 依次执行默认方法
        foreach ($app_list as $key => $app_name) {
            $ret = App::{$app_name}()->run();
            printf("%s: %s\n", $app_name, $ret);
        }

        return $this->i;
    }
}
