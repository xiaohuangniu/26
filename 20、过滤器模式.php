<?php
/**
 * 设计模式之过滤器器模式
 * 应用场景，对一系列结构相同的对象，定义特定的规则，进行筛选和过滤。
 * 小黄牛
 */
header("Content-type: text/html; charset=utf-8");

/**
 * 接口 - 过滤器
 */
interface Filter{
  public function Go($person); // 过滤方法 - 参数是一个存储了对象列表的数组
}

/**
 * 具体化 - 过滤器 - 按性别过滤对象
 */
class Gender implements Filter{
  private $_gender; // 过滤条件
  public function __construct($gender){
    $this->_gender = $gender;
  }
  # 实现过滤方法
  public function Go($person){
    foreach ($person as $k => $v) {
      if ($v->gender === $this->_gender) {
        $personsFilter[] = $person[$k];
      }
    }
    return $personsFilter;
  }
}
/**
 * 具体化 - 过滤器 - 按运动类型过滤对象
 */
class SportType implements Filter{
  private $_sportType; // 过滤条件
  public function __construct($sportType){
    $this->_sportType = $sportType;
  }
  # 实现过滤方法
  public function Go($person){
    foreach ($person as $k => $v) {
      if ($v->sportType === $this->_sportType) {
        $personsFilter[] = $person[$k];
      }
    }
    return $personsFilter;
  }
}


/**
 * 运动类
 */
class Motion{
  public $gender;    // 性别
  public $sportType; // 运动类型
  public function __construct($gender, $sportType){
    $this->gender    = $gender;
    $this->sportType = $sportType;
  }
}

# 定义一组对象列表
$persons = array();
$persons[] = new Motion('男', '篮球');
$persons[] = new Motion('女', '游泳');
$persons[] = new Motion('男', '羽毛球');
$persons[] = new Motion('女', '篮球');
$persons[] = new Motion('男', '游泳');
$persons[] = new Motion('女', '羽毛球');
# 按过滤男性
$filterGender = new Gender('男');
echo '<pre>';
var_dump($filterGender->Go($persons));
echo '</pre>';

# 过滤运动项目篮球
$filterSportType = new SportType('游泳');
echo '<pre>';
var_dump($filterSportType->Go($persons));
echo '</pre>';