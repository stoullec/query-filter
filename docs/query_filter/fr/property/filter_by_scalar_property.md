## Recherche par `urlFilter` = `/director/filter?id=1` // [x]

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
        "firstName": "Jacques",
        "lastName": "TOULLEC"
    }
]
```
**Quand** je cherche par le filtre `/director/filter?id=1`  
**Alors** j'affiche  
```json
[
    {
        "id": "1",
        "firstName": "Laurent",
        "lastName": "MAHE"
    }
]
```
**Et** la `QueryFilterService.getDQL()` = 
```sql
SELECT director 
FROM App\Entity\Director director 
WHERE director.last_name='TOULLEC'
;
```

## Recherche par `urlFilter` = `/director/filter?lastName=TOULLEC` // [x]

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
        "firstName": "Jacques",
        "lastName": "MAHE"
    }
]
```
**Quand** je cherche par le filtre `/director/filter?lastName=TOULLEC`  
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
WHERE director.last_name='TOULLEC'  
;
```


## Recherche par `urlFilter` = `/person_type/filter?name=Director` // [x]

* **Depuis** `/person-type/`  
**Etant donné que** 
```json
[
    {
        "id": "1",
        "name": "Director"
    },
    {
        "id": "2",
        "name": "Producer"
    }
]
```
**Quand** je cherche par le filtre `/person_type/filter?name=Director`  
**Alors** j'affiche  
```json
[
    {
        "id": "1",
        "name": "Director"
    }
]
```
**Et** la `QueryFilterService.getDQL()` = 
```sql
SELECT person_type  
FROM App\Entity\PersonType person_type   
WHERE person_type.name='TOULLEC'  
;
```