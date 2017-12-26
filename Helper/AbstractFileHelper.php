<?php

namespace OW\FileHelperBundle\Helper;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class FileHelper
 *
 * @package OW\FileHelperBundle\Helper
 */
abstract class AbstractFileHelper implements FileHelperInterface
{
    /**
     * @var string
     */
    private $projectDir;

    /**
     * @var string
     */
    private $uploadRootDir;

    /**
     * @var string
     */
    private $uploadDir;

    /**
     * @var boolean
     */
    private $saveOriginalFilename;

    /**
     * FileHelper constructor.
     *
     * @param string $projectDir
     * @param string $uploadRootDir
     * @param string $uploadDir
     * @param bool $saveOriginalFilename
     */
    public function __construct(string $projectDir, string $uploadRootDir, string $uploadDir, bool $saveOriginalFilename)
    {
        $this->projectDir = $projectDir;
        $this->uploadRootDir = $uploadRootDir;
        $this->uploadDir = $uploadDir;
        $this->saveOriginalFilename = $saveOriginalFilename;
    }

    /**
     * @return string
     */
    public function getUploadPath(): string
    {
        $path = realpath($this->projectDir . DIRECTORY_SEPARATOR . $this->uploadRootDir . DIRECTORY_SEPARATOR . $this->uploadDir);
        $this->createDirIfNotExists($path);
        return $path;
    }

    /**
     * @param File $file
     * @return string
     */
    protected function getFilename(File $file)
    {
        if ($this->saveOriginalFilename) {
            return time() . "-" . $file->getFilename() . $file->guessExtension();
        }

        return $file->getFilename() . $file->guessExtension();
    }

    /**
     * @param string $path
     */
    private function createDirIfNotExists(string $path)
    {
        if (!is_dir($path)) {
            $fs = new Filesystem();
            $fs->mkdir($path);
        }
    }
}