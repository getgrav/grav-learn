---
title: Conditional Logic
taxonomy:
    category: docs
description: Show or hide fields with rules in the Logic tab, applied live in the browser and enforced again on the server, with every operator and the YAML behind it.
---

# Conditional Logic

Conditional logic shows or hides a field depending on what the visitor has entered in other fields. A rule such as "show **Order number** when **Reason** is Support" is applied live in the browser as the visitor types, and enforced again on the server when the form is sent, so hiding a field really does remove it.

## Add a rule

1. Open the **Logic** tab. You need at least two input fields on the **Build** tab to make a rule.
2. In **+ Add condition…**, pick the field the rule will show or hide. This is the target field.
3. The rule reads as a sentence. Choose **Show** or **Hide**, then **all** or **any** of the rules, and set the rule itself: which field to look at, an operator, and a value.
4. Click **Add rule** for more rules, or the remove button to delete one.
5. Click **Save**.

Each target field gets a card. A field can have more than one card (one group of rules each). The target is hidden when any of its groups says so, so groups combine as "and". The fields offered as targets and as rule sources are the input fields. Layout fields, the honeypot and challenge fields are left out, since they have no answer a rule could test. A field cannot test itself.

For a choice field (a Dropdown, Radio Buttons, Checkboxes or Recipients field) the value box becomes a list of its options, and for a single Checkbox, Toggle or Switch the value is **Checked**. The stored value is the option's key, not its label.

A rule with no field, or with nothing to compare against, is flagged **Incomplete**. The **Logic** tab shows a count, and the form cannot be saved until each rule has a value or is removed. This stops a half-made rule from quietly hiding a field for the wrong people. To test for a blank answer, use **is empty**.

### Operators

| Operator | Key in YAML | True when the field's value |
|---|---|---|
| **is** | `is` | equals the value exactly, matching case |
| **is not** | `is_not` | does not equal the value |
| **contains** | `contains` | contains the value, ignoring case |
| **doesn't contain** | `not_contains` | does not contain the value, ignoring case |
| **starts with** | `starts_with` | starts with the value, ignoring case |
| **ends with** | `ends_with` | ends with the value, ignoring case |
| **is greater than** | `greater_than` | is a number larger than the value |
| **is less than** | `less_than` | is a number smaller than the value |
| **is empty** | `is_empty` | is blank |
| **is not empty** | `is_not_empty` | is not blank |

A field holding several values (Checkboxes, or a Dropdown with several selections) is compared as its values joined by commas, so **contains** is the operator to ask "is this one ticked?".

## What hidden means

In the browser, a hidden field is not shown and its inputs are disabled, so the browser skips them when it checks the form and they are not sent. On the server, a field the rules hide for the submitted answers is handled so that:

- Its **Required** is dropped, so an empty hidden field never blocks the form.
- Whatever was posted for it is thrown away before any action runs. A visitor who typed something, then changed their answer so the field hid, does not leave a stale value in the entry, the email or the webhook.
- It counts as blank in calculations. See [Calculations](../calculations).

The server works the rules out from the posted answers, not from anything the browser claims, so a tampered form gains nothing.

## The YAML

Rules live on the target field under `conditions`, a list of groups. This form was tested as written. **Tell us more** is required, but only when **Reason** is Other, and **Order number** shows for Support or Sales:

```yaml
fields:
  reason:
    type: select
    label: Reason
    options:
      sales: Sales
      support: Support
      other: Other
    validate:
      required: true
  other_reason:
    type: text
    label: Tell us more
    validate:
      required: true
    conditions:
      - action: show
        logic: all
        rules:
          - field: reason
            operator: is
            value: other
  order_number:
    type: text
    label: Order number
    conditions:
      - action: show
        logic: any
        rules:
          - field: reason
            operator: is
            value: support
          - field: reason
            operator: is
            value: sales
```

| Key | Meaning |
|---|---|
| `action` | `show` or `hide`. It defaults to `show`. |
| `logic` | `all` (every rule must match) or `any` (one is enough). It defaults to `all`. |
| `rules` | A list of `field`, `operator` and `value`. `is_empty` and `is_not_empty` take no `value`. |

A rule's `field` can reach into a composite field with a dot, such as `full_name.first` for the first name of a Name field. The Logic tab does not offer that, but it works when written by hand.

> [!NOTE]
> Conditions apply to whole fields. They do not apply to a step in a [multi-step form](../multi-step-forms) or to a notification. A notification has its own `conditions` for deciding whether to send. See [Actions and notifications](../actions-and-notifications#send-only-when-a-condition-is-met).

## Related

- [Field reference](../field-reference)
- [Calculations](../calculations)
- [Actions and notifications](../actions-and-notifications)
