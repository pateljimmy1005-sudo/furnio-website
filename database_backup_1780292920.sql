DROP TABLE IF EXISTS `abouts`;
CREATE TABLE `abouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `abouts` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES ('1', 'Welcome Furnio', 'FURNIO provides premium furniture solutions with modern designs and exceptional comfort. From luxurious sofas to elegant dining tables, our products are carefully designed to bring style, functionality, and happiness to your living spaces.', 'about1.jpg', '2026-05-27 10:59:29', '2026-05-27 09:59:28');
INSERT INTO `abouts` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES ('2', 'Our Mission', 'Our mission is to deliver premium quality furniture with modern designs that make every home beautiful, comfortable, and elegant for families.', 'about.jpg', '2026-05-27 10:59:29', '2026-05-27 10:59:29');
INSERT INTO `abouts` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES ('3', 'Why Choose Us', 'We provide durable furniture, modern collections, affordable pricing, fast delivery, and excellent customer support for every customer.', 'chooseus.jpg', '2026-05-27 10:59:29', '2026-05-27 10:59:29');
INSERT INTO `abouts` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES ('4', 'Our Vision', 'Our vision is to become one of the leading furniture brands by offering innovative furniture solutions and customer satisfaction.', 'vision.jpg', '2026-05-27 10:59:29', '2026-05-27 10:59:29');


DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES ('1', 'patel jimmi', 'pateljimmy1005@gmail.com', '703452334', 'complan', 'dwefrgthyujikolikujyhtgrfedwdefrgthyujikujyhtgrfe', '2026-05-29 11:52:56', '2026-05-29 11:52:56');
INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES ('2', 'patel jimmi', 'pateljimmy1005@gmail.com', '236788765', 'complan', 'binb ;QUIREH RHNFDUjdvnhjrefb', '2026-05-29 11:53:40', '2026-05-29 11:53:40');


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('1', '0001_01_01_000000_create_users_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('2', '0001_01_01_000001_create_cache_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('3', '0001_01_01_000002_create_jobs_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('4', '2026_04_08_094909_create_products_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('5', '2026_05_06_090643_create_carts_table', '1');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('6', '2026_05_07_092145_create_orders_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('7', '2026_05_21_090150_create_abouts_table', '2');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('8', '2026_05_25_061329_add_role_to_users_table', '3');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('9', '2026_05_26_120630_create_wishlists_table', '4');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES ('10', '2026_05_29_094103_create_contact_table', '5');


DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `quantity` int NOT NULL DEFAULT '1',
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Cash On Delivery',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `name`, `phone`, `address`, `quantity`, `total_price`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES ('1', '4', '12', 'User', '0000000000', 'N/A', '1', '25999.00', 'COD', 'pending', '2026-06-01 04:41:53', '2026-06-01 04:41:53');


DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL,
  `discount` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('1', '1', 'Modern Sofa Deluxe', 'Sofa', '26999.00', 'Premium deluxe sofa with extra comfort', 'sofa.jpg', 'Leather', 'Brown', '8', '5', '2026-05-27 10:23:23', '2026-05-27 10:23:23');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('2', '1', 'Luxury Corner Sofa', 'Sofa', '32999.00', 'Stylish corner sofa for large living rooms', 'sofa1.jpg', 'Velvet', 'Grey', '5', '10', '2026-05-27 10:23:23', '2026-05-27 10:23:23');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('3', '1', 'Classic Wooden Sofa', 'Sofa', '21999.00', 'Traditional wooden sofa with cushions', 'sofa2.jpg', 'Wood', 'Cream', '7', '7', '2026-05-27 10:23:23', '2026-05-27 10:23:23');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('4', '1', 'Modern Fabric Sofa', 'Sofa', '24999.00', 'Soft fabric sofa with elegant design', 'sofa3.jpg', 'Fabric', 'Blue', '9', '6', '2026-05-27 10:23:23', '2026-05-27 10:23:23');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('5', '1', 'Royal Leather Sofa', 'Sofa', '39999.00', 'Royal leather sofa set for luxury homes', 'sofa4.jpg', 'Leather', 'Black', '4', '15', '2026-05-27 10:23:23', '2026-05-27 10:23:23');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('6', '1', 'Compact Sofa', 'Sofa', '18999.00', 'Compact sofa suitable for small apartments', 'sofa5.jpg', 'Fabric', 'Green', '10', '4', '2026-05-27 10:23:23', '2026-05-27 10:23:23');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('7', '1', 'Designer Sofa', 'Sofa', '28999.00', 'Modern designer sofa with stylish look', 'sofa6.jpg', 'Velvet', 'White', '6', '9', '2026-05-27 10:23:23', '2026-05-27 10:23:23');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('8', '1', 'Premium Lounge Sofa', 'Sofa', '35999.00', 'Comfortable lounge sofa with premium finish', 'sofa10.jpg', 'Leather', 'Tan', '3', '12', '2026-05-27 10:23:23', '2026-05-27 10:23:23');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('9', '1', 'Minimal Sofa Set', 'Sofa', '22999.00', 'Minimal design sofa for modern interiors', 'sofa8.jpg', 'Fabric', 'Grey', '8', '5', '2026-05-27 10:23:23', '2026-05-27 10:23:23');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('10', '1', 'Elegant Family Sofa', 'Sofa', '30999.00', 'Large family sofa with elegant comfort', 'sofa9.jpg', 'Leather', 'Brown', '5', '8', '2026-05-27 10:23:23', '2026-05-27 10:23:23');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('11', '2', 'Wooden Bed Deluxe', 'Bed', '19999.00', 'Premium wooden bed with stylish finish', 'bad1.jpg', 'Wood', 'Walnut', '7', '10', '2026-05-27 10:42:44', '2026-05-27 10:42:44');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('12', '2', 'Modern King Bed', 'Bed', '25999.00', 'Modern king size bed with storage drawers', 'bad2.jpg', 'Teak Wood', 'Brown', '5', '12', '2026-05-27 10:42:44', '2026-05-27 10:42:44');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('13', '2', 'Classic Wooden Bed', 'Bed', '17999.00', 'Classic wooden bed for traditional homes', 'bad3.jpg', 'Wood', 'Cream', '8', '5', '2026-05-27 10:42:44', '2026-05-27 10:42:44');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('14', '2', 'Luxury Bed Set', 'Bed', '34999.00', 'Luxury bed set with premium headboard', 'bad4.jpg', 'Engineered Wood', 'Black', '4', '15', '2026-05-27 10:42:44', '2026-05-27 10:42:44');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('15', '2', 'Minimal Bed', 'Bed', '16999.00', 'Simple minimalist wooden bed design', 'bad5.jpg', 'Wood', 'White', '6', '6', '2026-05-27 10:42:44', '2026-05-27 10:42:44');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('16', '2', 'Storage Bed', 'Bed', '22999.00', 'Wooden storage bed with side drawers', 'bad6.jpg', 'Plywood', 'Brown', '5', '9', '2026-05-27 10:42:44', '2026-05-27 10:42:44');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('17', '2', 'Double Bed Premium', 'Bed', '28999.00', 'Premium double bed with smooth finish', 'bad7.jpg', 'Teak Wood', 'Walnut', '3', '14', '2026-05-27 10:42:44', '2026-05-27 10:42:44');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('18', '2', 'Family Bed', 'Bed', '31999.00', 'Large family size bed with comfort support', 'bad8.jpg', 'Wood', 'Grey', '4', '11', '2026-05-27 10:42:44', '2026-05-27 10:42:44');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('19', '2', 'Elegant Bed', 'Bed', '23999.00', 'Elegant modern bed for stylish bedrooms', 'bad9.jpg', 'Engineered Wood', 'Brown', '6', '8', '2026-05-27 10:42:44', '2026-05-27 10:42:44');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('20', '2', 'Royal Bedroom Bed', 'Bed', '39999.00', 'Royal bedroom bed with luxury comfort', 'bad10.jpg', 'Solid Wood', 'Dark Brown', '2', '18', '2026-05-27 10:42:44', '2026-05-27 10:42:44');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('21', '3', 'Gaming Office Chair', 'Chair', '7999.00', 'Comfortable gaming office chair with wheels', 'cha1.jpg', 'Mesh', 'Black', '12', '8', '2026-05-27 10:45:55', '2026-05-27 10:45:55');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('22', '3', 'Executive Chair', 'Chair', '9999.00', 'Premium executive chair for office use', 'cha2.jpg', 'Leather', 'Brown', '8', '10', '2026-05-27 10:45:55', '2026-05-27 10:45:55');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('23', '3', 'Modern Study Chair', 'Chair', '5499.00', 'Modern study chair with ergonomic support', 'cha3.jpg', 'Plastic', 'White', '15', '5', '2026-05-27 10:45:55', '2026-05-27 10:45:55');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('24', '3', 'Luxury Office Chair', 'Chair', '11999.00', 'Luxury office chair with adjustable height', 'cha4.jpg', 'Leather', 'Grey', '6', '12', '2026-05-27 10:45:55', '2026-05-27 10:45:55');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('25', '3', 'Wooden Chair', 'Chair', '4499.00', 'Classic wooden chair for home and office', 'cha5.jpg', 'Wood', 'Brown', '14', '4', '2026-05-27 10:45:55', '2026-05-27 10:45:55');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('26', '3', 'Comfort Chair', 'Chair', '6999.00', 'Soft cushion comfort chair with armrest', 'cha6.jpg', 'Fabric', 'Blue', '10', '7', '2026-05-27 10:45:55', '2026-05-27 10:45:55');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('27', '3', 'Minimal Chair', 'Chair', '3999.00', 'Minimal style chair with modern look', 'cha7.jpg', 'Plastic', 'Black', '18', '3', '2026-05-27 10:45:55', '2026-05-27 10:45:55');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('28', '3', 'Dining Chair Premium', 'Chair', '5999.00', 'Premium dining chair with stylish design', 'cha8.jpg', 'Wood', 'Cream', '11', '6', '2026-05-27 10:45:55', '2026-05-27 10:45:55');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('29', '3', 'Computer Chair', 'Chair', '8499.00', 'Computer chair with wheels and back support', 'cha9.jpg', 'Mesh', 'Red', '9', '9', '2026-05-27 10:45:55', '2026-05-27 10:45:55');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('30', '3', 'Royal Chair', 'Chair', '12999.00', 'Royal luxury chair with premium comfort', 'cha10.jpg', 'Velvet', 'Golden', '5', '15', '2026-05-27 10:45:55', '2026-05-27 10:45:55');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('31', '4', 'Modern Dining Table', 'Table', '13999.00', 'Modern dining table for family dining rooms', 'ta1.jpg', 'Wood', 'White', '5', '12', '2026-05-27 10:50:31', '2026-05-27 10:50:31');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('32', '4', 'Luxury Dining Table', 'Table', '24999.00', 'Luxury dining table with premium finish', 'ta2.jpg', 'Teak Wood', 'Brown', '3', '15', '2026-05-27 10:50:31', '2026-05-27 10:50:31');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('33', '4', 'Glass Coffee Table', 'Table', '8999.00', 'Stylish glass coffee table for living room', 'ta3.jpg', 'Glass', 'Black', '8', '7', '2026-05-27 10:50:31', '2026-05-27 10:50:31');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('34', '4', 'Office Computer Table', 'Table', '10999.00', 'Computer table with storage shelves', 'ta11.jpg', 'Engineered Wood', 'Grey', '6', '9', '2026-05-27 10:50:31', '2026-05-27 10:50:31');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('35', '4', 'Minimal Study Table', 'Table', '6999.00', 'Minimal study table for students', 'ta5.jpg', 'Wood', 'White', '10', '5', '2026-05-27 10:50:31', '2026-05-27 10:50:31');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('36', '4', 'Round Dining Table', 'Table', '15999.00', 'Round dining table with modern design', 'ta6.jpg', 'Wood', 'Cream', '4', '10', '2026-05-27 10:50:31', '2026-05-27 10:50:31');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('37', '4', 'Classic Wooden Table', 'Table', '11999.00', 'Classic wooden table for home interiors', 'ta7.jpg', 'Solid Wood', 'Walnut', '7', '6', '2026-05-27 10:50:31', '2026-05-27 10:50:31');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('38', '4', 'Premium Office Desk', 'Table', '17999.00', 'Premium office desk with modern finish', 'ta8.jpg', 'Engineered Wood', 'Brown', '5', '11', '2026-05-27 10:50:31', '2026-05-27 10:50:31');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('39', '4', 'Compact Coffee Table', 'Table', '5999.00', 'Compact coffee table for small spaces', 'ta9.jpg', 'Glass', 'White', '12', '4', '2026-05-27 10:50:31', '2026-05-27 10:50:31');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('40', '4', 'Royal Dining Table', 'Table', '29999.00', 'Royal dining table set for luxury homes', 'ta10.jpg', 'Teak Wood', 'Golden Brown', '2', '18', '2026-05-27 10:50:31', '2026-05-27 10:50:31');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('41', '9', 'Modern Wardrobe Deluxe', 'Wardrobe', '28999.00', 'Modern wardrobe with deluxe storage space', 'war1.jpg', 'Wood', 'Brown', '8', '10', '2026-05-27 10:54:51', '2026-05-27 10:54:51');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('42', '9', 'Sliding Door Wardrobe', 'Wardrobe', '35999.00', 'Sliding door wardrobe with mirror finish', 'war2.jpg', 'Engineered Wood', 'White', '5', '15', '2026-05-27 10:54:51', '2026-05-27 10:54:51');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('43', '9', 'Classic Wooden Wardrobe', 'Wardrobe', '24999.00', 'Classic wooden wardrobe with drawers', 'war3.jpg', 'Solid Wood', 'Walnut', '6', '8', '2026-05-27 10:54:51', '2026-05-27 10:54:51');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('44', '9', 'Luxury Wardrobe', 'Wardrobe', '42999.00', 'Luxury wardrobe for premium bedrooms', 'war4.jpg', 'Teak Wood', 'Black', '3', '18', '2026-05-27 10:54:51', '2026-05-27 10:54:51');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('45', '9', 'Minimal Wardrobe', 'Wardrobe', '21999.00', 'Minimal wardrobe with simple elegant design', 'war5.jpg', 'Wood', 'Grey', '9', '5', '2026-05-27 10:54:51', '2026-05-27 10:54:51');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('46', '9', 'Mirror Wardrobe', 'Wardrobe', '31999.00', 'Wardrobe with full size mirror and shelves', 'war6.jpg', 'Engineered Wood', 'Cream', '4', '12', '2026-05-27 10:54:51', '2026-05-27 10:54:51');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('47', '9', 'Family Wardrobe', 'Wardrobe', '38999.00', 'Large family wardrobe with multiple sections', 'war7.jpg', 'Wood', 'Brown', '5', '14', '2026-05-27 10:54:51', '2026-05-27 10:54:51');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('48', '9', 'Premium Closet Wardrobe', 'Wardrobe', '46999.00', 'Premium closet wardrobe with luxury finish', 'war8.jpg', 'Solid Wood', 'Dark Brown', '2', '20', '2026-05-27 10:54:51', '2026-05-27 10:54:51');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('49', '9', 'Compact Wardrobe', 'Wardrobe', '19999.00', 'Compact wardrobe for small bedrooms', 'war9.jpg', 'Plywood', 'White', '10', '6', '2026-05-27 10:54:51', '2026-05-27 10:54:51');
INSERT INTO `product_images` (`id`, `product_id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('50', '9', 'Royal Wardrobe', 'Wardrobe', '54999.00', 'Royal wardrobe with stylish modern interior', 'war10.jpg', 'Teak Wood', 'Golden Brown', '2', '25', '2026-05-27 10:54:51', '2026-05-27 10:54:51');


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `discount` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('1', 'Modern Sofa', 'Sofa', '2599911.00', 'Comfortable modern sofa for living room', 'sofa1.jpg', 'Leather', 'Brown', '10', '5', '2026-05-27 15:08:54', '2026-05-28 12:25:20');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('2', 'Wooden Bed', 'Bed', '18999.00', 'Stylish wooden king size bed', 'bed1.jpg', 'Wood', 'Walnut', '7', '10', '2026-05-27 15:08:54', '2026-05-27 15:08:54');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('3', 'Office Chair', 'Chair', '5999.00', 'Ergonomic office chair with wheels', 'chair1.jpg', 'Mesh', 'Black', '15', '8', '2026-05-27 15:08:54', '2026-05-27 15:08:54');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('4', 'Dining Table', 'Table', '12999.00', '6-seater modern dining table', 'table1.jpg', 'Wood', 'White', '5', '12', '2026-05-27 15:08:54', '2026-05-27 15:08:54');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('5', 'Luxury Sofa', 'Sofa', '34999.00', 'Premium luxury sofa set', 'sofa2.jpg', 'Velvet', 'Grey', '4', '15', '2026-05-27 15:08:54', '2026-05-27 15:08:54');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('6', 'Study Table', 'Table', '7999.00', 'Compact study table for students', 'studytable.jpg', 'Wood', 'Brown', '12', '5', '2026-05-27 15:08:54', '2026-05-27 15:08:54');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('7', 'Classic Chair', 'Chair', '55000.00', 'Classic wooden chair design', 'chair2.jpg', 'Wood', 'Cream', '20', '3', '2026-05-27 15:08:54', '2026-05-28 12:24:33');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('8', 'Double Bed', 'Bed', '22999.00', 'Modern double bed with storage', 'bed2.jpg', 'Engineered Wood', 'Brown', '6', '7', '2026-05-27 15:08:54', '2026-05-27 15:08:54');
INSERT INTO `products` (`id`, `name`, `category`, `price`, `description`, `image`, `material`, `color`, `stock`, `discount`, `created_at`, `updated_at`) VALUES ('9', 'Classic Wardrobe', 'Wardrobe', '3999.00', 'Classic wooden wardrobe design', 'war2.jpg', 'Wood', 'Cream', '20', '3', '2026-05-27 15:08:54', '2026-05-27 15:08:54');


DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('0LUlpbrbwZPxvFd62kzR0KnvYw2apkB91n7l2SBR', '4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYmtXQkR5RERrNW83YzhDa1hNRnJwbjAwZW1hZ1ozU0U2NEVJWElVUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', '1780029958');


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES ('4', 'Admin', 'admin@gmail.com', NULL, '$2y$12$VrLimFVloUGymswDBBGE6OpYWeUEnteYabXPoMLSJ0Ug8goLYRUsO', NULL, '2026-05-28 15:12:48', '2026-05-28 12:49:31', 'admin');


DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wishlist_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



