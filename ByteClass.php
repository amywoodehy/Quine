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
	public $cubes = array();
	public $Yfunc = array();

	private $Xvar;
	private $input;
	private $cycle = 1;
	private $sub_cubes = array();
	/*
	 * methods
	 */
	function __construct ($input = null) {
		if(is_null($input) or $input == "") {
			$array = $this->random();
		}
		else {
			$array = $this->multy_explode(array(" ", ",", ".", "|", "/", "+", "-"), $input);
		}
		$array = $this->prepare($array);
		$this->Xvar = $this->var_count($this->find_max($array));
		$this->Yfunc = $array;

		foreach ($array as $key => $value) {
			$this->cubes[0][] = $this->binary($value);
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

	private function multy_explode($delimiters,$string) {
		$ready = str_replace($delimiters, $delimiters[0], $string);
		$launch = explode($delimiters[0], $ready);
		return  $launch;
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
	 * @return bool
	 */
	private function isGreyCode(/*string*/ $a, /*string*/ $b) {
		$flag = 0;
		for ($i = 0; $i < strlen($a); $i++) {
			if($a[$i] != $b[$i]) {
				$flag++;
			}
		}
		return ($flag==1);
	}

	/**
	 * @return string $temp
	 */
	private function replace_bit(/*string*/ $a, /*string*/ $b) {
		$temp = "";
		for($i = 0; $i < $this->Xvar; $i++) {
			if($a[$i] != $b[$i]) {
				$temp .= "X";
			}
			else {
				$temp .= $a[$i];
			}
		}
		return $temp;
	}


	private function in_array($array, $string) {
		for ($int = 0; $int < count($array); $int++)
			if($array[$int] == $string) 
				return true;
		return false;
	}

	private function make_cube(/*array*/ $cycle) {
		$array = $this->make_sub_cube($cycle);
		
		$this->cycle++;
		return $cube;
	}

	private function make_cubes() {
		$cubes = array();
		for($i = 0; $i < $this->cycle; $i++) {
			$cubes[] = $this->make_cube($i);
		}
		$this->$cubes = $cubes;
		$this->make_sub_cubes();
	}

	private function make_sub_cube ($cycle) {
		$temp_cube = $this->cubes[$cycle];
		for($j = 0; $j <= $this->Xvar; $j++) {
			$count = 0;
			foreach ($temp_cube as $key => $value) {
				$var = substr_count($value, "1");
				if ($var == $j) {
					$count++;
					$sub_cube[$j][] = $value;
				}
			}
		}
		return $sub_cube;
	}

	private function make_sub_cubes() {
		$sub_cubes = array();
		for ($i = 0; $i < $this->cycle; $i++) {
			$sub_cubes[] = $this->make_sub_cube($i);
		}
		$this->sub_cubes = $sub_cubes;
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
			if ($binary[$key] === "0") $string .= "&#772;";
			$string .= "x<sub>$key</sub>";
			if ($key != $m-1) $string .= "&and;";
		}
		return $string;
	}

	public function write_maxterm ($binary) {
		$string = "";
		$m = strlen($binary);
		for ($key = 0; $key < $m; $key++) {
			if ($binary[$i] == "0") $string .= "&#772;";
			$string .= "x<sub>$key</sub>";
			if ($key != $m-1) $string .= "&or;";
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
		$array = $this->cubes[$cycle];
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
		$this->make_sub_cubes() ;
		for($i = 0; $i < $this->cycle; $i++) {
			$output .= $this->write_cube($i);
			$output .= $this->write_sub_cube($i);
		}
		return $output;
	}

	public function write_sub_cube($cycle) {
		$output = "<div class='cubediv'> \n";
		$temp = $this->sub_cubes[$cycle];
		foreach ($temp as $key => $value) {
			$output .= "<h3>K$cycle<sub>$key</sub></h3>\n";
			$output .= "<ul class='cube' style=".$this->CUBE[$key%3].">\n";
			foreach ($value as $index => $word) {
				$output .= "<li>$word</li>\n";
			}
			$output .= "</ul>";
		}
		$output .= "</div>";
		return $output;
	}


}
?>