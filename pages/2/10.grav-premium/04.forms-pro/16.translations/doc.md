---
title: Translations
taxonomy:
    category: docs
description: Translate Forms Pro into another language, and translate your own form labels, placeholders, options and messages. Covers the language block, where to put it, and which text visitors see in which language.
---

# Translations

Forms Pro ships in English. Everything it says is stored as language strings under one key, `PLUGIN_FORMS_PRO`, so you can translate the plugin into another language, or change any phrase, without touching its files. You can also translate the labels and messages of your own forms.

## Where the strings are

The plugin's strings are in `user/plugins/forms-pro/languages/en.yaml`. They cover the builder in Admin Next, the field and action catalog, messages from the API and the validator, and the text visitors see on the form. A few of the visitor-facing ones:

| Key | English text |
|---|---|
| `PLUGIN_FORMS_PRO.STEP_NEXT` | Next |
| `PLUGIN_FORMS_PRO.STEP_PREVIOUS` | Previous |
| `PLUGIN_FORMS_PRO.STEP_X_OF_Y` | Step %1$s of %2$s |
| `PLUGIN_FORMS_PRO.FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `PREFIX`, `SUFFIX` | The parts of a **Name** field |
| `PLUGIN_FORMS_PRO.STREET_ADDRESS`, `CITY`, `STATE_PROVINCE`, `ZIP_POSTAL`, `COUNTRY` | The parts of an **Address** field |
| `PLUGIN_FORMS_PRO.REMOVE_ITEM`, `CLEAR` | The buttons on a **Repeater** and a **Signature** |

Open `en.yaml` to see all of them. Do not edit the plugin's own file, because an update replaces it.

## Translate the plugin

Create a file for your language in `user/languages/`, such as `user/languages/de.yaml`, and copy in the `PLUGIN_FORMS_PRO` block from the plugin's `en.yaml` with the text translated. Strings you leave out stay in English, so you can start with the ones visitors see:

```yaml
PLUGIN_FORMS_PRO:
  STEP_NEXT: "Weiter"
  STEP_PREVIOUS: "Zurück"
  STEP_X_OF_Y: "Schritt %1$s von %2$s"
  FIRST_NAME: "Vorname"
  LAST_NAME: "Nachname"
```

Files in `user/languages/` win over a plugin's own, and an update to Forms Pro does not touch them. The same file also changes the wording in a language that already exists: a `user/languages/en.yaml` with `STEP_NEXT: "Onward"` makes the multi-step buttons read **Onward**. Clear the cache after a change (`bin/grav clear`).

Which language a person gets depends on who they are:

- A visitor gets the site's active language, for example from a `/de` route when your site has several languages (see the language settings under **Configuration**).
- The builder and the messages the API sends back to it use the language of the logged-in Admin Next user.

Number formats follow the active language too, so a Calculation shows `1.234,50` on a German page and `1,234.50` on an English one (see [Calculations](../calculations)).

## Translate your own forms

A label, placeholder, option label, or confirmation message in a form can be a language key instead of plain text. Grav looks the key up in the active language and shows the translation. If there is no translation, the key itself is shown, so add the key to every language you use.

```yaml
fields:
  name:
    type: text
    label: CONTACT_FORM.NAME
    placeholder: CONTACT_FORM.NAME_PLACEHOLDER
  topic:
    type: select
    label: CONTACT_FORM.TOPIC
    options:
      sales: CONTACT_FORM.TOPIC_SALES
process:
  - message: CONTACT_FORM.THANKS
```

```yaml
# user/languages/en.yaml
CONTACT_FORM:
  NAME: "Your name"
  NAME_PLACEHOLDER: "Ada Lovelace"
  TOPIC: "Topic"
  TOPIC_SALES: "Sales"
  THANKS: "Thank you, we will be in touch."
```

```yaml
# user/languages/de.yaml
CONTACT_FORM:
  NAME: "Ihr Name"
  NAME_PLACEHOLDER: "Ada Lovelace"
  TOPIC: "Thema"
  TOPIC_SALES: "Vertrieb"
  THANKS: "Vielen Dank, wir melden uns."
```

Keys work in a field's `label` and `placeholder`, in the label of each option of a Dropdown, in the `label` of each Recipients choice, and in the Message action's text.

## Related

- [Settings tab](../settings-tab)
- [Configuration](../configuration)
