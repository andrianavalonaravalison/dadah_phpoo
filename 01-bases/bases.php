
<style>
   body {
        margin-bottom: 400px;
    }
    

h2 {
    border-top : 1px solid navy;
    border-bottom: 1px solid navy;
    color: navy;
}
</style>


<?php 

// ----------------------------------
echo '<h2> Les balises PHP </h2>';
// ----------------------------------
?>

<?php
// pour ouvrir un passage en PHP on utilise la balise précedente (ligne 18)
// pour fermer un passage en PHP on utilise la balise suivante :
?>

<p>Ici je suis en HTML</p>
<!--en déhors de balise d'ouverture et de fermeture de PHP, nous pouvons écrire du HTML quand on est dans un fichier ayant l'extension PHP. -->

<?php
// Vous n'etes pas oubligé de fermer un passage PHP en FIN de script.

// pour faire 1 ligne de commentaire
# pour faire 1 ligne de commentaire

/*
pour faire de commentaires sur plusieurs lignes
*/


// ----------------------------------
echo '<h2> Affichage </h2>';
// ----------------------------------

echo 'Bonjour <br>'; // echo permet d'effectuer un affichage dans le navigateur. Nous pouvons y mettre des balises HTML sous forme de string. Notez que toutes les instruction se terminent par un ";" . 

print 'Nous somme jeudi <br>'; // autre instruction d'affichage dans le navigateur.

// Autres instruction d'affichage que nous verrons plus loin :
print_r('code'); 
echo '<br>';
var_dump('code');


// ----------------------------------
echo '<h2> Variable </h2>';
// ----------------------------------
// Une variable est un espace mémoire qui porte un nom et qui permet de conserver une valeur.
// en PHP on présente une variable avec le signe $.

$a = 127; // on déclare la variable "a" et lui affecte la valeur 127.
echo gettype($a); // gettype est une fonction prédéfinie qui permet de voir d'une type de variable. Ici il s'agit d'un INTEGER (entier).
echo '<br>';

$a = 1.5;
echo gettype($a); // ici nous avon un double = float (nombre à virgule)
echo '<br>';

$a = 'une chaine de caractère';
echo gettype($a); // ici nous avon un STRING
echo '<br>';

$a = '127'; // un nombre ecrit dans des cuotes ou de guillemets est interprété comme un STRING
echo gettype($a);
echo '<br>';

$a = true; // ou false
echo gettype($a); // ici nous avon un boolean (booléen)
echo '<br>';

// Par convention un nom de variable commence par une miniscule, puis on met une majuscule à chaque mot (Camel Case). Il peut contenir des chiffres (jamais au début) ou un (_) (pas au début ni à la fin). Exemple : $maVariable1

// ----------------------------------
echo '<h2> Guillemets et quotes </h2>';
// ----------------------------------

$message = "aujourd'hui"; // ou bien : 
$message = 'aujourd\'hui'; // on echappe l'appostrophe dans les quotes simple

$prenom = 'john';
echo "Bonjour $prenom <br>"; // quand on écrit une variable dans le guillemets, elle est évaluée : c'est son contenu qui est affiché. ici "John".
echo 'Bonjour $prenom <br>'; // dans des quotes simples, tout est du texte brut : c'est le nom de la variable  qui est affiché.


// ----------------------------------
echo '<h2> Concatenation </h2>';
// ----------------------------------

// En PHP on concatène les éléments avec le point (.).

$x = 'Bonjour ';
$y = 'tous le monde';
echo $x . $y . '<br>'; // Concaténation de variables et d'un string. On peut traduir le point de concaténation par "suivi de ...". 

// -------
// Concaténation lors de l'affectation avec l'opérateur .= 
$message = '<p>Erreur sur le champ email</p>';
$message .= '<p>Erreur sur le champ téléphone</p>'; // avec l'opérateur combiné .= on ajoute la nouvelle valeur SANS remplacer la valeur précédente dans la variable $message .

echo $message; // on affiche donc les 2 messages. 



