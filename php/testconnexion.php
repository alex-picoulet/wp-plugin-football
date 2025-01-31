<?php
    require_once('ripcord/ripcord.php');


    //Connexion
    $url = "http://host.docker.internal:8069";
    $db = "admin";
    $username = "apiwordpress@admin.fr";
    $cleapi = "de1cfdc34a78e1538026fd2deb159f79dccc729e";


//Création du client XML-RPC à l'adresse de l'API qui permet de se connecter
$common = ripcord::client($url."/xmlrpc/2/common");


//Appel de la méthode authenticate qui permet de se connecter à l'API
$uid = $common->authenticate($db, $username, $cleapi, array());


if(!empty($uid)){
    echo "<p>Successfully sign in Odoo API with the user id of : " . $uid . '</p>';


    //Création du client XML-RPC à l'adresse de l'API qui expose les données
    $object = ripcord::client("$url/xmlrpc/2/object");


    //Suppression d'un élément
    $vehicule_id_a_supprimer=[17];        
   
    $positionnal_argument=[
        $vehicule_id_a_supprimer
    ];
   
        //Envoi des données et affichage.
    $donneesrecues = $object->execute_kw($db, $uid, $cleapi, 'rentcars.vehicle', 'unlink', $positionnal_argument);


    echo "<pre>" . print_r($donneesrecues, true) . "</pre>";      
   
    // Suppression de plusieurs éléments
    $vehicule_id_a_modifier=[18,19];     


    $positionnal_argument=[
        $vehicule_id_a_modifier,
    ];


    $donneesrecues = $object->execute_kw($db, $uid, $cleapi, 'rentcars.vehicle', 'unlink', $positionnal_argument);


    //Envoi des données et affichage.
    echo "<pre>" . print_r($donneesrecues, true) . "</pre>";

}else{
    echo "Failed to sign in";
}  

?>
