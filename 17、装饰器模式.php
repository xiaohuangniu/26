<?php
/**
 * 设计模式之装饰器模式
 * 场景：在不改动类文件的前提上，对类进行功能上的扩展
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");
/**
 * 接口 - 鞋
 */
interface ShoesInterface{
  public function product();
}
/**
 * 创建 - 运动鞋模型
 */
class ShoesSport implements ShoesInterface{
  public function product(){
    echo "生产一双球鞋";
  }
}

/**
 * 抽象 - 装饰器类
 */
abstract class Decorator implements ShoesInterface{
  protected $shoes; // 模型的实例
  public function __construct($shoes){
      $this->shoes = $shoes;
  }
  # 生成方法
  public function product(){
      $this->shoes->product();
  }
  #定义装饰操作
  abstract public function decorate();
}

/**
 * 创建 - 贴标装饰器
 */
class DecoratorBrand extends Decorator{
  public $_value; // 标签名
  /**
   * 生成操作
   */
  public function product(){
    $this->shoes->product();
    $this->decorate();
  }
  /**
   * 贴标操作
   */
  public function decorate(){
    echo "贴上{$this->_value}标志 <br/>";
  }
}

echo "未加装饰器之前：";
# 生产运动鞋
$shoesSport = new ShoesSport();
$shoesSport->product();
echo "<br/>";

echo "加贴标装饰器：";
# 初始化一个贴商标适配器
$DecoratorBrand = new DecoratorBrand($shoesSport);
# 写入标签名
$DecoratorBrand->_value = 'nike';
# 生产nike牌运动鞋
$DecoratorBrand->product();