// ----------------------------------
echo '<h2> Constante </h2>';
// ----------------------------------

// une constante permet d conserver une valeur sauf celle- ne peut pas changer. C-a-d on ne pourra pas la modifier durant l'execution du script. Utile pour conserver par exemple les paramètres de connexion à la BDD.

// fonction prédefinies (1er nom de la constante, 2è la valeur de la constante)

define('CAPITAL_FRANCE', 'Paris'); // Définit la constante appelée CAPITAL_FRANCE à laquelle on donne la valeur Paris. Par convention des constantes est toujours en majuscules.
echo CAPITAL_FRANCE . '<br>'; // affiche Paris


// Autre façon :
const TAUX_CONVERSION = 6.55957; // définit la constante de TAUX_CONVERSION 
echo TAUX_CONVERSION . '<br>'; // affiche 6.55957

// Qualques constantes magiques :

echo __DIR__ . '<br>'; // contient le chemin complet vers notre dossier
echo __FILE__ . '<br>'; // contient le chemin complet vers notre fichier

// ---------
// Exercice : afficher Bleu-Blanc-Rouge en mettant le texte de chaque couleur dans une variable.

$Bleu = 'Bleu-';
$Blanc = 'Blanc-';
$Rouge = 'Rouge';
echo $Bleu . $Blanc . $Rouge . '<br>';
echo "$Bleu-$Blanc-$Rouge <br>";

define('BLEU', 'Bleu-');
define('BLANC', 'Blanc-');
define('ROUGE', 'Rouge');
echo BLEU . BLANC . ROUGE;

echo '<br>';

// ----------------------------------
echo '<h2> Opérateur arithmétiques </h2>';
// ----------------------------------

$a = 10;
$b = 2;

echo $a + $b .' <br>'; // affiche 12
echo $a - $b .' <br>'; // affiche 8
echo $a * $b .' <br>'; // affiche 20
echo $a / $b .' <br>'; // affiche 5
echo $a % $b .' <br>'; // Affiche 0 . modulo = reste de la division entière. exemple : 3%2= 1, car si on a 3 billes on les répartit sur 2 joueurs, il nous reste 1. 

// ----------
// Les opérateurs arithmétiques combinés :

$a += $b; // équivaut à $a = $a + $b soit $a = 10 + 2. $a vaut donc à la fin 12.
echo $a . ' <br>';

$a -= $b; // équivaut à $a = $a - $b soit $a = 12 - 2. $a vaut donc à la fin 10.
echo $a . ' <br>';

$a *= $b; // équivaut à $a = $a * $b soit $a = 10 * 2. $a vaut donc à la fin 20.
echo $a . ' <br>';

$a /= $b; // équivaut à $a = $a / $b soit $a = 20 / 2. $a vaut donc à la fin 10.
echo $a . ' <br>';

$a %= $b; // équivaut à $a = $a % $b soit 0.
echo $a . ' <br>';

// on utilisera le += et le -= dans le panier d'achat

// -------
// incrémenter et décrémenter : 
$i = 0;

$i++; // incrémentation de $i par ajout de 1 :  équivaut à $i = $i + 1 = 1
$i--; // décrémentation  de $i par soustraction de 1 : $i vaut donc à la fin 0 ici


// ------------------------------------------
echo '<h2> Structure conditionelles </h2>';
// ------------------------------------------

$a = 10;
$b = 5;
$c = 2;

// if ... else :

if ($a > $b) { // si la condition est vraie, c-a-d $a est bien supérieur  $b , alors on entre dns les accolades qui suivent
    echo '$a est surérieur à $b <br>';
} else { // sinon, on exécute le else
    echo 'Non, c\'est $b est supérieur ou égal à $a <br>';
}

// l'opérateur AND qui s'écrit &&
if ($a > $b && $b > $c) {  // si $a est supérieur $b et dans le meme temps $b est sup à $c, alors on entre dans les accolades
    echo 'Vrais pour les 2 conditions <br>';
}

