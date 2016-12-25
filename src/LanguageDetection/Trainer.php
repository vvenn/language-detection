<?php

declare(strict_types = 1);

namespace LanguageDetection;

/**
 * Class Trainer
 *
 * @author Patrick Schur
 * @package LanguageDetection
 */
class Trainer
{
    use NgramParser;

    public function learn()
    {
        $tokens = [];

        foreach (new \GlobIterator(__DIR__ . '/../../etc/[^_]*') as $file)
        {
            $content = file_get_contents($file->getPathname());

            echo $file->getBasename(), PHP_EOL;

            $tokens[$file->getBasename()] = $this->getNgrams($content);
        }

        file_put_contents(__DIR__ . '/../../etc/_langs.json', json_encode($tokens, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}