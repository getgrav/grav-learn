---
title: Authentication
taxonomy:
    category: docs
---
# Authentication

The API supports three authentication methods, tried in this order: API key, JWT, then session. Requests to public endpoints (everything under `/auth/`, translations, thumbnails and `/ping`) skip authentication.

## API Keys

The recommended method for server-to-server integrations and CLI tools.

**Generate a key:**

```bash
bin/plugin api keys:generate --user=admin --name="CI Pipeline" --expiry=90
```

**Use in requests:**

```bash
# Via header (preferred)
curl -H "X-API-Key: grav_abc123..." https://my-site.example/api/v1/pages

# Via query parameter (useful for quick testing)
curl "https://my-site.example/api/v1/pages?api_key=grav_abc123..."
```

API keys are stored as bcrypt hashes on the user account. Each key can have an optional expiry date, tracks its last-used timestamp, and can be limited to a set of permission scopes when it is created through the API.

### Managing Keys

- **List keys**: `bin/plugin api keys:list --user=admin`
- **Revoke a key**: `bin/plugin api keys:revoke key_id --user=admin` (leave out the key ID to pick one from a list)
- Keys can also be managed through the Admin UI on each user's profile page

## JWT Tokens

Best for browser-based applications like Admin2.

**Obtain tokens:**

```bash
curl -X POST https://my-site.example/api/v1/auth/token \
  -H "Content-Type: application/json" \
  -d '{"username": "admin", "password": "password"}'
```

Response:

```json
{
  "data": {
    "access_token": "eyJ...",
    "refresh_token": "eyJ...",
    "token_type": "Bearer",
    "expires_in": 3600,
    "user": { "username": "admin", "fullname": "Admin", "email": "admin@example.com", "super_admin": true, "access": { } }
  }
}
```

If the account has 2FA turned on, the response holds a short-lived challenge instead of tokens (`requires_2fa: true`, `challenge_token`, `token_type: "Challenge"`). Send the challenge token and a code to `POST /auth/2fa/verify` to get the token pair.

**Use in requests:**

```bash
# Recommended: X-API-Token (survives FastCGI / PHP-FPM Authorization-stripping)
curl -H "X-API-Token: eyJ..." https://my-site.example/api/v1/pages

# Also accepted: standard Authorization: Bearer
curl -H "Authorization: Bearer eyJ..." https://my-site.example/api/v1/pages
```

> [!NOTE]
> PHP under FastCGI / CGI / PHP-FPM (notably MAMP's `mod_fastcgi`) can silently strip the `Authorization` header before it reaches PHP, breaking Bearer auth. The `X-API-Token` custom header bypasses this — it's accepted on every endpoint, with either a bare JWT (`X-API-Token: eyJ...`) or the traditional Bearer form (`X-API-Token: Bearer eyJ...`). Prefer it when host portability matters.

**Refresh expired tokens:**

```bash
curl -X POST https://my-site.example/api/v1/auth/refresh \
  -H "Content-Type: application/json" \
  -d '{"refresh_token": "eyJ..."}'
```

## Session Passthrough

If a user already has an active Grav session (e.g., logged into the admin), the API accepts that session automatically. This is primarily used by the admin interface for seamless integration.

Because a browser sends the session cookie with any request to the site, including a form posted from another site, a write (`POST`, `PUT`, `PATCH` or `DELETE`) signed in by the session cookie alone must show that it came from your own site. Its `Origin` header (or `Referer` when there is no `Origin`) must name this host or an origin listed in `cors.origins`. With neither header, it must carry a JSON content type or a custom header such as `X-Requested-With`. Otherwise the API answers `403`. Reads are not affected, same-origin `fetch()` calls pass as they are, and API keys and JWTs are never checked this way. On a public route, a write that fails this check is treated as a guest request instead of being refused.

## Permissions

The API uses its own permission namespace, separate from admin permissions:

| Permission | Purpose |
|-----------|---------|
| `api.super` | Super user for the API; must be granted on its own, a blanket `api` grant does not include it |
| `api.access` | Base access to the API |
| `api.pages.read` | Read pages |
| `api.pages.write` | Create, update, delete pages |
| `api.media.read` | Read media files |
| `api.media.write` | Upload, delete media |
| `api.config.read` | Read configuration |
| `api.config.write` | Modify configuration |
| `api.users.read` | Read user accounts |
| `api.users.write` | Create, modify, delete users |
| `api.gpm.read` | List packages, check updates |
| `api.gpm.write` | Install, remove, update packages |
| `api.system.read` | System info, logs, system health |
| `api.system.write` | Cache management, updates |
| `api.system.backup` | Create, download, delete backups |
| `api.scheduler.read` | View scheduler jobs, status, history |
| `api.scheduler.write` | Run scheduler jobs |
| `api.reports.read` | View reports |
| `api.translations.read` | Browse translation strings |
| `api.translations.write` | Override and revert translation strings |
| `api.webhooks.read` | List webhooks |
| `api.webhooks.write` | Manage webhooks |

Grant permissions to users via their account's `access` configuration:

```yaml
access:
  api:
    access: true
    pages:
      read: true
      write: true
    media:
      read: true
      write: true
```
