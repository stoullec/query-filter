## Recherche par `urlFilter` = `/director/filter?firstName[eq]=Laurent` // [x]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Jacques",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par `urlFilter` = `/director/filter?firstName[eq]=Laurent`  
**Alors** j'affiche

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name = 'Laurent'
AND director.last_name='TOULLEC'
;
```

# Recherche avec une valeur égale à un `operator` // [ ]

## Recherche par `urlFilter` = `/director/filter?firstName[eq]=[btw]=` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]=[btw]=`  
**Alors** j'affiche

```json
Erreur: [[btw]=] Le filtre est incorrect. Veuillez l'entourer de guillemets.
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]="[btw]="` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "[btw]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]="[btw]="`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "[btw]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name = '[btw]='
;
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]=[ctn]=` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]=[ctn]=`  
**Alors** j'affiche

```json
Erreur: [[ctn]=] Le filtre est incorrect. Veuillez l'entourer de guillemets.
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]="[ctn]="` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "[ctn]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]="[ctn]="`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "[ctn]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name = '[ctn]='
;
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]=[ew]=` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]=[ew]=`  
**Alors** j'affiche

```json
Erreur: [[ew]=] Le filtre est incorrect. Veuillez l'entourer de guillemets.
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]="[ew]="` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "[ctn]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]="[ew]="`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "[ew]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name = '[ew]='
;
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]="[ew]="` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]=[gte]=`  
**Alors** j'affiche

```json
Erreur: [[gte]=] Le filtre est incorrect. Veuillez l'entourer de guillemets.
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]="[gte]="` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "[ctn]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]="[gte]="`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "[gte]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name = '[gte]='
;
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]=[gt]=` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]=[gt]=`  
**Alors** j'affiche

```json
Erreur: [[gt]=] Le filtre est incorrect. Veuillez l'entourer de guillemets.
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]="[gt]="` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "[gt]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]="[gt]="`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "[gt]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name = '[gt]='
;
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]=[ste]=` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]=[ste]=`  
**Alors** j'affiche

```json
Erreur: [[ste]=] Le filtre est incorrect. Veuillez l'entourer de guillemets.
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]="[ste]="` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "[ste]=",
    "lastName": "TOULLEC"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]="[ste]="`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "[ste]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name = '[ste]='
;
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]=[st]=` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]=[st]=`  
**Alors** j'affiche

```json
Erreur: [[st]=] Le filtre est incorrect. Veuillez l'entourer de guillemets.
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]="[st]="` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "[ste]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]="[st]="`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "[st]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name = '[st]='
;
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]=[sw]=` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "Marc",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]=[sw]=`  
**Alors** j'affiche

```json
Erreur: [[st]=] Le filtre est incorrect. Veuillez l'entourer de guillemets.
```

## Recherche par `urlFilter` = `/director/filter?firstName[eq]="[sw]="` // [ ]

- **Depuis** `/director/`  
  **Etant donné que**

```json
[
  {
    "id": "1",
    "firstName": "Laurent",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  },
  {
    "id": "2",
    "firstName": "[sw]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Quand** je cherche par le filtre `/director/filter?firstName[eq]="[sw]="`  
**Alors** j'affiche

```json
[
  {
    "id": "2",
    "firstName": "[sw]=",
    "lastName": "TOULLEC",
    "birthDate": "1995-05-05"
  }
]
```

**Et** la `QueryFilterService.getDQL()` =

```sql
SELECT director
FROM App\Entity\director director
WHERE director.first_name = '[sw]='
;
```
