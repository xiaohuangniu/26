<?php
/**
 * 设计模式之桥接模式
 * 场景：将对象与类型解耦，对象与类型之间可以随意关联调用
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");
/**
 * 抽象 道路
 */
 abstract class Road{
     public $ICAR; // 汽车的实例
     abstract public function RoRun();
 }
 /**
  * 创建 - 高速公路
  */
  class SpeedRoad extends Road{
      public function RoRun(){
          $this->ICAR->IcRun();
          echo '：极速的行驶在高速公路上！<br/>';
      }
  }
/**
  * 创建 - 乡村小道
  */
  class StreetRoad extends Road{
      public function RoRun(){
          $this->ICAR->IcRun();
          echo '：欢快的行驶在乡村小道上！<br/>';
      }
  }

/**
 * 抽象接口 车 
 */  
interface ICAR{  
    function IcRun();  
}
/**
 * 创建 - 轿车
 */
class Car implements ICAR{
    public function IcRun(){
        echo '轿车';
    }
}
/**
 * 创建 - 马车
 */
class Carriage implements ICAR{
    public function IcRun(){
        echo '马车';
    }
}

# 让轿车跑到 乡村小道
$speedRoad=new StreetRoad();  // 先创建乡村小道 
$speedRoad->ICAR=new Car();   // 再把轿车放到马路上
$speedRoad->RoRun();   
# 让马车跑到 高速公路
$street=new SpeedRoad();      // 先创建高速公路
$street->ICAR=new Carriage(); // 再把马车放到马路上
$street->RoRun();  