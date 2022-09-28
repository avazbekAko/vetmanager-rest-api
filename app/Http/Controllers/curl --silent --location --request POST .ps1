curl --silent --location --request POST 'https://devlaravel.vetmanager.ru/rest/api/pet' \
--header 'X-REST-API-KEY: b2720694a3a218bd59f59380b24bb4a5' \
--header 'Content-Type: application/json' \
--data-raw '{
     "owner_id":8,
     "alias":"Матроскин",
     "type_id": 13,
     "breed_id":444
}'