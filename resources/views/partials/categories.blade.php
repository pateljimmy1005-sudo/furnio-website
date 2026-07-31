<section class="categories-new container py-5">
    
    <div class="text-center mb-4 mb-md-5">
        <h2 class="fw-bold mb-2 section-title">Shop by Categories</h2>
        <div class="d-flex justify-content-center align-items-center">
            <div class="title-line" style="width: 80px; height: 3px; background-color: var(--theme-primary, #C06B1F); border-radius: 2px;"></div>
        </div>
    </div>

    <div class="position-relative">
        <div class="row g-3 g-md-4 justify-content-center">
            
            @php
                $cats = [
                    ['name' => 'SOFAS', 'img' => 'sofa.jpg', 'url' => 'Sofa'],
                    ['name' => 'BEDS', 'img' => 'bad8.jpg', 'url' => 'Bed'],
                    ['name' => 'CHAIRS', 'img' => 'cha1.jpg', 'url' => 'Chair'],
                    ['name' => 'TABLES', 'img' => 'cofee.jpg', 'url' => 'Table'],
                    ['name' => 'WARDROBES', 'img' => 'war3.jpg', 'url' => 'Wardrobe'],
                    ['name' => 'DINING TABLES', 'img' => 'dini7.jpg', 'url' => 'Dining Table'],
                    ['name' => 'KITCHEN CABINETS', 'img' => 'k5.jpg', 'url' => 'Kitchen Cabinet'],
                    ['name' => 'MATTRESSES', 'img' => 'mat1.jpg', 'url' => 'Mattress'],
                    ['name' => 'SOFA CUM BED', 'img' => 'cumsofa.jpg', 'url' => 'Sofa Cum Bed'],
                    ['name' => 'OFFICE FURNITURE', 'img' => 'off1.jpg', 'url' => 'Office Furniture'],
                    ['name' => 'CABINETS', 'img' => 'cabinet1.jpg', 'url' => 'Cabinet'],
                    ['name' => 'STUDY TABLES', 'img' => 'study.jpg', 'url' => 'Study Table']
                ];
            @endphp

            @foreach($cats as $cat)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                <a href="{{ url('/category/'.rawurlencode($cat['url'])) }}" class="text-decoration-none d-block h-100">
                    <div class="bg-white rounded-4 shadow-sm overflow-hidden d-flex flex-column h-100 border transition-all category-card-hover">
                        <div class="cat-img-wrapper ratio ratio-4x3 overflow-hidden bg-light">
                            <img src="{{ asset('images/'.$cat['img']) }}" alt="{{ $cat['name'] }}" class="w-100 h-100 object-fit-cover cat-img-fit" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.svg') }}';">
                        </div>
                        <div class="p-2 p-md-3 text-center mt-auto">
                            <h3 class="fw-bold m-0 cat-title-text fs-6 text-dark text-truncate">{{ $cat['name'] }}</h3>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</section>