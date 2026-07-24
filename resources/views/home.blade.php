@extends('layouts.app')

@section('content')

<style>
    /* Homepage Specific Typography Adjustments */
    @media (min-width: 992px) {
        p, span, .cat-title-text, .hero-subtitle-styled, .badge-promo, .btn-orange-styled {
            font-size: 17px !important;
        }
    }
    /* Fix spans inside headings from becoming tiny */
    h1 span, h2 span, h3 span, h4 span, h5 span, h6 span {
        font-size: inherit !important;
    }
</style>

    @include('partials.hero')
    
    @include('partials.categories')
    
@endsection