// TRUE && TRUE   => TRUE
// FALSE && FALSE => FALSE
// TRUE && FALSE  => FALSE

// l'opérateur OR s'écrit || :
$a = 10;
$b = 5;
$c = 2;

if ($a == 9  || $b > $c) { // si $a est égale (==) à 9 ou alors $b > $c, dans ce cas on entre dans les accolades qui suivent
    echo 'Vrais pour au moins une des deux conditions <br>';
} else {
    echo 'Les deux conditions sont fausses <br>';
}

// TRUE || TRUE   => TRUE
// FALSE || FALSE => FALSE
// TRUE || FALSE  => TRUE

// ----------
// if ... elseif ... else :
if ($a == 8) { // si $a est égale à 8
    echo 'Réponse 1 : $a est égal à 8';
} elseif ($a != 10 ) { // sinon si $a est différent de 10
    echo'Réponse 2 : $a est différent de 10';
} else { // si je n'entre pas dans le if ni dans le elseif, alors j'arrive dans le else
    echo 'Réponse 3 : $a est égal à 10 <br>';
}

// Note : les eles n'est pas obligatoire (on ne le met pas quand on n'en a pas besoin). Else n'est jamais suivi d'une condition.

// ------------
// l'opérateur XOR pour OU exclusif :
$question1 = 'mineur';
$question2 = 'je vote'; // exemple d'un questionneire

// Les réponse de l'internaute n'etant pas cohérentes, on kui met un message :
if ($question1 == 'mineur' XOR $question2 == 'je vote') { // XOR = OU exclusif . Seulement une de 2 conditions doit etre valide pour entrer dans le if. Si nous avons TRUE XOR TRUE  cela vaut FALSE.
    echo 'Vos réponse sont cohérentes <br>';
}else {
    echo 'Vos réponse ne sont pas cohérentes <br>';
}

// --------- 
// Forme dite ternaire de la condition (autre syntax du if) :
$a = 10;

echo ( $a == 10 ) ? '$a est égale à 10 <br>' : '$a est différent de 10 <br>'; // le "?" remplace if, et le ":" remplace else. On affiche le premier string si la condition est vraie, sinon le second.

//-----------
// comparaison == ou === :

$varA = 1; // integer
$varB = '1'; // string

if ($varA == $varB) { // avec le double == on compare uniquement la valeur
 echo '$varA et égale à $varB en valeur <br>';
}

if ( $varA === $varB) { // avec le triple === on compare la valuer et le type
    echo 'Les deux variables sont égales en valeur ET en type <br>';
} else {
    echo 'Les deux variables sont différentes en valeur OU en type <br>';
}

// Rappel : le symple = est le signe d'affectation.


// ----------
// isset() et empty() :
// empty() : vérifie si la variable est vide, c-a-d 0, '', NULL, false, ou non définie.
// isset() : vérifie si la variable existe et a une valeur non NULL.

$var1 = 0;
$var2 = '';

if (empty($var1)) echo '$var1 contient <b>0, string vide, NULL, false  ou n\'est pas définie </b> <br>'; // VRAI car la variable contient 0

if (isset($var2)) echo 'La variable existe et est non NULL <br>'; // VRAI car la variable existe bien et ne contient pas NULL

// Contexte : empty pour verifier les champs de formulaire, isset pour vérifier l'existence d'un indice dans un tableau avant d'y acceder.

// ---------
// l'opérateur NOT qui s'ecrit "!" :
$var3 = 'quelque chose';
if( ! empty($var3)) { // le ! correspond à une négation : il intervertit le sens du booléen : !true devient false en ! false devient treue. Ici cela signifie "$var3" n'est pas vide .
echo 'La variable n\'est pas vide <br>';
}



// -----------
// L'opérateur ?? appelé "NULL coalescent" (PHP7):

echo $variable_inconnue ?? 'valeur par défaut <br>';


// ----------------------------------
echo '<h2> swicht </h2>';
// ----------------------------------
// la condition switch est une autre sytaxe pour écrire if elseif else quand on veut comparer une variable à une multitude de valeurs.

