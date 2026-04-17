---
title: System Info
api:
    method: GET
    path: '/system/info'
    description: 'Rich system information: Grav / PHP versions, loaded extensions, server software, current environment, installed plugins and themes, and a structured PHP configuration summary (uploads, memory, error handling, sessions, OPcache, security, locale). Intended to populate the Admin2 "System Info" / support pages.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"grav_version": "2.0.0-beta.1", "php_version": "8.3.2", "php_extensions": ["Core", "date", "pcre"], "server_software": "Apache/2.4.58", "environment": "localhost", "plugins": [...], "themes": [...], "php_config": {"Upload & POST": {"file_uploads": "On", "upload_max_filesize": "64M"}}}}'
    response_codes:
        - code: '200'
          description: 'Info returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.read` permission.'
---
