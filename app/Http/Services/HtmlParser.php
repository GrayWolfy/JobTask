<?php


namespace App\Http\Services;


class HtmlParser
{
    protected string $html;
    protected array $tags;

    public function __construct(string $html)
    {
        $this->html = $html;
        $this->tags = [];
    }

    public function tags()
    {
        $tags = [];
        $tagsBegin = explode('<', $this->html);
        foreach ($tagsBegin as $tag) {
            $tag = explode(' ', $tag);
            if (strpos($tag[0], '/') !== 0) {
                $tags[] = strtok($tag[0], '>');
            }
        }

        foreach ($tags as $tag) {
            if (!array_key_exists($tag, $this->tags)) {
                $this->tags[$tag] = 0;
            }

            if (array_key_exists($tag, $this->tags)) {
                $this->tags[$tag] += 1;
            }

        }

        return $this->tags;
    }
}
