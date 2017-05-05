<?php
/**
 * 设计模式之策略模式
 * 优势在 根据类名调用不同的算法
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");

/**
 * 抽象策略类
 * 派生出相关的算法和行为
 */
abstract class RotateItem {
    # 暂定2个
    public abstract function Algorithm();
    public abstract function Behavior();
}

/**
 * 策略角色类 - 算法1
 */
class AItem extends RotateItem{
    public function Algorithm(){
        echo '算法1：我爱计算，头脑好好！<br/>';
    }
    function Behavior(){
        echo '算法1：我爱洗澡，皮肤好好！<br/>';
    }
}

/**
 * 策略角色类 - 算法2
 */
class BItem extends RotateItem{
    public function Algorithm(){
        echo '算法2：我爱计算，头脑好好！<br/>';
    }
    function Behavior(){
        echo '算法2：我爱洗澡，皮肤好好！<br/>';
    }
}

/**
 * 环境角色类 - 通过这个类调用对应的策略算法
 */
class ContextItem{
    private $item; // 用户存储一个策略类的引用，最终返还给客户端调用。

    public function getItem($item_name, $fun_name){
        # 1、通过系统 ReflectionClass方法获得类的各项参数
        $class      = new ReflectionClass($item_name);
        # 2、再通过系统 newInstance方法实例化一个类
        $this->item = $class->newInstance();
        # 3、根据方法名调用对应的算法或行为
        $this->item->$fun_name();
    }
}

# 实例DEMO
$obj = new ContextItem();
$obj->getItem('BItem','Algorithm');
$obj->getItem('AItem','Behavior');