<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\Review;
use App\Models\Order;
use App\Models\OrderItem;

$allCategories = [
    // 1. SOFA (10 Products)
    'Sofa' => [
        ['name' => 'Modern Sofa Deluxe', 'price' => 26999, 'img' => 'images/sofa.jpg', 'mat' => 'Leather', 'color' => 'Brown', 'disc' => 5, 'desc' => 'Premium deluxe sofa with extra comfort and ergonomic support for modern living rooms.'],
        ['name' => 'Luxury Corner Sofa', 'price' => 32999, 'img' => 'images/sofa1.jpg', 'mat' => 'Velvet', 'color' => 'Grey', 'disc' => 10, 'desc' => 'Stylish L-shaped corner sofa designed for spacious living spaces.'],
        ['name' => 'Classic Wooden Sofa', 'price' => 21999, 'img' => 'images/sofa2.jpg', 'mat' => 'Wood', 'color' => 'Cream', 'disc' => 7, 'desc' => 'Traditional solid wood frame sofa with plush cushions.'],
        ['name' => 'Modern Fabric Sofa', 'price' => 24999, 'img' => 'images/sofa3.jpg', 'mat' => 'Fabric', 'color' => 'Blue', 'disc' => 6, 'desc' => 'Soft linen fabric sofa with elegant design and durable frame.'],
        ['name' => 'Royal Leather Sofa', 'price' => 39999, 'img' => 'images/sofa4.jpg', 'mat' => 'Leather', 'color' => 'Black', 'disc' => 15, 'desc' => 'Royal genuine leather sofa set for luxury home interiors.'],
        ['name' => 'Compact Apartment Sofa', 'price' => 18999, 'img' => 'images/sofa5.jpg', 'mat' => 'Fabric', 'color' => 'Green', 'disc' => 4, 'desc' => 'Space-saving compact sofa perfect for modern studio apartments.'],
        ['name' => 'Designer Velvet Sofa', 'price' => 28999, 'img' => 'images/sofa6.jpg', 'mat' => 'Velvet', 'color' => 'White', 'disc' => 9, 'desc' => 'Modern designer sofa crafted with soft velvet upholstery.'],
        ['name' => 'Premium Lounge Sofa', 'price' => 35999, 'img' => 'images/sofa10.jpg', 'mat' => 'Leather', 'color' => 'Tan', 'disc' => 12, 'desc' => 'Ultra-comfortable lounge sofa with adjustable headrests.'],
        ['name' => 'Minimalist Sofa Set', 'price' => 22999, 'img' => 'images/sofa8.jpg', 'mat' => 'Fabric', 'color' => 'Grey', 'disc' => 5, 'desc' => 'Minimalist design sofa set tailored for contemporary interiors.'],
        ['name' => 'Elegant Family Sofa', 'price' => 30999, 'img' => 'images/sofa9.jpg', 'mat' => 'Leather', 'color' => 'Brown', 'disc' => 8, 'desc' => 'Spacious 5-seater family sofa with high density foam cushioning.'],
    ],

    // 2. BED (10 Products)
    'Bed' => [
        ['name' => 'Wooden Bed Deluxe', 'price' => 19999, 'img' => 'images/bad1.jpg', 'mat' => 'Wood', 'color' => 'Walnut', 'disc' => 10, 'desc' => 'Premium solid wooden bed with smooth walnut polish finish.'],
        ['name' => 'Modern King Size Bed', 'price' => 25999, 'img' => 'images/bad2.jpg', 'mat' => 'Teak Wood', 'color' => 'Brown', 'disc' => 12, 'desc' => 'King size wooden bed featuring spacious built-in hydraulic storage.'],
        ['name' => 'Classic Wooden Bed', 'price' => 17999, 'img' => 'images/bad3.jpg', 'mat' => 'Wood', 'color' => 'Cream', 'disc' => 5, 'desc' => 'Classic handcrafted wooden bed suitable for traditional master bedrooms.'],
        ['name' => 'Luxury Velvet Bed Set', 'price' => 34999, 'img' => 'images/bad4.jpg', 'mat' => 'Engineered Wood', 'color' => 'Black', 'disc' => 15, 'desc' => 'Luxury bed set featuring a cushioned velvet tufted headboard.'],
        ['name' => 'Minimalist Wooden Bed', 'price' => 16999, 'img' => 'images/bad5.jpg', 'mat' => 'Wood', 'color' => 'White', 'disc' => 6, 'desc' => 'Sleek minimalist wooden bed frame with clean aesthetic lines.'],
        ['name' => 'Storage Hydraulic Bed', 'price' => 22999, 'img' => 'images/bad6.jpg', 'mat' => 'Plywood', 'color' => 'Brown', 'disc' => 9, 'desc' => 'Wooden bed with heavy-duty hydraulic lifting mechanism.'],
        ['name' => 'Double Bed Premium', 'price' => 28999, 'img' => 'images/bad7.jpg', 'mat' => 'Teak Wood', 'color' => 'Walnut', 'disc' => 14, 'desc' => 'Premium double bed crafted from 100% natural teak wood.'],
        ['name' => 'Family Size Bed', 'price' => 31999, 'img' => 'images/bad8.jpg', 'mat' => 'Wood', 'color' => 'Grey', 'disc' => 11, 'desc' => 'Generous family size bed with robust side support beams.'],
        ['name' => 'Elegant Bedroom Bed', 'price' => 23999, 'img' => 'images/bad9.jpg', 'mat' => 'Engineered Wood', 'color' => 'Brown', 'disc' => 8, 'desc' => 'Elegant bed frame designed for maximum durability and style.'],
        ['name' => 'Royal Solid Wood Bed', 'price' => 39999, 'img' => 'images/bad10.jpg', 'mat' => 'Solid Wood', 'color' => 'Dark Brown', 'disc' => 18, 'desc' => 'Royal solid wood king bed with intricate carved details.'],
    ],

    // 3. CHAIR (10 Products)
    'Chair' => [
        ['name' => 'Gaming Office Chair', 'price' => 7999, 'img' => 'images/cha1.jpg', 'mat' => 'Mesh', 'color' => 'Black', 'disc' => 8, 'desc' => 'Ergonomic gaming & office chair with lumbar support and 360 wheels.'],
        ['name' => 'Executive Leather Chair', 'price' => 9999, 'img' => 'images/cha2.jpg', 'mat' => 'Leather', 'color' => 'Brown', 'disc' => 10, 'desc' => 'High-back executive leather chair for home office setup.'],
        ['name' => 'Modern Study Chair', 'price' => 5499, 'img' => 'images/cha3.jpg', 'mat' => 'Plastic', 'color' => 'White', 'disc' => 5, 'desc' => 'Lightweight study chair with comfortable ergonomic backrest.'],
        ['name' => 'Luxury Office Chair', 'price' => 11999, 'img' => 'images/cha4.jpg', 'mat' => 'Leather', 'color' => 'Grey', 'disc' => 12, 'desc' => 'Premium luxury chair with pneumatic height adjustment.'],
        ['name' => 'Classic Wooden Chair', 'price' => 4499, 'img' => 'images/cha5.jpg', 'mat' => 'Wood', 'color' => 'Brown', 'disc' => 4, 'desc' => 'Handmade wooden chair built with solid Sheesham wood.'],
        ['name' => 'Soft Cushion Lounge Chair', 'price' => 6999, 'img' => 'images/cha6.jpg', 'mat' => 'Fabric', 'color' => 'Blue', 'disc' => 7, 'desc' => 'Cozy lounge chair with extra soft padded cushion.'],
        ['name' => 'Minimalist Accent Chair', 'price' => 3999, 'img' => 'images/cha7.jpg', 'mat' => 'Plastic', 'color' => 'Black', 'disc' => 3, 'desc' => 'Modern minimalist accent chair suitable for balconies & cafes.'],
        ['name' => 'Premium Dining Chair', 'price' => 5999, 'img' => 'images/cha8.jpg', 'mat' => 'Wood', 'color' => 'Cream', 'disc' => 6, 'desc' => 'Elegant wooden dining chair with fabric seat padding.'],
        ['name' => 'Computer Mesh Chair', 'price' => 8499, 'img' => 'images/cha9.jpg', 'mat' => 'Mesh', 'color' => 'Red', 'disc' => 9, 'desc' => 'Breathable mesh chair with headrest and tilt lock feature.'],
        ['name' => 'Royal Velvet Chair', 'price' => 12999, 'img' => 'images/cha10.jpg', 'mat' => 'Velvet', 'color' => 'Golden', 'disc' => 15, 'desc' => 'Royal velvet armchair with gold-plated metal legs.'],
    ],

    // 4. TABLE (10 Products)
    'Table' => [
        ['name' => 'Modern Coffee Table', 'price' => 7999, 'img' => 'images/ta1.jpg', 'mat' => 'Wood', 'color' => 'White', 'disc' => 5, 'desc' => 'Sleek modern coffee table with smooth wooden finish.'],
        ['name' => 'Luxury Glass Coffee Table', 'price' => 10999, 'img' => 'images/ta2.jpg', 'mat' => 'Glass', 'color' => 'Black', 'disc' => 10, 'desc' => 'Tempered glass top coffee table with chrome legs.'],
        ['name' => 'Classic Center Table', 'price' => 6999, 'img' => 'images/ta3.jpg', 'mat' => 'Solid Wood', 'color' => 'Walnut', 'disc' => 6, 'desc' => 'Classic walnut center table for family living rooms.'],
        ['name' => 'Modular Study Table Desk', 'price' => 8999, 'img' => 'images/ta11.jpg', 'mat' => 'Engineered Wood', 'color' => 'Grey', 'disc' => 8, 'desc' => 'Study table desk with drawers and shelf compartment.'],
        ['name' => 'Minimal Wooden Side Table', 'price' => 4999, 'img' => 'images/ta5.jpg', 'mat' => 'Wood', 'color' => 'White', 'disc' => 4, 'desc' => 'Compact side table ideal for bedroom nightstands.'],
        ['name' => 'Round Living Room Table', 'price' => 9999, 'img' => 'images/ta6.jpg', 'mat' => 'Wood', 'color' => 'Cream', 'disc' => 7, 'desc' => 'Round center table with solid tripod wooden legs.'],
        ['name' => 'Executive Office Desk Table', 'price' => 14999, 'img' => 'images/ta7.jpg', 'mat' => 'Solid Wood', 'color' => 'Brown', 'disc' => 12, 'desc' => 'Large executive desk table with cable routing.'],
        ['name' => 'Designer Accent Table', 'price' => 11999, 'img' => 'images/ta8.jpg', 'mat' => 'Teak Wood', 'color' => 'Golden', 'disc' => 9, 'desc' => 'Designer accent table with marble pattern top.'],
        ['name' => 'Compact Apartment Table', 'price' => 5499, 'img' => 'images/ta9.jpg', 'mat' => 'Glass', 'color' => 'Clear', 'disc' => 5, 'desc' => 'Compact glass top table suitable for tight spaces.'],
        ['name' => 'Royal Teak Table Deluxe', 'price' => 17999, 'img' => 'images/ta10.jpg', 'mat' => 'Teak Wood', 'color' => 'Dark Brown', 'disc' => 15, 'desc' => 'Royal teak wood table with rich hand polish.'],
    ],

    // 5. WARDROBE (10 Products)
    'Wardrobe' => [
        ['name' => 'Modern Wardrobe Deluxe', 'price' => 28999, 'img' => 'images/war1.jpg', 'mat' => 'Wood', 'color' => 'Brown', 'disc' => 10, 'desc' => 'Modern 3-door wardrobe with ample hanging & shelf space.'],
        ['name' => 'Sliding Door Mirror Wardrobe', 'price' => 35999, 'img' => 'images/war2.jpg', 'mat' => 'Engineered Wood', 'color' => 'White', 'disc' => 15, 'desc' => 'Smooth sliding door wardrobe with integrated full-length mirror.'],
        ['name' => 'Classic Wooden Wardrobe', 'price' => 24999, 'img' => 'images/war3.jpg', 'mat' => 'Solid Wood', 'color' => 'Walnut', 'disc' => 8, 'desc' => 'Classic 2-door wooden wardrobe with internal drawers.'],
        ['name' => 'Luxury Teak Wardrobe', 'price' => 42999, 'img' => 'images/war4.jpg', 'mat' => 'Teak Wood', 'color' => 'Black', 'disc' => 18, 'desc' => 'Premium teak wood wardrobe designed for luxury master bedrooms.'],
        ['name' => 'Minimal 2-Door Wardrobe', 'price' => 21999, 'img' => 'images/war5.jpg', 'mat' => 'Wood', 'color' => 'Grey', 'disc' => 5, 'desc' => 'Minimalist 2-door wardrobe with key lock security.'],
        ['name' => 'Full Mirror Storage Wardrobe', 'price' => 31999, 'img' => 'images/war6.jpg', 'mat' => 'Engineered Wood', 'color' => 'Cream', 'disc' => 12, 'desc' => 'Spacious wardrobe with full glass mirror panel on doors.'],
        ['name' => 'Family Size Wardrobe', 'price' => 38999, 'img' => 'images/war7.jpg', 'mat' => 'Wood', 'color' => 'Brown', 'disc' => 14, 'desc' => 'Large 4-door wardrobe featuring multiple hanging rods and lockers.'],
        ['name' => 'Premium Closet Wardrobe', 'price' => 46999, 'img' => 'images/war8.jpg', 'mat' => 'Solid Wood', 'color' => 'Dark Brown', 'disc' => 20, 'desc' => 'Walk-in style closet wardrobe with soft-close hinges.'],
        ['name' => 'Compact Apartment Wardrobe', 'price' => 19999, 'img' => 'images/war9.jpg', 'mat' => 'Plywood', 'color' => 'White', 'disc' => 6, 'desc' => 'Compact 2-door wardrobe designed for smaller bedrooms.'],
        ['name' => 'Royal 4-Door Wardrobe', 'price' => 54999, 'img' => 'images/war10.jpg', 'mat' => 'Teak Wood', 'color' => 'Golden Brown', 'disc' => 25, 'desc' => 'Grand royal 4-door wardrobe with premium finish and gold handles.'],
    ],

    // 6. KITCHEN CABINET (10 Products)
    'Kitchen Cabinet' => [
        ['name' => 'Modern Kitchen Storage Unit', 'price' => 15999, 'img' => 'images/k1.jpg', 'mat' => 'Engineered Wood', 'color' => 'White & Oak', 'disc' => 8, 'desc' => 'Spacious kitchen cabinet with microwave shelf and multi-storage doors.'],
        ['name' => 'Modular Kitchen Island Cabinet', 'price' => 22999, 'img' => 'images/k2.jpg', 'mat' => 'Plywood', 'color' => 'Grey', 'disc' => 12, 'desc' => 'Modular kitchen storage island cabinet with countertop space.'],
        ['name' => 'Classic Wooden Pantry Cabinet', 'price' => 18999, 'img' => 'images/k3.jpg', 'mat' => 'Solid Wood', 'color' => 'Brown', 'disc' => 10, 'desc' => 'Tall kitchen pantry storage cabinet with adjustable inner shelves.'],
        ['name' => 'Glass Door Crockery Cabinet', 'price' => 19999, 'img' => 'images/k4.jpg', 'mat' => 'Glass & Wood', 'color' => 'Cream', 'disc' => 9, 'desc' => 'Elegant kitchen crockery cabinet featuring tempered glass showcase doors.'],
        ['name' => 'Luxury Kitchen Utility Unit', 'price' => 24999, 'img' => 'images/k5.jpg', 'mat' => 'Teak Wood', 'color' => 'Walnut', 'disc' => 15, 'desc' => 'High-end kitchen utility cabinet with soft close drawers.'],
        ['name' => 'Compact Wall Kitchen Cabinet', 'price' => 11999, 'img' => 'images/k6.jpg', 'mat' => 'Engineered Wood', 'color' => 'White', 'disc' => 5, 'desc' => 'Wall-mounted compact kitchen storage cabinet for small kitchens.'],
        ['name' => 'Multi-Tier Spice & Utensil Rack', 'price' => 13999, 'img' => 'images/k7.jpg', 'mat' => 'Stainless Steel & Wood', 'color' => 'Silver & Brown', 'disc' => 7, 'desc' => 'Multi-tier storage rack cabinet for organized kitchen utensils.'],
        ['name' => 'Royal Kitchen Buffet Hutch', 'price' => 29999, 'img' => 'images/k8.jpg', 'mat' => 'Solid Wood', 'color' => 'Mahogany', 'disc' => 18, 'desc' => 'Royal kitchen hutch cabinet with wine rack and drawer storage.'],
        ['name' => 'Minimalist Kitchen Trolley Cabinet', 'price' => 9999, 'img' => 'images/k9.jpg', 'mat' => 'Metal & Wood', 'color' => 'Black & Natural', 'disc' => 6, 'desc' => 'Moveable kitchen trolley cabinet with lockable caster wheels.'],
        ['name' => 'Designer Kitchen Crockery Display', 'price' => 21999, 'img' => 'images/k10.jpg', 'mat' => 'Teak Wood', 'color' => 'Dark Walnut', 'disc' => 11, 'desc' => 'Designer crockery display cabinet for modern kitchen dining areas.'],
    ],

    // 7. DINING TABLE (10 Products)
    'Dining Table' => [
        ['name' => 'Modern 6-Seater Dining Table', 'price' => 24999, 'img' => 'images/dini1.jpg', 'mat' => 'Teak Wood', 'color' => 'Brown', 'disc' => 10, 'desc' => 'Premium 6-seater dining table set with cushioned chairs.'],
        ['name' => 'Luxury Marble Top Dining Table', 'price' => 38999, 'img' => 'images/dini2.jpg', 'mat' => 'Marble & Wood', 'color' => 'White & Gold', 'disc' => 15, 'desc' => 'Luxury dining table featuring genuine marble top and solid wood legs.'],
        ['name' => 'Classic Wooden Dining Table', 'price' => 19999, 'img' => 'images/dini3.jpg', 'mat' => 'Solid Wood', 'color' => 'Walnut', 'disc' => 8, 'desc' => 'Traditional solid wood 4-seater dining table set.'],
        ['name' => 'Glass Top Modern Dining Table', 'price' => 21999, 'img' => 'images/dini4.jpg', 'mat' => 'Glass', 'color' => 'Black', 'disc' => 12, 'desc' => 'Contemporary glass top dining table with ergonomic chairs.'],
        ['name' => 'Compact 4-Seater Dining Set', 'price' => 16999, 'img' => 'images/dini5.jpg', 'mat' => 'Engineered Wood', 'color' => 'Cream', 'disc' => 6, 'desc' => 'Space-saving 4-seater dining table for compact family rooms.'],
        ['name' => 'Round Wooden Dining Table', 'price' => 22999, 'img' => 'images/dini6.jpg', 'mat' => 'Teak Wood', 'color' => 'Natural Brown', 'disc' => 9, 'desc' => 'Elegant round dining table with central wooden pedestal base.'],
        ['name' => 'Designer 6-Piece Dining Table', 'price' => 29999, 'img' => 'images/dini7.jpg', 'mat' => 'Wood & Fabric', 'color' => 'Grey & Walnut', 'disc' => 14, 'desc' => 'Designer 6-piece dining table with bench & cushioned chairs.'],
        ['name' => 'Royal Family Dining Table', 'price' => 45999, 'img' => 'images/dini8.jpg', 'mat' => 'Solid Wood', 'color' => 'Dark Walnut', 'disc' => 20, 'desc' => 'Grand 8-seater family dining table set for formal dining rooms.'],
        ['name' => 'Minimalist Dining Desk Table', 'price' => 14999, 'img' => 'images/dini9.jpg', 'mat' => 'Wood', 'color' => 'White', 'disc' => 5, 'desc' => 'Clean minimalist dining table suitable for modern interiors.'],
        ['name' => 'Executive Dining Table Set', 'price' => 33999, 'img' => 'images/dini10.jpg', 'mat' => 'Teak Wood', 'color' => 'Espresso', 'disc' => 16, 'desc' => 'Executive dining table crafted from selected teak wood.'],
    ],

    // 8. MATTRESS (10 Products)
    'Mattress' => [
        ['name' => 'Orthopedic Memory Foam Mattress', 'price' => 14999, 'img' => 'images/mat1.jpg', 'mat' => 'Memory Foam', 'color' => 'White', 'disc' => 10, 'desc' => 'High density orthopedic memory foam mattress for spine alignment.'],
        ['name' => 'Pocket Spring Luxury Mattress', 'price' => 18999, 'img' => 'images/mat2.jpg', 'mat' => 'Pocket Spring', 'color' => 'Grey & White', 'disc' => 12, 'desc' => 'Zero motion transfer pocket spring mattress with pillow top layer.'],
        ['name' => 'Natural Latex Foam Mattress', 'price' => 22999, 'img' => 'images/mat3.jpg', 'mat' => 'Natural Latex', 'color' => 'Cream', 'disc' => 15, 'desc' => '100% natural organic latex mattress for breathable cooling comfort.'],
        ['name' => 'Dual Comfort Reversible Mattress', 'price' => 11999, 'img' => 'images/mat4.jpg', 'mat' => 'PU Foam', 'color' => 'Blue & White', 'disc' => 7, 'desc' => 'Dual sided mattress with medium soft and medium firm options.'],
        ['name' => 'King Size Extra Plush Mattress', 'price' => 25999, 'img' => 'images/mat5.jpg', 'mat' => 'Memory Foam & Latex', 'color' => 'White', 'disc' => 18, 'desc' => 'King size plush mattress with multi-layer comfort quilting.'],
        ['name' => 'Back Support Firm Mattress', 'price' => 13999, 'img' => 'images/mat6.jpg', 'mat' => 'Coir & Foam', 'color' => 'Maroon & White', 'disc' => 8, 'desc' => 'Natural bonded coir mattress providing firm spinal support.'],
        ['name' => 'Queen Size Ergonomic Mattress', 'price' => 16999, 'img' => 'images/mat7.jpg', 'mat' => 'High Resilience Foam', 'color' => 'White', 'disc' => 11, 'desc' => 'Queen size ergonomic mattress for pressure point relief.'],
        ['name' => 'Hotel Collection Plush Mattress', 'price' => 29999, 'img' => 'images/mat8.jpg', 'mat' => 'Pocket Spring & Foam', 'color' => 'White & Gold', 'disc' => 20, 'desc' => '5-star hotel luxury mattress with plush euro top layer.'],
        ['name' => 'Rollable Memory Foam Mattress', 'price' => 9999, 'img' => 'images/mat9.jpg', 'mat' => 'Memory Foam', 'color' => 'White', 'disc' => 5, 'desc' => 'Convenient rollable memory foam mattress in a compact box.'],
        ['name' => 'Royal Ortho Care Mattress', 'price' => 21999, 'img' => 'images/mat10.jpg', 'mat' => 'Latex & Spring', 'color' => 'White & Blue', 'disc' => 14, 'desc' => 'Advanced orthopedic care mattress endorsed by spine specialists.'],
    ],

    // 9. SOFA CUM BED (10 Products)
    'Sofa Cum Bed' => [
        ['name' => 'Modern Fabric Sofa Cum Bed', 'price' => 18999, 'img' => 'images/cum1.jpg', 'mat' => 'Fabric', 'color' => 'Blue', 'disc' => 10, 'desc' => 'Multi-functional 3-seater sofa that easily converts into a queen bed.'],
        ['name' => 'Folding Wooden Sofa Cum Bed', 'price' => 22999, 'img' => 'images/cum2.jpg', 'mat' => 'Solid Wood', 'color' => 'Walnut', 'disc' => 12, 'desc' => 'Solid wooden frame folding sofa cum bed with storage box.'],
        ['name' => 'Luxury Velvet Convertible Sofa Bed', 'price' => 26999, 'img' => 'images/cum3.jpg', 'mat' => 'Velvet', 'color' => 'Grey', 'disc' => 15, 'desc' => 'Plush velvet convertible sofa bed with adjustable reclining back.'],
        ['name' => 'Compact Pull-Out Sofa Bed', 'price' => 16999, 'img' => 'images/cum4.jpg', 'mat' => 'Fabric', 'color' => 'Brown', 'disc' => 8, 'desc' => 'Smooth pull-out mechanism sofa cum bed for guest rooms.'],
        ['name' => 'L-Shaped Sectional Sofa Cum Bed', 'price' => 31999, 'img' => 'images/cum5.jpg', 'mat' => 'Leatherette', 'color' => 'Black', 'disc' => 18, 'desc' => 'Spacious L-shaped sectional sofa with pop-up sleeper bed.'],
        ['name' => 'Minimalist Futon Sofa Bed', 'price' => 14999, 'img' => 'images/cum6.jpg', 'mat' => 'Metal & Fabric', 'color' => 'Red', 'disc' => 6, 'desc' => 'Sleek click-clack futon sofa bed for modern living rooms.'],
        ['name' => 'Designer Cushion Sofa Cum Bed', 'price' => 24999, 'img' => 'images/cum7.jpg', 'mat' => 'Fabric', 'color' => 'Teal', 'disc' => 11, 'desc' => 'Designer sofa bed with thick removable cushion covers.'],
        ['name' => 'Royal Teak Frame Sofa Bed', 'price' => 34999, 'img' => 'images/cum8.jpg', 'mat' => 'Teak Wood', 'color' => 'Dark Walnut', 'disc' => 20, 'desc' => 'Handcrafted teak wood sofa cum bed built to last generations.'],
        ['name' => 'Single Seater Chair Sofa Bed', 'price' => 11999, 'img' => 'images/cum9.jpg', 'mat' => 'Fabric', 'color' => 'Yellow', 'disc' => 5, 'desc' => 'Single seater armchair that unfolds into a comfortable lounger bed.'],
        ['name' => 'Premium Leatherette Convertible Bed', 'price' => 28999, 'img' => 'images/cum10.jpg', 'mat' => 'Leatherette', 'color' => 'Tan', 'disc' => 14, 'desc' => 'Premium leatherette sofa bed with armrest cup holders.'],
    ],

    // 10. OFFICE FURNITURE (10 Products)
    'Office Furniture' => [
        ['name' => 'Executive Office Workstation', 'price' => 21999, 'img' => 'images/off1.jpg', 'mat' => 'Engineered Wood', 'color' => 'Brown & Black', 'disc' => 10, 'desc' => 'Spacious executive workstation with drawers & lockable cabinet.'],
        ['name' => 'Ergonomic Office Mesh Chair', 'price' => 7999, 'img' => 'images/off2.jpg', 'mat' => 'Mesh', 'color' => 'Black', 'disc' => 8, 'desc' => 'Full mesh office chair with 3D armrests and lumbar support.'],
        ['name' => 'Conference Room Table 8-Seater', 'price' => 32999, 'img' => 'images/off3.jpg', 'mat' => 'Wood & Metal', 'color' => 'Walnut', 'disc' => 15, 'desc' => 'Large conference table with integrated power sockets & cable box.'],
        ['name' => 'Steel Office Storage Cabinet', 'price' => 12999, 'img' => 'images/off4.jpg', 'mat' => 'Steel', 'color' => 'Grey', 'disc' => 7, 'desc' => 'Heavy-duty steel office filing cabinet with key lock system.'],
        ['name' => 'Modern Computer Desk Unit', 'price' => 9999, 'img' => 'images/off5.jpg', 'mat' => 'Engineered Wood', 'color' => 'White', 'disc' => 6, 'desc' => 'Compact computer desk unit with keyboard tray and monitor riser.'],
        ['name' => 'Manager Executive Chair', 'price' => 11999, 'img' => 'images/off6.jpg', 'mat' => 'Leather', 'color' => 'Brown', 'disc' => 12, 'desc' => 'High back manager chair upholstered in genuine leather.'],
        ['name' => 'Modular Office Partition Desk', 'price' => 18999, 'img' => 'images/off7.jpg', 'mat' => 'Aluminum & Wood', 'color' => 'Silver & Blue', 'disc' => 11, 'desc' => 'Dual workstation office desk with privacy divider screen.'],
        ['name' => 'Reception Counter Table', 'price' => 25999, 'img' => 'images/off8.jpg', 'mat' => 'Wood & Glass', 'color' => 'White & Walnut', 'disc' => 14, 'desc' => 'Professional office reception desk counter with LED accent light.'],
        ['name' => 'Mobile Office Drawer Pedestal', 'price' => 5999, 'img' => 'images/off9.jpg', 'mat' => 'Steel', 'color' => 'Black', 'disc' => 5, 'desc' => '3-drawer mobile under-desk pedestal cabinet with wheels.'],
        ['name' => 'Royal Boardroom Table Set', 'price' => 48999, 'img' => 'images/off10.jpg', 'mat' => 'Teak Wood', 'color' => 'Dark Walnut', 'disc' => 20, 'desc' => 'Premium 10-seater boardroom table set for executive office suites.'],
    ],

    // 11. CABINET (10 Products)
    'Cabinet' => [
        ['name' => 'Modern Living Room Display Cabinet', 'price' => 17999, 'img' => 'images/livi1.jpg', 'mat' => 'Wood & Glass', 'color' => 'White', 'disc' => 10, 'desc' => 'Modern display cabinet with glass doors and internal LED lighting.'],
        ['name' => 'Classic Wooden Shoe Cabinet', 'price' => 8999, 'img' => 'images/livi2.jpg', 'mat' => 'Solid Wood', 'color' => 'Walnut', 'disc' => 8, 'desc' => 'Multi-tier wooden shoe rack cabinet with ventilation louvers.'],
        ['name' => 'TV Console Storage Cabinet', 'price' => 14999, 'img' => 'images/livi3.jpg', 'mat' => 'Engineered Wood', 'color' => 'Brown', 'disc' => 12, 'desc' => 'Low profile TV entertainment cabinet with open media shelves.'],
        ['name' => 'Accent Sideboard Cabinet', 'price' => 19999, 'img' => 'images/livi4.jpg', 'mat' => 'Wood', 'color' => 'Navy Blue', 'disc' => 15, 'desc' => 'Vibrant accent sideboard cabinet with patterned carved doors.'],
        ['name' => 'Bookshelf Display Cabinet', 'price' => 12999, 'img' => 'images/livi5.jpg', 'mat' => 'Wood', 'color' => 'Cream', 'disc' => 6, 'desc' => 'Open bookshelf cabinet for books, trophies and home decor.'],
        ['name' => 'Tall Glass Showcase Cabinet', 'price' => 22999, 'img' => 'images/livi6.jpg', 'mat' => 'Glass & Metal', 'color' => 'Black', 'disc' => 14, 'desc' => 'Tall glass showcase cabinet for collectibles and glassware.'],
        ['name' => 'Compact Entryway Console Cabinet', 'price' => 10999, 'img' => 'images/livi7.jpg', 'mat' => 'Engineered Wood', 'color' => 'Grey', 'disc' => 7, 'desc' => 'Slim entryway console cabinet with drawers for keys and essentials.'],
        ['name' => 'Royal Bar Cabinet Unit', 'price' => 28999, 'img' => 'images/livi8.jpg', 'mat' => 'Teak Wood', 'color' => 'Dark Walnut', 'disc' => 18, 'desc' => 'Royal wooden bar cabinet unit with glass holder and bottle racks.'],
        ['name' => 'Minimalist Storage Chest Cabinet', 'price' => 11999, 'img' => 'images/livi9.jpg', 'mat' => 'Plywood', 'color' => 'Natural Wood', 'disc' => 5, 'desc' => 'Multi-drawer chest cabinet for bedroom and living room storage.'],
        ['name' => 'Designer Crockery Cabinet Deluxe', 'price' => 25999, 'img' => 'images/livi10.jpg', 'mat' => 'Solid Wood', 'color' => 'Espresso', 'disc' => 16, 'desc' => 'Deluxe crockery cabinet with brass handles and glass doors.'],
    ],

    // 12. STUDY TABLE & BOOKSHELF (10 Products)
    'Study Table' => [
        ['name' => 'Modern Student Study Table', 'price' => 7999, 'img' => 'images/study.jpg', 'mat' => 'Wood', 'color' => 'Brown', 'disc' => 8, 'desc' => 'Ergonomic study table with bookshelves and pull-out drawer.'],
        ['name' => 'Wooden Bookshelf Unit', 'price' => 9999, 'img' => 'images/book.jpg', 'mat' => 'Solid Wood', 'color' => 'Walnut', 'disc' => 10, 'desc' => '5-tier wooden bookshelf unit for home libraries and offices.'],
        ['name' => 'Executive Study Desk Table', 'price' => 13999, 'img' => 'images/studydesk.jpg', 'mat' => 'Engineered Wood', 'color' => 'White & Oak', 'disc' => 12, 'desc' => 'Spacious study desk with side storage cabinet.'],
        ['name' => 'Tall Library Bookshelf Cabinet', 'price' => 15999, 'img' => 'images/book1.jpg', 'mat' => 'Wood', 'color' => 'Dark Brown', 'disc' => 14, 'desc' => 'Tall library bookshelf with lower storage doors.'],
        ['name' => 'Compact Corner Study Table', 'price' => 6999, 'img' => 'images/studytable2.jpg', 'mat' => 'Engineered Wood', 'color' => 'Grey', 'disc' => 6, 'desc' => 'L-shaped corner study table suitable for small rooms.'],
        ['name' => 'Modern Open Wall Bookshelf', 'price' => 8499, 'img' => 'images/book2.jpg', 'mat' => 'Metal & Wood', 'color' => 'Black & Natural', 'disc' => 7, 'desc' => 'Industrial style open wall bookshelf with sturdy metal frame.'],
        ['name' => 'Height Adjustable Study Table', 'price' => 11999, 'img' => 'images/book4.jpg', 'mat' => 'Steel & Wood', 'color' => 'White', 'disc' => 9, 'desc' => 'Ergonomic height adjustable study table for growing children.'],
        ['name' => 'Designer Ladder Bookshelf', 'price' => 7499, 'img' => 'images/book5.jpg', 'mat' => 'Wood', 'color' => 'White', 'disc' => 5, 'desc' => 'Trending ladder style bookshelf for books and planters.'],
        ['name' => 'Royal Teak Study Table', 'price' => 19999, 'img' => 'images/bookshelf2.jpg', 'mat' => 'Teak Wood', 'color' => 'Natural Teak', 'disc' => 16, 'desc' => 'Handcrafted royal teak study table with brass lock drawers.'],
        ['name' => 'Minimalist Computer Desk', 'price' => 6499, 'img' => 'images/studydesk.jp.jpg', 'mat' => 'Wood', 'color' => 'Natural', 'disc' => 5, 'desc' => 'Simple minimalist computer desk with metal leg supports.'],
    ],
];

echo "Seeding 120 products (10 products per category across 12 categories)...\n";
$totalCount = 0;

foreach ($allCategories as $categoryName => $products) {
    foreach ($products as $pData) {
        $product = Product::updateOrCreate(
            ['name' => $pData['name']],
            [
                'category'    => $categoryName,
                'price'       => $pData['price'],
                'description' => $pData['desc'],
                'image'       => $pData['img'],
                'material'    => $pData['mat'],
                'color'       => $pData['color'],
                'stock'       => rand(5, 20),
                'discount'    => $pData['disc'],
            ]
        );

        ProductImage::updateOrCreate(
            [
                'product_id'  => $product->id,
                'image'       => $pData['img'],
            ],
            [
                'sort_order'  => 0,
                'is_featured' => true,
            ]
        );

        $totalCount++;
    }
}

echo "SUCCESS! $totalCount products seeded into database across all 12 categories!\n";
echo "Total products in database: " . Product::count() . "\n";
