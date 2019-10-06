# INSTALLATION
`composer require dawid-bednarz/sf-status-bundle`

####1. Create entities file
```php
namespace App\Entity;

use DawBed\StatusBundle\Entity\AbstractStatus as Base;

class Status extends Base
{
}
```
#### 2. Create status_bundle.yaml in your ~/config/packages directory
```yaml
dawbed_status_bundle:
    entities:
      DawBed\StatusBundle\Entity\AbstractStatus: 'App\Entity\Status'
```
# CONFIGURATION
#### Add your Context types (required)
```yaml
dawbed_status_bundle:
  statuses:
    userConfirmated:
      name: 'User Confirmated'
      groups: ['user']
```
Purpose of this is protection against duplication or overwriting statuses. 
Defined types is real unique key in your Context table.

#COMMANDS

`php bin/console dawbed:status:update` - run after add/update status in config file