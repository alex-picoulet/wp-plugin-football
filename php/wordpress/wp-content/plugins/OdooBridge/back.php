<?php

function administration_add_admin_page() {
    add_submenu_page(
       'options-general.php',
       'Options OdooBridge',
       'Options OdooBridge',
       'manage_options',
       'administration',
       'administration_page'
    );
}
function administration_page() {
 
    if (isset($_POST['submit'])) {
        //on enregistre le parametre d'url si il est renseigné
        if (isset($_POST['urlOdoo'])) 
            update_option('urlOdoo', $_POST['urlOdoo']);
        //on enregistre le parametre de base de données si il est renseigné
        if (isset($_POST['dbOdoo'])) 
            update_option('dbOdoo', $_POST['dbOdoo']);                        
     } 
     $db_actuel = get_option('dbOdoo');
     $url_actuel = get_option('urlOdoo');
     ?>
     <div class="wrap OdooBridge OdooBridgeBack">
        <h1>Mes options OdooBridge</h1>
        <form method="post" action="">
            <label for="dbOdoo">Saisissez le nom de la base Odoo (ex: odoo_v16) : </label>
            <input class="input" id="dbOdoo" name="dbOdoo" value="<?php echo $db_actuel; ?>">
            <br/><label for="urlOdoo">Saisissez l'url d'Odoo (ex: http://web:8069): </label>
            <input id="urlOdoo" name="urlOdoo" value="<?php echo $url_actuel; ?>">
            <br/><input type="submit" name="submit" class="button button-primary" value="Enregistrer" />
        </form>
     </div>
     <?php
}
   add_action('admin_menu', 'administration_add_admin_page');


   function add_custom_user_profile_apikey($user) {
    printf(
    '
<h3>%1$s</h3>
<table class="form-table">
<tr>
<th><label for="odooapikey">%2$s</label></th>
<td>
  <input type="text" name="odooapikey" id="odooapikey" value="%3$s" class="regular-text" />
  <br /><span class="description">%4$s</span>
</td>
</tr>
</table>
',      __('Extra Profile Information', 'locale'),
        __('Odoo API key', 'locale'),
        esc_attr(get_user_meta($user->ID, 'odooapikey', true)),
        __('Start typing API key', 'locale')
    );
}


function save_custom_user_profile_apikey($user_id) {
    if (!current_user_can('edit_user', $user_id))
        return FALSE;


    $odooapikey = ( isset($_POST['odooapikey']) ) ? $_POST['odooapikey'] : '';


    // human readable value and id
    update_user_meta($user_id, 'odooapikey', $odooapikey);
}

// for account owner
add_action('show_user_profile', 'add_custom_user_profile_apikey');
add_action('personal_options_update', 'save_custom_user_profile_apikey');


// for admins
add_action('edit_user_profile', 'add_custom_user_profile_apikey');
add_action('edit_user_profile_update', 'save_custom_user_profile_apikey');


//Interception du formulaire de réservation
function traitement_formulaire_reservation($url) {
    if ( ! isset( $_POST['reservation_OdooBridge'] ) || ! isset( $_POST['reservation_OdooBridge-verif'] ) )  {
        // si le nonce n'est pas présent ou que ce n'est pas le formulaire qu'on attend, on ne fait rien
        return;
    }


    if ( ! wp_verify_nonce( $_POST['reservation_OdooBridge-verif'], 'reserverVoiture') ) {
        // si le nonce n'est pas vérifié on ne traite pas les données soumises, on ne fait rien
        return;
    }


    // On est bon : le formulaire a été soumis et le nonce est correct, on peut traiter les données
	
	// On nettoie les variables POST pour éviter les injections de JS, de commandes et les injections SQL avant envoi


    $od_vehicule_id = sanitize_text_field($_POST['vehicule_id']);
    $od_date_reservation = sanitize_text_field($_POST['date_reservation']);
    $od_duree_reservation = sanitize_text_field($_POST['duree_reservation']);


    $resultat = addReservation($od_vehicule_id,$od_date_reservation,$od_duree_reservation);


    // on renvoie vers la suite de la page
    wp_safe_redirect('odooreservation/');
    exit();
}


// On se raccroche à l'action template_redirect pour intercepter le formulaire au rechargement d'une page
add_action( 'template_redirect', 'traitement_formulaire_reservation' );