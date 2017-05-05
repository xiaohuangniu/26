<?php
/**
 * 设计模式之迭代器模式
 * 场景：指针读取 - 先进先出，后进后出
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");
/**
 * 接口 迭代器
 */
interface IIterator{
    public function First();        // 首元素
    public function Next();         // 下一个元素
    public function IsDone();       // 是否已结束
    public function CurrentItem();  // 当前元素
    public function CurrentIdx();   // 当前指针
}

/**
 * 抽象 容器
 */ 
abstract class Aggregate{
    protected $IIter; // 迭代器的实例
    /**
     * 选择容器对应的迭代器
     */
    public function __construct($New){
        $this->IIter = $New;
    }
    /**
     * 将容器的this传给 迭代器，并返回迭代器的当前实例
     */
    abstract public function CreateIterator();
}

/**
 * 创建一个 - 具体容器
 */
class MyAggregate extends Aggregate{
    public $Items = array(); // 数据存储内容
    # 容器的迭代器 
    public function CreateIterator(){
        return $this->IIter->GetAg($this);
    }
    # 获得指定容器内容
    public function GetItem($idx){
        return isset($this->Items[$idx]) ? $this->Items[$idx] : null; 
    }
    # 修改容器内容
    public function SetItem($idx,$val){
        $this->Items[$idx] = $val;
    }
    # 获得容器内容长度
    public function GetCount(){
        return count($this->Items); 
    }
}

/**
 * 创建一个 - 具体迭代器
 */
class MineIterator implements IIterator{
    //容器【聚集对象】
    private $aggregate;   // 容器的实例
    private $current = 0; // 容器内的数据长度
    
    # 为迭代器注入容器
    public function GetAg($aggregate){
        $this->aggregate = $aggregate;
        return $this;
    }
    # 获取首元素
    public function First(){
        return $this->aggregate->GetItem(0);
    }
    # 下一个元素内容
    public function Next(){
        $this->current++;
        # 在这一步你也可以设置成指针向下，并获取下一个元素内容
    } 
    # 是否已结束 - 已无内容
    public function IsDone() {
        return ($this->current >= $this->aggregate->GetCount()) ? true : false;
    }
    # 获取当前元素
    public function CurrentItem(){
        return $this->aggregate->GetItem($this->current);
    }
    # 获取当前元素长度
    public function CurrentIdx() {
        return $this->current; 
    }
}


# 创建一个容器 
$myAggregate = new MyAggregate(new MineIterator());
# 向容器中添加元素
$myAggregate->SetItem(0,'小黄牛');
$myAggregate->SetItem(1,'小黄狗');
$myAggregate->SetItem(2,'小黄猪');
# 迭代器注入容器内容
$iterator = $myAggregate->CreateIterator(); 
# 还有内容，就一直遍历
while(!$iterator->IsDone()) {
    $idx = $iterator->CurrentIdx();        // 获得元素当前位置长度
    $item = $iterator->CurrentItem();      // 获取当前元素内容
    echo "当前位置:{$idx},值：{$item}<br/>";
    $iterator->Next(); // 将指针指向下一个元素，否则将会出现死循环
}

