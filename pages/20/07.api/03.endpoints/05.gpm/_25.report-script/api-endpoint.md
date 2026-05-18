---
title: Get Report Script
api:
    method: GET
    path: '/gpm/plugins/{slug}/report-script/{reportId}'
    description: 'Serve the web component for a custom report shown on the Admin2 Reports page. Plugins ship the file at `admin-next/reports/{reportId}.js` and register the report via the `onApiGenerateReports` event. Admin2 loads the script only when the matching report is rendered.'
    parameters:
        - name: slug
          type: string
          required: true
          description: 'Plugin slug.'
        - name: reportId
          type: string
          required: true
          description: 'Report identifier (matches the `id` from `onApiGenerateReports`).'
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'JavaScript file served.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.read` permission.'
        - code: '404'
          description: 'Report component not found.'
---