$langue = 'chinois';

switch ( $langue) {

    case 'français': // compare $langue à la valeur "case" et execute le code qui suit si elle correspond :
        echo 'Bonjour !';
    break; // obligatoire pour quitter le switch une fois un "case" executé
    case 'italien':
        echo 'Buongiorno !';
    break;
    case 'espagnol':
        echo 'Hola !';
    break;
    default : // cas par défaut qui est exécuté si on n'entre pas dans l'un des "case"
    echo 'Hello ! <br>';
    break;
}

// Exercice : vous réécrivez ce switch sous forme de condition if ... pour obtenir exactement le meme résultat.

$langue = 'chinois';

if ($langue == 'français') {
    echo 'Bonjour !';
} elseif ($langue == 'italien') {
    echo 'Buongiorno !';
} elseif ($langue == 'espagnol') {
    echo 'Hola !';
} else {
    echo 'Hello ! <br>';
}


// -------------------------------------
echo '<h2> Fonctions utilisateur </h2>';
// -------------------------------------

// une fonction est un morceau de code encapsulé dans des accolades et qui porte un nom. on appelle cette fonction au besoin pour exécuter le code qui s'y trouve. le fait de définir des fonctions pour ne pas se répéter s'appelle "factoriser" son code . 

// On définit puis on exécute une fonction :
function separation() { // déclaration d'une fonction prévu pour ne pas recevoir d'arguments
    echo '<hr>';
}

separation(); // on appelle notre fonctin par son nom suivi d'1 aire de ()

// ---------
// fonction avec paramètre et return :
function bonjour($prenom, $nom) { // $prenom et $nom sont des parametres de la fonction. Ils permettent de recevoir une valeur car il s'agit de variables de réception

    return 'Bonjour ' . $prenom . '  ' . $nom . '  ' . ' ! <br>'; // return renvoie la chaine de caractères "Bonbjour..." à l'endroit ou la fonctin est appelée.
    
    echo 'Cette ligne ne sera pas exécutée'; // car après un return on quitte la fonction
}

echo bonjour('John', 'Doe'); // si la fonction attend des valeurs, il faut les lui envoyer dans le meme ordre que les paramètres de réception. Les valeurs envoyées s'appellent "arguments". Quand on souhaite afficher le résultat, et qu'il n'y a pas de echo dans la fonction, il faut le faire en meme temps que l'appel de la fonction.

//--------
$prenom = 'Pierre'; 
$nom = 'Quiroule';

echo bonjour($prenom, $nom); // on peut mettre des variables à la place des valeurs dans l'appel d'1 fonction (exemple : quand ou voudra récupérer les valeurs d'un formulaire).

//------
// Exercice :
// - Ecrivez la fonction factureEssence() qui calcule le cout total de votre facture en fonction du nombre de litres d'essence que vous indiquez lors de l'appel de la fonction. Cette fonction retourne la phrase "votre facture est de X euros pour Y litres d'essence" ou X et Y sont des variables. Pour cela, on vous donne une fonction prixLitre() qui vous retourne le prix du litre d'essence. Vous l'utilisez donc pour calculer le total de la facture.

/*
$Y = 50;

function prixLitre($X = 1) {
    return rand(100, 200)/100;
}

function factureEssence($Y) {
    return 'votre facture est de ' . prixLitre($X) * $Y . 'euros pour ' . $Y . ' litres d\'essence' . '<br>';
}

echo factureEssence($Y);
*/

// correction

function prixLitre() {
    return rand(100, 200)/100;
}

function factureEssence($litres) {
    $prix = prixLitre();

    return 'votre facture est de ' . $prix * $litres . 'euros pour ' . $litres . ' litres d\'essence' . '<br>';
}
echo factureEssence(15);

//-------
// En PHP7 on peut préciser le type valeurs entrantes dans une fonction :

