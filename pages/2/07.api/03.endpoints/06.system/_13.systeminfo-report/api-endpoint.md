---
title: System Info Report
api:
    method: GET
    path: '/systeminfo'
    description: 'Generate a compact system report: PHP info (version, SAPI, extensions, memory/upload limits), Grav version, disk free/total space, plugin counts and cache status. Lighter than `/system/info`, and intended for the dashboard "System Health" widget rather than the full Admin2 System Info page. Requires `api.system.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"php": {"version": "8.3.14", "sapi": "fpm-fcgi", "extensions": ["Core", "date"], "memory_limit": "256M", "max_execution_time": "60", "upload_max_filesize": "64M", "post_max_size": "64M"}, "grav": {"version": "2.1.0", "php_version": "8.3.14"}, "disk": {"free_space": 10737418240, "total_space": 53687091200}, "plugins": {"total": 30, "enabled": 24, "disabled": 6}, "cache": {"enabled": true, "driver": "auto"}}}'
    response_codes:
        - code: '200'
          description: 'Report returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.system.read` permission.'
---

`disk.free_space` and `disk.total_space` are in bytes, or `false` when PHP cannot read them.
