<?php


abstract class AbstractTextFactory
{

    abstract public function prepareText($content);
}


class JsonFactory extends AbstractTextFactory
{

    public function prepareText($content)
    {
        return new JsonText($content);
    }
}

class HtmlFactory extends AbstractTextFactory
{

    public function prepareText($content)
    {
        return new HtmlText($content);
    }

}

abstract class AbstractText
{

    protected $content;


    public function __construct($content)
    {
        $this->content = $this->createText($content);
    }

    public function getText()
    {
        return $this->content;
    }

    public abstract function createText($content);


}

class JsonText extends AbstractText
{

    public function __construct($content)
    {
        parent::__construct($content);
    }

    public function createText($content)
    {
        return json_encode($content);
    }

}


class HtmlText extends AbstractText
{

    public function __construct($content)
    {
        parent::__construct($content);
    }

    public function createText($content)
    {
        return "<html>
                    <body>
                        {$content}
                    </body>
                </html>";
    }
}

class AbstractFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string $text - text, ktorý chceme
     * transformovať
     */
    protected $text = "Lorem ipsum,lorem ipsum is good.";

    /**
     *test transformovania textu do HTML
     */
    public function test_return_html_object(){
        $html = (new HtmlFactory())->prepareText($this->text);
        $this->assertTrue($html instanceof HtmlText);
        $this->assertEquals("<html>
                    <body>
                        {$this->text}
                    </body>
                </html>",$html->getText());
    }

    /**
     *test transformovania textu do JSON
     */
    public function test_return_json_object(){
        $json = (new JsonFactory())->prepareText($this->text);
        $this->assertTrue($json instanceof JsonText);
        $this->assertEquals("\"Lorem ipsum,lorem ipsum is good.\"",$json->getText());
    }

}