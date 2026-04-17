---
title: Scheduler Status
api:
    method: GET
    path: '/scheduler/status'
    description: 'Report the scheduler''s crontab installation state, the cron + scheduler commands Grav would expect, the effective user (`whoami`), health diagnostics, and whether the optional scheduler-webhook plugin is installed/enabled. Drives the "is cron set up?" panel on the Admin2 dashboard.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"crontab_status": "installed", "cron_command": "* * * * * cd /path/to/grav && /usr/bin/php bin/grav scheduler", "scheduler_command": "bin/grav scheduler", "whoami": "www-data", "health": {}, "triggers": [], "webhook_installed": false, "webhook_enabled": false}}'
    response_codes:
        - code: '200'
          description: 'Status returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.scheduler.read` permission.'
---

`crontab_status` is one of: `not_installed`, `installed`, `error`, `unknown`.
