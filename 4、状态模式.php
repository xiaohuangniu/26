<?php
/**
 * 设计模式之状态模式
 * 使用场景 大量和对象状态相关的条件语句
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");

/**
 *
 * 派生出相关的接口状态
 */
interface IState{
    function WriteCode($Work);
}

/**
 * 春季
 */
class AState implements IState{
    function WriteCode($Work){
        if($Work->hour == '春'){
            echo '春季，要下雨啦！<br/>';
        }else{
            # 调用回调方法，去访问夏季方法
            $Work->SetState(new BState());
            $Work->WriteCode();
        }
    }
}
/**
 * 夏季
 */
class BState implements IState{
    function WriteCode($Work){
        if($Work->hour == '夏'){
            echo '夏季，好热额！<br/>';
        }else{
            # 调用回调方法，去访问秋季方法
            $Work->SetState(new CState());
            $Work->WriteCode();
        }
    }
}
/**
 * 秋季
 */
class CState implements IState{
    function WriteCode($Work){
        if($Work->hour == '秋'){
            echo '秋季，恋爱的季节！<br/>';
        }else{
            # 调用回调方法，去访问冬季方法
            $Work->SetState(new DState());
            $Work->WriteCode();
        }
    }
}
/**
 * 冬季
 */
class DState implements IState{
    function WriteCode($Work){
        if($Work->hour == '冬'){
            echo '冬季，浪漫的季节！<br/>';
        }else{
            echo '你不是地球人！<br/>';
        }
    }
}

/**
 * 处理季节筛选
 */
class Work{
    public $hour;       // 季节成员
    private $current;   // 季节对象实例
    public $isDone;
    /**
     * 默认选择第一个筛选项
     */
    public function __construct(){
        $this->current = new AState();
    }
    /**
     * 当筛选不正确时，调用该方法继续向下筛选
     */
    public function SetState($S){
        $this->current = $S;
    }
    /**
     * 调用这个方法，使用筛选
     */
    public function WriteCode(){
        $this->current->WriteCode($this);
    }
}

# 实例DEMO
$obj = new Work();
$obj->hour = '春';
$obj->WriteCode();
$obj->hour = '夏';
$obj->WriteCode();
$obj->hour = '秋';
$obj->WriteCode();
$obj->hour = '冬';
$obj->WriteCode();
$obj->hour = '小黄牛';
$obj->WriteCode();
