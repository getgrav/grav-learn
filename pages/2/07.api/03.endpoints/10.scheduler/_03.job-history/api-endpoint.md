---
title: Job History
api:
    method: GET
    path: '/scheduler/history'
    description: 'Paginated job execution history sorted by most recent first. Only the latest run of each job is kept, so this lists one entry per job that has run, not every past run. Each record has the job id, its last status (`unknown` if none was recorded), the last run as an ISO-8601 timestamp, and any error message captured on failure.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number (default 1).'
        - name: per_page
          type: integer
          required: false
          description: 'Items per page (default `plugins.api.pagination.default_per_page`, 20).'
    request_example: ''
    response_example: '{"data": [{"job_id": "default-site-backup", "status": "success", "last_run": "2026-03-26T03:00:00+00:00", "error": null}], "meta": {"pagination": {"page": 1, "per_page": 20, "total": 12, "total_pages": 1}}, "links": {"self": "/api/v1/scheduler/history?page=1&per_page=20"}}'
    response_codes:
        - code: '200'
          description: 'History returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.scheduler.read` permission.'
---
