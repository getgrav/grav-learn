---
title: Formula Reference
taxonomy:
    category: docs
description: Every function, operator and rule of the Forms Pro formula language, with worked examples and a walk-through of converting a Calculated Fields Form calculator.
---

# Formula Reference

Formulas in a **Calculation** field use a small, fixed language: numbers, field names, arithmetic, comparisons, `&&`, `||`, a conditional and thirteen functions. It cannot run code, read anything but the form's own answers, or reach outside the form. The same language runs in the browser and on the server, so both give the same answer. How to add a calculation, and what each field type gives a formula, is on the [Calculations](../calculations) page.

## Numbers and field names

Numbers are written `12`, `0.5`, `.5` or `1e3`. There is no thousands separator and no currency symbol in a formula.

A field is named by its **Field Name**, bare (`price`) or in braces (`{price}`). A name uses the letters `a` to `z` (either case), digits and `_`, and cannot start with a digit. A name with a hyphen or a space in it, such as `unit-price`, cannot be used in a formula, because `unit-price` is read as `unit` minus `price`. Give the field a name like `unit_price` instead. The braces do not change this rule, they only make a name stand out.

`true` and `false` are numbers `1` and `0` and cannot be used as field names. Names are case-sensitive: `Price` and `price` are different fields. Function names are not: `round`, `Round` and `ROUND` are the same.

Text in quotes is not part of the language. A formula works with numbers only, so a Dropdown or Radio Buttons field is read by the selected option's key when that key is a number (`10`, `2.5`), and a key that is not a number makes the formula blank. To price options, use numbers as the keys (see [What a formula can read](../calculations#what-a-formula-can-read)).

## Operators

From the loosest to the tightest binding:

| Operators | Meaning |
|---|---|
| `c ? a : b` | If `c` is not zero, `a`, otherwise `b`. Same as `IF(c, a, b)`. Nests to the right, so `x ? 1 : y ? 2 : 3` works. |
| `\|\|` | Either side is not zero. Gives `1` or `0`. |
| `&&` | Both sides are not zero. Gives `1` or `0`. |
| `==` `!=` | Equal, not equal. Gives `1` or `0`. |
| `<` `<=` `>` `>=` | Comparisons. Give `1` or `0`. |
| `+` `-` | Add, subtract. |
| `*` `/` `%` | Multiply, divide, remainder. |
| `-x` `+x` `!x` | Negate, no change, and not (`!0` is `1`, anything else gives `0`). |

Parentheses group as usual: `1 + 2 * 3` is `7` and `(1 + 2) * 3` is `9`. Operators of the same level work left to right.

There is no `^` for powers (use `POW`), and no `=` for equality (use `==`).

> [!NOTE]
> Comparisons give a number, so they chain in a way you may not expect. `1 < 2 < 3` is `(1 < 2) < 3`, which is `1 < 3`, which is `1`. `3 > 2 > 1` is `1 > 1`, which is `0`. Write `a < b && b < c` when you mean "b is between a and c".

Only the branch that is actually used is worked out. In `IF(qty == 0, 0, total / qty)` the division never happens when `qty` is zero, so it does not make the result blank. The same is true for the right side of `&&` and `||`.

The `%` remainder keeps the sign of the left number: `-7 % 3` is `-1` and `7 % -3` is `1`.

Each result is a floating point number, like in most programming languages, so `0.1 + 0.2` is `0.30000000000000004` inside the formula. You never see that, because the field rounds its result to its decimal places. When a formula compares two decimal results, round both first: `ROUND(a, 2) == ROUND(b, 2)`.

## Functions

| Function | Gives | Examples |
|---|---|---|
| `IF(test, a, b)` | `a` when `test` is not zero, otherwise `b`. | `IF(x == 0, 0, 10 / x)` |
| `ROUND(x)`<br>`ROUND(x, places)` | `x` rounded to `places` decimals (default `0`). Half away from zero. | `ROUND(2.5)` is `3`<br>`ROUND(-2.5)` is `-3`<br>`ROUND(2.675, 2)` is `2.68` |
| `PREC(x, places)` | Same as `ROUND`, with the places required. For people coming from Calculated Fields Form. | `PREC(2 / 3, 4)` is `0.6667` |
| `FLOOR(x)`<br>`FLOOR(x, places)` | `x` rounded down, toward negative infinity. | `FLOOR(2.7)` is `2`<br>`FLOOR(-2.7)` is `-3`<br>`FLOOR(2.789, 2)` is `2.78` |
| `CEIL(x)`<br>`CEIL(x, places)` | `x` rounded up, toward positive infinity. | `CEIL(2.1)` is `3`<br>`CEIL(-2.1)` is `-2`<br>`CEIL(2.121, 2)` is `2.13` |
| `ABS(x)` | The number without its sign. | `ABS(-3)` is `3` |
| `SQRT(x)` | The square root. Blank for a negative number. | `SQRT(16)` is `4` |
| `POW(x, y)` | `x` to the power `y`. Blank when the result is too large to hold. | `POW(2, 10)` is `1024`<br>`POW(9, .5)` is `3` |
| `MIN(a, b, ...)` | The smallest of one or more values. | `MIN(3, 1, 2)` is `1` |
| `MAX(a, b, ...)` | The largest of one or more values. | `MAX(3, 1, 2)` is `3` |
| `SUM(a, b, ...)` | The total of one or more values. | `SUM(1, 2, 3, 4)` is `10` |
| `AVG(a, b, ...)` | The average of one or more values. | `AVG(2, 4, 9)` is `5` |
| `PI()` | 3.14159265358979. Takes no arguments, but needs the parentheses. | `ROUND(PI() * r * r, 2)` with `r` of 3 is `28.27` |