function identite(string $nom, int $age) { // array, bool, float, int, string
    echo gettype($nom) . '<br>'; // string
    echo gettype($age) . '<br>'; // integer
    echo $nom . ' a ' . $age . ' ans ' . '<br>';
}

identite('Astérix', 60); // le type attendu pour la fonction est respecté, il n'y a pas d'erreur.

identite('Asterix', '60'); // ici il n'y a pas d'erreur, cependant le string '60' a été casté en integer (Note : si nous étions en mode strict, il y aurait une erreur).

// identite('Asterix', 'soixante'); // fatal error car on passe un string qui ne peut etre transformé en integer. On commente donc la ligne pour poursuivre.

// PHP7 on peut aussi préciser la valeur de retour que doit sortir la fonction :

function adulte(int $age) : bool { // array, bool, float, int, string

    if( $age >= 18) {
        return true;
    } else {
        return false;
    }
}

var_dump(adulte(7)); // ici la fonction retourne bien booléen, il n'y a donc pas  erreur. Bous faisons un var_dump car il permet d'afficher le false que retourne le fonction, "echo false" n'affiche rien.
echo '<br>';

// ----------
// Variable local et variable global :

// De l'espace local vers l'espace global :

function jourSemaine() {
    $jour = 'vendredi'; // variable locale
    return $jour;
}

// echo $jour; // ne fonctionne pas car cette variable n'est connu qu'à l'intérieur de la fonction
echo jourSemaine(); // on affiche ce que nous retourne la fonction grace à son return

echo '<br>';

// De l'espace globa vers l'espace local :

$pays = 'France'; // variable globale

function affichePays( ) {
    global $pays; // le mot clé global permet de récuperer une variable globale au sein de l'espace local de la fonction. On peut donc l'afficher.
    echo $pays;
}
affichePays();


// --------------------------------------------------
echo '<h2> Structures itérative : Les Boucles </h2>';
// --------------------------------------------------

// Les boucles sont destinées à repeter des lignes de code de façon automatique.

// Boucle while :

$i = 0; // on initialise une variable qui sert de compteur

while($i < 3) { // tant que $i est < 3 nous entrons dans la boucle
    echo $i . '<br>';
    $i++; // on incrémente $i à chaque tour de boucle afin de ne pas avoir une boucle infinie (à 3 la condition étant fausse, on quitte la boucle).
}

// Exercice : à l'aide d'une boucle while, afficher un sélecteur les années dépuis 1920 jusqu'à 2020.

// rappel :
echo '<select>';
    echo '<option>valeur 1</option>';
    echo '<option>valeur 2</option>';
    echo '<option>valeur ....</option>';
echo'</select>';

echo '<br>';
echo '<br>';

$annee = 1920;

echo '<select>';

    while( $annee <= date('Y')) { // date ('Y') retourne l'année en cours (2020) (on peut remplacer par  <= 2020)
        echo '<option>'.$annee.'</option>';
        $annee++;
    }

echo'</select>';

echo '<br>';

//--------------
//La boucle do...while 
// La boucle do while a la particularité de s'executer au moins une fois, puis tant que la condition de fin est vraie.
$j = 0;

do {
    echo 'je fais 1 tour <br>';
    $j++;
} while($j > 10); // la condition est false et pourtant la boucle a tourné 1 fois.

echo '<br>';

//---------
// La boucle for :
// la boucle for est une autre sytaxe de la boucle while.

for($i = 0; $i < 3; $i++) { // nous trouvons dans les () de for : la valeur de départ; la condition d'entrée dans la boucle; la variation de $i 
    echo $i . '<br>';
}

echo '<br>';

// Exercice : afficher les mois 1 à 12 dans un sélectaur à l'aide d'une boucle for.

echo '<p>selection des mois</p>';

echo '<select>';

for($mois = 1; $mois <= 12; $mois++) {
    echo '<option>' . 'Mois : ' . $mois . '</option>' . ' <br>';
}

echo'</select>';

// -----------
// Il existe aussi la boucle foreach que nous verrons un peu plus loin. Elle sert à parcourir les tableaux ou les objets.

