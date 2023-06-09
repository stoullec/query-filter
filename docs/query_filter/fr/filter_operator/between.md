## Information

Les valeurs sur l'opérateur doivent être int, int ou date,date.

## Recherche par `urlFilter` = `/director/filter?salary[btw]=1500,1700` // [x]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-22",
    "salary": 1600
  },
  {
    "id": "2",
    "firstName": "Jacques",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-22",
    "salary": 1400
  }
  {
    "id": "3",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-22",
    "salary": 1800
  }
]
```

**Quand** je cherche par `urlFilter` = `/director/filter?salary[btw]=1500,1700`  
**Alors** j'affiche

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-22",
    "salary": 1600
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\Director director
WHERE director.salary BETWEEN 1500 AND 1700
;
```


## Recherche par `urlFilter` = `/director/filter?salary[btw]=1700` // [x]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-22",
    "salary": 1600
  },
  {
    "id": "2",
    "firstName": "Jacques",
    "lastName": "TOULLEC",
    "salary": 1800
  }
]
```

**Quand** je cherche par `urlFilter` = `/director/filter?salary[btw]=1700`
**Alors** j'affiche

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-22",
    "salary": 1600
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\Director director
WHERE director.salary BETWEEN 0 AND 1700
;
```


## Recherche par `urlFilter` = `/director/filter?salary[btw]=bonjour` // [x]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-22",
    "salary": 1600
  }
]
```

**Quand** je cherche par `urlFilter` = `/director/filter?salary[btw]=bonjour`  
**Alors** j'affiche

```json
[]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\Director director
WHERE director.salary BETWEEN 0 AND bonjour
;
```

## Recherche par `urlFilter` = `/director/filter?birthDate[btw]=1995-06-06,1995-07-06` // [x]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-22"
  },
  {
    "id": "2",
    "firstName": "Jacques",
    "lastName": "TOULLEC",
    "birthDate": "1995-03-03"
  },
  {
    "id": "3",
    "firstName": "Jean",
    "lastName": "TOULLEC",
    "birthDate": "1995-07-07"
  }
]
```

**Quand** je cherche par `urlFilter` = `/director/filter?birthDate[btw]=1995-04-04,1995-06-06`  
**Alors** j'affiche

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-22"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\Director director
WHERE director.salary BETWEEN 0 AND bonjour
;
```