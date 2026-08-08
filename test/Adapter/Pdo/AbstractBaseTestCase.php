<?php // phpcs:disable WebimpressCodingStandard.NamingConventions.AbstractClass.Prefix

namespace LaminasTest\ApiTools\OAuth2\Adapter\Pdo;

use Laminas\ApiTools\OAuth2\Adapter\PdoAdapter;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Override;
use ReflectionException;
use ReflectionProperty;

use function file_get_contents;

abstract class AbstractBaseTestCase extends AbstractHttpControllerTestCase
{
    #[Override]
    protected function setUp(): void
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../TestAsset/pdo.application.config.php'
        );

        parent::setUp();

        $serviceManager = $this->getApplication()->getServiceManager();
        $serviceManager->setAllowOverride(true);
    }

    /**
     * @psalm-return array<array-key, array{0: PdoAdapter}>
     * @throws ReflectionException
     */
    /**
     * Builds the PDO storage adapter and loads the SQL fixture.
     *
     * This was previously a @dataProvider, but it depends on instance state
     * (setUp() and the booted application), which PHPUnit 11 forbids: data
     * providers must be static. Tests call it directly instead.
     */
    protected function createStorage(): PdoAdapter
    {
        $serviceManager = $this->getApplication()->getServiceManager();
        $pdo            = $serviceManager->get(PdoAdapter::class);

        $r  = new ReflectionProperty($pdo, 'db');
        $db = $r->getValue($pdo);

        $sql = file_get_contents(__DIR__ . '/../../TestAsset/database/pdo.sql');
        $db->exec($sql);

        return $pdo;
    }
}
