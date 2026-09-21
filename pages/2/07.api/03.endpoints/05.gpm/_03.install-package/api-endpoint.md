---
title: Install Package
api:
    method: POST
    path: /gpm/install
    description: 'Install a plugin or theme from the GPM repository, along with any dependencies it needs. Requires `api.gpm.write`. Fires `onApiBeforePackageInstall` and `onApiPackageInstalled`.'
    parameters:
        - name: package
          type: string
          required: true
          description: 'Package slug to install'
        - name: type
          type: string
          required: false
          description: 'Package type: `plugin` (default) or `theme`'
        - name: license
          type: string
          required: false
          description: 'Licence key for a premium package. It is saved only when the slug names a real package, and removed again if the install fails.'
    request_example: '{"package": "sitemap", "type": "plugin"}'
    response_example: '{"data": {"message": "Plugin ''sitemap'' installed successfully.", "package": "sitemap", "type": "plugin", "dependencies": []}}'
    response_codes:
        - code: '201'
          description: 'Package installed. `dependencies` lists any dependencies that were installed or updated along with it.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.gpm.write` permission'
        - code: '422'
          description: 'Validation error (invalid type, already installed, malformed licence key, premium package without a licence, or dependency/requirement check failed)'
        - code: '500'
          description: 'Installation failed. The message names any dependencies that were installed before the failure.'
---

