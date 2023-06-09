## Feature

* **Quand** `urlFilter` est `/director/filter?id=1`    
**Alors** `FilterClass.getClass()` prend en `parameter` `/director/filter?id=1`  
**Et** `return` 'director'  

* **Quand** `urlFilter` est `/director/id498549/filter?id=1`    
**Alors** `FilterClass.getClass()` prend en `parameter` `/director/filter?id=1`  
**Et** `return` 'director' 

* **Quand** `urlFilter` est `/director-type/filter?id=1`    
**Alors** `FilterClass.getClass()` prend en `parameter` `/director-type/filter?id=1`  
**Et** `return` 'director-type' 

## Information

Cette classe trouve depuis l'url du filtre le nom de class. Puis elle convertit ce nom de class en nom DQL.

Signature de méthode => `FilterClass.getClass(string $urlFilter): string`

## Zone du développeur
 
 FilterClass appelle:  

* ValidateDQLClass.throwErrorIfClassNotExist() => void 
