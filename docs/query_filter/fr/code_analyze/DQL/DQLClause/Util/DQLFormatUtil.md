## Feature

* **Quand** le `urlFilter` est `/director/filter?id=1`  
**Alors** `DQLFormatUtil.getListOfFilterFomUrlFilter` prend en `parameter` `/director/filter?id=1`  
**Et** `return` '["director.id[eq]=1"]'


* **Quand** le `urlFilter` est `/director/id22298/filter?firstName[eq]=Marc[and]lastName[eq]=MAHE`  
**Alors** `DQLFormatUtil.getListOfFilterFomUrlFilter` prend en `parameter` `/director/id22298/filter?firstName[eq]=Marc[and]lastName[eq]=MAHE` 
**Et** `return` ["director.first_name[eq]=Marc", "[and]", "director.last_name[eq]=MAHE"]

* **Quand** le `urlFilter` est `/director/filter?firstName[eq]=Marc[and]lastName[eq]=MAHE`  
**Alors** `DQLFormatUtil.getListOfFilterFomUrlFilter` prend en `parameter` `/director/filter?firstName[eq]=Marc[and]lastName[eq]=MAHE` 
**Et** `return` ["director.first_name[eq]=Marc", "[and]", "director.last_name[eq]=MAHE"]

## Information

Cette classe forme des `filter` depuis un `urlFilter`.

Signature de méthode => `DQLFormatUtil.getListOfFilterFomUrlFilter(string $urlFilter): array`

## Zone du développeur

DQLFormatUtil appelle:  

* Analyse sur les `filter_operator` => [firstName[eq]=Marc, lastName[eq]=MAHE]
* Analyse sur les `logic_operator` => [firstName[eq]=Marc, [and], lastName[eq]=MAHE]

DQLFormatUtil est appelée par:

* QueryFilterService