## Erreur d'operateur de filtre nécessaire // [x]

- **Depuis** `/director/filter?[and]`
  **Quand** je cherche par `urlFilter` = `/director/filter?[and]`
  **Alors** j'affiche

```json
{
  "message": "At least one filter operator([eq], [btw], etc...) is required.",
  "httpCode": 400
}
```

## Erreur d'operateur de filtre nécessaire // [x]

- **Depuis** `/director/filter?personType.name[bonjour]=Director`
  **Quand** je cherche par `urlFilter` = `/director/filter?personType.name[bonjour]=Director`
  **Alors** j'affiche

```json
{
  "message": "At least one filter operator([eq], [btw], etc...) is required",
  "httpCode": 400
}
```
