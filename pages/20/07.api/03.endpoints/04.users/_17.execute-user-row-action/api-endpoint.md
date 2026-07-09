---
title: Execute User Row Action
api:
    method: POST
    path: /users/{username}/row-action
    description: 'Run a plugin-declared Users-list row action against one account. The API re-checks the declared action''s authorize against the caller, then fires `onApiUserListRowAction` with the target username; the plugin handler re-authorizes against that target and returns a result. Any redirect URL in the result is validated to a safe same-origin target before it reaches the client.'
    parameters:
        - name: username
          in: path
          required: true
          description: 'The target account the action runs against.'
    request_example: |
        {
            "id": "impersonate-user"
        }
    response_example: |
        {
            "data": {
                "status": "success",
                "message": "Impersonating alice",
                "url": "/admin/impersonate/alice"
            }
        }
    response_codes:
        - code: '200'
          description: 'Action executed; body carries the handler result.'
        - code: '401'
          description: 'Unauthorized'
        - code: '403'
          description: 'Forbidden — caller lacks `api.users.read`, or the handler rejected this target'
        - code: '404'
          description: 'Unknown username, or an action id the caller isn''t authorized for'
---

Post the `id` of a declared row action. The API loads the target account, confirms the caller may list users (`api.users.read`), and re-checks the action's own `authorize` — an unknown or unauthorized id is an indistinguishable `404`, so nothing leaks. It then fires `onApiUserListRowAction` with the resolved `username`; the handler must guard on `$event['plugin']`, re-authorize against the target, and set `$event['result']`.

The result is normalized to a fixed shape:

- `status` — `success` or `error`; drives whether Admin2 shows a success or error toast.
- `message` — optional text shown as a toast (length-capped).
- `url` — optional redirect. Only a root-relative path (not the protocol-relative `//host` form) or a same-origin absolute URL survives validation; a `javascript:`/`data:` scheme or a cross-origin URL is dropped. Admin2 opens the surviving URL in a new tab with `noopener`.

A handler that throws degrades to an error toast rather than breaking the Users list; a thrown `ForbiddenException` propagates as a `403`.

See the [API Events](/20/api/events) page for the `onApiUserListRowAction` contract.
