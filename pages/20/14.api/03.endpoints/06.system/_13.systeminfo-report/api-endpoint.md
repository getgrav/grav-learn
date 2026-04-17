---
title: System Info Report
api:
    method: GET
    path: '/systeminfo'
    description: 'Generate a compact, self-contained system report aggregating PHP info (version, SAPI, extensions, memory/upload limits), Grav version, and disk free/total space. Lighter than `/system/info` — intended for the dashboard "System Status" widget rather than the full Admin2 System Info page.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"php": {"version": "8.3.2", "sapi": "fpm-fcgi", "extensions": ["Core", "date"], "memory_limit": "256M", "max_execution_time": "60", "upload_max_filesize": "64M", "post_max_size": "64M"}, "grav": {"version": "2.0.0-beta.1", "php_version": "8.3.2"}, "disk": {"free_space": 10737418240, "total_space": 53687091200}}}'
    response_codes:
        - code: '200'
          description: 'Report returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.read` permission.'
---
