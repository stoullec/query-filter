## Feature

* **Quand** `urlFilter` est `/director/filter?id=1`  
**Alors** `DQLClass.getClass` prend en `parameter` `/director/filter?id=1`
**Et** `return` 'Director'

* **Quand** `urlFilter` est `/director/id22298/filter?id=1`  
**Alors** `DQLClass.getClass` prend en `parameter` `/director/id22298/filter?id=1`
**Et** `return` 'Director'

* **Quand** `urlFilter` est `/director-type/filter?id=1`  
**Alors** `DQLClass.getClass` prend en `parameter` `/director-type/filter?id=1`
**Et** `return` 'DirectorType'

## Information

Cette class convertit une class en DQL.

Signature de méthode => `DQLClass.getClass(string $urlFilter): string`