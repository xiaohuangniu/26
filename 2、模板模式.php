<?php
/**
 * 设计模式之模板模式
 * 优势在 将不变的方法和多变的方法分离。
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");

/**
 * 抽象模板类
 * 调用模板方法，进行流程处理
 * 派生出数个多变的方法，内置一个不变的方法
 * 场景：可以假设这个类是一个手机制造厂家 - 他需要知道找他制造手机的品牌名 - 然后品牌商按照厂家制定的步骤，各自制造出不同的零件 - 最后统一回到总部组装
 */
abstract class MakePhone {
    public $name; // 品牌名

    # 找我们做手机之前先报上自家名号
    public function __construct($name){
        $this->name = $name;
    }

    # 组装方法 ，都是不变的组装流程
    public function MakeFlow(){
        $this->MakeBattery();
        $this->MakeCamera();
        $this->MakeScreen();
        echo $this->name.': 手机生产完毕！<br/>';
    }

    # 派生出三个零件制作流程，交由品牌商自己制作
    public abstract function MakeScreen();  // 屏幕
    public abstract function MakeBattery(); // 电池
    public abstract function MakeCamera();  // 摄像头
}

/**
 * 我是 - 小米品牌商
 */
class XiaoMi extends MakePhone{
    # 按照厂家给的流程，制作手机零件
    public function MakeScreen(){echo $this->name.'屏幕生产完成！<br/>'; }    // 屏幕
    public function MakeBattery(){echo $this->name.'电池生产完成！<br/>'; }   // 电池
    public function MakeCamera(){echo $this->name.'摄像头生产完成！<br/>'; }  // 摄像头
}

/**
 * 我是 - 魅族品牌商
 */
class MeiZu extends MakePhone{
    # 按照厂家给的流程，制作手机零件
    public function MakeScreen(){echo $this->name.'屏幕生产完成！<br/>'; }     // 屏幕
    public function MakeBattery(){echo $this->name.'电池生产完成！<br/>'; }    // 电池
    public function MakeCamera(){echo $this->name.'摄像头生产完成！<br/>'; }   // 摄像头
}

# 实例Demo
$xiaomi = new XiaoMi('红米3');
$meizu  = new MeiZu('魅蓝Note2');

$xiaomi->MakeFlow(); // 生产一部小米手机
$meizu ->MakeFlow(); // 生产一部魅族手机