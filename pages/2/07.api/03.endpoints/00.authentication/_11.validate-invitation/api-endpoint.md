---
title: Validate Invitation
api:
    method: GET
    path: '/auth/invite/{token}'
    description: 'Look up an invitation so the accept screen can show who it is for. An expired invitation still returns 200, with `valid: false`, `expired: true` and the email only. An unknown token returns 404. Public: the token is the only credential.'
    parameters:
        - name: token
          type: string
          required: true
          description: 'The invitation token from the emailed invite link.'
    request_example: ''
    response_example: '{"data": {"valid": true, "expired": false, "email": "jane@example.com", "fullname": "Jane Doe"}}'
    response_codes:
        - code: '200'
          description: 'Invitation status returned (including expired invitations).'
        - code: '404'
          description: 'This invitation is invalid.'
---
