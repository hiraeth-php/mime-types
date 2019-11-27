<?php

namespace Hiraeth\Utils;

use Hiraeth;
use Mimey;

/**
 * {@inheritDoc}
 */
class MimeTypesDelegate implements Hiraeth\Delegate
{
	/**
	 * {@inheritDoc}
	 */
	static public function getClass(): string
	{
		return MimeTypes::class;
	}


	/**
	 * {@inheritDoc}
	 */
	public function __invoke(Hiraeth\Application $app): object
	{
		$builder = Mimey\MimeMappingBuilder::create();

		foreach ($app->getConfig('*', 'mime-types.map', []) as $types) {
			foreach ($types as $extension => $mime_type) {
				$builder->add($mime_type, $extension);
			}
		}

		return new MimeTypes($builder->getMapping());
	}
}
