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


## Use:

Manage polls via wcms-polls dashboard

and view in blades

```php
{{ PollWriter::draw(Darkpony\WCMSPolls\Poll::find([POLL_ID])) }}
```



## Warning - This is a private use package.

## Warning - Do not use outside Darkpony Digital.