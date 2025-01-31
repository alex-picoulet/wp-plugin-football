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


function odooConnect() {
    global $odoo_url, $odoo_db, $odoo_username, $odoo_apikey;


    if ($odoo_url == "" || $odoo_db == "" || $odoo_username == "" || $odoo_apikey == "") {
        return "";
    }


    $common = ripcord::client($odoo_url."/xmlrpc/2/common");
    $common->version();
    $uid = $common->authenticate($odoo_db, $odoo_username, $odoo_apikey, array());
    return $uid;
}


function getAllVehicules() {
    global $odoo_url, $odoo_db, $odoo_username, $odoo_apikey;


    $uid = odooConnect();


    if(!empty($uid)){
    
        $models = ripcord::client("$odoo_url/xmlrpc/2/object");
 
         $domain = [];
        
        $kwargs = ['order' => 'model desc', 'domain' => $domain, 'fields' => ['model', 'immatriculation','garage_id', 'thumbnail', 'date_purchased', 'state']];
        $lesvehicules = $models->execute_kw($odoo_db, $uid, $odoo_apikey, 'rentcars.vehicle', 'search_read', [], $kwargs);
        
        return $lesvehicules;
    }
    else{
        return false;
    }
}

function addReservation($vehicule_id,$date_reservation,$duree_reservation) {
    global $odoo_url, $odoo_db, $odoo_apikey;


    $uid = odooConnect();


    if(!empty($uid)){   


        $models = ripcord::client("$odoo_url/xmlrpc/2/object");
 
        $book1=[
            'date_start' => $date_reservation,
            'date_delay' => $duree_reservation,
            'vehicle_id'=> $vehicule_id,
            'user_id'=> $uid
        ];
       
        //Création du tableau d'enregistrement
        $vals_list=[$book1];


        //Création du tableau des arguments positionnels
        $positionnal_argument =[
            $vals_list
        ];


        //Envoi des données et affichage.
        $donneesrecues = $models->execute_kw($odoo_db, $uid, $odoo_apikey, 'rentcars.booking', 'create', $positionnal_argument);


        return $donneesrecues;
    }
    else{
        return false;
    }
}
