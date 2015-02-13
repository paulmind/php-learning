<?php
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