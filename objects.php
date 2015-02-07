<?php
/**
 * Классы и объекты
 *
 * Классы определяют объекты!
 * Класс - это шаблон для создания объектов
 * Объект - это данные, которые структурируются в соответсвии с шаблоном, определенным в классе
 *
 */
class Monster {
	public $size; // размер
	private $weight; // вес // свойство доступно только внутри класса
	protected $aggressive; // статус (арессивный, добрый) //
	public $damage;
	public $name;
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
var_dump($monster_zombie, $monster_alien);