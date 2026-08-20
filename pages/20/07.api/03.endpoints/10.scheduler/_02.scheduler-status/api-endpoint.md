---
title: Scheduler Status
api:
    method: GET
    path: '/scheduler/status'
    description: 'Report the scheduler''s crontab installation state, the cron + scheduler commands Grav would expect, the effective user (`whoami`), health diagnostics, and whether the optional scheduler-webhook plugin is installed/enabled. Drives the "is cron set up?" panel on the Admin2 dashboard.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"crontab_status": "installed", "cron_detection": "crontab", "process_available": true, "last_run": "2026-08-20T12:00:00+00:00", "environment": "www.example.com", "environment_has_overrides": true, "last_run_environment": "cli", "cron_command": "* * * * * cd /path/to/grav && /usr/bin/php bin/grav scheduler", "scheduler_command": "bin/grav scheduler", "whoami": "www-data", "health": {}, "triggers": [], "webhook_installed": false, "webhook_enabled": false}}'
    response_codes:
        - code: '200'
          description: 'Status returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.scheduler.read` permission.'
---

`crontab_status` is one of: `not_installed`, `installed`, `error`, `unknown`.

`environment` is the environment this request resolved to (normally the hostname), `environment_has_overrides` says whether it has its own `user/env/<name>/config` folder, and `last_run_environment` is the environment the scheduler last actually ran under (`cli` for a crontab line that does not pass `--env`). When the last two disagree and overrides exist, jobs defined only in the override never run from that trigger; `scheduler_command` already carries the `--env` flag to fix the crontab line.
