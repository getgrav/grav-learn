---
title: SSO Providers
api:
    method: GET
    path: '/auth/sso/providers'
    description: 'Return the single sign-on buttons to show on the login screen, collected from every plugin that answers the `onApiLoginProviders` event (for example Login OAuth2). An empty list means password login only. Public (no auth required).'
    parameters: []
    request_example: ''
    response_example: '{"data": {"providers": [{"id": "github", "label": "GitHub", "icon": "fa-github", "plugin": "login-oauth2"}]}}'
    response_codes:
        - code: '200'
          description: 'Providers returned (possibly an empty list).'
---
