<?php

namespace Webvelopers\WhatsAppCloudApi\Message\OptionsList;

/**
 * 
 */
class Action
{
    /**
     * 
     */
    protected string $button;

    /**
     * 
     */
    protected array $sections;

    /**
     * 
     */
    public function __construct(string $button, array $sections)
    {
        $this->button = $button;
        $this->sections = $sections;
    }

    /**
     * 
     */
    public function button(): string
    {
        return $this->button;
    }

    /**
     * 
     */
    public function sections(): array
    {
        $result = [];

        foreach ($this->sections as $section) {
            $result[] = [
                'title' => $section->title(),
                'rows' => $section->rows(),
            ];
        }

        return $result;
    }
}
