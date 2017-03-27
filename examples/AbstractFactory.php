<?php

namespace App;

abstract class AbstractTextFactory
{
    abstract public function createText($content);
}

class JsonFactory extends AbstractTextFactory
{

    /**
     * @param $content
     * @return Text
     */
    public function createText($content)
    {
        return new JsonText($content);
    }
}

class HtmlFactory extends AbstractTextFactory
{

    /**
     * @param $content
     * @return Text
     */
    public function createText($content)
    {
        return new HtmlText($content);
    }

}

abstract class Text
{

    public abstract function createText($content);

}

class JsonText extends Text
{

    public function createText($content)
    {
        return json_encode($content);
    }

}

class HtmlText extends Text
{

    public function createText($content)
    {
        return "<html>
                    <body>
                        {$content}
                    </body>
                </html>";
    }

}
