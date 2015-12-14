<?php

namespace LpdwBundle;

class Post
{
    private $content;

    private $author;

    private $visibility;

    private $date;

    private $lastUpdate;

    public function __construct($content, $author, $visibility, $date, $lastUpdate)
    {
        $this->content = $content;
        $this->author = $author;
        $this->visibility = $visibility;
        $this->date = $date;
        $this->lastUpdate = $lastUpdate;
    }

    /**
     * Get the value of Content
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of Author
     *
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Get the value of Visibility
     *
     * @return mixed
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Get the value of Date
     *
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get the value of Last Update
     *
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

}
