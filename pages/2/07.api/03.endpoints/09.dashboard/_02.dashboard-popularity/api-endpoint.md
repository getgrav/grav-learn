---
title: Page View Statistics
api:
    method: GET
    path: /dashboard/popularity
    description: 'Get page view statistics from the API popularity tracker. Requires `api.system.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"summary": {"today": 34, "week": 212, "month": 804}, "chart": [{"date": "Sep 8", "views": 25}, {"date": "Sep 9", "views": 31}], "top_pages": [{"route": "/blog", "views": 1204}, {"route": "/", "views": 980}]}}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.system.read` permission'
---

Returns page view statistics including daily chart data for the last 14 days (oldest first, with `M j` date labels), summary counters (today, the last 7 days, this calendar month), and the top 10 pages by total views. Data comes from the API plugin's own popularity store (`plugins.api.popularity`); on the first read after an upgrade from the classic admin, its older popularity files are imported automatically.
