<?php

/*Ez egy absztrakt osztály, vagyis nem lehet példányositani csak statikusan meghívni a metodúsait.
  Ez az oszály felel a config.json fájl olvasásáért.
*/
abstract class Config{
	
	/*Ez a metodús vissza adja config.json fájl elérési utját.
	  A függvény egy stringel tér vissza.
	*/
	public static function phta(){
		return $_SERVER["DOCUMENT_ROOT"] . "/smarthome/config.json";
	}
	
	/*Ez a függvény a config fájloból olvssa ki a megfelelő dimenzion található értéket és azt adja vissza.
	  A dimenziokat pontall kell elválasztani példa "elso.masodik.harmadik".
	  A függvény bemeneti értéke $loc egy string.
	  A függény kimeneti értéke egy string.
	*/
	public static function get($loc){
		try{
			$json_file = file_get_contents(Config::phta());
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		$json_data = json_decode($json_file, true);
		$result = $json_data;
		foreach(explode('.', $loc) as $val){
			$result = $result[$val];
		}
		return $result;
	}
}