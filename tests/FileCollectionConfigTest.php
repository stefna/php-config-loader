<?php declare(strict_types=1);

namespace Stefna\Config\Tests;

use PHPUnit\Framework\TestCase;
use Stefna\Config\Exception\ConfigLocked;
use Stefna\Config\Exception\FileNotFound;
use Stefna\Config\FileCollectionConfig;

final class FileCollectionConfigTest extends TestCase
{
	public function testFileNotFound(): void
	{
		$config = $this->getConfig('test-config.php', 'not-found.php');

		$this->expectException(FileNotFound::class);

		$config->get('test-key');
	}

	public function testLoadFileConfig(): void
	{
		$config = $this->getConfig('test-config.php', 'test-config-2.php');

		$this->assertSame(42, $config->getInt('testNumber'));
		$this->assertSame('on', $config->get('testBool'));
		$this->assertTrue($config->getBool('override'));
	}

	public function testCantAddFilesAfterConfigIsLoaded(): void
	{
		$config = $this->getConfig('test-config.php');
		$config->get('test');

		$this->expectException(ConfigLocked::class);

		$config->addFile('test-config-2.php');
	}

	private function getConfig(string ...$files): FileCollectionConfig
	{
		$config = new FileCollectionConfig(__DIR__ . '/resources/');
		foreach ($files as $file) {
			$config->addFile($file);
		}
		return $config;
	}
}
