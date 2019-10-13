# Bowling algoritme opgave

Opgaven er løst ved brug af docker, apache, php, composer og php unit.

Den er implementeret som en web service der køre i en docker på  `localhost:8080`

# Algoritme kode

Koden til algoritmen kan findes i folderen:  
 `php/app/BowlingScore/SumsCalculator.php`

# Configurering af webservice
Hvis der er behov for at løsningen kører på en anden port end 8080 kan man ændre konfigurationen.

Dette gøres ved at ændre `PORT` i `.env` filen

Hvis servicen allerede er started skal den genstartes.

# Service start og genstart 

`docker-compose up --build -d`


**Test af algoritme**
Algoritme testen er implementeret ved brug af phpunit.

Test koden kan findes i folderen:  
`tests/SumsCalculatorTest.php`

For at køre testen skal servicen først være startet.

Kørsel af testen gøres med kommandoen:  
 `docker-compose exec php vendor/bin/phpunit`

