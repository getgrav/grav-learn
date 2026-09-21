---
title: Upgrade Grav Core
api:
    method: POST
    path: '/gpm/upgrade'
    description: 'Self-upgrade the Grav core. Refuses to run when Grav is installed via symlink (typical dev/monorepo setups). Runs the upgrade preflight checks first. Requires `api.gpm.write`. Fires `onApiBeforeGravUpgrade` and `onApiGravUpgraded` around the upgrade.'
    parameters:
        - name: override
          type: boolean
          required: false
          description: 'Upgrade even when the preflight checks report blocking problems.'
    request_example: '{"override": false}'
    response_example: '{"data": {"message": "Grav upgraded successfully.", "previous_version": "2.1.0", "new_version": "2.1.1"}}'
    response_codes:
        - code: '200'
          description: 'Core upgraded.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.gpm.write` permission.'
        - code: '409'
          description: 'Blocked by the preflight checks. The body lists the problems; retry with `override: true` to upgrade anyway.'
        - code: '422'
          description: 'Grav is already at the latest version, or installed via symlink.'
        - code: '500'
          description: 'Upgrade failed mid-flight.'
---

When the preflight checks block the upgrade, the `409` response is a normal `data` payload rather than an error:

```json
{
    "data": {
        "status": "preflight_failed",
        "message": "Upgrade blocked by preflight checks.",
        "blocking": [
            "Some enabled plugins/themes have not been marked as compatible with Grav 2.2. Disable them before continuing."
        ],
        "warnings": [],
        "incompatible_packages": { "target": "2.2" },
        "can_override": true
    }
}
```
