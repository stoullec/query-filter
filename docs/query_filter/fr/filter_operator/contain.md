## Recherche par `urlFilter` = `/director/filter?firstName[ctn]=au` // [x]

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
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-22"
  }
]
```

**Quand** je cherche par `urlFilter` = `/director/filter?firstName[ctn]=au`
**Alors** j'affiche

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC"
  }
]
```

**Et** la `QueryFilterService.geDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name LIKE '%au%'
;
```
