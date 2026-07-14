---
title: List Page Media
api:
    method: GET
    path: '/pages/{route}/media'
    description: 'List all media files for a page, with optional metadata filtering and sorting.'
    parameters:
        - name: route
          type: string
          required: true
          description: 'The page route'
        - name: filter
          type: string
          required: false
          description: 'Metadata filter as `field:operator:value` (or `field:value`). Repeatable via `filter[]=`. Operators: == != > >= < <= in contains.'
        - name: sort
          type: string
          required: false
          description: 'Metadata (or intrinsic filename/size/modified) field to sort by'
        - name: order
          type: string
          required: false
          description: 'Sort direction: asc (default) or desc'
    request_example: ''
    response_example: '{"data": [{"filename": "photo.jpg", "url": "/user/pages/blog/photo.jpg", "type": "image/jpeg", "size": 245000}]}'
    response_codes:
        - code: '200'
          description: 'Success'
        - code: '400'
          description: 'Invalid filter/sort parameter'
        - code: '401'
          description: 'Unauthorized'
        - code: '404'
          description: 'Page not found'
---

## Filtering and sorting by metadata

When your media carry metadata via `.meta.yaml` sidecars, you can filter and sort the listing by those values instead of pulling the whole set. This mirrors the [Twig collection query methods](/20/content/media#filtering-media-by-metadata) but is **bound to the metadata schema** configured under **Plugins → API → Media Metadata** (`plugins.api.media_metadata.fields`).

### Filter

Each `filter` clause is `field:operator:value`. Repeat it with `filter[]=` to apply several (they are ANDed):

```
GET /pages/blog/media?filter=rating:>=:3&filter[]=tags:contains:sunset
```

Available operators are `==`, `!=`, `>`, `>=`, `<`, `<=`, `in`, and `contains`. You can also omit the operator (`filter=copyright:Jane Doe`), in which case it is inferred from the field type — `contains` for a `tags` field, `==` otherwise. For the `in` operator, give a comma-separated set: `filter=rating:in:4,5`.

### Sort

```
GET /pages/blog/media?sort=rating&order=desc
```

`sort` accepts any configured metadata field plus the intrinsic `filename`, `size`, and `modified` keys. `order` is `asc` (default) or `desc`; media missing the sorted field always sort last. (`dir` is accepted as an alias for `order`.)

### Rules and limits

- **Schema-bound.** Only fields defined in `media_metadata.fields` are filterable and sortable; unknown fields are ignored. A `tags` field accepts only `in`/`contains`.
- **Validation.** An unknown operator, a malformed clause, or an invalid `sort` field returns `400`. Filtering rides the existing `api.media.read` permission and exposes no metadata values the caller could not already read.
- **Cap.** At most 10 `filter` clauses per request.
