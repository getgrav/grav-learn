---
title: Clear Log
api:
    method: DELETE
    path: /system/logs
    description: 'Empty one of the log files listed by `GET /system/logs/files`. The file is truncated rather than deleted, and one entry recording who cleared it is left in its place. Requires a super admin; demo accounts get 403. Fires `onApiLogCleared`.'
    parameters:
        - name: file
          type: string
          required: false
          description: 'Log file to clear (default `grav.log`). Can be sent in the JSON body or as a `?file=` query parameter.'
    request_example: '{"file": "grav.log"}'
    response_example: '{"data": {"file": "grav.log", "cleared_bytes": 450507, "message": "Log cleared: grav.log"}}'
    response_codes:
        - code: '200'
          description: 'Log cleared, or already empty (`cleared_bytes: 0`)'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Not a super admin, or a demo account'
        - code: '422'
          description: 'Unknown log file, or the file is not writable'
---
