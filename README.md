`Period` is a library that extends `CarbonPeriod` to supply new customized methods. All of the `CarbonPeriod` functionality is available too.

You can find the `CarbonPeriod` documentation [here](https://carbon.nesbot.com/docs/#api-period).

# Installation
```sh
composer require rflex/period
```

# Usage
Import the class:
```php
use Rflex\Period;
```

# Available methods


## addDay() and addDays($days)
Add one or a number of days to the period.
```php
$period->addDay();
$period->addDays(5);
```

## subDay() and subDays($days)
Subtract one or a number of days to the period.
```php
$period->subDay();
$period->subDays(3);
```

## getMinutes()
Returns the total number of minutes of the period.
```php
$period->getMinutes();
```

## getHours()
Returns the total number of hours of the period.
```php
$period->getHours();
```

## overlappedMinutes($period)
Get the shared minutes between two periods if any.
```php
$period = Period::between(Carbon::now(), Carbon::now()->addDay());
$period2 = Period::between(carbon::now(), Carbon::now()->addDays(2));
$period->overlappedMinutes($period2);
// returns 1440 minutes
```

## touches($period)
Checks if a period overlaps with another period, despite the amount of overlapped time.
```php
$period = Period::between(Carbon::now(), Carbon::now()->addDay());
$period2 = Period::between(carbon::now(), Carbon::now()->addDays(2));
$period->touches($period2);
// returns true
```

## setLengthInMinutes($minutes)
Set the length of the period in minutes from the start.
```php
$period->setLengthInMinutes(700);
```

## setLengthInHours($hours)
Set the length of the period in hours from the start.
```php
$period->setLengthInHours(48);
```
