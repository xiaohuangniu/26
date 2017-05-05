<?php
/**
 * 设计模式之备忘录模式
 * 使用场景：编辑器后退操作/数据库事物/存档
 * 小黄牛
 */

header("Content-type: text/html; charset=utf-8");

/**
 * 角色状态存储器
 */
class RoleStateMemento{
    public $Life_Value;      // 生命力

    /**
     * 构造方法存储角色状态
     */
    public function __construct($Life){
        $this->Life_Value      = $Life;
    }
}

/**
 * 角色编辑器
 */
 class GameRole{
    public $LifeValue;      // 生命力
    /**
     * 构造方法，初始化状态
     */
    function __construct(){
        $this->LifeValue = 100;
    }
    /**
     * 保存状态 - 将最新状态保存到状态存储器中
     */
    public function Save(){
        return (new RoleStateMemento(
            $this->LifeValue
        ));
    }
    /**
     * 恢复状态 - 从状态存储器中读取状态
     */
    public function Recovery($_memento){
        $this->LifeValue = $_memento->Life_Value;
    }
    /**
     * 被攻击
     */
     public function Display(){
         $this->LifeValue -= 10; // 每次被攻击减少10点生命值
     }
     /**
      * 打印生命值
      */
      public function Dump(){
          echo "当然角色状态：<br/>";
          if ($this->LifeValue <= 0) {
              echo "你已经挂了！<br/>";
          } else {
              echo "生命值：{$this->LifeValue}<br/>";
          }  
      }
 }

 //游戏角色状态管理者类
class RoleStateManager{
    public $Memento;
}


# 先创建一个角色
$Role = new GameRole();
# RPG游戏中经常出现，打BOSS前怕死先存档，肯定是玩家才有权力去存档
$RoleMan = new RoleStateManager();
$RoleMan->Memento = $Role->Save();
# 开始打BOSS了
$num = 1; // 记录回合数
for ($i=0; $i<10; $i++){
    echo "-------------第{$num}回合------------<br/>";
    $Role->Display();
    $Role->Dump();
    $num++;
    
    # 在第5个回合的时候老妈杀来了，你经常会在战斗中存档一次，防止老妈拉电闸
    if($num == 6){
        $RoleMan2 = new RoleStateManager();
        $RoleMan2->Memento = $Role->Save();
    }
}
# 恢复存档：地狱模式打不过，还好他妈存档了！
$Role->Recovery($RoleMan->Memento);
$Role->Dump();

# 咦，好像之前被老妈拉电闸有存档，恢复看下！
$Role->Recovery($RoleMan2->Memento);
$Role->Dump();