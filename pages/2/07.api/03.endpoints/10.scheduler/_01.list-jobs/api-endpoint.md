---
title: List Scheduler Jobs
api:
    method: GET
    path: '/scheduler/jobs'
    description: 'List every registered scheduler job (both plugin-registered and system jobs like cache-purge, cache-clear, backups). Each job includes its cron expression, enabled flag, status (`pending` until it has run), last-run timestamp and what triggered it (`cron`, `webhook`, `manual` and so on), the next scheduled run, whether it is `overdue` (missed its last scheduled slot), and any error from the last run. A job defined as a closure reports its `command` as `(closure)`. Fires `onSchedulerInitialized` so system jobs show up even if no one has touched the scheduler yet this request.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "default-site-backup", "command": "Grav\\Common\\Backup\\Backups::backup", "expression": "0 3 * * *", "enabled": true, "status": "success", "last_run": "2026-03-26T03:00:00+00:00", "last_run_trigger": "cron", "next_run": "2026-03-27T03:00:00+00:00", "overdue": false, "error": null}]}'
    response_codes:
        - code: '200'
          description: 'Jobs returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.scheduler.read` permission.'
---
