<section class="categories-new container py-5">
    
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-2 section-title">Shop by Categories</h2>
        <div class="d-flex justify-content-center align-items-center">
            <div class="title-line" style="width: 80px; height: 3px; background-color: var(--theme-primary, #C06B1F); border-radius: 2px;"></div>
        </div>
    </div>

    <div class="position-relative">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">
            
            @php
                $cats = [
                    ['name' => 'SOFAS', 'img' => 'sofa.jpg', 'url' => 'Sofa'],
                    ['name' => 'BEDS', 'img' => 'bad8.jpg', 'url' => 'Bed'],
                    ['name' => 'DINING', 'img' => 'dini7.jpg', 'url' => 'Dining Table'],
                    ['name' => 'TV UNITS', 'img' => 'tvunit.jpg', 'url' => 'TV Unit'],
                    ['name' => 'COFFEE TABLES', 'img' => 'cofee.jpg', 'url' => 'Table'],
                    ['name' => 'CABINETS', 'img' => 'cabinet1.jpg', 'url' => 'Cabinet'],
                    ['name' => 'MATTRESSES', 'img' => 'bad7.jpg', 'url' => 'Mattress'],
                    ['name' => 'WARDROBES', 'img' => 'war3.jpg', 'url' => 'Wardrobe'],
                    ['name' => 'SOFA CUM BED', 'img' => 'cumsofa.jpg', 'url' => 'Chair'],
                    ['name' => 'BOOKSHELVES', 'img' => 'book.jpg', 'url' => 'Bookshelf'],
                    ['name' => 'STUDY TABLES', 'img' => 'study.jpg', 'url' => 'Study Table'],
                    ['name' => 'KITCHEN CABINETS', 'img' => 'k5.jpg', 'url' => 'Kitchen Cabinet']
                ];
            @endphp

            @foreach($cats as $cat)
            <div class="col">
                <a href="{{ url('/category/'.$cat['url']) }}" class="text-decoration-none d-block h-100">
                    <div class="bg-white rounded-3 shadow-sm overflow-hidden d-flex flex-column h-100 border transition-all category-card-hover">
                        <div class="cat-img-wrapper">
                            <img src="{{ asset('images/'.$cat['img']) }}" alt="{{ $cat['name'] }}" class="w-100 h-100 cat-img-fit">
                        </div>
                        <div class="p-3 text-center mt-auto">
                            <h3 class="fw-bold m-0 cat-title-text">{{ $cat['name'] }}</h3>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</section>