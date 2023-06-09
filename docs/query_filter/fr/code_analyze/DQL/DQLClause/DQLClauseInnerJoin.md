**Quand** `urlFilter` est `/director/filter?personType[eq]=Director`  
**Alors** `DQLClauseInnerJoin.get` prend en `parameter` `['personType[eq]=Director'], 'director'`
**Et** `return` ''

**Quand** `urlFilter` est `/director/filter?personType.name[eq]=Director`  
**Alors** `DQLClauseInnerJoin.get` prend en `parameter` `['personType.name[eq]=Director'], 'director'`
**Et** `return` 'INNER JOIN director.personType person_type'

**Quand** `urlFilter` est `/director/filter?personType.name[eq]=Director[and]personType.ref[eq]=Reference`  
**Alors** `DQLClauseInnerJoin.get` prend en `parameter` `['personType.name[eq]=Director','personType.ref[eq]=Reference'], 'director'`
**Et** `return` 'INNER JOIN director.personType person_type'

**Quand** `urlFilter` est `/director/filter?personType.type.name[eq]=Director`  
**Alors** `DQLClauseInnerJoin.get` prend en `parameter` `['personType.type.name[eq]=Director'], 'director`
**Et** `return` 'INNER JOIN director.personType person_type INNER JOIN person_type.type type'

## Information

Cette classe est appelée par QueryFilterService qui va initialiser après le `DQLClauseFrom` tous les INNER JOIN existants, sinon "".

Elle prend en paramètre une `listOfFilter` et un `tableAlias`.

Signature de méthode => `DQLClauseInnerJoin.getDQL():string`

Exemples:

```sql
INNER JOIN persony_type ON persony_type.id = director.persony_type_id

```

## Zone du développeur

`DQLClauseInnerJoin.getDQL(array listOfFilter):string ` est appelée par QueryFilterService.  
`DQLClauseInnerJoin.isFilterIsInnerJoin(string $filter): bool` est appelée par DQLFormatUtil.
