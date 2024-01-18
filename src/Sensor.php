<?php

require_once ("enums.php"); /*import enums*/

/*Ez az osztály egy szenzort emulál és a hozzá tartozó aktuátort*/
class Sensor{
	private $last_values; /*Ebbe a tömbe kerülnek az tulsó mért értékek*/
	private $settings; /*Ebbe a tömbe kerülnek az adott napra és időintervallumhoz tartozó beállitani kivánt érték intervallum*/
	private Aktuator $aktuator; /*Ebbe kerül a szenzorhoz tartozó aktuátor állapota*/
	private $base;
	
	/*Konstruktor*/
	public function __construct($from, $to){
		$this->set_aktuator(Aktuator::OFF);
		$this->base = ($from + $to) /2;
	}
	
	/*Ennak a metodusnak a célja hogy elmentse az utolsó mért értékeket.
	  Bemeneti érték $val ez egy float tömb.
	*/
	public function set_last_values($val){
		$this->last_values = $val;
		$this->aktuator_calculation();
	}
	
	/*Ez a függvény a mért értékekböl az utolsót adja vissza.
	  Kimeneti érték egy float.
	*/
	private function last(){
		if($this->last_values != NULL)
			return end($this->last_values);
		return $this->base;
	}
	
	/*Ez a metodus az utolsó mért érték és a beállitási intervallumot össze haonlitja.
	  És ezek alapjén meghatározza hogy az aktuátor UP, DOWN vagy OFF állapotba kerüljőn.
	*/
	private function aktuator_calculation(){
		if($this->settings != NULL  && $this->last_values != NULL){
			if($this->last() < $this->settings[1] && $this->last() < $this->settings[0])
				$this->set_aktuator(Aktuator::UP);
			elseif($this->last() > $this->settings[1] && $this->last() > $this->settings[0])
				$this->set_aktuator(Aktuator::DOWN);
			else
				$this->set_aktuator(Aktuator::OFF);
		}
	}
	
	/*Ez a metodus menti el a beállitási intervallumot.
	  Bemeneti érték $val egy float tömb.
	*/
	public function set_settings($val){
		if($val != NULL)
			$this->settings = array($val["from_value"], $val["to_value"]);
		$this->aktuator_calculation();
	}
	
	/*Ez a függvény Brown mozást valosit meg az utolsó mért értékkel.
	  Az $a és $b értékek egy 0-1 közötti intervallumot szanak 3 felé.
	  Ha a $chance értéke 0-$a között van akkor az utolsó értéket nővelem 0.1.
	  Ha a $chance értéke $a-$b között van akkor az utolsó érték ugyan az marad.
	  Ha a $chance értéke $b-1 között van akkor 0.1 csökken az értéke.
	  A függvény bemeneti értékei $a és $b float és 0-1 kötötti szám.
	  A függvény kimeneti értéke egy float.
	 */
	private function general($a, $b){
		$chance = rand(1, 999)/1000;
		if($chance <= 1 && $chance >= $b)
			return $this->last() + 0.1;
		elseif($chance <= $b && $chance >= $a)
			return $this->last();
		return $this->last() - 0.1;
	}
	
	/*Ebben a függvényben az aktuátór állapota alapján generálom az új mért értéket.
	 A függvény kimeneti értéke egy float.
	*/
	public function get_new_value(){
		if($this->aktuator == Aktuator::UP)
			return $this->general(1/8, 4/8);
		elseif($this->aktuator == Aktuator::DOWN)
			return $this->general(4/8, 7/8);
		return $this->general(1/3, 2/3);
	}
	
	/*Ez a függvény vissza adja az aktuátór értékét.
	  A függény vissza térési értéke egy Aktuator enum.
	*/
	public function get_aktuator(){
		return $this->aktuator;
	}
	
	/*Ez a függény az aktuáror állását stringkénd adaj vissza.
	  A függény kimeneti értéke egy string.
	*/
	public function get_aktuator_string(){
		if($this->aktuator == Aktuator::UP)
			return "UP";
		elseif($this->aktuator == Aktuator::DOWN)
			return "DOWN";
		return "OFF";
	}
	
	/*Ez a metodus elmenti az aktuátór új álapotát.*/
	private function set_aktuator($val){
		$this->aktuator = $val;
	}
}