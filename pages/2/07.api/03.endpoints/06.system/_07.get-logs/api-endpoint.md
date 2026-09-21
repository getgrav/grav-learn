---
title: Get Logs
api:
    method: GET
    path: /system/logs
    description: 'Read log entries from a log file (default `grav.log`) with pagination, level filtering and text search. Entries are returned newest first. Requires `api.system.read`; demo accounts get 403.'
    parameters:
        - name: file
          type: string
          required: false
          description: 'Log file to read (default `grav.log`). Must be one of the names listed by `GET /system/logs/files`.'
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 1000)'
        - name: level
          type: string
          required: false
          description: 'Filter by log level, case-insensitive (e.g. DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL)'
        - name: search
          type: string
          required: false
          description: 'Case-insensitive text the message must contain'
    request_example: ''
    response_example: '{"data": [{"date": "2026-09-21T10:30:00.123456+00:00", "logger": "grav", "level": "WARNING", "message": "Plugin X deprecated method"}], "meta": {"pagination": {"page": 1, "per_page": 20, "total": 150, "total_pages": 8}}, "links": {"self": "/api/v1/system/logs?page=1&per_page=20", "next": "/api/v1/system/logs?page=2&per_page=20", "last": "/api/v1/system/logs?page=8&per_page=20"}}'
    response_codes:
        - code: '200'
          description: 'Success. A registered log that has not been written yet returns an empty page.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.system.read` permission, or a demo account'
        - code: '422'
          description: 'Unknown log file'
---

