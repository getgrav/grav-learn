---
title: List Scheduler Jobs
api:
    method: GET
    path: '/scheduler/jobs'
    description: 'List every registered scheduler job (both plugin-registered and system jobs like cache-purge, cache-clear, backups). Each job includes its cron expression, enabled flag, last-run timestamp, status, and any error from the last run. Fires `onSchedulerInitialized` so system jobs show up even if no one has touched the scheduler yet this request.'
    parameters: []
    request_example: ''
    response_example: '{"data": [{"id": "cache-purge", "command": "bin/grav cache --purge", "expression": "0 4 * * *", "enabled": true, "status": "success", "last_run": "2026-04-17T04:00:00+00:00", "error": null}]}'
    response_codes:
        - code: '200'
          description: 'Jobs returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.scheduler.read` permission.'
---
