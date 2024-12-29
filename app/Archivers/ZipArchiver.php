<?php

namespace App\Archivers;

use App\Exceptions\ArchiveMakeException;
use App\Helpers\StringHelper;
use App\Interfaces\ArchiverInterface;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class ZipArchiver implements ArchiverInterface
{
    private const string PHP_EXTENSION_NAME = 'zip';

    public function makeArchive(string $source, string $destination): bool
    {
        try {
            if (!extension_loaded(self::PHP_EXTENSION_NAME) || !file_exists($source)) {
                throw new ArchiveMakeException;
            }

            $zip = new ZipArchive();

            if ($zip->open($destination, ZIPARCHIVE::CREATE) !== true) {
                throw new ArchiveMakeException;
            }

            $source = StringHelper::replaceSlashesWithDS(realpath($source));

            if (is_dir($source)) {
                $items = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST,
                );

                foreach ($items as $item) {
                    $item = StringHelper::replaceSlashesWithDS($item);

                    if (empty($item)
                        || in_array($item, [SD, DD, DS], true)
                        || in_array(substr($item, strrpos($item, DS) + 1), [SD, DD], true)
                    ) {
                        continue;
                    }

                    $item = realpath($item);

                    if (is_dir($item)) {
                        $dir = StringHelper::trimBaseFromPath($source, $item);

                        if (empty($dir)) {
                            continue;
                        }

                        $zip->addEmptyDir($dir);
                    } elseif (is_file($item)) {
                        $zip->addFromString(StringHelper::trimBaseFromPath($source, $item), file_get_contents($item));
                    }
                }
            } elseif (is_file($source)) {
                $zip->addFromString(basename($source), file_get_contents($source));
            }

            if (!$zip->close()) {
                throw new ArchiveMakeException;
            }

            return true;
        } catch (ArchiveMakeException) {
            return false;
        }
    }
}
