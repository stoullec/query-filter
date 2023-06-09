## Erreur de propriété non existante // [x]

- **Depuis** `/director/filter?bonjour[eq]=Marc`
  **Quand** je cherche par `urlFilter` = `/director/filter?bonjour[eq]=Marc`
  **Alors** j'affiche

```json
{
  "message": "[bonjour] This property not exist in director",
  "httpCode": 400
}
```

## Erreur de propriété non existante // [x]

- **Depuis** `/director/filter?lastName[eq]=Marc[and][and]id[eq]=TOULLEC`
  **Quand** je cherche par `urlFilter` = `/director/filter?name[eq]=Marc[and][and]id[eq]=TOULLEC`
  **Alors** j'affiche

```json
{
  "message": "[[and]id] This property not exist in director",
  "httpCode": 400
}
```

## Erreur de propriété non existante // [x]

- **Depuis** `/director/filter?firstName[eq]Simon`
  **Quand** je cherche par `urlFilter` = `/director/filter?firstName[eq]Simon`
  **Alors** j'affiche

```json
{
  "message": "[firstName[eq]Simon] This property not exist in director",
  "httpCode": 400
}
```


## Erreur de propriété non existante // [x]

- **Depuis** `/director/filter?bonjour=Marc`
  **Quand** je cherche par `urlFilter` = `/director/filter?bonjour[eq]=Marc`
  **Alors** j'affiche

```json
{
  "message": "[bonjour] This property not exist in director",
  "httpCode": 400
}
```

## Erreur de propriété non existante // [x]

- **Depuis** `/director/filter?firstName[eq]=Simon[and]bonjour[eq]=Simon`
  **Quand** je cherche par `urlFilter` = `/director/filter?firstName[eq]=Simon[and]bonjour[eq]=Simon`
  **Alors** j'affiche

```json
{
  "message": "[bonjour] This property not exist in director",
  "httpCode": 400
}
```

## Erreur de propriété non existante // [x]

- **Depuis** `/director/filter?[eq]=`
  **Quand** je cherche par `urlFilter` = `/director/filter?[eq]=`
  **Alors** j'affiche

```json
{
  "message": "[] This property not exist in director",
  "httpCode": 400
}
```

## Erreur de propriété non existante // [x]

- **Depuis** `/director/filter?[eq]=`
  **Quand** je cherche par `urlFilter` = `/director/filter?[eq]`
  **Alors** j'affiche

```json
{
  "message": "[[eq]] This property not exist in director",
  "httpCode": 400
}
```
