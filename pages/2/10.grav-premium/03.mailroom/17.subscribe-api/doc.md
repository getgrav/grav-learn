---
title: Subscribe API
taxonomy:
    category: docs
description: The public subscribe endpoint as a JSON reference, with every field, every answer, the honeypot and rate limit, how the source is recorded, and a server-side relay behind trusted proxies.
---

# Subscribe API

The signup box posts to one public endpoint, and so can anything else: a form on another site, a script, a server relaying signups from somewhere Mailroom does not run. This page is the reference for that endpoint.

```
POST {route}/subscribe
```

With the default route base, `https://www.example.com/newsletter/subscribe`. There is no API key: the endpoint is public, like the signup box that uses it.

## Two ways to post

| Request | Accepted when |
|---|---|
| JSON, `Content-Type: application/json` | Always. A cross-site browser form cannot send this content type without a preflight the browser will not grant, so it needs no nonce. This is what the signup box's script sends, and what a script or relay should send. |
| A form post (`application/x-www-form-urlencoded` or `multipart/form-data`) | Only with the site's nonce in a `nonce` field, which is what the signup box sends without JavaScript. |

Anything else is refused with `415`. A `GET` is refused with `405`.

## Fields

| Field | Type | What it does |
|---|---|---|
| `email` | string, required | The address. |
| `name` | string | Their name. |
| `list` | string | A list code. Empty, or a code that names no list, is the default list. |
| `lists` | array of strings, or one comma-separated string | More list codes for the same signup. Each list keeps its own double opt-in, and one confirmation email covers them all. Codes that name no list are left out; with none left, the default list is used. |
| `tags` | array of strings, or one comma-separated string | Tag codes to put on them. |
| `consent` | boolean | Required, and must be true, whenever the site has a **Consent Sentence**. `true`, `1`, `"true"`, `"on"` and `"yes"` count. |
| `language` | string | A two-letter language code to store on them. |
| `source` | string | How they came in: `form` or `api`. Anything else is ignored. See below. |
| `source_ref` | string | Your own note of where they came from, such as `footer`. Up to 190 characters. |
| `pick_lists` | boolean | Sent by a form that offers lists to tick. With it, a signup naming no list is refused rather than put on the default list. |
| `website` | string | The honeypot. Must be empty (see below). |

## Answers

A JSON request always gets JSON back; a form post gets JSON when it sends `Accept: application/json`, and otherwise a page in your theme with the same sentence.

| Status | Body | When |
|---|---|---|
| `200` | `{"status": "subscribed", "message": "Thanks. You are on the list."}` | They are on the list now (a list that does not ask people to confirm). |
| `202` | `{"status": "pending", "message": "We have sent you a confirmation email. Check your inbox and press the button in it to be added to the list."}` | A confirmation email is on its way. They are on nothing until they press it. |
| `405` | `{"status": "error", "error": "method_not_allowed", ...}` | Not a `POST`. Carries `Allow: POST`. |
| `415` | `{"status": "error", "error": "unsupported_media_type", ...}` | A form post without the nonce, or another content type. |
| `422` | `{"status": "error", "error": "invalid_email", ...}` | The address is not an address. |
| `422` | `{"status": "error", "error": "consent_required", ...}` | The site has a consent sentence and `consent` was not true. |
| `422` | `{"status": "error", "error": "list_required", ...}` | `pick_lists` was sent with no list. |
| `429` | `{"status": "error", "error": "rate_limited", "message": "...", "retry_after": 1800}` | Too many signups from one visitor address. Carries `Retry-After`. |

Every error body also has a `message` you can show the visitor as it is.

A new address, one already on the list and a suppressed one get the same answer, byte for byte, so the endpoint never tells anybody whether a particular person reads your mail. A suppressed address is simply not written.

The honeypot is the `website` field. A request with anything in it gets the `200` answer and nothing is written, so a bot learns nothing about which field gave it away. Leave it out, or send it empty.

## Rate limit

