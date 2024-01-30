Ez a program egy egyetemi tantárgy beadandójaként születet meg.
A feladatnak az volt a célja, hogy írok egy olyan program szerkezetet webre, ami egy valós
okos otthon fűtési és hűtési rendszerét képes vezérelni.

A program dolgozik virtuális input és output adatokkal, ezek a virtuális szenzorok és a hozzájuk
párosított aktúátorók. 3 féle szenzort emulálok, de a program képes befogadni kevés módosítással
többet is. Ezek a következőek: Hőmérséklet mérő, páratartalom mérő, légnyomásmérő. És van 6
darab szoba, amiben mind van egy-egy szenzor, persze a szobák számát is könnyedén lehet bővíteni.
Ezek a következők: nappali, hálószoba, előszoba, garázs, konyha, fürdőszoba. A weboldalra
elhelyeztem egy le egyszerűsített alaprajzot a házról és a benne lévő 6 szobáról. A valóságban a
szenzorok egy arduino panelre lehetnének kötve, ami el van látva vagy vezetékes vagy vezeték nélküli
LAN kapcsolattal. És egy egyszerű web API hívassál el tudják küldeni a mért értékeket az
adatbázisnak. Amit a ```/api/set/sensor_value_insert.php``` URL címre küldenek. Ahova a szoba
azonosítóját és a szenzor azonosítóját (adatbázis béli ID) egy GET üzenettel küld el és a szenzor által
mért értéket pedig egy POST üzenetben küldi el.

A programban csak egy aktuátor van, az pedig a hőmérséklethez. Ezt a valóságban úgy gondolnám
kivitelezni, hogy van egy arduino amire rá van kötve egy kazán és egy klíma vezérlése. Ha bármelyik
szobában fűteni vagy hűteni kellene akkor bekapcsolná a kazánt vagy a klímát és szelepekkel
vezérelné, hogy az adott szobába eljusson a radiátorokba a meleg víz vagy éppen a szellőzőn át a
hideg levegő. A jelet pedig egy web kérésen kapná meg mégpedig a ```/api/get/aktuator.php``` URL címen.
Ahová GET kérésként küldené el a szoba és a szenzor azonosítóját (az utóbbi csak a hőmérő lenne,
aminek az azonosítója 1). A vissza kapott érték 3 lehet: OFF, UP DOWN. Az OFF amikor az adót
szobában a mért utolsó hőmérséklet az adót tartományba esik. Az UP azt jelenti, hogy a tartomány
alatt van így fűteni kell. A DOWN pedig azt jelenti, hogy az adót tartomány felett van így hűteni kell. 

De mivel ez egy szimulált környezet ezért a szenzorjaim által mért értékeket emulálnom kell és
valóság hűen bele építve azt is, hogy ha éppen megy az egyik aktuátor. Erre van az
```/api/get/new_sensor_value.php``` URL, ami arra szolgál, hogy realisztikus adatokat generáljón a
szenzoroknak. Ezt úgy csinálja, hogy veszi az előző mért értéket és Brown mozgás valósit meg. Vagyis
generál egy véletlen számot 0 és 1 kötött és ezt az intervallumot 3 felé osztom, ha az első felébe esik
a szám akkor az előző mért értékből ki vonok 0.1-et. Ha a középső szekcióba esik a szám akkor az
előző mért értéket békén hagyom és ha az utolsóba akkor pedig hozzá adok 0.1-et. Ezeket a
határokat attól függően választom meg hogy éppen az aktuátor milyen állapotban vagy (OFF, UP,
DOWN). Ha OFF akkor pontosan harmadolom, ha UP vagy DWON akkor kicsit eltolom, hogy nagyobb
eséllyel generáljon kisebb vagy épp nagyobb értéket. 

A termosztát beállításai az adatbázisban tárolom. Méghozzá olyan módon mintha egy igaz termosztát
lenni, vagyis minden szobának egyedileg lehet beállítani a hőmérsékleti adatait és a hét minden
napjára is lehet bontani. Ezen kívül azt lehet meg mondani, hogy egy hőmérsékleti tartomány hány
órától hány óráig tartsa. 

Ezt a ```/settings.php``` URL címen található oldalon lehet látni és szerkeszteni. Lehet ott új beállítást
rögzíteni, korábbit törölni, illetve módosítani. A fő oldalon (```/index.php```) lehet látni az
összes szenzor által mért adatót és a hozzá kapcsolódó aktuátor állapotát. Ezek 10 másodpercenként
frissülnek. A frissítés gombra nyomva a 10 másodpercen kívül frissíti az adatókat. Az adatbázis
importálni lehet manuálisan is egy phpMyAdmin felületen kérészül, az adatbázis szerkezete a
```smarthome.sql``` fájlban található. De a könnyebbség kedvéért iram egy automata importáló fájlt, ez
úgy lehet futtatni, hogy a böngészőben behívjuk a ```/db_migration_and_seed.php``` URL címet. Ha
minden simán lefutott akkor nem kell error üzenetnek lennie az oldalon csak rengeteg ömlesztett
SQL kódnak. A megfelelő adatbázis kapcsolathoz a ```config.json``` fájlba be kell írni az adatbázis szerver
elérhetőségét.

A weboldalt érdemes egy XAMPP Windows-os webszerver programmal futtatni. Én is ezt használtam
a fejlesztéshez. Illetve Notepad++ IDE-t használtam a kód írásához. És a frontenden használom a
jQuery és Bootstrap keret rendszerket. 
