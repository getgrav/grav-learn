---
title: Run Scheduler
api:
    method: POST
    path: '/scheduler/run'
    description: 'Run scheduler jobs now, without waiting for cron. By default (`mode: overdue`) it runs every enabled job that missed the last slot its schedule gave it, which is what a manual trigger almost always wants: a job is only "due" during the exact minute its cron expression names. Runs started this way are recorded as manual and never count as evidence that cron is set up. Returns a summary, per-job results, and every job''s state after the run. For demo accounts each job''s `output` is replaced with `(hidden in demo mode)`.'
    parameters:
        - name: mode
          type: string
          required: false
          description: '`overdue` (default) runs the jobs that missed their last scheduled slot, `due` runs only what a cron tick this minute would run, `all` runs every enabled job whatever its schedule says.'
        - name: job
          type: string
          required: false
          description: 'Run only this job id, whatever its schedule says. Ignores `mode`, and the response reports `mode: job`.'
        - name: force
          type: boolean
          required: false
          description: 'Legacy alias for `mode: all`.'
    request_example: '{"mode": "overdue"}'
    response_example: '{"data": {"message": "1 job ran successfully.", "mode": "overdue", "forced": false, "jobs_run": 1, "jobs_failed": 0, "duration": 1.42, "results": [{"id": "default-site-backup", "successful": true, "output": ""}], "job_states": {"default-site-backup": {"state": "success", "last-run": 1790000000, "trigger": "manual"}}}}'
    response_codes:
        - code: '200'
          description: 'Run completed. `jobs_run` is 0 (with the message `Nothing to run: no jobs were due.`) when nothing matched.'
        - code: '400'
          description: 'Unknown `mode`.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.scheduler.write` permission.'
        - code: '404'
          description: 'No job with the requested `job` id.'
        - code: '409'
          description: 'The requested job is disabled.'
        - code: '501'
          description: 'Running jobs is not available because PHP''s `proc_open` is disabled on the host.'
---
