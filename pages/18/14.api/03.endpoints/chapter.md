---
title: Rest API Reference
template: chapter
description: 'Complete REST API endpoint reference with parameters, examples, and response codes. All endpoints are prefixed with the configured route (default: /api/v1).'
taxonomy:
    category: docs
---

## Base URL

All endpoints are prefixed with: `{site_url}/api/v1`

## Authentication

All endpoints except `/auth/token` and `/auth/refresh` require authentication via API Key, JWT Bearer token, or active session. See [Authentication](/18/api/authentication).

## Common Response Codes

| Code | Description |
|------|-------------|
| 200 | Success |
| 201 | Created |
| 204 | No Content (successful deletion) |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 409 | Conflict (ETag mismatch) |
| 422 | Validation Error |
| 429 | Rate Limited |
| 500 | Internal Server Error |
