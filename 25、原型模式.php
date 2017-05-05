<?php
/**
 * 设计模式之原型模式
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");
/**
 * 抽象 - 原型类
 */
abstract class Prototype{
  abstract function cloned(); // 克隆方法
}

/**
 * 具体化 - 原型类
 */
class Plane extends Prototype{
  public $color; // 测试的成员属性
  public function cloned(){
    # clone 关键字，是PHP5才有的，用于克隆一个实例
    return clone $this;
  }
}

# 测试
$res1 = new Plane();
$res1->color = '蓝色';   // 赋值成员属性
$res2 = $res1->cloned(); // 克隆一个实例

echo "res1的颜色为：{$res1->color}<br/>";  
echo "res2的颜色为：{$res2->color}<br/>";  