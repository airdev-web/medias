<?php

namespace Airdev\Medias\App\Views\Components;

use Airdev\Medias\App\Models\AirdevMedia;
use Illuminate\View\Component;
use Spatie\MediaLibrary\MediaCollections\Exceptions\InvalidConversion;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Picture extends Component
{
    public $slug;
    public $media;

    // Extra attributes
    public $img_class;

    // srcset for formats
    public $srcset_webp_responsive;
    public $srcset_original_responsive;
    public $src_original;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($slug = null, $class = null)
    {
        if ($slug === null)
            return;

        $this->slug = $slug;
        $this->img_class = $class;

        $this->media = AirdevMedia::get($this->slug);

        if ($this->media == null) {
            $this->src_original = 'https://airdev.be/no-img.jpg';
        } else {
            $this->src_original = $this->media->getUrl();
            $this->srcset_original_responsive = $this->get_srcset($this->media, 'responsive');
            $this->srcset_webp_responsive = $this->get_srcset($this->media, 'responsive_webp');
        }

    }

    public function get_srcset(Media $media, $conversion_name)
    {
        $srcset = '';

        try {
            $urls = $media->getResponsiveImageUrls($conversion_name);
        } catch (InvalidConversion $e) {
            return null;
        }

        foreach ($urls as $url) {
            $exploded = explode('_', $url);
            $width = $exploded[count($exploded) - 2];
            $srcset .= $url . ' ' . $width . 'w, ';
        }

        // Removing last ',' and spaces
        return trim($srcset, ' ,');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('airdev::components.picture');
    }
}
