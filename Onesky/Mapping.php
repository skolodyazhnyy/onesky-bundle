<?php

namespace Seven\Bundle\OneskyBundle\Onesky;

class Mapping
{
    /** @var array */
    private $sources = array();

    /** @var array */
    private $locales = array();

    /** @var string */
    private $output;

    /**
     * @param array  $sources
     * @param array  $locales
     * @param string $output
     */
    public function __construct(array $sources, array $locales, $output)
    {
        $this->sources = $sources;
        $this->locales = $locales;
        $this->output  = $output;
    }

    /**
     * @param string $source
     *
     * @return bool
     */
    public function useSource($source)
    {
        return empty($this->sources) || in_array($source, $this->sources);
    }

    /**
     * @param string $locale
     *
     * @return bool
     */
    public function useLocale($locale)
    {
        return empty($this->locales) || in_array($locale, $this->locales);
    }

    /**
     * @param string $source
     * @param string $locale
     *
     * @return string
     */
    public function getOutputFilename($source, $locale)
    {
        return strtr($this->output, array(
            '[dirname]'   => pathinfo($source, PATHINFO_DIRNAME),
            '[filename]'  => pathinfo($source, PATHINFO_FILENAME),
            '[locale]'    => $locale,
            '[extension]' => pathinfo($source, PATHINFO_EXTENSION),
            '[ext]'       => pathinfo($source, PATHINFO_EXTENSION),
        ));
    }
}
