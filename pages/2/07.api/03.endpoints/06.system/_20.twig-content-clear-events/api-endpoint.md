---
title: Clear Twig Content Events
api:
    method: DELETE
    path: /reports/twig-content/events
    description: 'Empty the list of recently blocked or blanked content-Twig tokens that the Twig in Content report and the page editor banner read. `logs/security.log` is not touched. Requires `api.system.write`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"cleared": true}}'
    response_codes:
        - code: '200'
          description: 'Cleared. `cleared` is false only if the stored list could not be deleted.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.system.write` permission'
---
