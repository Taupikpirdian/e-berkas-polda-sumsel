# CJS Sumsel

Aplikasi CJS Polda Sumsel

## Getting started

-   php artisan key:generate
-   composer install
-   composer dump-autoload
-   php artisan optimize
-   php artisan config:clear

## Create User Dari Awal

-   Create Seeder Kategori Bagian
-   Run Seeder KategoriBagianTurunanTableSeeder
-   Create Seeder User

## menggunakan db local

-   php artisan migrate
-   php artisan db:seed

## Region

## Setup API Whatsapp Twilio

1. composer require twilio/sdk

## Setup Password PDF

1. https://packagist.org/packages/devraeph/laravel-pdf-protect

## Data Telegram ID

1. Add bot to group telegram
2. Send Message To Group telegram /my_id @crimy_polda_sumbar_bot
3. Akses https://api.telegram.org/bot1665981374:AAElQue-hYGSwqeuwhxONwIQOsgn0n7GvCQ/getUpdates
4. Result:
   {
   "ok": true,
   "result": [{
   "update_id": 83639885,
   "message": {
   "message_id": 358,
   "from": {
   "id": 697990499,
   "is_bot": false,
   "first_name": "Taupik",
   "last_name": "Pirdian",
   "username": "piridin"
   },
   "chat": {
   "id": -616649803,
   "title": "Monitoring Ditlantas Sumsel",
   "type": "group",
   "all_members_are_administrators": true
   },
   "date": 1643953407,
   "group_chat_created": true
   }
   }, {
   "update_id": 83639886,
   "message": {
   "message_id": 359,
   "from": {
   "id": 697990499,
   "is_bot": false,
   "first_name": "Taupik",
   "last_name": "Pirdian",
   "username": "piridin"
   },
   "chat": {
   "id": -753187396,
   "title": "Monitoring CJS Sumsel",
   "type": "group",
   "all_members_are_administrators": true
   },
   "date": 1643953454,
   "group_chat_created": true
   }
   }, {
   "update_id": 83639887,
   "message": {
   "message_id": 360,
   "from": {
   "id": 697990499,
   "is_bot": false,
   "first_name": "Taupik",
   "last_name": "Pirdian",
   "username": "piridin"
   },
   "chat": {
   "id": -753187396,
   "title": "Monitoring CJS Sumsel",
   "type": "group",
   "all_members_are_administrators": true
   },
   "date": 1643953631,
   "new_chat_participant": {
   "id": 668342259,
   "is_bot": true,
   "first_name": "Shiyinq Bot",
   "username": "ShiyinqBot"
   },
   "new_chat_member": {
   "id": 668342259,
   "is_bot": true,
   "first_name": "Shiyinq Bot",
   "username": "ShiyinqBot"
   },
   "new_chat_members": [{
   "id": 668342259,
   "is_bot": true,
   "first_name": "Shiyinq Bot",
   "username": "ShiyinqBot"
   }]
   }
   }, {
   "update_id": 83639888,
   "message": {
   "message_id": 361,
   "from": {
   "id": 697990499,
   "is_bot": false,
   "first_name": "Taupik",
   "last_name": "Pirdian",
   "username": "piridin"
   },
   "chat": {
   "id": -501932091,
   "title": "MappingCrime-Report",
   "type": "group",
   "all_members_are_administrators": true
   },
   "date": 1643953683,
   "text": "/dbg",
   "entities": [{
   "offset": 0,
   "length": 4,
   "type": "bot_command"
   }]
   }
   }, {
   "update_id": 83639889,
   "my_chat_member": {
   "chat": {
   "id": -616649803,
   "title": "Monitoring Ditlantas Sumsel",
   "type": "group",
   "all_members_are_administrators": true
   },
   "from": {
   "id": 697990499,
   "is_bot": false,
   "first_name": "Taupik",
   "last_name": "Pirdian",
   "username": "piridin"
   },
   "date": 1643953407,
   "old_chat_member": {
   "user": {
   "id": 1665981374,
   "is_bot": true,
   "first_name": "Crimy",
   "username": "crimy_polda_sumbar_bot"
   },
   "status": "left"
   },
   "new_chat_member": {
   "user": {
   "id": 1665981374,
   "is_bot": true,
   "first_name": "Crimy",
   "username": "crimy_polda_sumbar_bot"
   },
   "status": "member"
   }
   }
   }, {
   "update_id": 83639890,
   "my_chat_member": {
   "chat": {
   "id": -753187396,
   "title": "Monitoring CJS Sumsel",
   "type": "group",
   "all_members_are_administrators": true
   },
   "from": {
   "id": 697990499,
   "is_bot": false,
   "first_name": "Taupik",
   "last_name": "Pirdian",
   "username": "piridin"
   },
   "date": 1643953454,
   "old_chat_member": {
   "user": {
   "id": 1665981374,
   "is_bot": true,
   "first_name": "Crimy",
   "username": "crimy_polda_sumbar_bot"
   },
   "status": "left"
   },
   "new_chat_member": {
   "user": {
   "id": 1665981374,
   "is_bot": true,
   "first_name": "Crimy",
   "username": "crimy_polda_sumbar_bot"
   },
   "status": "member"
   }
   }
   }]
   }

# Web Sidokter

Url: https://sidokter.kejaksaanri.id/adm
Akun:
username : kejati@gmail.com
passwordnya : 12345

# Web Sniper

Url: http://sniper.pn-lubuklinggau.go.id/
User : testerpolisi@test.com
pass : 123456

# punya baceng

DB_CONNECTION=mysql
DB_HOST=localhost:8889
DB_PORT=8889
DB_DATABASE=cjs-sumsel
DB_USERNAME=root
DB_PASSWORD=root

# akun testing taupik

email: kepolisian01@yopmail.com
email: kejaksaan03@yopmail.com

# Penamaan Table Master

m_nametable
