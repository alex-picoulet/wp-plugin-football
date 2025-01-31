from odoo import models, fields, api
import re
from odoo.exceptions import ValidationError
from datetime import date
from dateutil.relativedelta import relativedelta
from pprint import pprint


class Equipe(models.Model):
    # ---------------------------------------- Private Attributes ---------------------------------
     _name = 'football.equipe'
     _description = 'Description de lEquipe'
     # --------------------------------------- Fields Declaration ----------------------------------
     nom_club = fields.Char("Nom du club")
     
     ligue_des_champions = fields.Integer(string="Nombre de LDC")

     fondation = fields.Date(string="Date de fondation")
     
     thumbnail = fields.Binary("Thumbnail")

     maillots = fields.Selection([
        ('exterieur', 'Extérieur'),
        ('domicile', 'Domicile'),
        ('third', 'Third')
     ])
     
     joueur_ids = fields.One2many("football.joueur","equipe_id",string="Joueur Equipe")