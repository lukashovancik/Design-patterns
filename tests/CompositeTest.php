<?php

abstract class Component
{
    public $id;
    public $name;


    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function get($offset = 0){
        return false;
    }
    public function add(Component $component){
        return false;
    }
    public function remove(Component $component){
        return false;
    }
}

class DirectoryComposite extends Component
{
    private $components = [];

    public function get($offset = 0)
    {
        $content = str_repeat("-", $offset) . ' ' . $this->name . "/\n";

        $offset = $offset + 1;

        foreach ($this->components as $component) {
            $content .= $component->get($offset);
        }

        return $content;
    }

    public function add(Component $component)
    {
        $this->components[$component->id] = $component;

        return $this;
    }

    public function remove(Component $component)
    {
        unset($this->components[$component->id]);
    }

}

class FileLeaf extends Component
{
    public function get($offset = 0)
    {

        return str_repeat("-", $offset-1) . '> ' . $this->name . "\n";
    }

}


class CompositeTest extends PHPUnit_Framework_TestCase
{
    public function test_directory_component()
    {
        $rootDirectory = new DirectoryComposite(1, "");

        $music = new DirectoryComposite(2, "music");
        $pop = new DirectoryComposite(1, "pop");

        $rootDirectory->add($music)->add($pop);

        $music->add(
            new FileLeaf(1, "song1.mp3", "album")
        );
        $music->add(
            $pop
        );
        $pop->add(
            new FileLeaf(1, "song-pop1.mp3", "album")
        );
        $pop->add(
            new FileLeaf(2, "song-pop2.mp3", "album")
        );

        $expected =
            " /\n"
            .'- music'."/\n"
            .'-- pop'."/\n"
            .'--> song-pop1.mp3'."\n"
            .'--> song-pop2.mp3' ."\n"
            .'- pop'."/\n"
            .'-> song-pop1.mp3'."\n"
            .'-> song-pop2.mp3' ."\n";

        $this->assertEquals($rootDirectory->get(),$expected);

    }

}