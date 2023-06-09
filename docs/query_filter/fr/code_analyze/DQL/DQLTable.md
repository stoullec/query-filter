## Feature

* **Quand** `urlFilter` est `/director/filter?id=1`  
**Alors** `DQLTable.convertDQLClassToDQLTable` prend en `parameter` `Director`(DQLClass.getClass)
**Et** `return` 'App\Entity\Director'

* **Quand** `urlFilter` est `/director/id22298/filter?id=1`  
**Alors** `DQLTable.convertDQLClassToDQLTable` prend en `parameter` `Director`(DQLClass.getClass)
**Et** `return` 'App\Entity\Director'

## Information

Cette class convertit une class en DQL.

Signature de méthode => `DQLTable.convertDQLClassToDQLTable(string $dqlClass): string`