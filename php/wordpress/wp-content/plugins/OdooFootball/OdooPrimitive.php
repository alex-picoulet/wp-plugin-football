<?php


if (!class_exists('ripcord')) {
    require_once('ripcord/ripcord.php');
}


// paramètres de connexion à Odoo


// on déclare les variables comme globales
global $odoo_url, $odoo_db, $odoo_username, $odoo_apikey;


// on récupère les paramètres de connexion à Odoo depuis les options
$odoo_url = get_option('urlOdoo');
$odoo_db = get_option('dbOdoo'); 


//récupération des paramètres de connexion de l'utilisateur courant
global $current_user;
get_currentuserinfo();


$odoo_username = $current_user->user_email;


// et sans oublier de récupérer la clé d'api de l'utilisateur courant
$odoo_apikey = get_user_meta($current_user->ID, 'odooapikey',true); 


function odooConnect_football() {
    global $odoo_url, $odoo_db, $odoo_username, $odoo_apikey;


    if ($odoo_url == "" || $odoo_db == "" || $odoo_username == "" || $odoo_apikey == "") {
        return "";
    }


    $common = ripcord::client($odoo_url."/xmlrpc/2/common");
    $common->version();
    $uid = $common->authenticate($odoo_db, $odoo_username, $odoo_apikey, array());
    return $uid;
}


function getAllJoueurs() {
    global $odoo_url, $odoo_db, $odoo_username, $odoo_apikey;

    $uid = odooConnect_football();


    if(!empty($uid)){
    
        $models = ripcord::client("$odoo_url/xmlrpc/2/object");
 
         $domain = [];
        
        $kwargs = ['order' => 'nom_complet desc', 'domain' => $domain, 'fields' => ['nom_complet', 'age','fin_contrat', 'thumbnail', 'poste', 'equipe_id']];
        $lesjoueurs = $models->execute_kw($odoo_db, $uid, $odoo_apikey, 'football.joueur', 'search_read', [], $kwargs);
        
        return $lesjoueurs;
    }
    else{
        return false;
    }
}
