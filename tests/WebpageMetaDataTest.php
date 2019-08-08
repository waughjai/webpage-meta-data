<?php

declare( strict_types = 1 );

use PHPUnit\Framework\TestCase;
use WaughJ\WebpageMetaData\WebpageMetaData;

class WebpageMetaDataTest extends TestCase
{
	public function testObjectWorks() : void
	{
		$object = new WebpageMetaData();
		$this->assertTrue( is_object( $object ) );
	}
}
