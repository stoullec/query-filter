## Recherche par `urlFilter` = `/director/filter?firstName=Laurent[and]lastName=TOULLEC` // [x]

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
    "firstName": "Laurent",
    "lastName": "MAHE",
    "birthDate": "1995-05-05"
  },
  {
    "id": "3",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par `urlFilter` = `/director/filter?firstName=Laurent[and]lastName=TOULLEC`  
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

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\Director director
WHERE director.first_name = 'Laurent'
AND director.last_name='TOULLEC'
;
```
