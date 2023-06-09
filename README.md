## Vocabulaire DQL:

| Libellé         | Exemple d'implementation                                                                                 |
| --------------- | -------------------------------------------------------------------------------------------------------- |
| Table           | App\Entity\Director                                                                                      |
| Clause          | WHERE                                                                                                    |
| Filter operator | >                                                                                                        |
| Logic operator  | AND                                                                                                      |
| DQL property    | first_name                                                                                               |
| DQL class       | Director                                                                                                 |
| DQL table       | App\Entity\Director                                                                                      |
| Column          | director.salary                                                                                          |
| DQLQuery        | SELECT director FROM APP\Entity\Director WHERE director.salary > 1500 AND director.first_name = 'Simon'; |

## Vocabulaire Filter:

| Libellé         | Exemple d'implementation |
| --------------- | ------------------------ |
| Filter class    | director-type            |
| Filter property | lastName                 |
| Logic operator  | [and]                    |
| Filter operator | greater than = [gt]      |
| Logic operator  | [and]                    |
| URL             | /director/filter?id=1    |
| url_filter      | /director/filter?id=1    |
| Filter          | firstName[eq]=Simon      |

## Filter

Le `url_filter` doit respecter certains formats:

- L'entity(`FilterClass`) sur laquelle vous filtrez doit être en format 'my-entity'
  Exemple:
  Entity = Director => URL = /director/filter?id=1
  Entity = DirectorType => URL = /director-type/filter?id=1

- La property sur laquelle vous filtrez doit être en format camelCase 'myProperty'
  Exemple:
  Property = name => URL = /director/filter?name=Simon
  Property = firstName => URL = /director-type/filter?firstName=Simon

- Le `filter_operator` doit être en format '[filteroperator]='
  Exemple:
  Operator = equal => URL = /director/filter?firstName[eq]=Simon
  Operator = not equal => URL = /director-type/filter?firstName[not:eq]=Simon

- Le `logic_operator` doit être en format '[logicoperator]='
  Exemple:
  Operator = and => URL = /director/filter?firstName[eq]=Simon[and]=lastName[eq]=MAHE

## Liste des `filter_operator`

| Libellé                | Utilisation | Exemple SQL          |
| ---------------------- | ----------- | -------------------- |
| Between                | [btw]=      | BETWEEN 1 AND 2      |
| Contain                | [ctn]=      | LIKE "%value%"       |
| End with               | [ew]=       | LIKE "%value"        |
| Equal                  | [eq]=       | = "value"            |
| Greater equal than     | [gte]=      | >= "value"           |
| Greater than           | [gt]=       | > "value"            |
| Smaller equal than     | [ste]=      | >= "value"           |
| Smaller than           | [st]=       | > "value"            |
| Start with             | [sw]=       | LIKE "value%"        |
| Sort                   | [sort]=     | ORDER BY property    |
| Not Between            | [not:btw]=  | NOT(BETWEEN 1 AND 2) |
| Not Contain            | [not:ctn]=  | NOT(LIKE "%value%")  |
| Not End with           | [not:ew]=   | NOT(LIKE "%value")   |
| Not Equal              | [not:eq]=   | NOT(= "value")       |
| Not Greater equal than | [not:gte]=  | NOT(>= "value")      |
| Not Greater than       | [not:gt]=   | NOT(> "value")       |
| Not Smaller equal than | [not:ste]=  | NOT(>= "value")      |
| Not Smaller than       | [not:st]=   | NOT(> "value")       |
| Not Start with         | [not:sw]=   | NOT(LIKE "value%")   |

## Liste des `logic_operator`

| Libellé | Utilisation | Exemple SQL                        |
| ------- | ----------- | ---------------------------------- |
| And     | [and]=      | AND entity.property = "value"      |
| Or      | [or]=       | OR entity.property = "value"       |
| Not And | [not:and]=  | AND NOT(entity.property = "value") |
| Not Or  | [not:or]=   | OR NOT(entity.property = "value")  |

## Zone du développeur

DQLClauseSelect => get() => SELECT director  
DQLClauseFrom => get() => FROM App\Entity\Director  
DQLClauseInnerJoin => get() => null| INNER JOIN person_type ON person_type.id = director.person_type_id  
DQLClauseWhere => getListOfFilterFromUrl()

Les fichiers sont séparés en deux parties: par Filter et par DQL.

La partie Filter représente les informations côté Symfony tel que 'SELECT', clauses WHERE etc...Dès qu'on aura besoin d'une information lié à DQL pour la réalisation de la requête DQL, alors on lancera des appels dans le dossier Filter.

La partie DQL représente les informations côté Symfony tel que 'App\Entity\...', nom des property etc...Dès qu'on aura besoin d'une information lié à Symfony pour la réalisation de la requête DQL, alors on lancera des appels dans le dossier Filter.

## A faire

// TODO transformer en package: je peux utiliser ismail1432/skeletn-bundle

// TODO réaliser la documentation en anglais

// TODO faire le sort
