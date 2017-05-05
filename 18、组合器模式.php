<?php
/**
 * 设计模式之组合器模式
 * 定义：将对象以树形结构组织起来，以达成“部分－整体”的层次结构，使得客户端对单个对象和组合对象的使用具有一致性
 * 我的理解：把对象构建成树形结构
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");
/**
 * 抽象 - 枝节点与叶子节点都要实现的接口
 */  
abstract class Company{  
    protected $name; // 节点名
    function __construct($name){  
        $this->name = $name;  
    }  
    public function Add($composite){}    // 增加一个节点对象
    public function Delete($composite){} // 删除一个节点对象
    public function Dump($length){}      // 打印对象组合
}  

/**
 * 具体化 - 枝节点 - 公司
 */
class SubCompany extends Company{
     private $sub_companys = array();  // 节点对象组合器
     # 添加节点名称
     public function __construct($name){parent::__construct($name);}  
     # 增加一个节点对象
     public function Add($company){ $this->sub_companys[] = $company;}
     # 删除一个节点对象
     public function Delete($company){
         $key = array_search($company, $this->sub_companys);
         if(false !== $key){
             unset($this->sub_companys[$key]);
         }
     }
     # 打印对象组合
     public function Dump($length = 1){
         $hr =  '├';
         for ($i=0; $i<$length; $i++){  
            $hr .= "─";  
         } 
         echo $hr.$this->name. "<br/>";  
         foreach($this->sub_companys as $val){
            $val->Dump($length+1); // 让叶子节点继续打印，这一步+1很重要
         }
     }           
} 

/**
 * 具体化 - 叶子节点 - 部门
 */
class Dept extends Company{
     # 添加节点名称
     public function __construct($name){parent::__construct($name);}  
     # 增加一个节点对象
     public function Add($company){echo '叶子节点，不给你再添加节点....当然你自己可以看需求定义结构层级<br/>';}
     # 删除一个节点对象
     public function Delete($company){echo '叶子节点，不给你删除节点....当然你自己可以看需求定义结构层级<br/>';}
     # 打印对象组合
     public function Dump($length){
         $hr =  '├';
         for ($i=0; $i<$length; $i++){  
            $hr .= "─";  
         }
         echo $hr.$this->name. "<br/>"; 
     }           
} 

# 创建一级根节点
$root = new SubCompany('总部');
$root->Add(new Dept("财务部"));
$root->Add(new Dept("技术部"));
$root->Add(new Dept("商务部"));
$root->Add(new Dept("采购部"));
$root->Dump();

echo '<br/>';

# 创建二级节点，实际上在没有关联到总部之前，分公司还是一级节点
$guangzhou = new SubCompany('广州分公司');
$guangzhou->Add(new Dept("分公司财务部"));
$guangzhou->Add(new Dept("分公司技术部"));
$guangzhou->Add(new Dept("分公司商务部"));
$guangzhou->Add(new Dept("分公司采购部"));
$guangzhou->Dump();

echo '<br/>';

# 向一级节点关联二级节点
$root->Add($guangzhou);
$root->Dump();