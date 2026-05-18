---
title: Getting Started
taxonomy:
    category: docs
---
# Getting Started with the Grav API

The [Grav API Plugin](https://github.com/getgrav/grav-plugin-api) adds a RESTful API to your Grav site, providing full headless access to pages, media, configuration, users, and system management.

## Requirements

- Grav CMS 2.0+
- PHP 8.3+
- Login Plugin 3.8+

## Installation

Install via GPM:

```bash
bin/grav install api
```

Or manually: download the plugin into `user/plugins/api` and run `composer install`.

## Quick Setup

### 1. Enable the Plugin

```yaml
# user/config/plugins/api.yaml
enabled: true
```

### 2. Generate an API Key

**Via CLI** (recommended for initial setup):

```bash
bin/plugin api keys:generate --user=admin --name="My First Key"
```

**Via Admin Panel**: Navigate to a user's profile and use the **API Keys** section.

The key is shown once — save it immediately.

### 3. Make Your First Request

```bash
curl https://yoursite.com/api/v1/pages \
  -H "X-API-Key: grav_abc123..."
```

## Configuration

The API is configured via `user/config/plugins/api.yaml`:

```yaml
enabled: true
route: /api                    # Base route for all API endpoints
version_prefix: v1             # Version prefix

auth:
  api_keys_enabled: true       # Enable API key authentication
  jwt_enabled: true            # Enable JWT token authentication
  session_enabled: true        # Enable session passthrough

cors:
  enabled: true                # Enable CORS headers
  origin: '*'                  # Allowed origins
  credentials: false           # Allow credentials

rate_limit:
  enabled: true                # Enable rate limiting
  requests_per_minute: 120     # Requests per minute per user/IP

pagination:
  default_per_page: 20         # Default items per page
  max_per_page: 100            # Maximum items per page
```

## Environments

Grav supports multiple environments. The API respects this via the `X-Grav-Environment` header:

```bash
curl -H "X-Grav-Environment: mysite.com" \
     -H "X-API-Key: ..." \
     https://yoursite.com/api/v1/pages
```

## Response Format

All API responses follow a consistent structure:

```json
{
  "data": { ... }
}
```

Paginated responses include metadata:

```json
{
  "data": [ ... ],
  "meta": {
    "total": 42,
    "page": 1,
    "per_page": 20,
    "total_pages": 3
  },
  "links": {
    "self": "/api/v1/pages?page=1",
    "next": "/api/v1/pages?page=2",
    "last": "/api/v1/pages?page=3"
  }
}
```

Errors use RFC 7807 format:

```json
{
  "status": 404,
  "title": "Not Found",
  "detail": "Page '/missing' not found."
}
```

## Concurrency Control

The API uses ETags for optimistic concurrency. When updating resources, include the `If-Match` header with the ETag from the GET response:

```bash
# Fetch with ETag
curl -H "X-API-Key: ..." https://yoursite.com/api/v1/pages/blog
# Response includes: ETag: "abc123"

# Update with If-Match
curl -X PATCH \
  -H "X-API-Key: ..." \
  -H "If-Match: \"abc123\"" \
  -H "Content-Type: application/json" \
  -d '{"title": "Updated Title"}' \
  https://yoursite.com/api/v1/pages/blog
```

If the resource was modified since your last fetch, you'll receive a 409 Conflict response.
