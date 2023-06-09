## Recherche par `urlFilter` = `/director/filter?personType.name=Director` // [ ]

* **Depuis** `/director/`  
**Etant donné que** 
```json
[
    {
        "id": "1",
        "firstName": "Laurent",
        "lastName": "TOULLEC",
        "personType": {
            "id": "1",
            "name": "Director"
        }
    },
    {
        "id": "2",
        "firstName": "Jacques",
        "lastName": "TOULLEC",
        "personType": {
            "id": "2",
            "name": "Producer"
        }
    }
]
```
**Quand** je cherche par le filtre `/director/filter?personType.name=Director`  
**Alors** j'affiche  
```json
[
    {
        "id": "1",
        "firstName": "Laurent",
        "lastName": "TOULLEC",
        "personType": {
            "id": "1",
            "name": "Director"
        }
    }
]
```
**Et** la `QueryFilterService.getDQL()` = 
```sql
SELECT director 
FROM App\Entity\Director director 
INNER JOIN App\Entity\PersonType person_type ON person_type.id = director.person_type_id
WHERE person_type.name='Director'
;
```