---
title: Reports
api:
    method: GET
    path: /reports
    description: 'Get plugin-extensible diagnostic reports. Built-in reports are a Security Check (XSS scan), Twig in Content, and a YAML Linter. Plugins can add their own reports via the onApiGenerateReports event. Requires `api.reports.read`.'
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
                    "id": "twig-content",
                    "title": "Twig in Content",
                    "provider": "core",
                    "component": null,
                    "status": "success",
                    "message": "Twig in Content is disabled. No pages are leaking raw Twig.",
                    "meta": { "gate": false, "sandbox": true, "editor_enabled": false, "leak_count": 0, "event_count": 0, "global_request_gated": false, "frontmatter_request_gated": false },
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
          description: 'Forbidden - requires `api.reports.read` permission'
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
| `meta` | object | Optional report-specific summary values |
| `items` | array | Report-specific detail items |

## Built-in Reports

- **Security Check** — Scans all pages for potential XSS vulnerabilities. Items contain `route` and `field` for each issue found.
- **Twig in Content** (`twig-content`): Shows whether Twig in page content is switched on and sandboxed, pages whose raw Twig markers render to visitors, and recent tokens the sandbox blocked. Its `meta` carries `gate`, `sandbox`, `editor_enabled`, `leak_count`, `event_count`, `global_request_gated` and `frontmatter_request_gated`; its items are `kind: leak` and `kind: event` rows. The endpoints under `/reports/twig-content/` act on this report.
- **YAML Linter** — Checks all YAML files for syntax errors. Items contain `file` and `error` for each issue found.

## Plugin Reports

Plugins add reports by listening for the `onApiGenerateReports` event. When a report specifies a `component`, the admin frontend loads the plugin's web component from `GET /gpm/plugins/{provider}/report-script/{component}`.

See the [Plugin API Integration](/plugins/plugin-api-integration#reports-integration) guide for implementation details.
