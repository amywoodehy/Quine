<?php 
/**
 * @author "Sulaimanov Malik, Sagynbek u. Salambek, Egemberdiev Eldiar"
 * @version 0.1.1 alpha
 * ! Реализация метода Квайна-МакКласки на PHP
 * ! начало: 10 декабря 2014
 * ! дедлайн: 23 декабря 2014
 */

class ByteSentence {
	/*
	 * Constants
	 */
	const MAXIMUM = 255;
	private $CUBE = array(	"'background: #faa'",
							"'background: #afa'",
							"'background: #aaf'"
								);
	/*
	 * Variables
	 */
	public $cube = array();
	public $Yfunc = array();

	private $Xvar;
	private $input;
	private $cycle = 1;
	private $sub_cube = array();
	/*
	 * methods
	 */
	function __construct ($input = null) {
		if(is_null($input) or $input == "") {
			$array = $this->random();
		}
		else {
			$array = explode (" ", $input);
		}
		$array = $this->prepare($array);
		$this->Xvar = $this->var_count($this->find_max($array));
		$this->Yfunc = $array;

		foreach ($array as $key => $value) {
			$this->cube[0][] = $this->binary($value);
		}
		unset($array);
	}

	function __destruct() {

	}

	/*
	 * Private methods
	 */
	private function prepare ($array) {
		$array = array_unique($array);
		sort($array);
		$this->Xvar = $this->var_count($this->find_max($array));
		$input = implode (" ", $array);
		$this->input = $input;
		return $array;
	}

	private function find_max ($array) {
		$m = count($array);
		$max = $array[0];
		for($i = 0; $i < $m; $i++) 
			if($max <= $array[$i]) 
				$max = $array[$i];
		
		unset($m);
		return $max;
	}

	private function var_count ($int) {
		$m = 32;
		for($i=0; $i < $m; $i++)
			if($int < pow(2, $i))
				return $i;
		return false;
	}

	private function random () {
		srand();
		$array = array();
		$m = rand(3, self::MAXIMUM/2);
		$n = self::MAXIMUM;
		for($i = 0; $i < $m; $i++) {
			$rand = rand(0, $n);
			$array[]= $rand;
		}
		return $array;
	}

	private function binary ($int) {
		$binary = "";
		for($i = 0; $i < $this->Xvar; $i++) {
			$der = $int%2;
			$int = floor($int/2);
			$binary = $der.$binary;
		}
		return $binary;
	}
	/**
	 
	 * Помогите сделать это
	 
	 */
	/**
	 
	 ТВОЯ РАБОТА, ЭЛДИ!

	 */ 
	private function make_cubes() {
		$from_array = $this->cube[0];
		$m = count($from_array);
		for($i = 0; $i < $m; $i++) {

		}
	}

	private function make_sub_cubes() {
		$sub_cube = array();
		for ($i = 0; $i < $this->cycle; $i++) {
			$from_array = $this->cube[$i];
			$to_array = array();
			foreach ($from_array as $key => $value) {
				$array = array();
				$length = strlen($value);
				for ($j = 0; $j < $length; $j++) {
					$array[] = $value[$i];
				}
				$to_array[] = $array;
				unset($array);
			}




			$sub_cube[] = $array;
		}
		$this->sub_cube = $sub_cube;
	}

	/*
	 * public methods
	 */

	public function write_function () {
		$output = "<div id='info'>\n\t<p><b>Ваша функция</b>: <i>f(";
		$str = str_replace(" ", ", ", $this->input);
		for($i = 0; $i < $this->Xvar; $i++) {
			if($i != $this->Xvar-1) $output .= "x<sub>$i</sub>, ";
			else $output .= "x<sub>$i</sub>";
		}
		$output .= ") = V<sub>1</sub>(".$str.")</i><br>\n";
		$y_count = count($this->Yfunc);
		$output .= "<p><b>Всего единичек</b>: <i>$y_count</i>\n</p>\n<p><b>Битность</b>: <i>".$this->Xvar."</i></p></div>";
		return $output;
	}

	public function write_table () {
		#$output = "<div class='truth-table'>\n\t<table class='mytable'>\n\t<caption>Таблица истинности</caption>\n\t<thead><tr>\n\t<td>#</td>\n";
		$output = "<div class='truth-table'>\n\t<h3>Таблица истинности</h3>
		<table class='mytable'>\n\t<thead><tr>\n\t<td>#</td>\n";
		$index = 0;
		for ($i=1; $i <= $this->Xvar; $i++) {
			$output .= "<td>x<sub>$i</sub></td>\n";
		}
		$output .= "<td>&nbsp;</td><td>Минтермы</td><td>f</td>\n</tr>\n</thead>\n<tbody>\n\t";
		for($rows = 0; $rows < pow(2, $this->Xvar); $rows++) {
			$bool = $this->Yfunc[$index] == $rows;
			if ($bool) $output .= "<tr class='selected'>\n\t";
			else $output .= "\t<tr>\n\t";
			$output .= "\t<td>$rows</td>\n";
			$bit_number = $this->binary($rows);
			for($col = 0; $col < $this->Xvar; $col++)
				$output .= "\t\t<td>".$bit_number[$col]."</td>\n";
			$output .= "\t\t<td>&nbsp;</td>\n";
			if ($bool) {
				$output .= "<td>".$this->write_minterm($bit_number)."</td>\n
				\t<td>1</td>\n";
				$index++;
			}
			else $output .= "<td>&nbsp;</td>\n<td>0</td>\n";
			$output .= "\t</tr>\n";
		}
		$output .= "</tbody>\n</table>\n</div>";
		return $output;
	}


	public function write_minterm ($binary) {
		$string = "";
		$m = strlen($binary);
		for ($key = 0; $key < $m; $key++) {
			if ($binary[$key] === "0") $string .= "-";
			$string .= "x<sub>$key</sub>";
			if ($key != $m-1) $string .= "*";
		}
		return $string;
	}

	public function write_maxterm ($binary) {
		$string = "";
		$m = strlen($binary);
		for ($key = 0; $key < $m; $key++) {
			if ($binary[$i] == "0") $string .= "-";
			$string .= "x<sub>$key</sub>";
			if ($key != $m-1) $string .= "*";
		}
		return $string;
	}

	/**
	 * 
	 
	 Работа для Саламбека

	*Его надо сделать универсальным. считай, что принимаешь ассоциативный массив и выводишь его, согласно его номеру. Вторая функция - вызывает предыдущую функцию через цикл.


	короче, я это сам уже сделал
	 */


	public function write_cube ($cycle) {
		#include style for cube as cube-0, cube-1, cube-2 etc;
		$output = "<div class='cubediv'>\n\t
		<h3>Куб $cycle</h3>\n <ul class='cube' style=".$this->CUBE[$cycle%3].">\n";
		$array = $this->cube[$cycle];
		foreach ($array as $key => $value) {
			$output .= "\t<li>$value</li>\n";
		}
		$output .= "</div>";
		return $output;
	}

	public function write_all_cubes() {
		$output = "";
		/*
		Вызывает функцию
		 */
		for($i = 0; $i < $this->cycle; $i++)
			$output .= write_cube($i);
		$output .= "";

		return $output;
	}


}


















?>