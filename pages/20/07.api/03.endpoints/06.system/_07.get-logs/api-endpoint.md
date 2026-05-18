---
title: Get Logs
api:
    method: GET
    path: /system/logs
    description: 'Read system log entries from grav.log with pagination and optional level filtering. Entries are returned in reverse chronological order.'
    parameters:
        - name: page
          type: integer
          required: false
          description: 'Page number for pagination (default: 1)'
        - name: per_page
          type: integer
          required: false
          description: 'Number of results per page (default: 20, max: 100)'
        - name: level
          type: string
          required: false
          description: 'Filter by log level (e.g. DEBUG, INFO, WARNING, ERROR, CRITICAL)'
    request_example: ''
    response_example: '{"data": [{"date": "2025-03-15 10:30:00", "logger": "grav", "level": "WARNING", "message": "Plugin X deprecated method"}], "meta": {"total": 150, "page": 1, "per_page": 20}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