Every function takes the number of arguments shown. A formula with the wrong number, or with a function name that does not exist, is refused (see [Checks when you edit](#checks-when-you-edit)). `SUM` and `AVG` take their values one by one. There is no range form, so to add up a group of fields write them out, `SUM(a, b, c)`.

### How rounding works

`ROUND`, `PREC`, `FLOOR` and `CEIL` work on the decimal digits of the number, not on its binary form. That is why `ROUND(2.675, 2)` and `ROUND(1.005, 2)` give `2.68` and `1.01`, where many programming languages give `2.67` and `1.00`. Halves go away from zero, so `ROUND(-2.5)` is `-3`.

`places` can be negative to round to tens, hundreds and so on: `ROUND(1234, -2)` is `1200`. A fractional `places` is cut to a whole number first, so `ROUND(1.26, 1.9)` is the same as `ROUND(1.26, 1)`, which gives `1.3`.

The field applies its own **Decimal Places** to the final result in the same way, so you only need `ROUND` or `PREC` inside a formula when an intermediate step has to be a rounded amount, such as a tax that is rounded to cents before it is added to the total.

## Blank values and errors

A formula gives a number, or it gives nothing. When it gives nothing, the calculation shows blank and stores an empty value. This happens when:

- the formula does not parse (a typo, an unbalanced bracket, an unknown function);
- it divides, or takes a remainder, by zero;
- it takes the square root of a negative number;
- any step gives a number too large to hold, such as `POW(10, 400)`;
- it uses a name that is not a field in the form;
- a field it reads holds text that is not a number, such as `abc`.

An empty field is not an error. A field that is empty, or a checkbox that is not ticked, counts as `0` in arithmetic, so `a + b` with `a` empty and `b` of `5` is `5`. If you want a calculation to show nothing until the visitor has filled something in, use **Blank Until Filled** (see [Calculations](../calculations#blank-until-filled)).

A formula can be at most 2000 characters long and nested at most 64 levels deep. A formula that goes over either limit is refused when you edit it.

## Checks when you edit

The formula editor in the builder checks a formula as you type, with plain messages and the spot marked (see [Calculations](../calculations#the-formula-editor)). Saving checks every formula again on the server. A formula that does not parse, names a field the form does not have, or forms a loop with other calculations is refused. An empty formula is accepted as a draft and shows nothing.

## Worked examples

A total with a percentage discount:

```yaml
total:
  type: pro-calculation
  label: Total
  formula: 'subtotal * (1 - discount / 100)'
  prefix: '$'
```

With a `subtotal` of `1525` and a `discount` of `10`, the total is `1372.50`.

Quantity, price and tax, with the tax shown as a percentage the visitor picks:

```yaml
total:
  type: pro-calculation
  label: Total
  formula: 'quantity * price * (1 + tax_rate / 100)'
  prefix: '$'
```

With `3`, `19.99` and `8` this gives `64.7676`, which the field shows as `$64.77` and stores as `64.77`.

A circle's area, rounded to two places:

```yaml
area:
  type: pro-calculation
  label: Area
  formula: 'ROUND(PI() * radius * radius, 2)'
```

A discount that only applies above a threshold, and a division that protects itself:

```yaml
price_each:
  type: pro-calculation
  label: Price each
  formula: 'IF(quantity == 0, 0, total / quantity)'
```

## Moving a Calculated Fields Form calculator

If you have a calculator built with the Calculated Fields Form plugin for WordPress, most of its formulas can move across with small changes. Forms Pro keeps the parts that most calculators use: `fieldname1`-style names work as they are (give your fields those names if you want to keep the formulas as they are), and `IF`, `PREC`, `ROUND`, `SUM`, `MIN`, `MAX`, `ABS`, `SQRT`, `POW`, `FLOOR` and `CEIL` have the same meaning.

This fuel calculator is a tested example. The form has two number fields and three calculations, in a form whose `mode` is `calculator`:

```yaml
title: Fuel Calculator
type: forms-pro
mode: calculator
fields:
  fieldname1:
    type: number
    label: Litres
  fieldname2:
    type: number
    label: Price per litre
  fieldname3:
    type: pro-calculation
    label: Cost
    formula: 'PREC(fieldname1 * fieldname2, 2)'
    prefix: '$'
  fieldname4:
    type: pro-calculation
    label: Tax
    formula: 'PREC(fieldname3 * .27, 2)'
    prefix: '$'
  fieldname5:
    type: pro-calculation
    label: Total
    formula: 'IF(fieldname1 > 100, fieldname3 * 0.9, fieldname3) + fieldname4'
    prefix: '$'
    decimals: 2
```

With `fieldname1` of `40` litres and `fieldname2` of `1.659`, the page shows a cost of `$66.36`, a tax of `$17.92` and a total of `$84.28`. With `120` litres at the same price the cost is `$199.08`, the tax `$53.75`, and, because the volume is over 100 litres and the 10 percent discount applies, the total is `$232.92`. Until both number fields have a value the three results stay blank, because a calculator shows nothing until everything a formula reads is filled in. The calculations read each other (`fieldname5` reads `fieldname3` and `fieldname4`), and the order they sit in on the page does not matter.

Things to check when you move formulas:

- Only the functions in the table above exist. A function from the original plugin that is not listed, such as a date or text function, is refused when you edit the formula.
- A Number field needs its decimals in `validate.step`, for example `validate.step: 0.01` for a price (see [Field reference](../field-reference#basic)), or the browser refuses a value like `19.99` before the calculation runs.

## Related

- [Calculations](../calculations)
- [Field reference](../field-reference)
- [Conditional logic](../conditional-logic)
