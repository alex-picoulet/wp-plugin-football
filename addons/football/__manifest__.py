# -*- coding: utf-8 -*-
{
    'name': "Football",

    'summary': """
        Outil de gestion d'équipe de football""",

    'description': """
        Outil de gestion d'équipe de football
    """,

    'author': "Alexandre PICOULET SONDER",
    'website': "tuto-drupal.fr",

    # for the full list
    'category': 'Inventory/football',
    'version': '18.0',

    # any module necessary for this one to work correctly
    'depends': ['base'],

    'application': True,
    'license': "AGPL-3",
    # always loaded
    'data': [
        'security/football_security.xml',
        'security/ir.model.access.csv',
        'views/joueur_views.xml',
        'views/equipe_views.xml',
        'views/views.xml',
        'views/templates.xml',
        'views/football_menu.xml',
    ],
    # only loaded in demonstration mode
    'demo': [
        'demo/demo.xml',
    ],
}