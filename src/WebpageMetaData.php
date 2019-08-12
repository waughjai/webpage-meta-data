<?php

declare( strict_types = 1 );
namespace WaughJ\WebpageMetaData;

use Symfony\Component\DomCrawler\Crawler;

class WebpageMetaData
{
	public function __construct( string $html )
	{
		$crawler = new Crawler( $html );
		$title_element = $crawler->filter( 'title' );
		$this->title = ( $title_element->count() > 0 ) ? $title_element->first()->text() : null;
		$desc_element = $crawler->filter( 'meta[name="description"]' );
		$this->description = ( $desc_element->count() > 0 ) ? $desc_element->first()->attr( "content" ) : null;
	}

	public function hasTitle() : bool
	{
		return $this->title !== null;
	}

	public function hasDescription() : bool
	{
		return $this->description !== null;
	}

	public function getTitle() : string
	{
		return ( $this->hasTitle() ) ? $this->title : '';
	}

	public function getDescription() : string
	{
		return ( $this->hasDescription() ) ? $this->description : '';
	}

	private $title;
	private $description;
}