// -----------
// Exercice : faite une boucle for qui affiche les chiffres 0 à 9 dans une table HTML sur une seule ligne. Vous faites du CSS dans la balise <style> du début pour mettre une bordure sur ce tableau.

echo '<p>Correction exercice</p>';

$col = 0;

?>
    <style>
    td{
        border: 1px solid;
        width : 30px;
        text-align: center;
    }

    table {
        border-collapse: collapse;
    }
    </style>

<?php 

echo '<table>';
    echo '<tr>';
        for ($col = 0; $col <= 9; $col++) {
            echo '<td>'. $col . '</td>';
        }
    echo '</tr>';
echo '</table>';

echo '<br>';

// exercice : faite une boucle qui affiche de 0 à 9 sur la mme ligne , cette ligne se répétant 10 fois, le tout dans une table HTML.

// correction : principe de la boucle imbriquée :

echo '<table>';

for( $ligne = 0; $ligne < 10; $ligne++){
    echo '<tr>';

        echo '<tr>';
            for ($col = 0; $col <= 9; $col++) { // ici on fait les colonnes
                 echo '<td>'. $col . '</td>';
            }
        echo '</tr>';
      
    echo '</tr>';
}

echo '</table>';


// ----------------------------------------------
echo '<h2> Quelques fonction prédéfinies </h2>';
// ----------------------------------------------

// Une fonction prédéfinie permet de réaliser un traitement spécifique prédeterminé dans le langage PHP.

// strlen
$phrase = 'mettez une phrase ici';

echo strlen($phrase); // affiche le nombre d'octet occupés par ce string, 1 caractère accentué comptant pour 2, les autres pour 1.

echo '<br>';

// substr
$texte = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi ab magnam rem debitis, maiores suscipit non odit sint, veniam recusandae nihil magni fugiat. Similique maiores exercitationem ab ex adipisci. Suscipit!';

echo substr($texte, 0, 20) . '...<a href="">lire la suite</a>'; // coupe le texte de la position 0 et sur 20 caractères. 

echo '<br>';

// strtolower, strtoupper, trim :
$message = '          Hello World !         ';
echo strtolower($message) . '<br>'; // affiche tout en miniscules
echo strtoupper($message) . '<br>'; // affiche tout en majuscules

echo strlen($message) . '<br>'; // on compte la longueur y compris les espaces
echo strlen(trim($message)) . '<br>'; // trim() supprime les espaces au début et à la fin de chaine de caractères. Puis ici on compte le résultat sans les espaces.

// $message = trim($message)

// la documentation PHP en ligne :
// https://www.php.net/


// ----------------------------------------------
echo '<h2> Tableaus (arrays) </h2>';
// ----------------------------------------------

//un tableau ou encore (array) en aglais est déclaré comme une variable améliorée dans laquelle on stoke une multitude de valeurs. Ces valeurs peuvent etre de n'importe quel type et poddède un indices par défaut dont la numérotation commence à 0.

// Utilisation : souvent quand on récupère des information de la BDD, nous les retruovons sous forme de tableau.

// Déclarer un tableau (méthode 1) :

$liste = array('Grégoire', 'Nathalie', 'Emilie', 'François', 'Georges');

echo gettype($liste) .'<br>'; // type array

// echo $liste;  erreur de type "Notice: Array to string conversion in" car on ne peut pas afficher directement un tableau

echo 'var_dump et print_r';

echo '<pre>';
var_dump($liste); // affiche le contenu du tableau avec le type des valeurs
echo '</pre>';

echo '<br>';

echo '<pre>';
print_r($liste); // affiche le contenu du tableau sans le type des valeurs
echo '</pre>'; // la balise <pre> permet de formater l'affichage du print_r ou du var_dump

// déclaration de notre fonction d'affichage :

function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

debug($liste);

// Autre méthode pour déclarer un tableau (méthode 2) :

$tab = ['France', 'Italie', 'Espagne', 'Portugal'];

debug($tab);

