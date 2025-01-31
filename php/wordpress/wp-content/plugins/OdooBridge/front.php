<?php
require_once('OdooPrimitive.php');

// Le paramètre content est automatiquement ajouté par le filtre the_content
function listeVehiculesDispo($content) {
    if (is_page('odooreservation')) {
      $moncontenu = '
          <div class="OdooBridge">
              <div class="OdooContent">
      ';
  
  
      if ($allvehicules = getAllVehicules()) {
          $moncontenu .= '
              <h2>Liste des véhicules disponibles à l\'IUT</h2>
              <div class="liste">
          ';
          
          // On parcourt le tableau des véhicules pour afficher chaque d'entre eux sous la forme d'une "carte"
          foreach ($allvehicules as $vehicule) {
              if ($vehicule["thumbnail"] == "")
                  //replace with default image
                  $vehicule["thumbnail"] = plugin_dir_url(__FILE__) . "/assets/images/placeholder.png";
              else 
                  $vehicule["thumbnail"] = "data:image/png;base64," . $vehicule["thumbnail"];
  
  
              $moncontenu .= '
                  <div class="card">
                      <form action="" method="post">
                      ' . wp_nonce_field( 'reserverVoiture', 'reservation_OdooBridge-verif' ,true,false) . '        
                          <div class="cardContent">
                              <img class="thumb" src="' . $vehicule["thumbnail"] . '" alt="Image du véhicule">
                              <div class="formulaire">
                                  <p class="model">'. $vehicule["model"] . '</p>        
                                  <p class="immat">Immatriculation : ' . $vehicule["immatriculation"] . '</p>
                                  <p class="date">Date d\'achat : ' . date("d-m-Y", strtotime($vehicule["date_purchased"])) . '</p>
                                  <p class="state">Lieu : ' . $vehicule["garage_id"][1] . '</p>
                                  <input type="hidden" name="vehicule_id" value="' . $vehicule["id"] . '">
                                  <div class="date_reservation">
                                      <label for="date_reservation">Date de réservation :</label><br/>
                                      <input type="date" name="date_reservation" id="date_reservation" required><br/>
                                  </div>
                                  <div class="duree_reservation">
                                      <label for="duree_reservation">Durée de réservation :</label><br/>
                                      <input type="number" name="duree_reservation" id="duree_reservation" required>
                                  </div>
                                  <input type="submit" name="reservation_OdooBridge" value="Réserver">
                              </div>
                          </div>
                      </form>
                  </div>
              ';
          }
  
  
          $moncontenu .= '
              </div>
          ';
      }
      else {
  
  
          if (is_user_logged_in()) {
              $moncontenu .= "<p>Erreur de connexion à Odoo. Vérifier vos identifiants de connexion (email et cle api) dans votre profil , et les paramétrages de BD dans la page d'options du plugin</p>";    
          }
          else {
              $moncontenu .= "<p>Vous devez être connecté pour consulter cette page !</p>";
          }
      }
      $moncontenu .= '
              </form>
          </div>
      </div>
      ';
  
  
      return $moncontenu;
    }
    else {
      return $content;
    }
  }
  


// On remplace le contenu de la page par ce que produit notre fonction notre fonction
add_filter( 'the_content', 'listeVehiculesDispo' );

function odoo_bridge_enqueue_styles() {
    wp_enqueue_style('odoobridge-style', plugin_dir_url(__FILE__) . 'assets/css/odoostyle.css');
}
add_action('wp_enqueue_scripts', 'odoo_bridge_enqueue_styles');
