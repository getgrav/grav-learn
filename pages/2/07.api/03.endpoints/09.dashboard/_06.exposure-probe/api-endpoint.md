---
title: Storage Exposure Probe
api:
    method: GET
    path: /dashboard/security/exposure-probe
    description: 'Get the probe URLs Admin2 uses to check whether private storage folders can be reached over HTTP. Requires `api.system.read`.'
    parameters: []
    request_example: ''
    response_example: '{"data": {"url": "https://example.com/user/data/grav-security-probe.dat", "token": "3f9c2a7e5b1d4c8a9e0f6b2d7c4a1e8f", "available": true, "probes": [{"location": "user/data", "extension": "dat", "url": "https://example.com/user/data/grav-security-probe.dat", "token": "3f9c2a7e5b1d4c8a9e0f6b2d7c4a1e8f", "available": true}, {"location": "tmp", "extension": "txt", "url": "https://example.com/tmp/grav-security-probe.txt", "token": "8b1e4d7a2c9f0e3b6a5d8c1f4e7b0a2d", "available": true}]}}'
    response_codes:
        - code: '200'
          description: 'Probe list returned.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Missing `api.system.read` permission'
---

For each of `user://data`, `backup://` and `tmp://` that lives inside the web root, the server makes sure a sentinel file `grav-security-probe.{dat,txt,zip,json}` exists, creating it with a random hex token if it is missing (it never overwrites an existing file or follows a symlink), and returns its public URL and token. Admin2 then requests each URL through the site's real web server: if the response body matches the token, that folder and file type are publicly reachable, which usually means the web server isn't applying Grav's deny rules. Several file types are tested because a front proxy may serve some extensions itself.

Folders relocated outside the web root have no public URL and are skipped. The top-level `url`, `token` and `available` fields repeat the first `user://data` probe for older Admin2 builds. Note that this `GET` creates files on first call.
