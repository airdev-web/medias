@if ($slug == null)
    No slug was given to tag
@else
    <picture>
        @if ($srcset_webp_responsive)
            <source type="image/webp" srcset="{{ $srcset_webp_responsive }}">
        @endif

        <img srcset="{{ $srcset_original_responsive }}"
             src="{{ $src_original }}" class="{{ $img_class }}">
    </picture>
@endif