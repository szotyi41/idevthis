<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
	
	<link rel="stylesheet" href="css/highlight.min.css">
	<script src="js/highlight.pack.js"></script>

</head>
<body>

ł<div class="container">
	<h1>Objektum Orientált Programozás</h1>

	<p>Az OOP programozásra azért van szükség, hogy hierarchiákat modellezzünk átláthatóbb módon. </p>

	<p>Nézzünk meg, hogy néz ki egy PHP kód ami metódusokat tartalmaz.</p>

	<pre><code class="php">
function apple() {
	echo "Alma";
}

function pear() {
	echo "Körte";
}
	</code></pre>

	<p>Ez azért hasznos, mert nem a kód lefutásakor hajtódnak végre az adott funkciók, hanem ha meghívjuk őket a <code class="short">apple();</code> sorral. Számtalan metódust hozhatunk létre, viszont ezeket valahogy osztályozni kellene, hogy kialakítsunk egy rendszert. Osztályokat az alábbi módon hozhatunk létre. Érdemes az osztályok neveit nagybetűvel kezdeni, ezzel is egyfajta <span class="alt" title="Szabály">konvenciót</span> valósítunk meg és jobban el tudunk igazodni később a változók tömegei mellett.</p>

	<pre><code class="php">
class Fruit {
	function alma() {
		echo "Apple";
	}

	function körte() {
		echo "Pear";
	}
}

class Vegetable {
	function tomato() {
		echo "Paradicsom";
	}
}
	</code></pre>

	<h2>Jogosultságok</h2>
	<p>Három jogosultság közül választhatunk fejlesztőként a <code class="short">public</code>, <code class="short">protected</code> és a <code class="short">private</code> közül. Feladatuk, hogy minél jobban leszűkítsük egyes osztályok metódusainak meghívhatóságát, változók értékeinek lekérdezését, módosítását más osztályokból. A public értelemszerűen a legszabadabb, bármilyen osztályból meghívható. A protected csak a <span class="alt" title="Alosztály">subclassokból</span> hívható meg. A private pedig csak a saját osztályából férhet hozzá.</p>

	<pre><code class="php">
class Things {
	//...
	$machine = <span title="Osztály példányosítás">new Machine();</span>
	$mug = $machine->dishwasher();
}

class Machine {
	private function washing() {

	}

	public function dishwasher() {

	}
}
	</code></pre>

	<p>A fenti példában leszűkítettük a lehetőségeket, hogy a bögrét a gépek közül csak a mosogatógépbe tehessük, és a mosógépbe ne legyen jogosultságunk.</p>

	<h2>Példányosítás</h2>
	<p>A fenti kódhoz visszatérve a Things osztályban példányosítottuk a Machine osztályt mielőtt belenyúltunk volna. Mit is jelent ez? Mielőtt egy osztályt használnánk egy Objektumot kell belőle létrehoznunk. Több objektumot is létrehozhatunk ugyanabból az osztályból.</p>
	<pre><code class="php">
$hospital = new Building("hospital");
$policestation = new Building("policestation");

class Building {
	private $name;
	function <span title="A konstruktor olyan metódus, amely az osztály példányosításakor automatikusan lefut.">__construct</span>($buildname) {
		$this->name = $buildname;
	}
}
	</code></pre>

	<h2>Paraméterezés</h2>
	<p>A fenti példában a <span title="A konstruktor olyan metódus, amely az osztály példányosításakor automatikusan lefut.">konstruktor</span> metódusnak paramétereket, argumentumokat adtunk meg. Bármilyen metódusnak adhatunk paramétereket az alábbi módon.</p> 
	<pre><code class="php">
$house = new House();
$house->address("Europe", "Hungary", 1052, "Budapest", "Deák Ferenc utca", 5);
$house->area(85, 3, 6);

class House {
	function address($city, $street, $number) {
		$this->city = $city;
	}

	function area($area, $headroom, $rooms) {
		$this->area = $area;
	}
}

	</code></pre>
<p>Viszont nem érdemes sok paramétert adni egy-egy metódusnak. Ennek kikerülése érdekében egyes esetekben ajánlott a <span title="Módosító">set</span>ter metódusok használata. Ugyanúgy működik mint egy rendes metódus csak elosztottuk a feladatokat, valamint ha egy értéken változtatni kell egyszerűbb dolgunk van.</p>

	<pre><code class="php">
$house = new House();
$house->setCity(1052, "Budapest");
$house->setStreet("Deák Ferenc", "tér");
$house->setNumber(5);

