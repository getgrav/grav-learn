---
title: System Info
api:
    method: GET
    path: '/system/info'
    description: 'Rich system information: Grav / PHP versions, loaded extensions, server software, current environment, installed plugins and themes, and a structured PHP configuration summary (uploads, memory, error handling, paths, sessions, OPcache, security, locale). Intended to populate the Admin2 "System Info" / support pages. Requires `api.system.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"grav_version": "2.1.0", "php_version": "8.3.14", "php_extensions": ["Core", "date", "pcre"], "server_software": "Apache/2.4.58", "environment": "localhost", "plugins": [{"name": "API", "version": "1.0.38", "enabled": true}], "themes": [{"name": "Quark", "version": "2.0.4", "active": true}], "php_config": {"Upload & POST": {"file_uploads": "1", "upload_max_filesize": "64M", "max_file_uploads": "20", "post_max_size": "64M"}}}}'
    response_codes:
        - code: '200'
          description: 'Info returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.read` permission.'
---

For demo accounts, `server_software` and the path values in `php_config` (error log, open_basedir, temp dir, document root, include path, session save path) are replaced with `(hidden in demo mode)`.
