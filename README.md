`Period` is a library that extends `CarbonPeriod` to supply new customized methods.

You can find the `CarbonPeriod` documentation [here](https://carbon.nesbot.com/docs/#api-period).

# Installation & Usage
```sh
composer require rflex/period
```

Import the class:
```php
use Rflex\Period;
use Rflex\Event; // Extension of the Carbon class.
```

# Testing
## PHPUnit
```bash
./vendor/phpunit/phpunit/phpunit
```

## PHPStan
```bash
./vendor/bin/phpstan analyse
```

# Available methods

## addDay() and addDays($days): void
Add one or a number of days to the period.
```php
$period->addDay(true, false); // Add a day to the start of the period.
$period->addDays(5, true, false); // Add five days to the start of the period.
```

## subDay() and subDays($days): void
Subtract one or a number of days to the period.
```php
$period->subDay(false, true); // Subtract a day to the end of the period.
$period->subDays(3, false, true); // Subtract three days to the end of the period.
```

## getSeconds(): int
Returns the total number of seconds of the period.
```php
$period->getSeconds();
```

## getMinutes(): int
Returns the total number of minutes of the period.
```php
$period->getMinutes();
```

## getHours(): int
Returns the total number of hours of the period.
```php
$period->getHours();
```

## union($period, $intersects): Period
Returns a new Period that is the sum of another two Periods. By default it will sum two periods without
validating if they intersect. With the `$intersects` in `true` you can specify that you only need
to sum two periods that intersect with each other.
```php
$period = Period::between(Carbon::now(), Carbon::now()->addDay());
$period2 = Period::between(carbon::now(), Carbon::now()->addDays(2));
$unifiedPeriod = $period->union($period2); // Returns a new unified Period.
```

## intersection($period): Period
Get the shared period between two other periods.
```php
$period = Period::between(Carbon::now(), Carbon::now()->addDay());
$period2 = Period::between(carbon::now(), Carbon::now()->addDays(2));
$intersection = $period->intersection($period2); // Returns a new intersected Period.
```

## intersects($period): bool
Checks if a period intersects with another.
```php
$period = Period::between(Carbon::now(), Carbon::now()->addDay());
$period2 = Period::between(carbon::now(), Carbon::now()->addDays(2));
$period->intersects($period2); // Returns true.
```

## difference($period): array|null
Returns the difference between two Periods. This function can return more than one Period
if the original Period was cut in different pieces.
`[totalLengthInSeconds, 'periods' => []]`
```php
$period = Period::between(Carbon::now(), Carbon::now()->addDay());
$period2 = Period::between(carbon::now(), Carbon::now()->addDays(2));
$unifiedPeriod = $period->difference($period2); // Returns an array.
```

## differenceWithEvent($event, $point): int
Returns the difference in seconds between a Period and an Event. The comparison is between the Event
and a point of the Period. 0 = start, 1 = end.
```php
$period = Period::between(Carbon::now(), Carbon::now()->addDay());
$event = Event::create(carbon::now());
$seconds = $period->differenceWithEvent($event); // Returns the difference between the two in seconds.
```

## setLengthInSeconds($seconds): void
Set the length of the period in seconds from the start.
```php
$period->setLengthInSeconds(3600);
```

## setLengthInMinutes($minutes): void
Set the length of the period in minutes from the start.
```php
$period->setLengthInMinutes(700);
```

## setLengthInHours($hours): void
Set the length of the period in hours from the start.
```php
$period->setLengthInHours(48);
```
