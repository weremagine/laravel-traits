Below is an example of fields to add within a migration, to parse and store extra details.

```php
$table->text('agent');
$table->string('platform')->nullable();
$table->string('platform_version')->nullable();
$table->string('browser')->nullable();
$table->string('browser_version')->nullable();
$table->string('device')->nullable();
$table->string('device_name')->nullable();
```