echo $tab[1] .'<br>'; // pour afficher "italie" , on écrit le nom du tableau $tab suivi de l'indice de "italie" écrit entre []

// --------
// Ajouter une valeur à la fin de notre tableau $tab :
$tab[] = 'Suisse'; // les crochets [] vide permettent d'ajouter une valeur à la fin du tableau

debug($tab);

//---------
// Tableau associatif :
// Dans un tableau associatif, on peut choisir les indices.

$couleur = array(
    'j' => 'jaune',
    'b' => 'bleu',
    'v' => 'vert'
);

// pour afficher un élément du tableau associatif :

echo 'La seconde couleur de notre tableau est le ' . $couleur['b'] . '<br>'; // affiche "bleu"

echo "la seconde couleur est le $couleur[b] <br>"; // un tableau associatif écrit dans des guillemets perd les quotes autour de son indice

//----------
// Mesurer le nombre d'éléments dans un tableau :

echo 'Taille du tableau :' . count($couleur) . '<br>'; // compte le nombre d'élément dans le tableau, ici 3.

echo 'Taille du tableau :' . sizeof($couleur) . '<br>'; // sizeof() fait la meme chose que count() dont il est un alias.


// ----------------------------------------------
echo '<h2> Boucle foreach </h2>';
// ----------------------------------------------

// foreach est un moyen symple de parcourir un tableau de façon automatique. Cette boucle fonctionne uniquement sur les tableaux et les objets. Elle retourne une erreur si vous utiliser sur une variable d'un autre type ou non initialisée.

debug($tab);

foreach($tab as $pays) { // la variable $pays vient parcourir la colonne valeurs : elle prend chaque valeur successivement à chaque tours de boucle. Le mot "as" est obligatoire et fait partie de la syntaxe.
    echo $pays . '<br>'; // affiche successivement les valeurs du tableau
}

echo '<br>';

foreach($tab as $indice => $pays) { // quand il y a deux variables, celle qui est à gauche de la flèche => parcourt la colonne des indices, et celle de droite parcourt la colonne des valeurs.
    echo $indice . ' correspond à ' . $pays . '<br>'; 
}

echo '<br>';

// ----------
// Exercice :
// Ecrivez un tableau associatif avec les INDICES prenom, nom, email et telephone, auxquel vous associez des valeurs pour 1 contact.

// Puis avec une boucle foreach, afficher les valeurs dans des <p>, sauf le prénom qui doit etre dans un <h3>. 

// correction :


$contact = array(
    'prenom' => 'Pierre',
    'nom' => 'Name',
    'email' => 'Pierre@gmail.com',
    'telephone' => '06 56 84 65 20'
);

echo '<br>';

foreach($contact as $indice1 => $valeur) { 
    if($indice1 == 'prenom') {
        echo '<h3> Bonjour '. $valeur . ' !</h3>'; 
    } else {
        echo '<p>'. $valeur .'</p>'; 
    }
}


// ----------------------------------------------
echo '<h2> Tableau multidimensionnel </h2>';
// ----------------------------------------------

// Nous parlons de tableaux multidimensionnels quand un tableau est contenu dans un autre tableau. Chaque tableau représente une dimension.

// Déclaration d'un tableau multidimensionnel :

$tab_multi = array(
    array(
        'prenom'     => 'Julien',
        'nom '       => 'Dupon',
        'telephone ' => '0625897545',
    ),

    array(
        'prenom'     => 'Nicolas',
        'nom '       => 'Duran',
        'telephone ' => '0789562322',
    ),

    array(
        'prenom'     => 'Pierre',
        'nom '       => 'Dulac',
    ),
); // il est possible de choisir des indices dans un tableau multidimentionnels.

debug($tab_multi);


// afficher la valeur "Julien"

echo $tab_multi[0]['prenom'] . '<br>'; // pour afficher "Julien" nous entrons d'abord dans le tableau $tab_multi, puis nous allons à son indice [0] , dans lequel nous allons à l'indice ['prenom']. (les crochets sont successif)
echo $tab_multi[1]['prenom'] . '<hr>';

