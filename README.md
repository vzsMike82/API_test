Basic API for test
========================

- This Project is based on Symfony 3.4
- Minimum PHP 5.5+

Install
------------------------
- Composer Install (needed)
- SET (dbname and user, pass) /app/config/parameters.yml 
- Need to create manually a DB without any table
- on project root in CLI run 'php app/console doctrine:schema:update --force' or import DB dump
- give permission to project especially var, web, vendor folders

Symfony vhsot settings:
------------------------
The most important part is '/web'

#<VirtualHost *:80>
#    DocumentRoot "project_root/web"
#    ServerName project
#        <Directory "project root /web">
#            Options Indexes FollowSymLinks
#            RewriteEngine On
#            RewriteCond %{HTTP:Authorization} ^(.*)
#            RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
#        AllowOverride All
#        Order allow,deny
#        Allow from all
#        </Directory>
#</VirtualHost>

More information:
------------------------
Setup helper: https://symfony.com/doc/3.4/setup.html





------------------------
API calls:
------------------------

- POST {{host}}/payment
// id is generated
Request Body:
{
    "name":  "Test111",
    "type":  "dd",
    "iban":  "IBAN23565154544161",
    "expiry": "2018-11-12",
    "cc":    "1334",
    "ccv":   "12435"
}

- POST {{host}}/charge
// id is generated
Request Body:
{
    "payment_id": "2",
    "amount": "50.12"
}

- GET {{host}}/charge

Response
[
    {
        "id": 1,
        "payment_id": 1,
        "amount": 11.98
    },
    {
        "id": 2,
        "payment_id": 1,
        "amount": 59.06
    }
]

- GET {{host}}/charge/1
Response
{
     "id": 1,
     "payment_id": 1,
     "amount": 11.98
}
