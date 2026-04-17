---
title: Run Scheduler
api:
    method: POST
    path: '/scheduler/run'
    description: 'Manually trigger a scheduler run. When `force` is true, runs every job regardless of its cron expression; otherwise runs only jobs that are currently due. Returns a snapshot of every job''s state after the run.'
    parameters:
        - name: force
          type: boolean
          required: false
          description: 'If true, run all jobs now regardless of schedule. Defaults to false.'
    request_example: '{"force": true}'
    response_example: '{"data": {"message": "Scheduler run completed.", "forced": true, "job_states": {"cache-purge": {"state": "success", "last-run": 1713355200}}}}'
    response_codes:
        - code: '200'
          description: 'Run completed.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.scheduler.write` permission.'
---
