---
title: News Feed
template: api-endpoint
api:
    method: GET
    path: /dashboard/feed
    description: 'Get the latest news feed from getgrav.org.'
    parameters: []
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

Returns the latest blog posts from the getgrav.org Atom feed. Results are cached and include the 10 most recent articles with title, URL, date, and content snippet.
