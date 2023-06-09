## Recherche par `urlFilter` = `/director/filter?firstName=Laurent[not:or]lastName=TOULLEC` // [x]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Simon",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Simon",
    "lastName": "MAHE",
    "birthDate": "1995-05-05"
  },
  {
    "id": "3",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "4",
    "firstName": "Léo",
    "lastName": "TARD",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par `urlFilter` = `/director/filter?firstName=Laurent[not:or]lastName=TOULLEC`  
**Alors** j'affiche

```json
[
  {
    "id": "1",
    "firstName": "Simon",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Simon",
    "lastName": "MAHE",
    "birthDate": "1995-05-05"
  },
  {
    "id": "4",
    "firstName": "Léo",
    "lastName": "TARD",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT d
FROM App\Entity\Director d
WHERE d.first_name = 'Laurent'
OR !(d.last_name='TOULLEC')
;
```
