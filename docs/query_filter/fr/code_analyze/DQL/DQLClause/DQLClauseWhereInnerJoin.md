**Quand** `urlFilter` est `/director/filter?personType.name[eq]=Director`  
**Alors** `DQLClauseInnerJoin.get` prend en `parameter` `personType.name[eq]=Director`, `[eq]=`, `Director`
**Et** `return` "person_type.name = 'Director'"

**Quand** `urlFilter` est `/director/filter?personType.type.name[eq]=Director`  
**Alors** `DQLClauseInnerJoin.get` prend en `parameter` `personType.type.name[eq]=Director`
**Et** `return` "type.name = 'Director'"

**Quand** `urlFilter` est `/director/filter?lastName[eq]=TOULLEC[and]personType.type.name[eq]=Director`  
**Alors** `DQLClauseInnerJoin.get` prend en `parameter` `personType.type.name[eq]=Director`
**Et** `return` "type.name = 'Director'"

## Information

Elle est appelée depuis DQLFormatUtil pour vérifier si le `filter` est un INNER JOIN.

A chaque identification d'un `filter`, on appel `DQLClauseInnerJoin.isFilterPropertyIsInnerJoin(string $filterProperty): bool`. Si `true` alors on ajoute dans `getDQL(string $filter):string`

## Zone du développeur

DQLClauseInnerJoin est appelée par:

`DQLFormatUtil.getListOfFilterFomUrlFilter()`
