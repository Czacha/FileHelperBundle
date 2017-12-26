<?php

namespace OW\FileHelperBundle\Helper;

use Symfony\Component\HttpFoundation\File\File;

/**
 * Interface FileHelperInterface
 *
 * @package OW\FileHelperBundle\Helper
 */
interface FileHelperInterface
{
    /**
     * @param File $file
     * @return string
     */
    public function save(File $file): string;

    /**
     * @return string
     */
    public function getUploadPath(): string;
}