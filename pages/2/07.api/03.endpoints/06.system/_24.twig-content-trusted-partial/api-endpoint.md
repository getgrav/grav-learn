---
title: Trust a Twig Partial
api:
    method: POST
    path: /reports/twig-content/trusted-partial
    description: 'Add a theme or plugin template that page content includes to `security.twig_sandbox.trusted_partials`, saved in `user/config/security.yaml`. This is the fix for a page whose include of a partial shows its Twig as plain text since Grav 2.2.18. Requires Grav 2.2.18 or later and a super admin (an API key needs `admin.super` in its scopes). Added in API 1.1.9.'
    parameters:
        - name: template
          type: string
          required: true
          description: 'The template name exactly as the page''s `{% include %}` writes it, such as `partials/teams.html.twig`. It must be a relative `.twig` path.'
    request_example: '{"template": "partials/teams.html.twig"}'
    response_example: '{"data": {"key": "trusted_partials", "template": "partials/teams.html.twig", "value": ["partials/teams.html.twig"]}}'
    response_codes:
        - code: '200'
          description: 'Template added (or already present) and saved'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Not a super admin'
        - code: '422'
          description: 'Missing or invalid template name, or Grav older than 2.2.18'
---

`value` is the site's full `trusted_partials` list. Grav's built-in entries, which cover the Form plugin's templates, are added to it in code. Fires `onApiConfigUpdated` with scope `security`.

The Twig in Content report (`GET /reports`) offers the name to send: a block that happened inside a theme or plugin template the page's content includes carries it as `partial`, and its `allowlist` is null. Blocks from a partial the site has since trusted are left out of the report. See [Troubleshooting Twig in Content](/2/content/twig-in-content-troubleshooting) for when trusting a partial is safe.
