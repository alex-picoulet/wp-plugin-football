from odoo import models, fields, api
import re
from odoo.exceptions import ValidationError
from datetime import date
from dateutil.relativedelta import relativedelta
from pprint import pprint


class Joueur(models.Model):
    # ---------------------------------------- Private Attributes ---------------------------------
     _name = 'football.joueur'
     _description = 'Description du joueur'
     # --------------------------------------- Fields Declaration ----------------------------------
     nom_complet = fields.Char("Nom complet")
     
     age = fields.Integer(string="Age")

     fin_contrat = fields.Date(string="Fin du contrat")
     
     thumbnail = fields.Binary("Thumbnail")

     poste = fields.Selection([
        ('attaquant', 'Attaquant'),
        ('milieu', 'Milieu'),
        ('defenseur', 'Défenseur'),
        ('gardien', 'Gardien')
     ])
     
     equipe_id = fields.Many2one("football.equipe", string="Equipe")

     

