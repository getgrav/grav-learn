---
title: Authentication
taxonomy:
    category: docs
---
# Authentication

The API supports three authentication methods, tried in order. Requests to public endpoints (token generation, translations) skip authentication.

## API Keys

The recommended method for server-to-server integrations and CLI tools.

**Generate a key:**

```bash
bin/plugin api keys:generate --user=admin --name="CI Pipeline" --expiry=90
```

**Use in requests:**

```bash
# Via header (preferred)
curl -H "X-API-Key: grav_abc123..." https://yoursite.com/api/v1/pages

# Via query parameter (useful for quick testing)
curl "https://yoursite.com/api/v1/pages?api_key=grav_abc123..."
```

API keys are stored as bcrypt hashes on the user account. Each key can have an optional expiry date and tracks its last-used timestamp.

### Managing Keys

- **List keys**: `bin/plugin api keys:list --user=admin`
- **Revoke a key**: `bin/plugin api keys:revoke --user=admin --id=key_id`
- Keys can also be managed through the Admin UI on each user's profile page

## JWT Tokens

Best for browser-based applications like admin-next.

**Obtain tokens:**

```bash
curl -X POST https://yoursite.com/api/v1/auth/token \
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
    "expires_in": 3600
  }
}
```

**Use in requests:**

```bash
curl -H "Authorization: Bearer eyJ..." https://yoursite.com/api/v1/pages
```

**Refresh expired tokens:**

```bash
curl -X POST https://yoursite.com/api/v1/auth/refresh \
  -H "Content-Type: application/json" \
  -d '{"refresh_token": "eyJ..."}'
```

## Session Passthrough

If a user already has an active Grav session (e.g., logged into the admin), the API accepts that session automatically. This is primarily used by the admin interface for seamless integration.

## Permissions

The API uses its own permission namespace, separate from admin permissions:

| Permission | Purpose |
|-----------|---------|
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
| `api.system.read` | System info, scheduler status |
| `api.system.write` | Cache management, scheduler |
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
