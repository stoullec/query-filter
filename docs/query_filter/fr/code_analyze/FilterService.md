## Feature

* **Quand** `urlFilter` est `/director/filter?id=1`    
**Alors** `QueryFilterService.getDQL()` prend en `parameter` `request`(Request)  
**Et** `return` 
```sql
SELECT director FROM App\Entity\Director director WHERE director.id = 1;
```  

## Information

Cette classe est appelée par les controllers de type GET, de méthode getFilter.  

Exemples:
DirectorController.getFilter(), PersonTypeController.getFilter etc...  

Cette classe renvoie la requête DQL complète.  


## Zone du développeur

QueryFilterService appelle:  

* DQLClauseSelect.getDQL() => SELECT director   
* DQLClauseFrom => getDQL() => FROM App\Entity\Director   
* DQLFormatUtil => getListOfFilterFomUrlFilter() => [' director.first_name = "Marc"', 'director.last_name = "MAHE"']  
* DQLClauseWhere => getDQL() => WHERE director.last_name = 'TOULLEC'  