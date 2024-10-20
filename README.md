## Установка:
В консоли выполнить make install

Для определения страны по номеру телефона используется внешний API.
Необходимо получить api_key в сервисе https://htmlweb.ru/geo/api.php/ и вставить его в .env


## Поднять проект:
В консоли выполнить make up


## Описание CRUD API

### Create:
url: localhost/api/visitor/create

params:{
name,
surname,
email,
phone(просто набор цифр без пробелов и каких-либо знаков),
country(В качестве страны принимается iso код)

return: visitor_id

### Update:
url: localhost/api/visitor/update

params:{
id,
name,
surname,
email,
phone(просто набор цифр без пробелов и каких-либо знаков),
country(В качестве страны принимается iso код)

return: message = 'success'

### Get:
url: localhost/api/visitor/get

params:{
id,

return: array

### Delete:
url: localhost/api/visitor/delete

params:{
id,

return: message = 'success'


