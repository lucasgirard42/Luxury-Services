# LUXURY SERVICES

![diagram](diagram/db.svg)


## wizard creation entity
```shell
php bin/console make:entity
```
## afficher les routes definies
```shell
php bin/console debug:route
```
## pour la compatiblité de route sous win avec laragon
```shell
 composer require symfony/apache-pack 
```

## symfony error convert objet to string
```shell
        public  function __toString()
    {
        return $this->getName();
    }
```

## pour construit un crud
```shell
    php bin/console make:crud
```