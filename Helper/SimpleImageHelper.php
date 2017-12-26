<?php

namespace OW\FileHelperBundle\Helper;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class SimpleImageHelper
 *
 * @package OW\FileHelperBundle\Helper
 */
class SimpleImageHelper extends AbstractFileHelper
{
    /**
     * @param File $file
     * @return string
     */
    public function save(File $file): string
    {
        $filename =  $this->getFilename($file);

        $file->move(
            $this->getUploadPath(),
            $filename
        );

        return $filename;
    }
}