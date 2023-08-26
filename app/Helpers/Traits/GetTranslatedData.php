<?php
namespace App\Helpers\Traits;

trait GetTranslatedData
{
    public function getAllTranslatedData() : array
    {
        $available_locales = config('app.available_locales');
        $data = [];
        foreach ($available_locales as $locale) {
            $data['title'][$locale] =  $this->translate('title', $locale);
            if ($this->description) {
                $data['description'][$locale] = $this->translate('description', $locale);
            } else if ($this->content) {
                $data['content'][$locale] = $this->translate('content', $locale);
            }
        }
        return $data;
    }
}
