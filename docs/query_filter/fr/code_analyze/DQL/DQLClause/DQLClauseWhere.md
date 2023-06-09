## Feature

- **Quand** `urlFilter` est `/director/filter?id=1`  
  **Alors** `DQLClauseWhere.getDQL()` prend en `parameter` `['id=1']`
  **Et** `return`

```sql
WHERE director.id = 1
```

- **Quand** `urlFilter` est `/director/id22298/filter?id=1`  
  **Alors** `DQLClauseSelect.getDQL()` prend en `parameter` `['id = 1']`  
  **Et** `return`

```sql
WHERE director.id = 1
```

- **Quand** `urlFilter` est `/director/filter?firstName[eq]=Laurent[and]lastName[eq]=TOULLEC`  
  **Alors** `DQLClauseSelect.getDQL()` prend en `parameter` `["firstName[eq]=Laurent", "[and]", "lastName[eq]=TOULLEC"]`  
  **Et** `return`

```sql
WHERE director.first_name = 'Laurent' AND director.last_name = 'TOULLEC'
```

## Information

Cette class renvoie la clause WHERE complète. Elle prend en paramètre des `filter`.

Signature de méthode => `DQLClauseWhere.getDQL(array $listOfFilter): string`

Exemples:

```sql
WHERE director.id = 1
```

```sql
WHERE director.first_name = 'Marc'
AND director.last_name = 'MAHE'
```

## Zone du développeur

DQLClauseWhere est appelée par:

- QueryFilterService
