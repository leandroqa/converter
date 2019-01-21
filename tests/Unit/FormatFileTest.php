<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Import;
use App\Services\FormatFile;

class FormatFileTest extends TestCase
{

    private $hotels;

    public function setup()
    {
        parent::setup();
        $this->hotels = factory(\App\Import::class,10)->make();
    }

    /**
     * test if after FormatName check, return is not empty.
     *
     * @return void
     */
    public function testNameIsNotEmpty()
    {  
        foreach($this->hotels as $hotel)
        {
            $name = FormatFile::formatName($hotel->name);            
            $this->assertNotEmpty($name);            
        }                 
    }

    /**
     * test if non-ascii names is considered after FormatName
     * 
     *
     * @return void
     */
    public function testNameNotAscii()
    { 
        $nonAsciiChars = ['£','¥','€','©','®','™','†','‡','§','¶','°','·','…','–','—','±','×','÷','¼','⅓','½','⅔','¾','μ','π','←','↑','→','↓','↔','↵','⇐','⇑','⇒','⇓','⇔','♠','♣','♥','♦','⚽','',''];
        foreach($nonAsciiChars as $ascii)
        {
            $this->assertEquals('0', FormatFile::formatName($ascii));
        }        
    }

    /* test if stars is valid: >=0 and <=5
     *
     * @return void
     */
    public function testIfStarsIsValid()
    {   
        foreach($this->hotels as $hotel)
        {  
            if($hotel->stars >=0 && $hotel->stars <=5)
            {
                $this->assertNotEquals(-1, FormatFile::formatStars($hotel->stars));   
            }
            else {
                $this->assertEquals(-1, FormatFile::formatStars($hotel->stars));
            }
        } 
    }

     /* test if stars is numeric
     *
     * @return void
     */
    public function testIfStarsIsNumeric()
    {   
        foreach($this->hotels as $hotel)
        {   
            $this->assertEquals(-1, FormatFile::formatStars($hotel->name));
        }        
    }


     /* test if url is valid
     *
     * @return void
     */
    public function testIfUrlIsValid()
    {   
        $urls = [
            "http://www.paucek.com/search.htm",
            "http://www.farina.org/blog/categories/tags/about.html",
            "http://www.garden.com/list/home.html",
            "http://reichmann.de/main/",
            "http://www.rousseau.fr/",
            "http://the.com/register/",
            "http://vaillant.com/list/app/faq/",
            "http://www.begue.fr/search/register/",
            "http://hotel.com/index/",
            "http://premier.de/about/",
            "http://ondricka.com/search/",
            "http://the.org/category/",
            "http://www.martini.net/main.asp",
            "http://schneider.fr/index/",
            "http://www.premier.com/login/",
            "http://www.martinelli.net/",
            "http://www.jockel.de/explore/tags/main/category.asp",
            "http://www.lockman.info/main/",
            "http://the.biz/",
            "http://www.the.net/blog/category/tag/author/",
            "http://www.hotel.com/index/",
            "http://the.de/author/",
            "http://benard.com/",
        ];
        
        $this->assertTrue(true);
    }



}