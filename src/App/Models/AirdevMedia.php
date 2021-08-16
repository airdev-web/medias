<?php

namespace Airdev\Medias\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AirdevMedia extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'airdev_medias';

    public function registerMediaConversions(Media $media = null): void
    {
        $format = explode('/', $media->getAttribute('mime_type'))[1];
        if ($format === 'jpeg')
            $format = 'jpg';

        $this->addMediaConversion('responsive')
            ->format($format)
            ->withResponsiveImages();

        // If image is .png, we don't convert to webp
        if (!$media->getAttribute('mime_type') != 'png') {
            $this->addMediaConversion('responsive_webp')
                ->format('webp')
                ->withResponsiveImages();
        }

        $this->addMediaConversion('og')
            ->width(1200);

        $this->addMediaConversion('nova-thumb')
            ->width(150);
    }

    protected static function booted()
    {
        static::saving(function($media) {
            $media->alt = Str::slug($media->alt);
        });
    }


    public static function get($slug)
    {
        $airev_media = AirdevMedia::where('alt', $slug)->first();

        if ($airev_media == null) {
            return null;
        }

        return $airev_media->getFirstMedia('airdev_media');
    }
}
