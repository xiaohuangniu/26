<?php
/**
 * 设计模式之命令模式
 * 模拟场景：
 * 1、在古代，皇帝是最喜欢下达命令的角色，并且皇宫重地，除了皇子与护卫之外，就不能有其他的男人，
 *    所以每次下达命令时，皇上不可能将所有部门重臣都召唤到跟前，这个时候就需要有一个能够传达命令的角色。
 * 2、在古代，这个传递命令的角色很出名，他就是太监，太监并没有任何权力，但当他拿到命令时，便可以调派命令所对应的部门角色。
 * 3、假设皇上想派兵攻打岛国，让厨房做个早点这个时候就需要2个部门角色了。
 * 4、并且太监是需要调派命令的权力，这时我们设计一个接口，用于把每个命令具体化，不然太监也不知道自己该去调派什么命令。
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");
/**
 * 接口 命令类
 */
interface Initiator{
     public function Command(); // 抽象出一个普通命令接口
 }
/**
 * 写张圣旨 - 皇上要打鬼子了
 */
 class DaZhang implements Initiator{
     public function Command(){
         echo '快去给我削了那帮鬼子！<br/>';
     }
 }
/**
 * 写张圣旨 - 皇上要吃饭
 */
 class ChiFan implements Initiator{
     public function Command(){
         echo '给朕准备两桌好菜！<br/>';
     }
 }


/**
 * 抽象 部门类
 */
abstract class Command{
    public    $name;            // 部门名称
    protected $Initiator;       // 命令的实例
    public function execute(){} // 抽象一个方法，所有部门都必须实现，用于执行命名
}
/**
 * 创建 - 兵部
 */
 class BingBu extends Command{
     public function __construct($Initiator){
         $this->name       = '兵部';
         $this->Initiator = $Initiator; // 接圣旨
     }
     public function execute(){
         $this->Initiator->Command();
     }
 }
/**
 * 创建 - 御膳房
 */
 class ChuFang extends Command{
     public function __construct($Initiator){
         $this->name       = '御膳房';
         $this->Initiator = $Initiator; // 接圣旨
     }
     public function execute(){
         $this->Initiator->Command();
     }
 }


/**
 * 抽象 对接类
 */
abstract class Pickup{
    public    $name;                // 对接人名称
    protected $Initiator;           // 部门的实例，你得告诉对接人要去哪里，并且对接人不该拥有任何操作命令的权限，防止中途被修改
    public function run_errands(){} // 抽象一个方法，对接人需要使用这个方法去发送命令
}
/**
 * 创建一个对接人 - 太监小李子
 */
 class TaiJian extends Pickup{
     public function __construct($Command){
         $this->name       = '东厂- 小李子';
         $this->Command = $Command; // 接到部门地址
     }
     # 去传递命令咯
     public function run_errands(){
         echo $this->name . '，奉天承运：';
         $this->Command->execute();
         echo $this->Command->name . '，领旨！<br/>';
     }
 }


/**
 * 创建一个发起人 - 皇上
 */
class HuangShang{
	public function Go(){
		# 让小李子去兵部
		$tj1 = new Taijian(new BingBu(new DaZhang()));
		$tj1->run_errands();

		# 让小李子去御膳房
		$tj2 = new Taijian(new Chufang(new ChiFan()));
		$tj2->run_errands();
	}
}

$res= new HuangShang();
$res->Go();
