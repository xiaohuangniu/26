<?php
/**
 * 设计模式之代理器模式
 * 我的理解：对对象进行了控制
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
    echo "生产一双球鞋<br/>";
  }
}

/**
 * 代理器
 */
class Proxy{
  private $_shoes;     // 鞋的模型对象
  private $_shoesType; // 生产哪种鞋子
  public function __construct($shoesType){$this->_shoesType = $shoesType;}
  /**
   * 生产.
   */
  public function product(){
      switch ($this->_shoesType) {
        case 'sport':
          echo "我可以偷工减料";
          $this->_shoes = new ShoesSport();
          break;
        default:
          throw new Exception("类型不正确", 404);
          break;
      }
      $this->_shoes->product();
  }
}

echo "未加代理之前：<br/>";
# 生产运动鞋
$shoesSport = new ShoesSport();
$shoesSport->product();


echo "加代理：<br/>";
# 把运动鞋产品线外包给代工厂
$proxy = new Proxy('sport');
# 代工厂生产运动鞋
$proxy->product();