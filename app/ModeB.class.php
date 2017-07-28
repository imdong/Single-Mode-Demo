<?php
/**
 * 模式B
 */
class ModeB
{
    // 运算模式
    public $mode = '*';

    // 进行运算
    public function run(): string
    {
        // 生成随机数
        $int    = rand(1, 10);

        // 调用执行
        $result = App::App()->append('ModeB', $this->mode, $int);

        return "{$this->mode}{$int}={$result}";
    }
}
