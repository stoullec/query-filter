## Feature

* **Etant donné que** mon dossier App\Entity contient la classe Director  
**Quand** `urlFilter` est `/director/filter?id=1`  
**Alors** `ValidateDQLClass.throwErrorIfClassNotExist()` prend en `parameter` 'Director'  


* **Etant donné que** mon dossier App\Entity contient la classe Director  
**Quand** `urlFilter` est `/bonjour/filter?id=1`  
**Alors** `ValidateDQLClass.throwErrorIfClassNotExist()` prend en `parameter` 'Bonjour'  
**Et** lance une exception: `httpCode` = '400', `messageError` = '[bonjour] Le nom de class du filtre n'existe pas.'  


## Information

Cette class réalise des validations sur le nom de class.

Signature de méthode => `ValidateDQLClass.throwErrorIfClassNotExist(string $dqlTable): void`