---
title: Translate Keys
api:
    method: POST
    path: '/i18n/translate'
    description: 'Send up to 200 keys'' source values to the AI Translate plugin and get proposed translations back. Nothing is written: review the proposals and save the ones you want with [Update Overrides](/2/api/endpoints/translations/update-overrides). Requires `api.translations.write`, since it spends provider credits; demo accounts get 403.'
    parameters:
        - name: target_lang
          type: string
          required: true
          description: 'Language to translate into, e.g. `fr`.'
        - name: keys
          type: array
          required: true
          description: 'Keys to translate, 1 to 200. Non-string entries are ignored.'
        - name: source_lang
          type: string
          required: false
          description: 'Language to translate from. Defaults to the editor''s default language, and must differ from `target_lang`.'
    request_example: '{"source_lang": "en", "target_lang": "fr", "keys": ["THEME_QUARK.SEARCH", "PLUGIN_ADMIN.TITLE"]}'
    response_example: '{"data": {"source_lang": "en", "target_lang": "fr", "proposals": [{"key": "THEME_QUARK.SEARCH", "source": "Search", "value": "Rechercher", "ok": true, "reason": null}, {"key": "PLUGIN_ADMIN.TITLE", "source": "Title", "value": "Titre", "ok": true, "reason": null}]}}'
    response_codes:
        - code: '200'
          description: 'Proposals returned.'
        - code: '401'
          description: 'Unauthorized.'
        - code: '403'
          description: 'Missing `api.translations.write` permission, or a demo account.'
        - code: '422'
          description: 'Machine translation unavailable, missing `target_lang` or `keys`, no keys or more than 200, source and target the same, or the provider call failed.'
---

Placeholders are masked before the text is sent and checked when it comes back. Proposals come back in the order the keys were sent. A proposal with `ok: false` has a `null` `value` and one of these `reason` values:

| Reason | Meaning |
|--------|---------|
| `no_source` | The key has no value in the source language |
| `icu_needs_human` | An ICU message that a person has to translate |
| `nothing_to_translate` | The value has no translatable text, only placeholders or markup |
| `provider_returned_nothing` | The provider returned an empty result |
| `placeholders_mangled` | The provider altered a placeholder, so the proposal was refused |

The first three are decided before the provider is called, so they cost nothing.
