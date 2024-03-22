# WCMSPolls
A Laravel package to manage polls on Darkpony Barb CMS


## Installation:
First, install the package through Composer. 

```bash
composer require darkperis/wcms-polls
```

Publish migrations, and migrate

```bash
php artisan vendor:publish
php artisan migrate
```

___


### Set up the admin middleware's name
A wcmspolls_config.php file will be added where you can put the name of the middleware used to protect the access and other things like pagination and prefix to protect your routes
Add this line in the .env too

```php
POLL_ADMIN_AUTH_MIDDLEWARE = auth
POLL_ADMIN_AUTH_GUARD = web
POLL_PAGINATION = 10
POLL_PREFIX = custompath
```
## Manage polls via Polls dashboard

## FRONT END USE
Specify the ID of the poll 

```php
{{ PollWriter::draw(Darkpony\WCMSPolls\Poll::find([POLL_ID])) }}
```
### Override views
You can override the views related to the results page and both pages checkbox/radio via the same wcmspolls_config.php file in the config folder.

#### Route of the vote action
``` php
{{ route('poll.vote', $id) }}
```

#### Data passed to result view
- $question : the question of the poll
- $options : array of objects holding (name, percent, votes).
#### Data passed to the poll checkbox/radio
- $question : the question
- $options : holding the name and id of the option.


## Warning - This is a private use package.

## Warning - Do not use outside Darkpony Digital.