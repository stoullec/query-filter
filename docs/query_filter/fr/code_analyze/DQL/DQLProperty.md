## Feature  

* **Quand** `urlFilter` est `/director/filter?id=1`     
**Alors** `DQLProperty.convertFilterPropertyToDQLProperty()` prend en `parameter` `id`  
**Et** `return` 'id'  

* **Quand** `urlFilter` est `/director/filter?  lastName=TOULLEC`    
**Alors** `DQLProperty.convertFilterPropertyToDQLProperty()` prend en `parameter` `lastName`  
**Et** `return` 'last_name'  

## Information

Cette class convertit la property du filtre en langage DQL.  

Signature de méthode => `DQLProperty.convertFilterPropertyToDQLProperty(string filterProperty): string`

## Zone du développeur

DQLProperty est appelée par:

* DQLSubClauseWhere