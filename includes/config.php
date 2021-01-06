<?php
//A l'installation du plugin on va faire en sorte qu'une table soit créé dans notre base de données si elle n'existe pas
global $wpdb;
$servername = $wpdb->dbhost;
$username = $wpdb->dbuser;
$password = $wpdb->dbpassword;
$dbname = $wpdb->dbname;
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$sh = $conn->prepare( "DESCRIBE `covidDatas`");
if ( !$sh->execute() ) {
  $sql = "CREATE TABLE covidDatas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(30) NOT NULL,
    nom VARCHAR(30) NOT NULL,
    date VARCHAR(50),
    hospitalises VARCHAR(30),
    reanimation VARCHAR(30),
    nouvellesHospitalisations VARCHAR(30),
    nouvellesReanimations VARCHAR(30),
    deces VARCHAR(30),
    gueris VARCHAR(30)
 )";
    $conn->exec($sql);
    $conn = null;
} 
 //Ajout de lien de notre plugin dans le menu latéral
add_action( 'admin_menu', 'pluginLink' );
 
function pluginLink()
{
      add_menu_page(
        'Covid Tracker - Admin', //Titre de la page
        'Covid Tracker', //Lien devant être affiché dans la barre latérale
        'manage_options', //Obligatoire pour que ca fonctionne
        'covid_tracker_admin', //Le Slug
        'covid_tracker_admin_page'//Le callBack
    );
}
//Maintenant génération de l'intérieur de la page admin quand le slug est appelé
function covid_tracker_admin_page(){
require_once("admin/covid-tracker-admin.php");

}

//Creation d'une page vituelle
add_filter( 'init', function( $template ) {
    if ( isset( $_GET['invoice_id'] ) ) {
        $invoice_id = $_GET['invoice_id'];
        include plugin_dir_path( __FILE__ ) . 'user/view.php';
        die;
    }
} );