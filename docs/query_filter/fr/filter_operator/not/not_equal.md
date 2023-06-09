## Recherche par `urlFilter` = `/director/filter?firstName[not:eq]=Laurent` // [x]

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
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[not:eq]=Laurent`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "Jacques",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name NOT (= 'Laurent')
;
```
