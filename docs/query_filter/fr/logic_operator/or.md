## Recherche par `urlFilter` = `/director/filter?firstName=Laurent[or]lastName=TOULLEC` // [x]

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
  },
  {
    "id": "4",
    "firstName": "Leo",
    "lastName": "TARD",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par `urlFilter` = `/director/filter?firstName[eq]=Laurent[or]lastName[eq]=TOULLEC`  
**Alors** j'affiche

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC"
  },
  {
    "id": "2",
    "firstName": "Laurent",
    "lastName": "MAHE"
  },
  {
    "id": "3",
    "firstName": "Marc",
    "lastName": "TOULLEC"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT d
FROM App\Entity\Director d
WHERE d.first_name = 'Laurent'
OR d.last_name='TOULLEC'
;
```
