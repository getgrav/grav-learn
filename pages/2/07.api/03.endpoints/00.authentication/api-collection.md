---
title: Authentication
template: api-collection
taxonomy:
    category: docs
content:
    items: '@self.modules'
---

Endpoints for JWT login/logout, password reset, two-factor verification, first-run setup, the password policy, invitation accept, login captcha, SSO login, and retrieving the current session. Everything under `/auth/` is public (no auth required). `GET /me` requires an authenticated session.
