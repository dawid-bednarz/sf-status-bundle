# INSTALLATION
`composer require dawid-bednarz/sf-status-bundle`

####1. Create entities file
```php
namespace App\Entity;

use DawBed\PHPStatus\Status as Base;

class Context extends Base
{
}
```
#### 2. Create status_bundle.yaml in your ~/config/packages directory
```yaml
dawbed_status_bundle:
    entities:
      status: 'App\Entity\Status'
```
# CONFIGURATION
#### Add your Context types (required)
```yaml
dawbed_status_bundle:
   types:
       registration: 1
```
Purpose of this is protection against duplication or overwriting statuses. 
Defined types is real unique key in your Context table.