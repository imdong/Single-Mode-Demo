<?php
/**
 * 模式A
 */
class ModeA
{
    // 运算模式
    public $mode = '+';

    // 进行运算
    public function run(): string
    {
        // 生成随机数
        $int    = rand(1, 10);

        // 调用执行
        $result = App::App('append', ['ModeA', $this->mode, $int]);

        return "{$this->mode}{$int}={$result}";
    }
}