Each visitor address may post **Signups Per Hour** (`rate_limits.subscribe`, 10) times an hour; `0` turns the limit off. One call counts once however many lists it names. The count is kept in Mailroom's database under a hash of the address, and an IPv6 address counts as its /64.

## How the source is recorded

`source` on the subscriber says how they came in. A caller may name it, `form` or `api`; anything else (`admin`, `import` and the other ways in only the site itself writes) is ignored and the signup read as if none was given, with the same answer. With none given:

- a form post that carried the nonce is `form`;
- a JSON body the browser sent from a page on your own site (`Sec-Fetch-Site: same-origin`, or an `Origin` naming the site's own host) is `form`, which is the signup box's own script;
- any other JSON body, such as a relay on another server, is `api`.

## Examples

```bash
curl -s -X POST https://www.example.com/newsletter/subscribe \
  -H "Content-Type: application/json" \
  -d '{"email": "ada@example.com", "name": "Ada", "list": "newsletter", "consent": true, "source_ref": "launch-page"}'
```

```json
{"status": "pending", "message": "We have sent you a confirmation email. Check your inbox and press the button in it to be added to the list."}
```

Several lists and tags at once:

```json
{"email": "ada@example.com", "lists": ["newsletter", "events"], "tags": ["webinar"], "consent": true}
```

## Behind a proxy or a relay

The address that counts against the rate limit, and that is stored with a person's consent, is the connection's `REMOTE_ADDR`. When your site sits behind a proxy or load balancer, or another server relays signups to it, every request would otherwise come from that one address, and ten signups an hour would be the whole site's allowance.

**Trusted Proxies** (`security.trusted_proxies`, on the **Public Pages** tab) lists the addresses or CIDR ranges of those servers:

```yaml
security:
  trusted_proxies:
    - 203.0.113.10
    - 10.0.0.0/8
```

Only a request whose `REMOTE_ADDR` is on the list has its `X-Forwarded-For` header believed. Mailroom reads the header from the right, skips every trusted hop, and takes the first address that is not trusted as the visitor. A port a proxy wrote on a hop (`203.0.113.9:5678`, `[2001:db8::1]:443`) is taken off. From anybody else the header is ignored, because anybody can send it.

### A server-side relay

Say `www.example.com` runs the footer form and `news.example.com` runs Mailroom. The form on `www.example.com` posts to its own server, which relays the signup as JSON, passing the visitor's address along:

```php
<?php
// On www.example.com, after reading the footer form.
$payload = json_encode([
    'email'      => $email,
    'list'       => 'newsletter',
    'consent'    => $consentTicked,   // true only when the visitor ticked the box
    'source'     => 'form',           // a form, even though a server posts it
    'source_ref' => 'www-footer',
]);

$ch = curl_init('https://news.example.com/newsletter/subscribe');
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 10,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Accept: application/json',
        'X-Forwarded-For: ' . $_SERVER['REMOTE_ADDR'],
    ],
]);
$body   = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$answer = json_decode((string) $body, true);
// 200 or 202: show $answer['message']. 422 or 429: show $answer['message'] as an error.
```

On `news.example.com`, add the relay server's address to **Trusted Proxies**. Then each visitor gets their own ten signups an hour, and their own address is stored with their consent.

- **Call Mailroom's server directly.** If the relay's request passes through a CDN or proxy on its way, `REMOTE_ADDR` is that proxy's, so either list those addresses too or send the request straight to the origin.
- **Show the same consent sentence.** The consent record keeps the hash of Mailroom's own **Consent Sentence**, so the relay's form should show that sentence word for word.
- **Pass the answer on.** The `message` is written for the visitor, and a `422` or `429` says exactly what to tell them.
- **Use this endpoint, not the admin API.** `POST /api/v1/mailroom/subscribers` is for admins: it needs a key with `mailroom.manage`, and records the person as added by the site.

## Related

- [Lists and signup forms](../lists-and-signup-forms)
- [Double opt-in and consent](../double-opt-in-and-consent)
- [Configuration](../configuration#public-pages)
