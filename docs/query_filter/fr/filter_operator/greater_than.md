## Recherche par `urlFilter` = `/director/filter?salary[gt]=1500` // [x]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1800
  },
  {
    "id": "2",
    "firstName": "Jacques",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1500
  }
  {
    "id": "3",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1400
  }
]
```

**Quand** je cherche par le filtre `/director/filter?salary[gt]=1500`  
**Alors** j'affiche

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05",
    "salary": 1800
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.salary > 1500
;
```
