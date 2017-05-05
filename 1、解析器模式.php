<?php
/**
 * 设计模式之解释器模式
 * 解释器 示例
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");

/**
 * 环境角色
 * 用于存储解析器所需要的全局信息
 */
class PlayContent{
    public $content;
}

/**
 * 抽象解析器
 * 调用解析方法，进行解析处理
 * 派生出一个具体解析方法，用于解析延伸
 */
abstract class IExpress{
    # 解析方法
    public function Translate($val){
        echo $this->Excute($val);
    }

    # 派生出一个具体的解析方法
    public abstract function Excute($key);
}

/**
 * 派生出的具体解析器A
 */
class AoNote extends IExpress{
    # 实现父类的抽象方法
    public function Excute($key){
        switch($key) {
            case 'i': $note = '我'; break;
            default : $note = null;
        }
        return $note;
    }
}
/**
 * 派生出的具体解析器B
 */
class BoNote extends IExpress{
    # 实现父类的抽象方法
    public function Excute($key){
        switch($key) {
            case '1': $note = '大'; break;
            case '2': $note = '狗'; break;
            case '3': $note = '蛋'; break;
            default : $note = null;
        }
        return $note;
    }
}
/**
 * 派生出的具体解析器C
 */
class CoNote extends IExpress{
    # 实现父类的抽象方法
    public function Excute($key){
        return $key;
    }
}


# 测试
$playContent = new PlayContent();
$playContent->content = 'i love you 123！'; // 注入解析规则需要的信息

# 下面的代码根据你自己定义的解析器规则，逻辑会变动
for ($i= 0; $i<strlen( $playContent->content ); $i++) {
    $temp=$playContent->content[$i];
    # 根据规则，选择对应的具体解析器
    switch($temp){
        case 'i' : $expression = new AoNote(); break;
        case '1': $expression = new BoNote(); break;
        case '2': $expression = new BoNote(); break;
        case '3': $expression = new BoNote(); break;
        default  : $expression = new CoNote();
    }
   echo $expression->Translate($temp);
}