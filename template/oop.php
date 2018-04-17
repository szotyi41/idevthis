<?php use Engine\Variable; ?>

<div class="container">
<h1><?=Variable::get('title')?></h1>
<p>Létrehozva <?=Variable::get('created')?></p>

<?php foreach(Variable::get('tags') as $tag):?>
    <p class="tag"><?=$tag?></p>
<?php endforeach;?>

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