class House {
	private $name;
	private $title;
	public function setStreet($name, $title) {
		$this->name = $name;
		$this->title = $title;
	}
}
	</code></pre>

<h2>Static metódus</h2>
<p>Amennyiben static metódust használunk nem szükséges az adott osztály példányosítása, viszont így elestünk a helyi változók és metódusok használatától.</p>

	<pre><code class="php">


class Movie {
	public static function 
}
	</code></pre>

</div>

<div class="container">
	<h1>Composer</h1>
	<p>A composer zeneszerkesztő szoftverrel remek hangokat adhatunk hozzá projektjeinket. Olyan nagy nevek fűzhetőek hozzá mint Beethowen, Bach, Haydn... A viccet félretéve a composer egy <span class="alt" title="függőség">dependencia</span> kezelő alkalmazás amit a PHP fejlesztők előszeretettel használnak. Működése nem bonyolult, leginkább az ubununtu rendszereken használt apt-get szoftverre hasonlít. Feladata, hogy mielőtt valaki felrakná a te programodat a webszerverére leellenőrizze, hogy minden szükséges feltételnek megfelel az ő gépén lévő szoftverek, mint például PHP verzió, adatbáziskezelő verziója, egyéb szükséges kódok mint például egy harmadik féltől származó wysiwyg editor, vagy egy egyszerű font-awesome package meghatározott verziója. Valamint még egy autoloader feladatát is elvégzi ami autómatikusan meghívja az összes függőséget futás előtt, vagy az összes php állományt amit mi írtunk, például egy adott névtérre szűkítve.</p>

	<p>Első dolgunk globálisan telepíteni a composert <a href="https://getcomposer.org/download/" target="_blank">erről</a> az oldalról. Windowson ezt a Composer-Setup.exe futtatásával ki is pipáltuk, viszont Linuxon és OSX rendszer esetében a terminálba beírt az adott oldalon található telepítési útmutató végrehajtása által érhetjük el. </p>

	<h2>composer init</h2>
	<p>A telepítést követően <span class="alt" title="Parancssoros felület">CLI</span> által jussunk el a projektünk könyvtáráig, majd adjuk ki a <code class="short">composer init</code> parancsot. Ez rögtön rá fog kérdezni mi a projekt neve, leírása, fejlesztője. Az enterre ütve ha nem írtunk be semmit a felkínált szöveg lép érvénybe. Majd megkérdezi, hogy mi a Minimum Stability ide az alábbiak közül érdemes beírni:</p>

	<ul>
		<li>Stable (Stabil verzió)</li>
		<li>RC (Kiadásra jelölt)</li>
		<li>Beta</li>
		<li>Alpha</li>
		<li>Dev (Fejlesztés alatt)</li>
	</ul>

	<p>Következő paraméter a Package Type, ahova az ott megjelenő példák közül beírhatunk egyet. License megadása pl. open-source. Majd jön a csoda. Definiálnunk kell a szükséges dependenciákat. Beírjuk, hogy PHP majd rákérdez a verziószámra.</p>

	<h2>verziók</h2>
	<p>Verziók megadásánál használhatunk relációs jeleket, így megadhatjuk például <code class="short">>=5.0.0</code>. Vagy megtehetjük a következőt <code class="short">7.*.*</code>. Erről több információt a <a href="https://getcomposer.org/doc/articles/versions.md" target="_blank">composer</a> oldalán találsz.</p>

	<h2>composer.json</h2>
	<p>Miután sikerült végighaladnunk a composer nyújtotta paraméterek megadásán, a könyvtárunkba kaptunk egy <code class="short">composer.json</code> és egy <code class="short">composer.lock</code> állományt. A json fájl gondolom nem idegen számunkra úgyhogy nem lepődünk meg a struktúráján. Az auto-loader a psr-4 szekciónál található, itt adhatjuk meg honnan importálja be a kódjainkat.</p>

	<pre><code class="json">
{
  "name": "vendor/application",
  "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
  "type": "project",
  "require": {
      "php": "7.*.*",
      "components/jquery": "^3.3",
      "components/font-awesome": "^5.0"
  },
  "autoload": {
      "psr-4": {
          "":""
      }
  },
  "license": "open-source",
  "authors": [
      {
          "name": "John Doe",
          "email": "johndoe@gmail.com"
      }
  ]
}
</code></pre>

	<h2>composer update</h2>
	<p>Amennyiben mi valaki más projektjét töltöttük le és composert használ mindenképpen a <code class="short">composer update</code>, vagy <code class="short">composer install</code> futtatásával tölthetjük le a szükséges dependenciákat.</p>

