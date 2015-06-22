<?php

namespace t1gor\RobotsTxt\Content;

use t1gor\RobotsTxt\Content\File\Exception\NotFound as FileNotFound;
use t1gor\RobotsTxt\Content\File\Exception\NotReadable as FileNotReadable;

/**
 * Class ContentFile
 *
 * Read the content from the file on the server.
 *
 * @package t1gor\RobotsTxt\Content
 */
final class File extends AbstractContent implements ContentInterface
{
    /**
     * @var string
     */
    protected $filePath;

    /**
     * Should set internal content var and return an instance of self
     * @return $this
     * @throws FileNotFound
     * @throws FileNotReadable
     */
    public function read() {
        // check file exists
        if (false === realpath($this->filePath)) {
            throw new FileNotFound("File {$this->filePath} not found.");
        }

        // can we read the file?
        if (!is_readable($this->filePath)) {
            throw new FileNotReadable("Failed to open {$this->filePath} for reading.");
        }

        // set to internal (content and length)
        $this->content = file_get_contents($this->filePath);
        $this->contentLength = mb_strlen($this->content, $this->encoding);
        return $this;
    }

    /**
     * @return string
     * @throws \BadMethodCallException
     */
    public function getCurrentWord() {
        throw new \BadMethodCallException('Not implemented.');
    }
}