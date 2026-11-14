---
title: Webhooks
taxonomy:
    category: docs
description: Send each Forms Pro submission as JSON to another service. Covers the Webhook action's options, the payload, headers, the safety checks on the target address, timeouts, and what happens when a call fails.
---

# Webhooks

The **Webhook** action sends each submission to a web address as JSON, as soon as the visitor sends the form. Use it to feed a CRM, a Zapier or Make scenario, a chat channel, or a script of your own. This page covers the action's options, exactly what it sends, and the rules it applies to the address it calls.

## Add a webhook

Open the form, go to **Actions**, click **Add action** and choose **Webhook** under **Integrations**. You can add several, each to a different address.

| Key | Label | Meaning |
|---|---|---|
| `url` | **URL** | Where to send the data. Required. Must start with `http://` or `https://`. |
| `method` | **Method** | `POST` (default), `PUT` or `PATCH`. |
| `headers` | **Headers** | Extra request headers, as name and value pairs. Under **Options**. |
| `include_ip` | **Include Submitter IP** | Off by default. Adds the visitor's IP address to the payload. Under **Options**. |
| `timeout` | **Timeout (seconds)** | How long to wait for an answer, 1 to 30. Default 10. Under **Advanced**. |
| `fail_silently` | **Continue on Failure** | On by default. See [When a webhook fails](#when-a-webhook-fails). Under **Advanced**. |

In the form's YAML it looks like this:

```yaml
process:
  - submission: true
  - webhook:
      url: 'https://hooks.example.com/forms/abc123'
      method: POST
      headers:
        X-Source: website
        Authorization: 'Bearer your-secret-token'
      include_ip: true
      timeout: 5
```

The URL, the method and the headers are used exactly as you write them. Merge tags are not processed in them, and nothing a visitor types can change where the data goes.

> [!TIP]
> Put the webhook below **Store Submission**. The webhook runs during the visitor's request, in the order shown on the Actions tab, so the entry is already safely stored if the other service is slow or down. See [Order matters](../actions-and-notifications#order-matters).

## What is sent

The request body is JSON, with the header `Content-Type: application/json`:

```json
{
  "form": "contact-us",
  "timestamp": "2026-11-14T03:42:52+00:00",
  "data": {
    "name": "Ada",
    "email": "ada@example.com"
  },
  "ip": "203.0.113.7"
}
```

| Key | Holds |
|---|---|
| `form` | The form's name (its file name, such as `contact-us`). |
| `timestamp` | When the form was sent, in ISO 8601, in the site's time zone. |
| `data` | The answers, keyed by Field Name. A field with several parts, such as a name, is a nested object. Values are as the form stores them, so a Calculation holds the server's result. A honeypot field is left out. |
| `ip` | The visitor's IP address. Only present when **Include Submitter IP** is on. |

Any headers you set are added to the request. The request also carries a `User-Agent` of `Grav CMS`. There is no signature header. Protect the receiving end with a secret in a header, as above, or a long random address, and check it there.

The webhook sends once and does not retry. A response whose status is 200 to 299 counts as success, and the body of the reply is ignored.

## Which addresses are allowed

The address you call is checked before anything is sent:

- The host name is looked up first. If any address it resolves to is loopback (`127.0.0.1`), private (`10.x.x.x`, `192.168.x.x`), link-local (including the cloud metadata address `169.254.169.254`), carrier-grade NAT, multicast or otherwise reserved, nothing is sent. The check covers IPv4 and IPv6, including IPv4 addresses written inside IPv6 forms.
- The request is then sent to the address that was checked, so a DNS answer that changes a moment later cannot send it somewhere else.
- Redirects are never followed. A reply with a status of 300 or more counts as a failure.
- An address with a user name or password in it (`https://user:pass@host/`) is refused. Put credentials in a header instead.
- A host that does not resolve is refused.

These rules stop a webhook from being turned against your own network. If a webhook has to reach a service on your own network, turn on **Allow Webhooks to Private Addresses** in the plugin's settings (`webhooks.allow_private_hosts: true`), which is off by default. With it on, the private-address checks are skipped, so only use it for addresses you control. See [Configuration](../configuration).

## When a webhook fails

A webhook that fails, is refused, or times out is written to Grav's log (`logs/grav.log`) with the address and the reason, for example:

```
Forms Pro: webhook 'http://127.0.0.1:18766/hook' refused: 127.0.0.1 is a private or reserved address
```

With **Continue on Failure** on, which is the default, the visitor does not see it. The form carries on with the actions below it, so the confirmation message and the notifications still happen, and the entry is stored if **Store Submission** sits above the webhook.

With **Continue on Failure** off, a failed webhook stops the submission. The visitor sees an error message above the form, with their answers still in it, and the actions below the webhook do not run, so there is no confirmation, no redirect and no notification below it. Actions above the webhook have already run and stay done. An entry stored by a **Store Submission** above it is kept, so a visitor who sends the form again leaves a second entry. Put the webhook above **Store Submission** if you want nothing stored when it fails.

A slow service slows the visitor's own request down, up to the timeout. Keep the timeout short, and for a service you do not control, use one of the queue or catch-hook addresses it offers (Zapier's *Catch Hook* trigger, for example) so that it answers at once. The plugin's default for every webhook is `webhooks.timeout` (10 seconds), and no webhook waits more than 30.

## Test a webhook

Point a webhook at a throwaway catch address, such as a Zapier *Catch Hook* trigger or a request bin, send the form once, and look at what arrived. If nothing arrives, open `logs/grav.log`: a refused address, a host that does not resolve and an answer of 300 or more each leave a line that names the reason.

To test against a script on your own computer, such as `http://localhost:8000/hook`, turn on **Allow Webhooks to Private Addresses** while you test and turn it off again afterwards.

## Related

- [Actions and notifications](../actions-and-notifications)
- [Configuration](../configuration)
- [Troubleshooting](../troubleshooting)