</div>

<div class="container">

	<h1>Verziókezelés</h1>

	<p>Rengeteg leírást találtam gitről viszont laikusok számára kissé érthetetlen lehet, hogyan is működik egy verziókezelő. A verziókezelők leginkább egy ftp szerverhez hasonlítanak annyi különbséggel, hogy nem csak a jelenlegi kódot tárolják, hanem minden commit után létrehoz egy verziót a megírt kódból, hogy visszaállítható legyen, vagy nyomon követhető ki mikor mit tett hozzá a produktum növekedéséhez. A git egy verziókezelő szoftver, a github pedig egy közösségi oldal ahol tárolhatjuk munkáinkat. Amennyiben a kódunk publikus, ingyen feltölthetjük és tárolhatjuk korlátlanul.</p>

	<p>Első dolgunk lesz telepíteni a git alkalmazást a fejlesztő számítógépére. Ezt az <a href="https://git-scm.com/" target="_blank">alábbi</a> oldalról letöltjük.
	Telepítés után Linux, vagy OSX esetében a terminálban, vagy Windows esetén a cmdben jussunk el a verziókezelésre szánt kódunk könyvtárába majd adjuk ki a <code class="short">git init</code> parancsot. Ekkor létrehozott a program egy rejtett .git nevű mappát a könyvtárba. Itt fogja kezelni a git a számára szükséges adatokat, nem szükséges benne mozogni.</p>

	<p>Mikor a git frissen települt be kell konfigurálnunk kik vagyunk, hogy később nyomon követhetőek legyünk. Ezt a <code class="short">git config --global user.name ”név”</code> és a <code class="short">git config --global user.email ”email cím”</code> parancsokkal tehetjük meg.</p>

	<p>Amennyiben egy meglévő <span class="alt" title="Tároló">repositoryból</span> szeretnénk letölteni a <code class="short">git clone https://github.com/felhasználó/tároló</code> paranccsal letölthetjük azt a könyvtárunkba és kedvünkre módosíthatjuk.</p> 

	<h2>.gitignore</h2>

	<p>Miután lefuttattuk a fent leírt parancsok egyikét elkezdhetünk dolgozni a könyvtárban. Amennyiben nem szeretnénk, hogy egy bizonyos állomány, vagy egy teljes könyvtár tartalma felkerüljön a tárolóba <span class="alt" title="Feltöltés a tárolóba">pusholáskor</span>, hozzunk létre egy <code class="short">.gitignore</code> szöveges állományt és írjuk bele annak elérhetőségét.</p> 
	<p>Ha a Windows nem enged ilyen fájlt létrehozni cmdben adjuk ki a <code class="short">notepad .gitignore</code> parancsot.</p>
	<p>Érdemes ignorálni azt a fájlt ami az adatbázis elérhetőséget tartalmazza (felhasználónév, jelszó), valamint a vendor mappát amennyiben létezik.</p> 

	<h2>commit</h2>
	<p>Miután hozzányúltunk a kódhoz és úgy érezzük megérett arra, hogy aláírjuk a nevünket, első feladatunk hogy hozzáadjuk a feltölteni kívánt állományokat, könyvtárakat a ”színpadunkhoz” amik később majd a tárolóba kerülnek. Ezt a <code class="short">git add állománynév/könyvtár</code> paranccsal érhetjük el. Amennyiben az összes könyvtárat és állományt hozzá szeretnénk adni a <code class="short">git add .</code> paranccsal megtehetjük ezt. Ekkor a .gitignore állományainkban talált útvonalakon kívül mindent hozzáad az adott könyvtárban.</p>

	<p>Majd ellenőrizzük le mihez is nyúltunk hozzá. Adjuk ki a <code class="short">git status</code> parancsot ami felsorolja, hogy milyen állományok változtak meg az előző verzióhoz képest. Majd ha mindent rendben találunk, (tényleg azokat a fájlokat sorolja fel amiket módosítottunk) akkor a <code class="short">git commit -m ”leírás”</code> parancsot kiadva létrehoztunk egy új commitot. Minden commit előtt érdemes egy git status paranccsal leellenőrizni mi változott, nehogy kavarodás legyen. A <code class="short">git diff</code> paranccsal megtekinthetjük milyen különbségek  vannak a legutóbbi verzió és a mostani állományokra amit még nem addoltunk.</p> 

	<p>A <code class="short">git log</code> paranccsal megnézhetjük a commitok történelmét, ki mikor mit változtatott. Új állományok létrehozásakor ne felejtsük el hozzáadni azt a <code class="short">git add fájlnév</code> paranccsal.</p> 

	<h2>Feltöltés távoli tárolóba</h2>
	<p>Az eddigi parancsokat nyugodtan használhatjuk offline így bármikor folytathatjuk a munkánkat. Következő dolgunk megosztani az elkészült munkánkat a világhálón. Ehhez szükségünk lesz egy <span class="alt" title="Tároló">repositoryra</span> amit a <a href="https://github.com/" target="_blank">github.com</a> weboldalon, regisztrálás után létre is hozhatunk a felületen. Miután létrehoztuk ezt a tárolót ami kap egy elérési utat az alábbi paranccsal egy <span class="alt" title="Távoli elérés">remoteot</span> adhatunk meg <code class="short">git remote add origin https://github.com/felhasználó/tároló</code>. Lefordítva ez azt jelenti, hogy adjon hozzá egy központi távoli elérést ahova feltöltheti a munkánkat a későbbiekben. Ez még nem tölti fel a kódot, csak meghatározza, hogy hova töltse fel azt a későbbiekben.</p>

	<p>Amennyiben fel szeretnénk tölteni a tárolóba a munkánkat a <code class="short">git push origin master</code> paranccsal megtehetjük ezt. Ekkor megtörténik a csoda és megjelenik a tárolónkban az összes állomány, a commitok leírásaival, dátumokkal.</p>

	<p>Mi történik, ha más folytatja a munkát? Hogyan kerül az ő verziója hozzánk? Más egy újabb verziót töltött fel a tárolóba mi pedig már dolgozunk az alkalmazás másik részén akkor a git szól nekünk, hogy újabb verzió elérhető és szükséged lesz rá, mielőtt folytatod a munkát. Ekkor ki kell adnod a <code class="short">git pull</code> parancsot ami letölti a legfrissebb verziót. Érdemes megbeszélni ki mikor melyik részén dolgozik a kódnak, nehogy conflict alakuljon ki.</p>

	<h2>branch</h2>
	<p>Amennyiben egy új ágat szeretnénk hozzáadni, hogy ne a master ágon történjenek a változások és ne az kerüljön alapértelmezetten letöltésre mások által, érdemes új ágat létrehozni a <code class="short">git branch ágnév</code> paranccsal. Ezután ne felejtsünk el átlépni a létrehozott ágba, hogy oda kerüljenek a változások a <code class="short">git checkout ágnév</code> paranccsal. Ha az imént létrehozott ágban elkészültünk a kóddal a master ággal a <code class="short">git merge ágnév</code> összefésülhetjük ezt.</p>

	<h2>issue</h2>
	<p>A githubon minden tárolóhoz hozzáadhatunk <span class="alt" title="Probléma meghatározás">issuekat</span> amiről a fejlesztők értesítést kapnak, így ha valaki ráakad egy bugra itt értesítheti a fejlesztőt, hogy javítást, vagy kiegészítést igényel a projekt.</p>

	<h2>readme.md</h2>
	<p>Githubon van lehetőség megjeleníteni egy leírást a munkánkról amennyiben létrehozunk egy <code class="short">readme.md</code> nevű állományt. Ide mindenképpen érdemes leírni a Specifikációt, Rendszerkövetelményeket, Telepítési útmutatót, vagy a teljes dokumentációt. Ennek a rendszernek egy saját szintaxisa van aminek <a href="https://help.github.com/articles/basic-writing-and-formatting-syntax/" target="_blank">itt</a> olvashatjátok a dokumentációját.</p>
</div>

</body>

<script type="text/javascript">

	$(document).ready(function() {

		hljs.configure({tabReplace: '  '});
    hljs.initHighlighting();

		$("code").click(function(event) {
			copyToClipboard($(this).text());
		});

		$("span").tooltip({
			tooltipClass: "tooltip",
			position: {
			  my: "center bottom",
			  at: "center top-5",
			  collision: "none"
			}
    });

    $("code.short").tooltip({
			tooltipClass: "tooltip",
			content: "Másolás",
			position: {
			  my: "center bottom",
			  at: "center top-5",
			  collision: "none"
			}
    });

		function copyToClipboard(text) {
			console.log("Copy: " + text);
	  	var temp = $("<input>");
	  	$("body").append(temp);
	  	temp.val(text).select();
	  	document.execCommand("copy");
	  	temp.remove();
		}
	});

</script>

</html>