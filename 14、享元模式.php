<?php
/**
 * 设计模式之享元模式
 * 场景：缓存调用 - 当需要重复调用一个工厂生产模型时，我们往往可以把这个模型实例缓存起来，以便多次重复调用，减少内存消耗。
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");

# 动物接口
interface AnimalInterface{
    public function getType();
}

/**
 * 创建 - 鸡模型
 */
class ChiCken implements AnimalInterface{
    public function getType(){
        echo "这是一只鸡~<br/>";
    }
}
/**
 * 创建 - 猪模型
 */
class Pig implements AnimalInterface{
    public function getType(){
        echo "这是一只猪~<br/>";
    }
}

# 农场缓存池
class Farm{
    private $_farmMap = array(); // 对象缓存池
    public function Produce($type){
        # 对象缓存池判断
        if (key_exists($type, $this->_farmMap)) {
            echo "来自缓存池-> ";
            return $this->_farmMap[$type]; // 返回缓存
        }
        # 建立缓存
        switch ($type) {
        case 'chicken':
            return $this->_farmMap[$type] =  new Chicken();
            break;
        case 'pig':
            return $this->_farmMap[$type] =  new Pig();
            break;
        }
    }
}


# 初始化一个缓存池
$farm = new Farm();
# 成产一只鸡
$farm->Produce('chicken')->getType();
# 再生产一只鸡
$farm->Produce('chicken')->getType();
# 再生产一只鸡
$farm->Produce('chicken')->getType();
# 生产一只猪
$farm->Produce('pig')->getType();
# 再生产一只猪
$farm->Produce('pig')->getType();
# 再生产一只猪
$farm->Produce('pig')->getType();