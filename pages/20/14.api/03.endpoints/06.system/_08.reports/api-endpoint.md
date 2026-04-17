---
title: Reports
api:
    method: GET
    path: /reports
    description: 'Get plugin-extensible diagnostic reports. Built-in reports include a Security Check (XSS scan) and YAML Linter. Plugins can add their own reports via the onApiGenerateReports event.'
    parameters: []
    request_example: ''
    response_example: |
        {
            "data": [
                {
                    "id": "security-check",
                    "title": "Grav Security Check",
                    "provider": "core",
                    "component": null,
                    "status": "success",
                    "message": "Security Scan complete: No issues found.",
                    "items": []
                },
                {
                    "id": "yaml-linter",
                    "title": "Grav Yaml Linter",
                    "provider": "core",
                    "component": null,
                    "status": "success",
                    "message": "YAML Linting: No errors found.",
                    "items": []
                },
                {
                    "id": "problems",
                    "title": "Grav Potential Problems",
                    "provider": "problems",
                    "component": "problems-report",
                    "status": "success",
                    "message": "No critical problems detected.",
                    "items": [
                        {
                            "id": "PHP Minimum Version",
                            "level": "critical",
                            "status": true,
                            "msg": "Your PHP 8.5.4 is greater than the minimum of 8.3.0 required"
                        }
                    ]
                }
            ]
        }
    response_codes:
        - code: '200'
          description: 'Reports returned successfully'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden - requires api.reports.read permission'
---

## Report Structure

Each report in the response array contains:

| Field | Type | Description |
|-------|------|-------------|
| `id` | string | Unique report identifier |
| `title` | string | Human-readable report title |
| `provider` | string | Source — `core` for built-in, or plugin slug |
| `component` | string\|null | Web component ID for custom rendering, or `null` for default |
| `status` | string | Overall status: `success`, `warning`, or `error` |
| `message` | string | Summary message |
| `items` | array | Report-specific detail items |

## Built-in Reports

- **Security Check** — Scans all pages for potential XSS vulnerabilities. Items contain `route` and `field` for each issue found.
- **YAML Linter** — Checks all YAML files for syntax errors. Items contain `file` and `error` for each issue found.

## Plugin Reports

Plugins add reports by listening for the `onApiGenerateReports` event. When a report specifies a `component`, the admin frontend loads the plugin's web component from `GET /gpm/plugins/{provider}/report-script/{component}`.

See the [Plugin API Integration](/plugins/plugin-api-integration#reports-integration) guide for implementation details.
