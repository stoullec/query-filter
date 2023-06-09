## Recherche par `urlFilter` = `/director/filter?firstName=Laurent[not:and]lastName=TOULLEC` // [x]

* **Depuis** `/director/`  
**Etant donné que**  
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
**Quand** je cherche par `urlFilter` = `/director/filter?firstName=Laurent[not:and]lastName=TOULLEC`  
**Alors** j'affiche  
```json
[
    {
        "id": "2",
        "firstName": "Laurent",
        "lastName": "MAHE"
    }
]
```
**Et** la `QueryFilterService.getDQL()` = 
```sql
SELECT director  
FROM App\Entity\Director director 
WHERE director.first_name = 'Laurent' 
AND !(director.last_name='TOULLEC')
;
```