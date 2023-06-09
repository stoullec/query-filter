## Feature

* **Quand** `urlFilter` est `/director/filter?id=1`  
**Alors** `DQLClauseFrom.getDQL` prend en `parameter` `App\Entity\Director`(DQLTable.getDQL())  et `director`(DQLTableAlias)
**Et** `return`  
```sql
FROM App\Entity\Director director
```

* **Quand** `urlFilter` est `/director/id22298/filter?id=1`   
**Alors** `DQLClauseFrom.getDQL` prend en `parameter` `App\Entity\Director`(DQLTable.getDQL())  et `director`(DQLTableAlias)
**Et** `return`  
```sql
FROM App\Entity\Director director
```

## Information

Cette class renvoie la clause FROM complète. 

Signature de méthode => `DQLClauseFrom.getDQL(string $dqlTable): string`

## Zone du développeur
 
DQLClauseFrom appelle:  

* FilterClass.getClass() => Director  
* DQLTableAlias.getDQL() => director
