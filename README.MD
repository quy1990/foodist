## Clone project
    git clone https://github.com/quy1990/foodist && cd foodist/

## Install composer:

    composer install

## Convert
### convert to csv:

    php bin/console app:convert tests\Command\test.xml csv

## convert to excel:

    php bin/console app:convert tests\Command\test.xml excel

## convert to json:

    php bin/console app:convert tests\Command\test.xml json
