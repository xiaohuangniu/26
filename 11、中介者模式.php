<?php
/**
 * 设计模式之中介者模式
 * 场景：使用中介类，为多个类之间进行信息交互，将交互流程解耦
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");
/**
 * 抽象 中介者类
 */
abstract class Department{  
    /**
     * 发送内容
     * $message 内容
     * $Colleague 同事实例
     */
    public abstract function Declared($Message, $Colleague);  
}  
/**
 * 创建一个 - 技术部部门
 */
class Technical extends Department{  
    public $CountryChen;  // 小陈
    public $CountryLin;   // 小林
  
    # 发送消息  
    public function Declared($Message, $Colleague) {  
        # 小陈的话是要传给小林的
        if($Colleague == $this->CountryChen){  
            $this->CountryLin->GetMessage($Message);  
        }  
        else  {  
            $this->CountryChen->GetMessage($Message);  
        }  
    }  
}  



/**
 * 抽象 同事类
 */
abstract class Colleague{
    protected $Mediator; // 中介者实例
    # 获得中介者实例
    public function __construct($Mediator){
        $this->Mediator = $Mediator;
    }
}

/**
 * 创建一个同事 - 小陈
 */
 class Chen extends Colleague{
     public function __construct($Mediator){
         parent::__construct($Mediator); // 调用父类构造方法
    }
    # 发送消息
    public function  Declared($Message){  
        $this->Mediator->Declared($Message, $this);  
    }
    # 获得消息  
    public function GetMessage($Message){  
        echo "小陈获得对方消息：{$Message}<br/>";  
    }  
 }
 /**
 * 创建一个同事 - 小林
 */
 class Lin extends Colleague{
     public function __construct($Mediator){
         parent::__construct($Mediator); // 调用父类构造方法
    }
    # 发送消息
    public function  Declared($Message){  
        $this->Mediator->Declared($Message, $this);  
    }
    # 获得消息  
    public function GetMessage($Message){  
        echo "小林获得对方消息：{$Message}<br/>";  
    }  
 }

# 生成中介者实例
$Men = new Technical();  
# 实例化同事 - 小陈、小林
$A = new Chen($Men);  
$B = new Lin($Men);  
$Men->CountryChen = $B; // 小陈要对小林说话
$Men->CountryLin  = $A; // 小林要对小陈说话 
$A->Declared("周经理让你过去他办公室一趟！");  
$B->Declared("好的，我现在就过去。");  
/**
 * 说话的顺序是，小陈让小林过去经理办公室,所以逻辑是，小陈说的话被小林获得，小林说的话被小陈获得，得出以下结果：
 * 小林获得对方消息：周经理让你过去他办公室一趟！
 * 小陈获得对方消息：好的，我现在就过去。
 */
