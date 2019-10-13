# Bowling algoritme opgave

Opgaven er løst ved brug af docker, apache, php, composer og php unit.

Den er implementeret som en apache web service der kører i en docker på  `localhost:8080`

# Forudsætninger
* en installeret docker version der er kompatibel med version 19.03.2
* en installeret docker-compose version der er kompatibel med version 1.24.1
* port 9000 på maskinen må ikke være i brug, da den skal bruges af php.

# Algoritme kode

Koden til algoritmen kan findes i folderen:  
 `php/app/BowlingScore/SumsCalculator.php`

# Configurering af webservice
Hvis der er behov for at løsningen kører på en anden port end 8080 kan man ændre konfigurationen.

Dette gøres ved at ændre `PORT` i `.env` filen

Hvis servicen allerede er startet skal den genstartes.

# Service start og genstart 

`docker-compose up --build -d`


# Test af algoritme
Algoritme testen er implementeret ved brug af phpunit.

Test koden kan findes i folderen:  
`tests/SumsCalculatorTest.php`

For at køre testen skal servicen først være startet.

Kørsel af testen gøres med kommandoen:  
 `docker-compose exec php vendor/bin/phpunit`

