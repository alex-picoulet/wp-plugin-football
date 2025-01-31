<?php

function administration_add_admin_page_football() {
    add_submenu_page(
       'options-general.php',
       'Options OdooFootball',
       'Options OdooFootball',
       'manage_options',
       'administration_odoofootball',
       'administration_page_football'
    );
}

function administration_page_football() {
 
    if (isset($_POST['submit'])) {
        // Enregistrer les paramètres en utilisant des clés uniques pour OdooFootball
        if (isset($_POST['urlOdoo'])) 
            update_option('urlOdooFootball', $_POST['urlOdoo']);
        if (isset($_POST['dbOdoo'])) 
            update_option('dbOdooFootball', $_POST['dbOdoo']);                        
    } 

    // Récupérer les options spécifiques à OdooFootball
    $db_actuel = get_option('dbOdooFootball');
    $url_actuel = get_option('urlOdooFootball');

    ?>
    <div class="wrap OdooFootball OdooFootballBack">
        <h1>Mes options OdooFootball</h1>
        <form method="post" action="">
            <label for="dbOdoo">Saisissez le nom de la base Odoo (ex: odoo_v16) : </label>
            <input class="input" id="dbOdoo" name="dbOdoo" value="<?php echo esc_attr($db_actuel); ?>">
            <br/>
            <label for="urlOdoo">Saisissez l'url d'Odoo (ex: http://web:8069): </label>
            <input id="urlOdoo" name="urlOdoo" value="<?php echo esc_attr($url_actuel); ?>">
            <br/>
            <input type="submit" name="submit" class="button button-primary" value="Enregistrer" />
        </form>
    </div>
    <?php
}

// Ajouter la page au menu d'administration
add_action('admin_menu', 'administration_add_admin_page_football');



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
