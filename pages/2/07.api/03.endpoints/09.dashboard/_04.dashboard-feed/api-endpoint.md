---
title: News Feed
api:
    method: GET
    path: /dashboard/feed
    description: 'Get the latest news feed from getgrav.org. Requires `api.system.read`.'
    parameters:
        - name: force
          type: boolean
          required: false
          description: 'Bypass the cached feed and refetch.'
    request_example: ''
    response_example: '{"data": {"feed": [{"title": "Grav 2.1 Released", "url": "https://getgrav.org/blog/grav-2-1-released", "date": "2026-09-11T12:00:00+00:00", "summary": ""}], "last_checked": "2026-09-21T08:00:00+00:00"}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.system.read` permission'
---

Returns the latest blog posts from the getgrav.org Atom feed: up to 10 of the most recent articles, each with `title`, `url`, `date` and `summary`, plus a `last_checked` timestamp. The feed is cached per user for `system.session.timeout` seconds, and a failed fetch silently returns the cached copy.
