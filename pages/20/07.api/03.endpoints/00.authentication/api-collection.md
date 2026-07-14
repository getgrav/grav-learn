---
title: Authentication
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modules'
---

Endpoints for JWT login/logout, password reset, two-factor verification, first-run setup, and retrieving the current session. Token/refresh/revoke/2FA/setup/forgot/reset endpoints are public (no auth required). `GET /me` requires an authenticated session.
