<?php
/**
 * 设计模式之适配器模式
 * 场景：接口设计
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");
/**
 * 接口 - 数据库
 */
interface DataBase{
    public function Connect(); // 链接数据库
    public function Select();  // 查询操作
}

/**
 * 实现两种数据库操作类
 */
class Mysql implements DataBase{
    public function Connect(){echo '链接Mysql <br/>';} // 链接数据库
    public function Select(){echo '查询Mysql <br/>';}  // 查询操作
}
class Oracle implements DataBase{
    public function Connect(){echo '链接Oracle <br/>';} // 链接数据库
    public function Select(){echo '查询Oracle <br/>';}  // 查询操作
}

/**
* 实现适配器 - 使用组件切换的模式，达到适配效果
* 注意：适配器也应该继承与 对应适配类的接口
*/
class Adapter implements DataBase{
    private $DataBase; // 数据库操作的实例 - 也就是组件操作的实例
    public function __construct($DataBase){
    $this->DataBase = $DataBase;
    }
    # 根据适配器调用对应的方法
    public function Connect(){$this->DataBase->Connect();}
    public function Select(){$this->DataBase->Select();}
}

# 实例化适配器，并传入Mysql组件
$obj = new Adapter(new Mysql());
$obj->Connect();
$obj->Select();

# 实例化适配器，并传入Oracle组件
$obj = new Adapter(new Oracle());
$obj->Connect();
$obj->Select();
