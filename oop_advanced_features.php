<?php
require_once('./objects.php');
/**
 * Static methods
 * Если классы это шаблоны, с помощью которых создаются объекты,
 * а объекты - как активные компоненты, методы которых мы вызываем и
 * к свойствам которых получаем доступ,
 * следовательно в ооп реальная работа выполняется с помощью экземпляров классов, но это не совсем так.
 * Получить доступ к методам и свойствам можно в контексте класса, а не объекта.
 * Такие методы и свойства являются статическими (объявляются ключевым словом static).
 */
class StaticExample {
	const AVAILABLE = 1;
	static public $my_static = "world\n";

	public function staticValue() {
		return self::$my_static;
	}

	static public function staticMethod(){
		print 'Hello '.self::$my_static;
	}
}
/**
 * Зачем использовать статический метод или свойство?
 * - они доступны из любой точки сценария (если есть доступ к классу),
 * - статическое свойство доступно каждому экземпляру объекта этого класса,
 * - не нужно иметь экземпляр класса для доступа к его стат. свойству или методу.
 */
print StaticExample::$my_static;

$obj = new StaticExample();
print $obj::$my_static;// Начиная с PHP 5.3.0

$class_name = 'StaticExample';
print $class_name::$my_static;// Начиная с PHP 5.3.0

StaticExample::staticMethod();
$class_name::staticMethod();

print StaticExample::AVAILABLE;

/**
 * Class MonsterWriter
 * Абстрактный класс - это класс, в котором определяется интерфейс для любого дочернего класса.
 * Нельзя создать экземпляр абстрактного класса.
 */
abstract class MonsterWriter {
	/**
	 * Закрыв доступ к свойству monsters, мы запретили внешние операции клиентского кода такие, как
	 * добавить объект неправильного типа, затереть весь массив или заменить его значением элементарного типа.
	 * Теперь добавлять монстров можно только через метод-установщик(setter) addMonster.
	 */
	protected $monsters = array();

	public function addMonster(Monster $monster){
		$this->monsters[] = $monster;
	}
	/**
	 * Создавая абстрактный метод, мы гарантируем, что его реализация будет во всех дочерних классах.
	 */
	abstract public function write($test=null, array $arr=array());
}

class XmlMonsterWriter extends MonsterWriter {
	/**
	 * Уровень доступа в реализующем методе должен быть не строже, чем в абстрактном методе.
	 * Количество и уточнение типов аргументов в реализующем методе должно соответствовать абстрактному методу.
	 */
	public function write($test=null, array $arr=array()){
		$str = "\n\n<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$str .= "<monsters>\n";
		foreach($this->monsters as $monster){
			$str .= "\t<monster name=\"{$monster->name}\" damage=\"{$monster->damage}\" size=\"{$monster->size}\"/>\n";
		}
		$str .= "</monsters>\n";
		print $str;
	}
}
$monster = new XmlMonsterWriter();
$monster->addMonster($monster_vampire);
$monster_valkyrie = new MonsterVampire('valkyrie', 0.8, 6, 'no', 'yes');
$monster->addMonster($monster_valkyrie);
$monster->write();

class initAction{
	/**
	 * Благодаря уточнению типа объекта, только летающие монстры могут летать,
	 * а класс MonsterVampire, расширяющий тип интерфейса Flyable гарантирует реализацию метода motion.
	 * @param Flyable
	 */
	function setFly(Flyable $obj){
		$obj->motion('dynamic', 100, 'circle');
	}
}

$initAction = new initAction();
$initAction->setFly($monster_valkyrie);
//$initAction->setFly($monster_zombie);

//и еще пример
interface Car { function go(); }
class Porsche implements Car { function go() {} }
function drive(Car $car) {}
$porsche = new Porsche();
if($porsche instanceof Car)
	echo "\nThis is a car";
drive($porsche);