# -*- coding: utf-8 -*-
# from odoo import http


# class Football(http.Controller):
#     @http.route('/football/football', auth='public')
#     def index(self, **kw):
#         return "Hello, world"

#     @http.route('/football/football/objects', auth='public')
#     def list(self, **kw):
#         return http.request.render('football.listing', {
#             'root': '/football/football',
#             'objects': http.request.env['football.football'].search([]),
#         })

#     @http.route('/football/football/objects/<model("football.football"):obj>', auth='public')
#     def object(self, obj, **kw):
#         return http.request.render('football.object', {
#             'object': obj
#         })

