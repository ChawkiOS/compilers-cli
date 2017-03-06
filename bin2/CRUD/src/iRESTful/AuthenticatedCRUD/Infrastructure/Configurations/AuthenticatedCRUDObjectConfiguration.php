<?php
namespace iRESTful\AuthenticatedCRUD\Infrastructure\Configurations;
use iRESTful\Entities\Domain\Configurations\EntityConfiguration;

final class AuthenticatedCRUDObjectConfiguration implements EntityConfiguration {

    public function __construct() {

    }

    public function getDelimiter() {
        return '___';
    }

    public function getTimezone() {
        return 'UTC';
    }

    public function getContainerClassMapper() {
        return [                        'combotest' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteCombotest',
    'endpoint' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteEndpoint',
    'api' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteApi',
    'params' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteParams',
    'registration' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteRegistration',
    'resource' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteResource',
    'shared_resource' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteSharedResource',
    'owner' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteOwner',
    'software' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteSoftware',
    'user' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteUser',
    'role' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteRole',
    'permission' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcretePermission'
    ];
    }

    public function getContainerDatabaseNameMapper() {
        return [                        'combotest' => 'pdo',
    'endpoint' => 'pdo',
    'api' => 'pdo',
    'params' => 'pdo',
    'registration' => 'pdo',
    'resource' => 'pdo',
    'shared_resource' => 'pdo',
    'owner' => 'pdo',
    'software' => 'pdo',
    'user' => 'pdo',
    'role' => 'pdo',
    'permission' => 'pdo'
    ];
    }

    public function getInterfaceClassMapper() {
        return [                        'iRESTful\AuthenticatedCRUD\Domain\Entities\Combotest' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteCombotest',
    'iRESTful\AuthenticatedCRUD\Domain\Entities\Endpoint' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteEndpoint',
    'iRESTful\AuthenticatedCRUD\Domain\Entities\Api' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteApi',
    'iRESTful\AuthenticatedCRUD\Domain\Entities\Params' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteParams',
    'iRESTful\AuthenticatedCRUD\Domain\Entities\Registration' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteRegistration',
    'iRESTful\AuthenticatedCRUD\Domain\Entities\Resource' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteResource',
    'iRESTful\AuthenticatedCRUD\Domain\Entities\SharedResource' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteSharedResource',
    'iRESTful\AuthenticatedCRUD\Domain\Entities\Owner' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteOwner',
    'iRESTful\AuthenticatedCRUD\Domain\Entities\Software' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteSoftware',
    'iRESTful\AuthenticatedCRUD\Domain\Entities\User' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteUser',
    'iRESTful\AuthenticatedCRUD\Domain\Entities\Role' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcreteRole',
    'iRESTful\AuthenticatedCRUD\Domain\Entities\Permission' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Entities\ConcretePermission',
    'iRESTful\AuthenticatedCRUD\Domain\Objects\Pattern' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Objects\ConcretePattern',
    'iRESTful\AuthenticatedCRUD\Domain\Objects\ParamPattern' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Objects\ConcreteParamPattern',
    'iRESTful\AuthenticatedCRUD\Domain\Objects\Credentials' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Objects\ConcreteCredentials',
    'iRESTful\AuthenticatedCRUD\Domain\Types\BaseUrls\BaseUrl' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Types\ConcreteBaseUrl',
    'iRESTful\AuthenticatedCRUD\Domain\Types\Keynames\Keyname' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Types\ConcreteKeyname',
    'iRESTful\AuthenticatedCRUD\Domain\Types\Uris\Uri' => 'iRESTful\AuthenticatedCRUD\Infrastructure\Types\ConcreteUri'
    ];
    }

    public function getTransformerObjects() {
        return [    'iRESTful\Libraries\Dates\Domain\Adapters\DateTimeAdapter' => new \iRESTful\Libraries\Dates\Infrastructure\Adapters\ConcreteDateTimeAdapter($this->getTimezone()),
    'iRESTful\Libraries\Ids\Domain\Uuids\Adapters\UuidAdapter' => new \iRESTful\Libraries\Ids\Infrastructure\Adapters\ConcreteUuidAdapter(),
                        'iRESTful\AuthenticatedCRUD\Domain\Types\BaseUrls\Adapters\BaseUrlAdapter' => new \iRESTful\AuthenticatedCRUD\Infrastructure\Types\Adapters\ConcreteBaseUrlAdapter(),
    'iRESTful\AuthenticatedCRUD\Domain\Types\Keynames\Adapters\KeynameAdapter' => new \iRESTful\AuthenticatedCRUD\Infrastructure\Types\Adapters\ConcreteKeynameAdapter(),
    'iRESTful\AuthenticatedCRUD\Domain\Types\Uris\Adapters\UriAdapter' => new \iRESTful\AuthenticatedCRUD\Infrastructure\Types\Adapters\ConcreteUriAdapter()
    ];
    }

}