//Parcourir le tableau multi avec une boucle for :

for($i = 0; $i < sizeof($tab_multi); $i++) { // tant que $i < inférieur au nombre d'éléments du tableau $tab_multi (ici = 3), on entre dans la boucle
    echo $tab_multi[$i]['prenom'] . '<br>'; // on passe successivement par 0 puis 1 puis 2 pour afficher les 3 prénoms
}

echo '<hr>';

//----------
// Exercice :

// afficher les 3 prénoms avec une boucle foreach.

foreach($tab_multi as $valeur) { 
    // debug($valeur); // on voit que $valeur est un array qui contient l'indice "prénom" . On accède donc aux prénom en mettant cet indice dans des [ ]:
   echo $valeur['prenom'] . '<br>';
}

echo '<hr>';

// autre syntaxe :
foreach($tab_multi as $indice => $contact) { 
    echo $tab_multi[$indice]['prenom'] . '<br>';
}

//-----------
// exercice (option) : vous déclarer un tableau contenant les tailles S, M, L et XL. Puis les afficher dans un menu déroulant (select/option) à l'aide d'une boucle foreach.













// ----------------------------------------------
echo '<h2> Inclusion de fichier </h2>';
// ----------------------------------------------

echo 'Première inclusion :';

include 'exemple.inc.php'; // le fichier est inclus. c'est à dire que son code s'exécute ici. En cas d'erreur lors de l'inclusion include génère une erreur de type "warning" et continue  l'execution du scripte.

echo '<br> Seconde inclusion :';

include_once 'exemple.inc.php'; // le "once" est là pour verifier si le fichier a déjà inclus, auquel cas il ne le ré-inclut pas.

echo'<br> Troixième inclusion : ';
require 'exemple.inc.php'; // le fichier est "requis" donc obligatoire : en cas d'erreur lors de l'inclusion, require génère une erreur de type "fatal error" qui stoppe l'execution du code.

echo '<br> Qatrième inclusion : ';
require_once 'exemple.inc.php'; // le "once" est là pour verifier si le fichier a déjà inclus, auquel cas il ne le ré-inclut pas.

echo '<br>';

echo '<br>' . $inclusion; // comme le fichier exemple.inc.php est inclus, on accède aux éléments qui sont déclarés à l'intérieur de celui-ci, comme les variables, les fonctions .... 

// La mention "inc" dans le nom du fichier précise aux développeur qu'il s'agit d'un fichier d'inclusion, et non pas d'une page entière.

// ----------------------------------------------
echo '<h2> Introduction aux objets </h2>';
// ----------------------------------------------

// Un objet est un autre type de données (object en anglais). Il représente une objet réel ( par ex : voiture, membre, panier d'achat, ....) auquel on peut associer des variables, appelées PROPRIETES, et de fonction appelées METHODES.

// Pour créer des objets, il nous faut un "plan de construction" : c'est le role de la classe.
// Nous créons ici une classe pour faire des objet "meubles" : 

class Meuble { // avec une majuscule

    public $marque = 'ikea'; // $marque est une propriété. "public" précise qu'elle sera accessible partout. 

    public function prix() { // prix est une méthode.
        return rand(50, 200) . ' €';
    }


}

// -------
$table = new Meuble(); // new est un mot clé qui permet d'instancier la classe pour en faire un objet. l'interet est que notre $table béneficie de la propriété "ikea" et de la méthode prix() définis dans la classe.

debug($table); // nous observons le type object, le nom de sa classe "Meuble" et sa propriété "marque". 

echo 'Marque du meuble : ' . $table->marque . '<br>'; // pour accéder à la propriété d'un objet, on écrit cet objet suivi de la flèche -> puis du nom de la propriété sans le $. 

echo 'Prix du meuble : ' . $table->prix() . '</br>'; // pour accéder à la méthode objet, on écrit après la flèche -> à laquelle on ajoute une paire de ( ).

// *******************************************  FIN  *****************************************











