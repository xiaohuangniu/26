<?php
/**
 * 设计模式之空对象模式
 * 场景：MVC架构中的Controller 控制器层中会运用到，当你匹配到一个不存在路由时，需要进行404响应，可以使用这种模式。
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");
/**
 * 抽象 控制器类
 */
abstract class Controller{
    public $_name = ''; // 控制器名称
    /**
     * 注入控制器名
     */
    public function __construct($name){
        $this->_name = $name;
    }
    /**
     * 输出内容
     * $Controller 被访问的控制器对象实例
     */
    abstract public function Dump($Controller);
}

/**
 * 创建 - 空对象时 返回的对象
 */
 class EmptyController extends Controller{
     public function Dump($Controller){
         echo '访问的控制器不存在，系统即将抛出404错误！';
     }
 }

 /**
  * 创建 - 假设这些都是正确的 - 子类控制器 
  */
class YesController extends Controller{
    public function Dump($Controller){
         echo "‘{$Controller->_name}’ 控制器的，‘{$this->_name}’ 控制器被用户访问了~ <br/>";
     }
}  

 /**
  * 创建 - 假设这个是父类控制器 
  */
class FuController extends Controller{
    public function Dump($Controller){
         # 不是对象则 返回空对象
         if (!is_object($Controller)) {
             $Controller = new EmptyController('');
         }
         $Controller->Dump($this);
     }
}  


# 创建父类控制器：Index
$teacher = new FuController('Index');
# 创建子类控制器 1-3
$A    = new YesController('子类1');
$B    = new YesController('子类2');
$C    = new YesController('子类3');
# 开始访问咯
$teacher->Dump($A);
$teacher->Dump($B);
$teacher->Dump($C);
$teacher->Dump('子类4'); // 访问了一个不存在的控制器，抛出404


