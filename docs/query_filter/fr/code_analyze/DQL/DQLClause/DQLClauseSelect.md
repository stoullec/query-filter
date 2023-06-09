## Feature

* **Quand** `urlFilter` est `/director/filter?id=1`  
**Alors** `DQLClauseSelect.getDQL()` prend en `parameter` `director`(DQLTableAlias)  
**Et** `return`
```sql
 SELECT director 
```
 
* **Quand** `urlFilter` est `/director/id22298/filter?id=1`    
**Alors** `DQLClauseSelect.getDQL()` prend en `parameter` `director`(DQLTableAlias)    
**Et** `return`
```sql
 SELECT director 
```

## Information

Cette class renvoie la clause SELECT complète.

Signature de méthode => `DQLClauseSelect.getDQL(string $url): string`

## Zone du développeur

DQLClauseSelect appelle:

* DQLTableAlias.getDQL() => director

DQLClauseSelect est appelée par:

* QueryFilterService