<?php
/**
 * Encodes and decodes certain symbols, specific for email addresses, for post content.
 *
 * @package Webbgaraget Wordpress plugins
 * @author Erik Hedberg
 */
class WGEmailObfuscator
{

	/**
	 * Symbols/strings to encode
	 *
	 * @var string
	 */
	var $replacements = array(
		'\.'  => 'ni8h2s70',
		'\@'  => 'uhv6qy85',
		'com' => 'm162ggg5',
		'se'  => '1h6qlsqo'
	);
	
	/**
	 * Prefix to encoded string
	 *
	 * @var string
	 */
	var $prefix;

	/**
	 * Array with regexps for all string containing text to be replaced
	 *
	 * @var string
	 */
	var $regexps = array(
		'email' => '/[\w\d+_.-]+@(?:[\w\d_-]+\.)+[\w]{2,6}/'
	);

	/**
	 * Constructor
	 *
	 * @author Erik Hedberg
	 */
	function __construct( $prefix = false )
	{
		if ( !$this->prefix )
		{
			if ( defined( 'NONCE_SALT' ) )
			{
				$this->prefix = substr( md5( NONCE_SALT ), 0, 8 );
			}
			else
			{
				$this->prefix = 'ndhxjntu';
			}			
		}
		else {
			$this->prefix = $prefix;
		}
		
		if ( !has_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_javascripts' ) )
		{
			add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_javascripts' ) );
		}
		if ( !has_filter( 'the_content', array( &$this, 'encode_addresses' ) ) )
		{
			add_filter( 'the_content', array( &$this, 'encode_addresses' ) );
		}
	}

	/**
	 * Registers filters
	 *
	 * @return void
	 * @author Erik Hedberg
	 */
	function init()
	{
	}
	
	/**
	 * Encode all email addresses
	 *
	 * @param string $content 
	 * @return void
	 * @author Erik Hedberg
	 */
	function encode_addresses( $content )
	{
		foreach( $this->regexps as $regexp )
		{
			$content = preg_replace_callback( $regexp, array(&$this, 'encode_addresses_callback'), $content);
		}
		return $content;
	}
	
	/**
	 * Callback function for encode_addresses
	 *
	 * @param string $matches 
	 * @return void
	 * @author Erik Hedberg
	 */
	function encode_addresses_callback( $matches )
	{
		return $this->encode( $matches[0] );
	}

	/**
	 * Encodes string
	 *
	 * @param string $content 
	 * @return void
	 * @author Erik Hedberg
	 */
    function encode( $string )
    {
        foreach($this->replacements as $original => $replacement)
        {
            $string = preg_replace( '/' . $original . '/', $this->build_nonce( $replacement ), $string);
        }
        
        return $string;
    }

	/**
	 * Adds JS that decodes decoded addresses
	 *
	 * @return void
	 * @author Erik Hedberg
	 */
	function enqueue_javascripts()
	{
		wp_enqueue_script( 'wg-email-obfuscator', plugins_url( './', __FILE__ ) . 'javascript.php?prefix='.$this->prefix, array( 'jquery' ) );
	}
	
	/**
	 * Creates a nonce. This nonce is supposed to be specific for each WP install
	 *
	 * @param string $suffix 
	 * @return void
	 * @author Erik Hedberg
	 */
	function build_nonce( $suffix )
	{
		$nonce = $this->prefix . $suffix;
		return $nonce;
	}
}
