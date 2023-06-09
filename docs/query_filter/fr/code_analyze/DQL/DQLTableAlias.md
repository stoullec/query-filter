## Feature

* **Quand** `urlFilter` est `/director/filter?id=1`  
**Alors** `DQLTableAlias.convertDQLClassToDQLTableAlias` prend en `parameter` `Director`(FilterClass.getClass)
**Et** `return` 'director'

* **Quand** `urlFilter` est `/director/id22298/filter?id=1`  
**Alors** `DQLTable.convertDQLClassToDQLTableAlias` prend en `parameter` `Director`(FilterClass.getClass)
**Et** `return` 'director'

* **Quand** `urlFilter` est `/director-type/filter?id=1`  
**Alors** `DQLTableAlias.convertDQLClassToDQLTableAlias` prend en `parameter` `Director`(FilterClass.getClass)
**Et** `return` 'director_type'

## Information

Cette class convertit le nom d'une class en alias de DQLTable.

## Zone développeur

DQLTableAlias est appelée par:  

* DQLClauseSelect