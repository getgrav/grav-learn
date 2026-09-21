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

The public endpoints that do not require authentication are everything under `/auth/` (token, 2FA verify, refresh, revoke, forgot and reset password, setup, invitation accept, password policy, captcha and SSO), `GET /translations/{lang}`, `GET /thumbnails/{file}` and `GET /ping`. Plugins can add their own public routes through the `onApiCollectPublicRoutes` event. Everything else requires authentication via:

- an **API Key** (`X-API-Key` header or `?api_key=` query param),
- a **JWT access token** (preferred as `X-API-Token`, accepted as `Authorization: Bearer`), or
- an active **Grav session** (passthrough).

See [Authentication](/2/api/authentication) for details including why `X-API-Token` is preferred over `Authorization: Bearer` on FastCGI / PHP-FPM hosts.

## Environments

The API respects Grav environments. Pass `X-Grav-Environment: <hostname>` to target a specific environment configuration.

## Common Response Codes

| Code | Description |
|------|-------------|
| 200 | Success |
| 201 | Created |
| 204 | No Content (successful deletion) |
| 304 | Not Modified (ETag match on conditional GET) |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 405 | Method Not Allowed (the path exists, but not for this method) |
| 409 | Conflict (including an `If-Match` ETag that no longer matches on update) |
| 422 | Validation Error |
| 429 | Rate Limited |
| 500 | Internal Server Error |
| 502 | Bad Gateway (e.g. GPM repository unreachable, webhook test failed) |
