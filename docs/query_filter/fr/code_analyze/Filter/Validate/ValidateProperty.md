## Feature

* **Etant donné que** mon entity Director contient la property 'id'  
**Quand** `urlFilter` est `/director/filter?id=1`  
**Alors** `ValidateFilterProperty.throwErrorIfPropertyNotExist()` prend en `parameter` 'id'  


* **Etant donné que** mon entity Director contient la property 'id'
**Quand** `urlFilter` est `/director/filter?bonjour=1`  
**Alors** `ValidateFilterProperty.throwErrorIfPropertyNotExist()` prend en `parameter` 'bonjour'  
**Et** lance une exception: `httpCode` = '400', `messageError` = 'Erreur: [bonjour] Le nom de property du filtre n'existe pas.'  


## Information

Cette class réalise des validations sur le propriété de class.

Signature de méthode => `ValidateFilterProperty.throwErrorIfPropertyNotExist(string $filterProperty): void`
 