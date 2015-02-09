<?php
/**
 * Классы и объекты
 *
 * Классы определяют объекты!
 * Класс - это шаблон для создания объектов
 * Объект (экземпляр класса) - это данные, которые структурируются в соответсвии с шаблоном, определенным в классе
 * Класс также можно считать новым типом
 *
 */
class Monster {
	public $size; // размер
	private $weight; // вес // свойство (property) доступно только внутри класса
	protected $aggressive; // статус (агрессивный, добрый) //
	public $damage;
	public $name;
//	Конструктор вызывается при создании объекта
//	PHPDoc comments
	/**
	 * @param null $name
	 * @param null $damage
	 * @param null $size
	 * @param array() $arr
	 * @type string $name
	 * @type int $damage
	 * @type int $size
	 * @type array $arr
	 */
	function __construct($name=null, $damage=null, $size=null,array /*уточнение типов*/ $arr=array()){
//		уточнение типов возможно только для массивов и объектов
		$this->name=$name;
		$this->damage=$damage;
		$this->size=$size;
		$this->getInfo();
	}

//	Методы [methods] - это спец. функции, которые объявляются внутри класса
	function getInfo() {
		echo <<<EOT
size: {$this->size}
damage: {$this->damage}
name: {$this->name}\n
EOT;
	}
}

$monster_zombie = new Monster();# объект zombie типа monster (также говорят, что объект - это экземпляр класса)
$monster_alien = new Monster();# объект alien типа monster
/**
 * Итак, мы использовали класс Monster как шаблон для создания двух объектов типа Monster.
 * Хотя функционально они идентичны, $monster_zombie и $monster_alien - это два
 * разных объекта одного типа, созданных с помощью одного класса.
 */

/**
 * Выведем информацию по объектам, включая идентификатор каждого объекта,
 * указанный после символа '#'
 */
var_dump($monster_zombie, $monster_alien);

// обратимся к свойству объекта $monster_zombie
var_dump($monster_zombie->size);
// переопределение свойств объектов
$monster_zombie->size=3;
$monster_zombie->damage=0.2;
$monster_zombie->name='zombie_warlord';

$monster_alien->size=5;
$monster_alien->damage=0.3;
$monster_alien->name='headcrab';
$monster_alien->getInfo();
$monster_zombie->getInfo();
//var_dump($monster_zombie, $monster_alien);
/**
 * Определив конструктор и добавив в тело метод getInfo мы упростили
 * работу с классом и обеспечили инициализацию свойств объекта
 */
$name='harpy';
$size='6';
$arr='type_array';
$monster_predator = new Monster((string) $name, 0.5,(int) $size,(array) $arr);# приведение типов


/**
 * Парадигмы ООП:
 *
 * Зачем нужно наследование (inheritance)?
 * Расширить возможности класса можно двумя способами:
 * 1 - объединением свойств и методов,
 *  дурной тон:
 *  (принудительное объединение полей различных объектов приведет к лишним свойствам и методам)
 *  (сложная реализация логики при добавлении доп. отличий объектов)
 * 2 - созданием других классов.
 *  дурной тон:
 *  (методы работают одинаково для каждого класса, дублирование кода)
 *  (каждый новый класс - это новый тип, необходима проверка типов и
 *   наличие тех же свойств и методов, при совместном использовании классов)
 *
 * краткий пример проблем:
 */
class MonsterZombie {
	public $size; // размер
	public $weight; // вес
	public $aggressive; // статус (агрессивный, добрый)
	public $damage; // урон
	public $name;

	function __construct($name, $damage, $size, $weight){
		$this->name=$name;
		$this->damage=$damage;
		$this->size=$size;
		$this->weight=$weight;
	}

//	данный метод дублируется в двух классах
	public function getRank(){
		$rank=array(
			1=>array(0,0.2),
			2=>array(0.2,0.4),
			3=>array(0.4,0.7),
			4=>array(0.7,1),
		);
		foreach($rank as $k => $v){
			if(($v[0] < $this->damage) && ($this->damage <= $v[1])){
				echo "\nУровень сложности: $k";
			}
		}
	}

	public function action($action){
		if($action==1)
			$this->aggressive=true;
		else
			$this->aggressive=false;
		return $action;
	}
}

class MonsterDragon {
	public $size; // размер
	public $color; // окрас
	public $aggressive=false; // статус (агрессивный, добрый)
	public $damage; // урон
	public $name;

	function __construct($name, $damage, $size, $color){
		$this->name=$name;
		$this->damage=$damage;
		$this->size=$size;
		$this->color=$color;
	}

//	данный метод дублируется в двух классах
	public function getRank(){
		$rank=array(
			1=>array(0,0.2),
			2=>array(0.2,0.4),
			3=>array(0.4,0.7),
			4=>array(0.7,1),
		);
		foreach($rank as $k => $v){
			if(($v[0] < $this->damage) && ($this->damage <= $v[1])){
				echo "\nУровень сложности: $k";
			}
		}
	}

	public function action($action){
		if($action==1)
			echo "\nЗлобный рев с языками пламени.";
		return $action;
	}
}

class MonsterInfo {
	function show($monster){
		if(!($monster instanceof MonsterZombie) && !($monster instanceof MonsterDragon))
			die("\nПередан неверный тип данных");
//		Вместо оператора instanceof будет true, если объект в операнде слева относится к типу операнда справа.
//		ВАЖНО!!!
//		Пока мы не использовали наследование, нам нужно не только проверять
//		аргумент $monster на соответствие двум типам (MonsterZombie и MonsterDragon),
//		но и надеятся, что в каждом типе будут те же свойства и методы, что и в другом.
		echo "\nИмя: {$monster->name}, Урон: {$monster->damage}, Размер: {$monster->size}, Агрессивный: {$monster->aggressive}";
	}
}

$monster_zombie = new MonsterZombie('zombie_warlord', 0.2, 3, 20);
$monster_zombie->action(1);
$info = new MonsterInfo();
$info->show($monster_zombie);
$monster_zombie->getRank();

$monster_dragon = new MonsterDragon('arch_demon', 0.9, 10, 'red');
$info->show($monster_dragon);
$monster_dragon->action(1);
$monster_dragon->getRank();

/**
 * Наследование (inheritance) - это механизм, который позволяет
 * из базового класса получить один или несколько дочерних классов
 *
 */
