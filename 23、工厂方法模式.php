<?php
/**
 * 设计模式之工厂方法模式
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");

/**
 * 接口 - 士兵
 */
interface IProduct{
  public function Attack();  // 攻击
}

/**
 * 创建 - 步兵
 */
class XPinfantry implements IProduct{
  public function Attack() { echo '步兵进攻，攻击力：10~ <br/>';} 
}
/**
 * 创建 - 骑兵
 */
class XPcavalry implements IProduct{
  public function Attack() { echo '骑兵进攻，攻击力：30~ <br/>';} 
}


/**
 * 接口 - 工厂
 */  
interface IServerFactory{  
    public function GetInstance();  
} 

/**
 * 创建 - 步兵工厂
 */  
class ProductInfantry implements IServerFactory{  
    public function GetInstance(){ return new XPinfantry();}  
}  
/**
 * 创建 - 骑兵工厂
 */  
class ProductCavalry implements IServerFactory{  
    public function GetInstance(){ return new XPCavalry ();}  
}

$Infantry = new ProductInfantry();  // 建立步兵工厂
$Cavalry  = new ProductCavalry();   // 建立骑兵工厂

$obj = array();
$obj[] = $Infantry->GetInstance(); // 生产一个步兵
$obj[] = $Cavalry ->GetInstance(); // 生产一个骑兵
$obj[] = $Cavalry ->GetInstance(); // 生产一个骑兵

foreach ($obj as $val) {
    $val->Attack();  // 进攻
}
