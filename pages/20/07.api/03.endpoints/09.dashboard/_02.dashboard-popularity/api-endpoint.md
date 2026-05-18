---
title: Page View Statistics
api:
    method: GET
    path: /dashboard/popularity
    description: 'Get page view statistics from the admin popularity tracker.'
    parameters: []
    request_example: ''
    response_example: ''
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
---

Returns page view statistics including daily chart data for the last 14 days, summary counters (today, this week, this month), and top 10 pages by total views. Data is sourced from the admin plugin's popularity tracker log files.
