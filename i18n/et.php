<?php
/**
 * Variable holds english translations for the site. Translations are accessed
 * by array key. Translation is keys value. This file needs to be included in
 * \Views\Page::_loadLanguage() method
 * @var array
 */
$lang = array (
	'choose' => 'Milline on Su lemmikmürk, mu sõber?',
	'drinkType1' => 'Beer',
	'drinkType2' => 'Wine',
	'planet' => 'Planet',
	'welcomeTo' => 'Teretulemast lehele',	
	'introtext' => '<p>Lehekülg sai loodud mõttega kirja panna erinevate jookide maitsed, 
		mida ma alates 2014 aasta esimesest poolest proovinud olen. Lisaks on teine põhjus ka: soovisin proovida enda
		tehtud lihtsat ORMi (Object Relational Mapping). Niisiis, siin see on: lehekülg mis on tehtud kasutades
		Onion ORMi ( https://github.com/Shmarkus/onion )! Kindlasti vaadake lähtekoodi ning kasutage seda ka oma 
		lehekülgedel..</p><p>..või</p><p>..kui Sul on mõnda hiljutist õlle/veini maitsmist olnud, siis pane see
		siia kirja! Kui seda toodet veel ei ole, saab selle lisada uue toote menüü alt</p><p> Seda kõike SAAKS ka
		ratebeer.com lehel teha, kuid SEE oleks liiga meinstriim ;)</p>',
	/* menu items */
	'home' => 'Avaleht',
	'reviews' => 'Hinnangud',
	'products' => 'Tooted',
	'newreview' => 'Uus hinnang',
	'newproduct' => 'Uus toode',
	'links' => 'Lingid',	
	'aboutSite' => 'Leheküljest',
		
	/* product adding */
	'type' => 'Tüüp',
	'subtype' => 'Alamtüüp',
	'manufactor' => 'Tootja',
	'name' => 'Nimetus',
	'year' => 'Aasta',
	'alc' => 'Alkoholi sisaldus',
	'origin' => 'Päritolumaa',
	'selectOrigin' => 'Vali riik',
	'user' => 'Kasutaja',
	'cancel' => 'Tühista',
	'save' => 'Salvesta',
	'allProducts' => 'Kõik tooted',
	'latestProducts' => 'Viimased tooted',
	'noProducts' => 'Tooteid ei ole',
	'productReviews' => 'Toote hinnangud',
	'averageRating' => 'Keskmine hinnang',
    'addReview' => 'Lisa hinnang',
	'topFresh' => 'Värskelt lisatud',
	'product' => 'Toode',
	'color' => 'Välimus',
	'smell' => 'Lõhn',
	'taste' => 'Maitse',
	'description' => 'Kirjeldus',
	'rating' => 'Hinnang',
	'notInList' => 'Ei leidnud toodet nimekirjast?',
	'latestReviews' => 'Viimased hinnangud',
	'allReviews' => 'Kõik hinnangud',
	'picture' => 'Pilt (PNG)',
		
	
	/* Product types and subtypes */
	'beer' => 'Õlu',
	'wine' => 'Vein',
	'lager' => 'Lager',
	'porter' => 'Porter',
	'white' => 'Valge',
	'red' => 'Punane',
	'rose' => 'Roosa',
	'ale' => 'Ale',
	'mead' => 'Mõdu',
	'sparkling' => 'Vahu',
	'rootbeer' => 'Kali',
	
	'donate' => 'Anneta!',
	'donateDetails' => '<p>Kui Sa hindad minu tehtud tööd, siis palun vajuta <b>Donate</b> nuppu! Äitähh!</p>',
	'help' => 'Abi',
	'helpDetails' => '<p>&raquo; Hinnangu sisestamiseks mine <b>Uus hinnang</b> lehele ja vali nimekirjast toode, mida äsja maitsesid!</p><p>&raquo; Kui Sa aga ei leia seda toodet nimekirjast, siis mine lehele <b>Uus toode</b> ja lisa see ise!',
	'contactInfo' => 'Kontaktandmed',
	'contactDetails' => 'Kui Sul on ettepanekuid, teateid vigadest,või muid märkusi, palun võta minuga ühendust aadressil: markuskarileet@hotmail.com',	
	'downloadDisclaimer' => 'CSS ja HTML: ',	
	
	/* technical messages */
	'insertSuccess' => 'Lisamine edukas!',
	'insertFail' => 'Lisamine ebaõnnestus',
	'internalError' => 'Serveri viga mis on logitud ja millega tegeletakse, vabandame!',
	'invalidInput' => 'Sisendandmed ei ole usaldusväärsed (ärge kasutage F5 nuppu)',
	'notFound' => 'Otsitud objekti ei leitud andmebaasist!',
			
	/* adjectives */
	'bitter' => 'Mõru',
	'bittery' => 'Mõrkjas',
	'tasteless' => 'Maitsetu',
	'sour' => 'Hapu',
	'mellow' => 'Mahe',
	'tasteful' => 'Maitsekas',
	'hopy' => 'Humalane',
	'sweet' => 'Magus',	
	'tummine' => 'Tummine',
	'light' => 'Hele',
	'dark' => 'Tume',
	'golden' => 'Kuldne',			
			
    'red' => 'Punane', 
    'clear' => 'Selge',
    'hazy' => 'Hägune', 
    'foamy' => 'Vahutav', 
    'lessFoamy' => 'Vähene vaht', 
    'tightFoam' => 'Tihe vaht', 
    'cafe' => 'Kohvi', 
    'chocolate' => 'Šokolaad', 
    'spicy' => 'Vürtsine', 
    'greenBottle' => 'Roheline pudel',
    
    'weak' => 'Nõrk', 
    'strong' => 'Tugev',
    'caramel' => 'Karamelline', 
    'orange' => 'Apelsin',
    
    'lightTaste' => 'Vähese maitsega', 
    'refreshing' => 'Karastav', 
    'lastingTaste' => 'Maitse kestab', 
    'dry' => 'Kuiv', 
    'wellBalanced' => 'Tasakaalukas', 
    'wheaty' => 'Leivane', 
    'heat' => 'Viha', 
    'versatile' => 'Mitmekülgne', 
    'watery' => 'Vesine'
);