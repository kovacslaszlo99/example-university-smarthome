<?php
/*Ez a fájl egy függvány gyüjtemény amit nem tutdam osztályhoz kapcsolni.*/

/*Ez a függvény megvizsgálja egy stringröl hogy időt tartalmaz-e.
  Formátúm "HH:ii:ss" HH=óra ii=perc ss=másodperc.
  A függvény bemeneti értéke $String egy string.
  A függvény kimeneti értéke egy bool.
*/
function is_time($String){
	return DateTime::createFromFormat('H:i:s', $String) !== false;
}

/*Ez a függvény vissza adja a hogy a hát melyik napja van ma egy számkánt 1-7.
  A függvény vissza térési értéke egy int.
*/
function get_week_day_now(){
	return date('N', strtotime(date("Y-m-d")));
}

/*Ez a függvény vissza adja a jelenlegi időt.
  Formátúm "HH:ii:ss" HH=óra ii=perc ss=másodperc.
  A függvény vissaz térési értéke egy string.
*/
function get_time_now(){
	return date("H:i:s");
}