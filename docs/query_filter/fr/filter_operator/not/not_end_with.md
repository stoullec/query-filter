## Recherche par `urlFilter` = `/director/filter?firstName[not:ew]=ent` // [x]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[not:ew]=ent`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name NOT (LIKE '%ent')
;
```