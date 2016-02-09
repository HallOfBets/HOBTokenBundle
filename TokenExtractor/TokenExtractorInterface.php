<?php
namespace HOB\TokenBundle\TokenExtractor;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface TokenExtractorInterface
 * @package HOB\TokenBundle\TokenExtractor
 */
interface TokenExtractorInterface
{
    /**
     * @param Request $request
     *
     * @return string
     */
    public function extract(Request $request);
}
