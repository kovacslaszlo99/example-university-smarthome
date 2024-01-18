<?php
/*import config*/
require_once ("Config.php");

/*Ez az osztály felel az adatbázis kapcsolatért.*/
class DB{
	private $username; /*Az adatbázis szervere való bejelentkezés felhasználóneve*/
    private $password; /*Az adatbázis szervere való bejelentkezésehz a jelszó*/
    private $host; /*Az adatbázis szervet elérési domain neve vagy ip címe*/
    private $database; /*Az adatbázis szerveren az adatbázis amihez szeretnénk csatlakozni*/
    private $options; /*Az adatbázis kapcsolat további beállitás opciói*/
    private $con; /*Ebben a vátozoban tárolodik el PDO adatbázis egy pédánya*/
	
	/*Konstruktór
	  Itt történik az adatbázishoz való csatlakozás.
	*/
    public function __construct(){
		$this->username = Config::get("db.username");
		$this->password = Config::get("db.password");
		$this->host = Config::get("db.hostname");
		$this->database = Config::get("db.datebase_name");
		$this->options = array(
			\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . Config::get("db.caracter_coding"),
		);
        try {
            $this->con = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password, $this->options);
        } catch (\PDOException $ex) {
            var_dump($ex->getMessage( ));
        }
    }
	
	/*Ezel a függvánnyel lehet lekérdezni az adatbázisból egy táblát.
	  A főggvány bemeneti értékei a $select $form és $where egy string.
	  A függvény kimeneti értéke egy tömb.
	*/
    public function getData($select, $from, $where = ""){
        if ($where != "") {
            $where = " WHERE " . $where;
        }
        try {
            $query = "SELECT " . $select . " FROM `" . $from . "`" . $where;
            $result = $this->con->prepare($query);
            $result->execute();
            return $result;
        } catch (\PDOException $ex) {
            var_dump($ex->getMessage());
        }
        return array();
    }
	
	/*Ezzel a függvényel lehet beszurni az adatbázis egy táblájába egy új sort.
	  A függvény bemeneti értékei $to, $columns stringek a $values_array pedig egy tömb.
	  A függvény vissza térési értéke egy bool.
	*/
    public function insertData($to, $columns, $values_array){
		$values = "";
		foreach($values_array as $key => $val){
			$values .= (!is_numeric($val))? "'" . $val . "'" : $val;
			if ($key+1 != count($values_array)){
				$values .= ", ";
			}
		}
        try {
            $query = "INSERT INTO `" . $to . "` (" . $columns . ") VALUES (" . $values . ")";
            $result = $this->con->prepare($query);
            $ex = $result->execute();
            return array($ex, $result);
        } catch (\PDOException $ex) {
            var_dump($ex->getMessage());
        }
        return false;
    }
	
	/*Ezzel a függvényel lehet modosítani egy már meglévő tábla egy sorát.
	  A függvény bemeneti értékei $to string a $values_array, $where_in pedig egy tömb.
	  A függvény vissza térési értéke egy bool.
	*/
    public function updateData($to, $values_array, $where_in){
		$set = "";
		$index = 0;
		foreach($values_array as $key => $val){
			$set .= $key . "=" . ((!is_numeric($val))? "'" . $val . "'" : $val);
			if ($index+1 != count($values_array)){
				$set .= ", ";
			}
			$index++;
		}
		$where = "";
		if(is_array($where_in)){
			$index = 0;
			foreach($where_in as $key => $val){
				$where .= $key . "=" . ((!is_numeric($val))? "'" . $val . "'" : $val);
				if ($index+1 != count($where_in)){
					$where .= " and ";
				}
				$index++;
			}
		}else{
			$where = "id=" . $where_in;
		}
        try {
            $query = "UPDATE `" . $to . "` SET " . $set . " WHERE " . $where;
            $result = $this->con->prepare($query);
            $ex = $result->execute();
            return array($ex, $result);
        } catch (\PDOException $ex) {
            var_dump($ex->getMessage());
        }
        return false;
    }
	
	/*Ezzel a függvényel lehet törölni egy már meglévő tábla sorait.
	  A függvény bemeneti értékei from string a $where_in pedig egy tömb.
	  A függvény vissza térési értéke egy bool.
	*/
    public function deleteData($from, $where_in){
		$where = "";
		if(is_array($where_in)){
			$index = 0;
			foreach($where_in as $key => $val){
				$where .= $key . "=" . ((!is_numeric($val))? "'" . $val . "'" : $val);
				if ($index+1 != count($where_in)){
					$where .= " and ";
				}
				$index++;
			}
		}else{
			$where = "id=" . $where_in;
		}
        try {
            $query = "DELETE FROM `" . $from . "` WHERE " . $where;
            $result = $this->con->prepare($query);
            $ex = $result->execute();
            return array($ex, $result);
        } catch (\PDOException $ex) {
            var_dump($ex->getMessage());
        }
        return false;
    }
	
	/*Ez a függvény kiűriti egy tábla tartalmát.
	  A fűggvény bemeneti értéke $table egy string.
	  A függvény vissza térési értéke egy bool.
	*/
    public function truncateTable($table){
        try {
            $query = "TRUNCATE TABLE `" . $table . "`";
            $result = $this->con->prepare($query);
            $result->execute();

            return $result;
        } catch (\PDOException $ex) {
            var_dump($ex->getMessage());
        }
        return false;
    }
	
	/*Ez a függvény a bemenetben megadott $sql stringet hajtja végre
	  ami egy SQL utasitás sorzat.
	*/
	public function sql($sql){
        try {
            $query = $sql;
            $result = $this->con->prepare($query);
            $result->execute();

            return $result;
        } catch (\PDOException $ex) {
            var_dump($ex->getMessage());
        }
        return false;
    }
	
	/*Ez a függvény vissza adja az utolsó beszúrt sor ID értékét.
	  A függvény vissza térési értéke egy int.
	*/
    public function getLastInsertId(){
        return $this->con->lastInsertId();
    }
}