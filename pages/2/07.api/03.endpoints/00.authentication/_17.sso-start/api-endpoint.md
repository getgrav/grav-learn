---
title: Start SSO Login
api:
    method: GET
    path: '/auth/sso/{provider}/start'
    description: 'Browser navigation, not an XHR call. Stores the admin''s return target in the PHP session, then redirects to the provider''s authorization URL built by the plugin that answers `onApiLoginStart` (that plugin keeps its own CSRF state in the same session). When no plugin handles the provider, redirects back to the admin''s `/login?sso_error=<code>` instead (default `sso_unavailable`). This route keeps its session cookie so the callback can read the state back. Public (no auth required).'
    parameters:
        - name: provider
          type: string
          required: true
          description: 'Provider id from `GET /auth/sso/providers` (path parameter).'
        - name: returnTo
          type: string
          required: false
          description: 'In-app path to land on after login (query parameter). Only a root-relative path is kept; absolute URLs, `//host` and control characters are dropped.'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '302'
          description: 'Redirect to the provider, or to the admin login screen with an `sso_error` query parameter.'
---
