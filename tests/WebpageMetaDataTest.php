<?php

declare( strict_types = 1 );

use PHPUnit\Framework\TestCase;
use WaughJ\WebpageMetaData\WebpageMetaData;

class WebpageMetaDataTest extends TestCase
{
	public function testMissingTags() : void
	{
		$html =
		'
			<!DOCTYPE html>
			<html>
			</html>
		';
		$meta_data = new WebpageMetaData( $html );
		$this->assertFalse( $meta_data->hasTitle() );
		$this->assertFalse( $meta_data->hasDescription() );
		$this->assertEquals( '', $meta_data->getTitle() );
		$this->assertEquals( '', $meta_data->getDescription() );
	}

	public function testWorks() : void
	{
		$html =
		'
			<!DOCTYPE html>
			<html>
				<head>
					<title>I am the Meta Title</title>
					<meta name="description" content="& I am the Meta Description." />
				</head>
			</html>
		';
		$meta_data = new WebpageMetaData( $html );
		$this->assertTrue( $meta_data->hasTitle() );
		$this->assertTrue( $meta_data->hasDescription() );
		$this->assertEquals( 'I am the Meta Title', $meta_data->getTitle() );
		$this->assertEquals( '& I am the Meta Description.', $meta_data->getDescription() );
	}

	public function testEmpty() : void
	{
		$html =
		'
			<!DOCTYPE html>
			<html>
				<head>
					<title></title>
					<meta name="description" content="" />
				</head>
			</html>
		';
		$meta_data = new WebpageMetaData( $html );
		$this->assertTrue( $meta_data->hasTitle() );
		$this->assertTrue( $meta_data->hasDescription() );
		$this->assertEquals( '', $meta_data->getTitle() );
		$this->assertEquals( '', $meta_data->getDescription() );
	}

	public function testEmptyNoDescContent() : void
	{
		$html =
		'
			<!DOCTYPE html>
			<html>
				<head>
					<title></title>
					<meta name="description" />
				</head>
			</html>
		';
		$meta_data = new WebpageMetaData( $html );
		$this->assertTrue( $meta_data->hasTitle() );
		$this->assertFalse( $meta_data->hasDescription() );
		$this->assertEquals( '', $meta_data->getTitle() );
		$this->assertEquals( '', $meta_data->getDescription() );
	}

	public function testInvalidHTML() : void
	{
		$html = 'asfsdfsf';
		$meta_data = new WebpageMetaData( $html );
		$this->assertFalse( $meta_data->hasTitle() );
		$this->assertFalse( $meta_data->hasDescription() );
		$this->assertEquals( '', $meta_data->getTitle() );
		$this->assertEquals( '', $meta_data->getDescription() );
	}

	public function testMultiple() : void
	{
		$html =
		'
			<!DOCTYPE html>
			<html>
				<head>
					<title>I am the Meta Title</title>
					<meta name="description" content="& I am the Meta Description." />
					<title>I am the 2nd Meta Title</title>
					<meta name="description" content="& I am the 2nd Meta Description." />
				</head>
				<meta name="description" content="& I am the 3rd Meta Description." />
				<title>I am the 3rd Meta Title</title>
			</html>
		';
		$meta_data = new WebpageMetaData( $html );
		$this->assertTrue( $meta_data->hasTitle() );
		$this->assertTrue( $meta_data->hasDescription() );
		$this->assertEquals( 'I am the Meta Title', $meta_data->getTitle() );
		$this->assertEquals( '& I am the Meta Description.', $meta_data->getDescription() );
	}
}
