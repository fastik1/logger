# Logger

### Install
- composer require fastik1/logger

### Usage
```php
<?php

require_once 'vendor/autoload.php';

use Fastik1\Logger\Logger;

Logger::setPath('logs'); // Default value
Logger::setExtension('.log'); // Default value
Logger::setDateFormat('d.m.Y H:i:s'); // Default value

Logger::add('errors', 'Fatal error...', ['info' => 'your info', 'data' => 'your data']);
```
### Result: logs/errors.log
```
    [01.01.2023 00:00:00] Fatal error... | Context: {"info":"your info","data":"your data"}
```