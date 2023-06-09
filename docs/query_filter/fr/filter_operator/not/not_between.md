## Recherche par `urlFilter` = `/director/filter?salary[not:btw]=1500,1700` // [x]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1600
  },
  {
    "id": "2",
    "firstName": "Jacques",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1400
  },
  {
    "id": "3",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1800
  }
]
```

**Quand** je cherche par le filtre `/director/filter?salary[not:btw]=1500,1700`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "Jacques",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1400
  },
  {
    "id": "3",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1800
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\Director director
WHERE director.salary NOT (BETWEEN 1500 AND 1700)
;
```


## Recherche par `urlFilter` = `/director/filter?salary[not:btw]=1700` // [x]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1600
  },
    {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1800
  }
]
```

**Quand** je cherche par le filtre `/director/filter?salary[not:btw]=1500,1700`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1800
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\Director director
WHERE director.salary NOT (BETWEEN 1500 AND 1700)
;
```




## Recherche par `urlFilter` = `/director/filter?salary[not:btw]=bonjour` // [ ]

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

**Quand** je cherche par `urlFilter` = `/director/filter?salary[not:btw]=bonjour`  
**Alors** j'affiche

```json
[]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\Director director
WHERE director.salary NOT (BETWEEN 0 AND bonjour)
;
```

## Recherche par `urlFilter` = `/director/filter?birthDate[not:btw]=1995-06-06,1995-07-06` // [ ]

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
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-07-07"
  }
]
```

**Quand** je cherche par `urlFilter` = `/director/filter?birthDate[not:btw]=1995-04-04,1995-06-06`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "Jacques",
    "lastName": "TOULLEC",
    "birthDate": "1995-03-03"
  },
  {
    "id": "3",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-07-07"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\Director director
WHERE director.salary NOT (BETWEEN 0 AND bonjour)
;
```