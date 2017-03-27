<?php


interface SocialServiceInterface
{
    public function authenticate(array $config);

    public function post($text);

}


class Facebook
{

    public function authenticateToFacebook($api_key)
    {
        return 'Authenticate to facebook with' . $api_key;
    }

    public function postToFacebook($text)
    {
        return 'Posting to facebook text: ' . $text;
    }
}


class Twitter
{

    public function authenticateToTwitter($api_key)
    {
        return 'Authenticate to twitter with' . $api_key;
    }

    public function tweet($text)
    {
        return 'Tweeting text: ' . $text;
    }
}


class FacebookService implements SocialServiceInterface
{
    protected $service;

    public function __construct()
    {
        $this->service = new Facebook();
    }

    public function authenticate(array $config)
    {
        $apiKey = $config['api_key'];

        $this->service->authenticateToFacebook($apiKey);
    }

    public function post($text)
    {
        return $this->service->postToFacebook($text);
    }
}


class TwitterService implements SocialServiceInterface
{
    protected $service;

    public function __construct()
    {
        $this->service = new Twitter();
    }

    public function authenticate(array $config)
    {
        $apiKey = $config['api_key'];

        $this->service->authenticateToTwitter($apiKey);
    }

    public function post($text)
    {
        return $this->service->tweet($text);
    }
}



class Post
{
    protected $service;


    public function setServiceAdapter(SocialServiceInterface $service)
    {
        $this->service = $service;
    }

    public function send($text)
    {
        return $this->service->post($text);
    }

}



class AdapterTest extends PHPUnit_Framework_TestCase
{

    /**
     * test pridania príspevku na facebook a twitter
     */
    public function test_send_post_to_social_network()
    {
        $post = new Post();
        $post->setServiceAdapter(new FacebookService());
        $this->assertEquals('Posting to facebook text: Dnes je pekný deň.', $post->send('Dnes je pekný deň.'));
        $post->setServiceAdapter(new TwitterService());
        $this->assertEquals('Tweeting text: Zajtra bude pekný deň.', $post->send('Zajtra bude pekný deň.'));
    }
}