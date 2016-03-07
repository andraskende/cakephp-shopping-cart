/*
 Navicat MySQL Data Transfer

 Source Server         : kende.com
 Source Server Version : 50628
 Source Host           : kende.com
 Source Database       : shop

 Target Server Version : 50628
 File Encoding         : utf-8

 Date: 03/07/2016 02:21:08 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `brands`
-- ----------------------------
DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `brands`
-- ----------------------------
BEGIN;
INSERT INTO `brands` VALUES ('1', 'Burton', 'burton', '1', '2012-12-06 00:00:00', '2012-12-06 00:00:00'), ('2', 'Celtek', 'celtek', '1', '2012-12-06 00:00:00', '2016-02-26 02:28:41'), ('3', 'Dakine', 'dakine', '1', '2012-12-06 00:00:00', '2012-12-06 00:00:00'), ('4', 'DC', 'dc', '1', '2012-12-06 00:00:00', '2012-12-06 00:00:00'), ('5', 'Electric', 'electric', '1', '2012-12-06 00:00:00', '2012-12-06 00:00:00'), ('6', 'Forum', 'forum', '1', '2012-12-06 00:00:00', '2012-12-06 00:00:00'), ('7', 'US Mint', 'us-mint', '1', '2014-10-30 02:06:24', '2014-10-30 02:06:24');
COMMIT;

-- ----------------------------
--  Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `lft` int(10) unsigned DEFAULT NULL,
  `rght` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `categories`
-- ----------------------------
BEGIN;
INSERT INTO `categories` VALUES ('1', null, '1', '6', 'Main', 'main', 'Main', '2013-10-29 23:59:43', '2013-10-29 23:59:43'), ('2', '1', '2', '3', 'Shoes', 'shoes', 'Shoes', '2013-11-05 13:39:09', '2013-11-05 13:39:09'), ('3', '1', '4', '5', 'Silver Coins', 'silver-coins', 'Silver Coins', '2014-10-30 02:06:12', '2016-02-26 02:29:12');
COMMIT;

-- ----------------------------
--  Table structure for `order_items`
-- ----------------------------
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `weight` decimal(8,2) unsigned DEFAULT '0.00',
  `price` decimal(8,2) unsigned DEFAULT NULL,
  `subtotal` decimal(8,2) unsigned DEFAULT NULL,
  `productmod_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `orders`
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` decimal(8,2) unsigned DEFAULT '0.00',
  `order_item_count` int(11) DEFAULT NULL,
  `subtotal` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `shipping` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) unsigned DEFAULT NULL,
  `order_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authorization` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `productmods`
-- ----------------------------
DROP TABLE IF EXISTS `productmods`;
CREATE TABLE `productmods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modified` (`modified`),
  KEY `category_id` (`product_id`),
  KEY `brand_id` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `productmods`
-- ----------------------------
BEGIN;
INSERT INTO `productmods` VALUES ('8', '19', 'brown_8', 'brown 8', null, '79.00', null, '1', '0', '2014-05-08 01:06:18', '2014-05-08 02:07:08'), ('9', '19', 'brown_9', 'brown 9', null, '79.00', null, '1', '0', '2014-05-08 01:06:39', '2014-05-08 02:07:22'), ('10', '19', 'brown_10', 'brown 10', null, '79.00', null, '1', '0', '2014-05-08 01:07:09', '2014-05-08 02:07:32');
COMMIT;

-- ----------------------------
--  Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned DEFAULT NULL,
  `brand_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `active` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `modified` (`modified`),
  KEY `name_slug` (`slug`),
  KEY `category_id` (`category_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `products`
-- ----------------------------
BEGIN;
INSERT INTO `products` VALUES ('1', '1', '1', 'Burton TWC Smuggler Snowboard Pant Bright White', 'burton-twc-smuggler-snowboard-pant-bright-white', 'That&apos;s one big ol&apos; cargo pocket; perfect for pushing ham sandwiches across the border.To give you the most bang for your buck, Shaun hid a ton of tricks inside this waterproof wonder. The not-too-baggy, classic fit leaves room for extra layers, while inner thigh vents let you release excess heat. The mesh lining dries quickly so you&apos;re never cold and clammy, and when nature calls, snap up your cuffs with the Leg Lifts to avoid nasty restroom floors.<br />Key Features of the Burton TWC Smuggler Snowboard Pant: 5,000mm Waterproof 5,000g Breathability DRYRIDE Durashell 2-Layer Coated Fabric [5,000MM, 5,000G] TWC Sig Fit Mesh Lining Mesh-Lined Inner Thigh Vents Fully Taped Seams Cargo Pocket with Velcro Closure Includes White Collection Pant Features Package', 'burton-twc-smuggler-snowboard-pant-bright-white.jpg', '77.95', '2.00', null, '51964', '1', '2012-12-06 00:00:00', '2012-12-08 05:08:22'), ('2', '1', '2', 'Celtek Merit Facemask Orange/Black', 'celtek-merit-facemask-orange-black', '<br />Key Features of the Celtek Merit Facemask: 100% nylon mesh Reversible Tie closure Oversized screen print Ventilated eyelets', 'celtek-merit-facemask-orange-black.jpg', '19.95', '7.00', null, '51964', '1', '2012-12-06 00:00:00', '2016-02-26 02:34:27'), ('3', '1', '1', 'Burton Restricted Wilkes 5 Pkt Snowboard Pants Blue Tiger Print', 'burton-restricted-wilkes-5-pkt-snowboard-pants-blue-tiger-print', 'Burton Restricted Wilkes 5 Pkt Snowboard Pants will keep you looking good and feeling good all day long in the snow. The DRYRIDE fabric allows for breathability and waterproofing all in one, making sure you stay both cool and dry. The pants are also backed by a lifetime warranty so if anything goes wrong simply get them exchanged for a new pair. The Burton Restricted Wilkes 5 Pkt Snowboard Pants also feature snap up leg lifts. No longer do you have to worry about scuffing and tearing the cuffs of your pants, simply snap them up when walking around and let them back down when on your snowboard.<br />Key Features of The Burton Restricted Wilkes 5 Pockets Men&apos;s Snowboard Pants: 10,000mm Waterproof 5,000g Breathability DRYRIDE Durashell 2-Layer Laminated Fabric [10,000MM, 5,000G] Burton Slim Fit Mesh Lining Inner Thigh Vents Fully Taped Seams LIFETIME WARRANTY DRYRIDE Fabrication with DWR Coating Inner Thigh Vents Fully Taped Seams Zippered, Microfleece-Lined Handwarmer Pockets Link ZIP Jacket-to-Pant Interface Boot Gaiter with Cuff-to-Boot Interface Articulated Knees Integrated Waist Adjustment Microfleece Fly and Waistband Double-Headed Fly Ghetto Slits Snap-Up Leg Lifts,Keep Your Cuffs Scuff-Free', 'burton-restricted-wilkes-5-pkt-snowboard-pants-blue-tiger-print.jpg', '81.95', '9.00', 'clothing, winter', '52503', '1', '2012-12-06 00:00:00', '2013-11-04 03:55:38'), ('4', '1', '1', 'Burton Society Snowboard Pants Capers', 'burton-society-snowboard-pants-capers', 'Be civilized yet play the edge in the women&apos;s Burton Society Pant. Waterproof/breathable DRYRIDE Durashell 2L fabric and our classic signature fit combine to protect you from wind, wet, and wacky style. Lightweight levels of Thermacore insulation protect your buns from freezer burn and with mesh-lined inner thigh vents, you can keep cool when hiking or springtime riding. When the snow-choked back bowls invite you to mingle; RSVP yes &apos;cause boot gaiters and jacket-to-pant interface let you have a blast without getting bogged down in the deep stuff.<br />Key Features of The Burton Society Women&apos;s Snowboard Pants: 5,000mm Waterproof 5,000g Breathability DRYRIDE Durashell 2-Layer Coated Smooth Face Woven Fabric [5,000MM, 5,000G] Fully Taped Seams Mesh Lined Inner Thigh Vents Taffeta Wrapture Lining Thermacore Insulation (40G Throughout) Includes Women&apos;s Burton Package Sig Fit', 'burton-society-snowboard-pants-capers.jpg', '49.95', '7.00', null, '51967', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:03'), ('5', '1', '1', 'Burton Society Snowboard Pants Grass Stain', 'burton-society-snowboard-pants-grass-stain', 'Get more bang for your buck. Waterproof warmth that performs all season.Get more bang for your buck with this weatherproof and versatile all-season style. Lightweight Thermacore insulation protect your buns from freezer burn and with mesh-lined inner thigh vents, you can cool quickly when hiking or springtime riding. Like all women&apos;s Burton pants, you can seal these to any Burton jacket to block out snow, and lift the cuffs to protect from mud and pavement.<br />Key Features of the Burton Society Snowboard Pants: 5,000mm Waterproof 5,000g Breathability DRYRIDE Durashell 2-Layer Coated Smooth Face Woven Fabric [5,000MM, 5,000G] Sig Fit Thermacore Insulation [40G Throughout] Taffeta Lining Mesh-Lined Inner Thigh Vents Fully Taped Seams Includes Women&apos;s Burton Pant Features Package', 'burton-society-snowboard-pants-grass-stain.jpg', '71.95', '5.00', null, '51966', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:04'), ('6', '1', '1', 'Burton TWC Factory Beanie Red', 'burton-twc-factory-beanie-red', 'Looking for a great looking beanie to keep your melon warm these winter months. When it comes to getting a beanie, you want to get one that offers a lot of warmth, because it&apos;s never fun when your ears are cold. It&apos;s also important to get a design you like, so you continue to wear your hat and protect your ears. If you like subtle looks, you will love this Burton TWC Factory Beanie. It&apos;s a real simple knitted beanie that offers a ton of warmth to those ears of yours.<br />Key Features of the Burton TWC Factory Beanie: 100% Acrylic Loose Knit Beanie Convertible Slouched to Skully Fit TWC Embroidery', 'burton-twc-factory-beanie-red.jpg', '12.56', '7.00', null, '52078', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:04'), ('7', '1', '4', 'DC Hall T-Shirt Royal Blue', 'dc-hall-t-shirt-royal-blue', '<br />Key Features of The DC Hall T-Shirt: Regular Fit Crew Neck Short Sleeve', 'dc-hall-t-shirt-royal-blue.jpg', '13.95', '1.00', null, '51964', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:04'), ('8', '1', '4', 'DC Iikka T-Shirt Black', 'dc-iikka-t-shirt-black', '<br />Key Features of The DC Iikka T-Shirt: Regular Fit Crew Neck Short Sleeve 100% cotton 6.0oz 18/1&apos;s core fit jersey', 'dc-iikka-t-shirt-black.jpg', '9.95', '5.00', null, '51964', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:04'), ('9', '1', '6', 'Forum Shepherd Snowboard Boots Brown', 'forum-shepherd-snowboard-boots-brown', 'The Shepherd is J.P.&apos;s signature boot and a team favorite. It returns this season with a few minor tweaks including our high-performance hybrid liner and a rubberized toe guard for extra protection against rail and snowmobile abuse. The Shepherd&apos;s overlasted midsole/outsole creates the ultimate all-mountain freestyle boot for riders who want enhanced terrain feel and board control.<br />Key Features of the Forum Shepherd Snowboard Boots: LINER: Concentrix Level 3 CUFF LINK: Gold SOLE: Overlasted LACING SYSTEM: Traditional', 'forum-shepherd-snowboard-boots-brown.jpg', '114.95', '4.00', null, '51964', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:04'), ('11', '1', '4', 'DC Trust Skate Shoes Dark Shadow', 'dc-trust-skate-shoes-dark-shadow', '<br />Key Features of the DC Trust Skate Shoes: Silky Suede Upper Foam-Padded Tongue and Collar for added Comfort &amp; Support DC&apos;s Performance Cup Sole Construction Abrasion-Resistant Sticky Rubber Outsole with DC&apos;s Trademarked &quot;Pill&quot; Pattern HEAVY DUTY CANVAS ON UPPER PANEL Extra sandwich mesh tongue with ventilated foam', 'dc-trust-skate-shoes-dark-shadow.jpg', '64.95', '9.00', null, '51964', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:05'), ('12', '1', '5', 'Electric Charge Sunglasses Crimson Red/Grey Fire Chrome Lens', 'electric-charge-sunglasses-crimson-red-grey-fire-chrome-lens', 'Sometimes going into social situations is scary, especially if your face is naked, and the fear in your eyes is visible. But when the time comes to make your entrance, there&amp;#8217;s only one thing to do&amp;#8230; CHARGE! Classic styling, wrap fit, great for any face-these are the no nonsense, no bullsh*t, universal shades that will make any entrance you make amazing.<br />Key Features of the Electric Charge Sunglasses: Size Category - 2 100% UV Protection 8 Base Mold Injected Grilamid Frame 8 Base Polycarbonate Lens 5 Barrel Stainless Steel Optical Hinge', 'electric-charge-sunglasses-crimson-red-grey-fire-chrome-lens.jpg', '100.00', '2.00', null, '52720', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:05'), ('13', '1', '4', 'DC Court Vulc Skate Shoes Black/Athletic Red', 'dc-court-vulc-skate-shoes-black-athletic-red', '<br />Key Features of the DC Court Vulc Skate Shoes: An extension of the successful Court Graffik franchise, the Court Vulc features the classic styling with a vulcanized construction for great board feel and sole flex Abrasion resistant sticky rubber outsole DC&apos;s Trademarked &quot;Pill Pattern&quot; bottom', 'dc-court-vulc-skate-shoes-black-athletic-red.jpg', '54.95', '0.00', null, '52016', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:05'), ('14', '1', '3', 'Dakine Scrambler Jr. Toddler Mittens Walrus', 'dakine-scrambler-jr-toddler-mittens-walrus', '<br />Key Features of the Dakine Scrambler Jr. Toddler Snowboard Mittens: Waterproof insert High Loft Synthetic Insulation 230g Fleece Lining', 'dakine-scrambler-jr-toddler-mittens-walrus.jpg', '23.00', '7.00', null, '51964', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:05'), ('15', '1', '4', 'DC So Long T-Shirt Blue Surf', 'dc-so-long-t-shirt-blue-surf', '<br />Key Features of The DC So Long T-Shirt: Regular Fit Crew Neck Short Sleeve', 'dc-so-long-t-shirt-blue-surf.jpg', '20.95', '5.00', null, '51963', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:05'), ('16', '1', '4', 'DC Shocked T-Shirt Celtic', 'dc-shocked-t-shirt-celtic', '<br />Key Features of the DC Shocked T-Shirt: Premium fit 100% cotton', 'dc-shocked-t-shirt-celtic.jpg', '14.95', '6.00', null, '51964', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:05'), ('18', '1', '4', 'DC Rogan Snowboard Boots Black/Rasta', 'dc-rogan-snowboard-boots-black-rasta', 'The Rogan offers the right amount of flex and comfort for all day park laps, while still be supportive enough to explore the entire mountain. This rider-inspired, skate influenced boot is one of the most versatile in DC&apos;s line.<br />Key Features of the DC Rogan Snowboard Boots: Direct power lacing 3D Tongue Articulation Molded backstay Internal ankle harness Unilite Bravo liner Flex rating: 6', 'dc-rogan-snowboard-boots-black-rasta.jpg', '118.95', '8.00', null, '52002', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:06'), ('19', '1', '6', 'Forum Aura Snowboard Boots Chocolate', 'forum-aura-snowboard-boots-chocolate', 'Had a little work done and now she&apos;s better than ever. The Aura is a perennial favorite that offers style and performance at a great price. For 2008, it received the most significant makeover of all our carryover boots. Its refined court shoe-inspired outer with metal lace hooks is packed with our new 4D-molded tongue, innovative hybrid liner with 3/4 footbed and ankle supports, stabilizing internal cuff, and our rugged high-traction cupsole with self-cleaning tread.<br />Key Features of The Forum Aura Women&apos;s Snowboard Boots: Concentrix Level 1 Liner - Basic yet supportive, this no frills option features a molded EVA footbed, new anatomical PE supports, and adjustable calf straps for enhanced fit Silver Cuff Link - This option has a new custom lace look and provides much of the same comfort and hold as Forum&apos;s Gold Cuff line, except it comes in a stream lined configuration with an internal cage Cup Sole Traditional Lacing System Flex - 4', 'forum-aura-snowboard-boots-chocolate.jpg', '68.95', '3.00', null, '52830', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:06'), ('20', '1', '4', 'DC Lear Mittens Blue Radiance/Black', 'dc-lear-mittens-blue-radiance-black', '<br />Key Features of the DC Lear Snowboard Mittens: 10,000mm waterproof poly-insulated mitten with inner finger channels nose wipe Grippy palm Thumb protection Internal pocket', 'dc-lear-mittens-blue-radiance-black.jpg', '29.95', '2.00', null, '51965', '1', '2012-12-06 00:00:00', '2012-12-08 02:39:06');
COMMIT;

-- ----------------------------
--  Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `modified` (`modified`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `tags`
-- ----------------------------
BEGIN;
INSERT INTO `tags` VALUES ('1', 'clothing', '2013-11-03 15:18:13', '2013-11-03 15:18:13'), ('2', 'winter', '2013-11-03 15:18:33', '2013-11-03 15:18:33'), ('3', 'summer', '2013-11-03 15:18:36', '2013-11-03 15:18:36'), ('4', 'equipment', '2013-11-03 15:18:41', '2013-11-03 15:18:41'), ('5', 'black', '2013-11-03 15:39:35', '2013-11-03 15:39:35'), ('6', 'white', '2013-11-03 15:39:39', '2013-11-03 15:39:39');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'admin', 'admin', 'admin', '009bb9a65ad55d0e8c9d0d86dcb5bb61755b4612', '1', '2011-09-26 00:34:07', '2016-03-07 10:00:48'), ('2', 'customer', 'andras', 'andras', '009bb9a65ad55d0e8c9d0d86dcb5bb61755b4612', '1', '2013-10-29 16:58:16', '2014-05-21 05:59:55');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
