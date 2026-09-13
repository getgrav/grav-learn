---
title: Job History
api:
    method: GET
    path: '/scheduler/history'
    description: 'Paginated job execution history sorted by most recent first. Each record has the job id, last status (`success`/`failure`/`pending`/`unknown`), last run ISO-8601 timestamp, and any error message captured on failure.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number (default 1).'
        - name: per_page
          type: integer
          required: false
          description: 'Items per page.'
    request_example: ''
    response_example: '{"data": [{"job_id": "cache-purge", "status": "success", "last_run": "2026-04-17T04:00:00+00:00", "error": null}], "meta": {"total": 12, "page": 1, "per_page": 50}}'
    response_codes:
        - code: '200'
          description: 'History returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.scheduler.read` permission.'
---
