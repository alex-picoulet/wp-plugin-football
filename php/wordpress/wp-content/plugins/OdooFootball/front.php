<?php
require_once('OdooPrimitive.php');


function listeJoueurs($content) {
    if (is_page('odoofootball')) {
      $moncontenu = '
          <div class="OdooFootball">
              <div class="OdooContent">
      ';
  
  
      if ($alljoueurs = getAllJoueurs()) {
          $moncontenu .= '
              <h2>Liste des joueurs</h2>
              <div class="liste">
          ';
          
          
          foreach ($alljoueurs as $joueur) {
              $moncontenu .= '
  <p class="nom_complet">'. $joueur["nom_complet"] . '</p>        
        <p class="age">age : ' . $joueur["age"] . '</p>
           <p class="fin_contrat">fin_contrat : ' . date("d-m-Y", strtotime($joueur["fin_contrat"])) . '</p>
             <p class="poste">'. $joueur["poste"] . '</p>        

              ';
          }
      }
      else {
          $moncontenu .= "<p>Erreur de connexion à Odoo. Vérifier vos identifiants de connexion (email et cle api) dans votre profil , et les paramétrages de BD dans la page d'options du plugin</p>";
      }
  
  
      $moncontenu .= '
      </div>
      ';
  
  
      return $moncontenu;
    }
    else 
      return $content;
  }
  
  
  // On remplace le contenu de la page par ce que produit notre fonction notre fonction
  add_filter( 'the_content', 'listeJoueurs' );
  
  