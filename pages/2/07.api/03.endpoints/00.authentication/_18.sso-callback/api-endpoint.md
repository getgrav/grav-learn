---
title: SSO Callback
api:
    method: GET
    path: '/auth/sso/{provider}/callback'
    description: 'The provider redirects the browser here. The plugin that answers `onApiLoginCallback` validates the response and resolves a Grav user; the same API-access, account-state and 2FA checks as `POST /auth/token` then run. The resulting token pair or 2FA challenge is stored under a single-use code (valid for 120 seconds) and the browser is redirected to `<admin>/oauth-callback?code=<code>` (plus `&returnTo=<path>` when one was given), where the admin trades it with `POST /auth/sso/exchange`. On failure the browser goes to `<admin>/login?sso_error=<code>` with `sso_failed`, `sso_forbidden` (no API access or account disabled), or a provider-specific code. Public (no auth required).'
    parameters:
        - name: provider
          type: string
          required: true
          description: 'Provider id (path parameter).'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '302'
          description: 'Redirect back into the admin, carrying either a one-time exchange code or an `sso_error`.'
---
