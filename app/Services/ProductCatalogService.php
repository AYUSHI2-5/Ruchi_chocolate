<?php

namespace App\Services;

class ProductCatalogService
{
    /**
     * Get the master product catalog.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getAllProducts(): array
    {
        return [
            // Row 1 (Items 1 - 4)
            [
                'id' => 'p001',
                'title' => 'P001 Small Heart Tin Box',
                'price' => 170.00,
                'rating' => 4.8,
                'rating_count' => 216,
                'image' => 'images/products/p001.jpg',
                'category' => 'chocolates',
                'occasions' => ['birthday', 'valentines-day', 'anniversary', 'congratulations', 'festive-gifting', 'childrens-day'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Make every celebration special with this elegant Heart-Shaped Chocolate Gift Box, beautifully decorated with red roses and filled with delicious assorted chocolates. Its attractive design makes it perfect for birthdays, anniversaries, Valentine’s Day and other special occasions. The chocolates and presentation can be customized according to your gifting needs.',
                'details' => [
                    'Heart-shaped decorative gift box',
                    'Contains 8–10 assorted chocolates',
                    'Beautiful red rose decoration',
                    'Customizable chocolates & presentation',
                    'Size: 3.5" × 3.75"',
                    'Net Weight: 80 g',
                ],
            ],
            [
                'id' => 'p002',
                'title' => 'P002 Big Heart Tin Box',
                'price' => 225.00,
                'rating' => 4.9,
                'rating_count' => 216,
                'image' => 'images/products/p002.jpg',
                'category' => 'chocolates',
                'occasions' => ['anniversary', 'wedding', 'reception', 'engagement', 'ring-ceremony', 'other-occasions', 'birthday', 'valentines-day'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Make gifting extra special with this elegant Big Heart-Shaped Chocolate Gift Box, featuring a beautiful red ribbon and floral decoration. Filled with 15–17 assorted chocolates, it offers a premium presentation for birthdays, anniversaries, Valentine’s Day and other celebrations. The chocolates and presentation can be customized to suit your occasion.',
                'details' => [
                    'Big heart-shaped decorative gift box',
                    'Contains 15–17 assorted chocolates',
                    'Elegant red ribbon & floral decoration',
                    'Customizable chocolates & presentation',
                    'Size: 6" × 4.5"',
                    'Net Weight: 150 g',
                ],
            ],
            [
                'id' => 'p003',
                'title' => 'P003 Rectangle Tin Box',
                'price' => 410.00,
                'rating' => 4.7,
                'rating_count' => 95,
                'image' => 'images/products/p003.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['birthday', 'mothers-day', 'wedding-hampers', 'uttarayan', 'festive-gifting', 'corporate-gifting', 'anniversary'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A stylish Rectangle Tin Chocolate Gift Box filled with 30–33 assorted chocolates, beautifully presented with a premium ribbon design. Its elegant look makes it perfect for birthdays, anniversaries, festive gifting and corporate occasions. The chocolates and presentation can be customized according to your requirements.',
                'details' => [
                    'Rectangle-shaped decorative tin box',
                    'Contains 30–33 assorted chocolates',
                    'Elegant ribbon & bow decoration',
                    'Customizable chocolates & presentation',
                    'Size: 4.5" × 4.5"',
                ],
            ],
            [
                'id' => 'p004',
                'title' => 'P004 Small Square Tin Box',
                'price' => 290.00,
                'rating' => 4.8,
                'rating_count' => 142,
                'image' => 'images/products/p004.jpg',
                'category' => 'chocolates',
                'occasions' => ['fathers-day', 'thank-you', 'corporate-gifting', 'new-year', 'uttarayan', 'birthday', 'anniversary', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => false,
                'description' => 'A beautiful Square Tin Chocolate Gift Box featuring an elegant ribbon and bow, filled with 18–20 assorted chocolates. Its compact and premium presentation makes it a lovely choice for birthdays, anniversaries, festive gifting and special occasions. The chocolates and presentation can be customized to create a personalized gift.',
                'details' => [
                    'Square decorative tin box',
                    'Contains 18–20 assorted chocolates',
                    'Elegant ribbon & bow decoration',
                    'Customizable chocolates & presentation',
                    'Size: 4" × 4"',
                ],
            ],

            // Row 2 (Items 5 - 8)
            [
                'id' => 'p005',
                'title' => 'P005 Big Square Tin Box',
                'price' => 730.00,
                'rating' => 4.9,
                'rating_count' => 310,
                'image' => 'images/products/p005.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['anniversary', 'birthday', 'wedding', 'wedding-hampers', 'raksha-bandhan', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Make gifting memorable with this Big Square Tin Chocolate Gift Box, beautifully decorated with an elegant ribbon and bow and filled with 50–55 assorted chocolates. Its generous size and premium presentation make it ideal for birthdays, anniversaries, festivals and special celebrations. The chocolates and presentation can be customized according to your gifting needs.',
                'details' => [
                    'Big square decorative tin box',
                    'Contains 50–55 assorted chocolates',
                    'Elegant ribbon & bow decoration',
                    'Customizable chocolates & presentation',
                    'Size: 8" × 8"',
                ],
            ],
            [
                'id' => 'p006',
                'title' => 'P006 Polka bag',
                'price' => 140.00,
                'rating' => 4.6,
                'rating_count' => 88,
                'image' => 'images/products/p006.jpg',
                'category' => 'chocolates',
                'occasions' => ['valentines-day', 'thank-you', 'childrens-day', 'return-gifts', 'uttarayan', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => false,
                'description' => 'Add a fun and colorful touch to your gifting with this Polka-Print Chocolate Paper Bag, filled with 12 delicious chocolates. Its cheerful design and convenient handle make it a lovely choice for birthdays, return gifts, celebrations and festive gifting. The chocolate selection and presentation can be customized to match your occasion.',
                'details' => [
                    'Colorful polka-print paper bag',
                    'Contains 12 assorted chocolates',
                    'Convenient carry handle',
                    'Customizable chocolates & presentation',
                    'Lightweight and attractive gifting option',
                ],
            ],
            [
                'id' => 'p007',
                'title' => 'P007 Chocopie Potli',
                'price' => 125.00,
                'rating' => 4.8,
                'rating_count' => 120,
                'image' => 'images/products/p007.jpg',
                'category' => 'chocolates',
                'occasions' => ['birthday', 'return-gifts', 'wedding-return-gifts', 'other-occasions', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => false,
                'description' => 'A charming Chocolate Polka Gift Pack, beautifully wrapped in a playful roll-style presentation with elegant golden and silver accents. Filled with delicious chocolates, it makes a lovely option for birthdays, return gifts, festive celebrations and special occasions. The chocolates and wrapping can be customized to match your gifting needs.',
                'details' => [
                    'Attractive roll-style chocolate packaging',
                    'Contains 15 assorted chocolates',
                    'Decorative golden & silver wrapping',
                    'Customizable chocolates & presentation',
                    'Compact and convenient gifting option',
                ],
            ],
            [
                'id' => 'p008',
                'title' => 'P008 Chocopie Round Box',
                'price' => 240.00,
                'rating' => 4.9,
                'rating_count' => 150,
                'image' => 'images/products/p008.jpg',
                'category' => 'chocolates',
                'occasions' => ['birthday', 'return-gifts', 'festive-gifting', 'anniversary', 'valentines-day'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A stylish Round Chocolate Gift Box featuring a compact and elegant design, filled with 8 delicious chocolates. Its premium round packaging makes it perfect for small gifts, return gifts, birthdays, festive occasions and celebrations. The chocolates and presentation can be customized according to your preference.',
                'details' => [
                    'Round decorative chocolate box',
                    'Contains 8 assorted chocolates',
                    'Elegant and compact presentation',
                    'Customizable chocolates & presentation',
                ],
            ],

            // Row 3 (Items 9 - 12)
            [
                'id' => 'p009',
                'title' => 'P009 Big Cone',
                'price' => 140.00,
                'rating' => 4.7,
                'rating_count' => 104,
                'image' => 'images/products/p009.jpg',
                'category' => 'chocolates',
                'occasions' => ['birthday', 'return-gifts', 'festive-gifting', 'celebrations', 'other-occasions'],
                'in_stock' => true,
                'is_trending' => false,
                'description' => 'Make gifting fun and memorable with this colorful Big Chocolate Cone, filled with 12 assorted chocolates and beautifully finished with decorative ribbons. Its unique cone-shaped presentation makes it perfect for birthdays, return gifts, celebrations and festive occasions. The chocolates and decoration can be customized to suit your gifting needs.',
                'details' => [
                    'Decorative cone-shaped chocolate gift pack',
                    'Contains 12 assorted chocolates',
                    'Colorful ribbon decoration',
                    'Customizable chocolates & presentation',
                    'Attractive and compact gifting option',
                ],
            ],
            [
                'id' => 'p010',
                'title' => 'P010 Bus',
                'price' => 160.00,
                'rating' => 4.8,
                'rating_count' => 175,
                'image' => 'images/products/p010.jpg',
                'category' => 'chocolates',
                'occasions' => ['birthday', 'congratulations', 'raksha-bandhan', 'holi', 'childrens-day', 'return-gifts', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Add a playful touch to gifting with this adorable Bus-Shaped Chocolate Gift Pack, filled with 15 assorted chocolates. Its colorful and fun design makes it especially suitable for kids\' birthdays, return gifts, school celebrations and festive occasions. The chocolates and presentation can be customized according to your requirements.',
                'details' => [
                    'Cute bus-shaped chocolate gift pack',
                    'Contains 15 assorted chocolates',
                    'Colorful decorative design',
                    'Customizable chocolates & presentation',
                    'Fun and attractive gifting option',
                ],
            ],
            [
                'id' => 'p011',
                'title' => 'P011 Chocolate Basket',
                'price' => 250.00,
                'rating' => 4.8,
                'rating_count' => 160,
                'image' => 'images/products/p011.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations', 'corporate-gifting'],
                'in_stock' => true,
                'is_trending' => false,
                'description' => 'A beautiful Round Basket Chocolate Gift, elegantly decorated with golden netting and a vibrant flower centerpiece. Filled with colorful assorted chocolates, it offers a festive and premium presentation for birthdays, anniversaries, festivals and special celebrations. The chocolates and decoration can be customized according to your gifting needs.',
                'details' => [
                    'Round decorative basket-style gift pack',
                    'Filled with assorted chocolates',
                    'Elegant golden net decoration',
                    'Decorative flower centerpiece',
                    'Customizable chocolates & presentation',
                ],
            ],
            [
                'id' => 'p012',
                'title' => 'P012 Teddy Basket',
                'price' => 180.00,
                'rating' => 4.7,
                'rating_count' => 132,
                'image' => 'images/products/p012.jpg',
                'category' => 'combos',
                'occasions' => ['birthday', 'baby-shower', 'childrens-day', 'valentines-day', 'return-gifts'],
                'in_stock' => true,
                'is_trending' => false,
                'description' => 'Make gifting extra adorable with this charming Teddy Basket Chocolate Gift, featuring a cute teddy bear holding a basket filled with 10 assorted chocolates. Its playful and attractive presentation makes it perfect for birthdays, kids\' celebrations, baby occasions and special gifting. The chocolates and presentation can be customized according to your preference.',
                'details' => [
                    'Cute teddy bear basket gift',
                    'Contains 10 assorted chocolates',
                    'Attractive decorative ribbon',
                    'Customizable chocolates & presentation',
                    'Fun and charming gifting option',
                ],
            ],

            // Row 4 (Items 13 - 16)
            [
                'id' => 'p013',
                'title' => 'P013 Cutie Jute Bag',
                'price' => 120.00,
                'rating' => 4.8,
                'rating_count' => 98,
                'image' => 'images/products/p013.jpg',
                'category' => 'chocolates',
                'occasions' => ['birthday', 'return-gifts', 'festive-gifting', 'celebrations', 'other-occasions'],
                'in_stock' => true,
                'is_trending' => false,
                'description' => 'A cute and charming Jute Bag Chocolate Gift, beautifully decorated with a floral design and filled with 8 assorted chocolates. Its natural and attractive presentation makes it perfect for birthdays, return gifts, festive occasions and small celebrations. The chocolates and decoration can be customized to match your gifting needs.',
                'details' => [
                    'Cute jute bag-style chocolate gift',
                    'Contains 8 assorted chocolates',
                    'Decorative floral embellishment',
                    'Customizable chocolates & presentation',
                    'Lightweight and attractive gifting option',
                ],
            ],
            [
                'id' => 'p014',
                'title' => 'P014 Square Cho Box',
                'price' => 210.00,
                'rating' => 4.9,
                'rating_count' => 240,
                'image' => 'images/products/p014.jpg',
                'category' => 'chocolates',
                'occasions' => ['anniversary', 'wedding', 'bride-and-groom', 'festive-gifting', 'birthday'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Add a colorful and elegant touch to your celebrations with this Square Chocolate Gift Box, beautifully designed with a vibrant decorative cover and filled with 12 assorted chocolates. Its premium presentation makes it suitable for birthdays, anniversaries, festive gifting and special occasions. The chocolates, wrapper design and presentation can be customized according to your preference.',
                'details' => [
                    'Square decorative chocolate box',
                    'Contains 12 assorted chocolates',
                    'Vibrant printed decorative cover',
                    'Customizable chocolates & packaging design',
                    'Premium and attractive presentation',
                ],
            ],
            [
                'id' => 'p015',
                'title' => 'P015 Chocolate Bar',
                'price' => 90.00,
                'rating' => 4.7,
                'rating_count' => 115,
                'image' => 'images/products/p015.jpg',
                'category' => 'chocolates',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations'],
                'in_stock' => true,
                'is_trending' => false,
                'description' => 'Make every occasion more personal with these beautifully wrapped Customized Chocolate Gifts, featuring specially designed wrappers for occasions such as birthdays, anniversaries and festivals. Filled with delicious chocolates, they are perfect for adding a thoughtful personal touch to your celebrations. Wrapper designs, messages and chocolate selection can be customized according to your occasion.',
                'details' => [
                    'Individually wrapped chocolate gifts',
                    'Custom occasion-based wrapper designs',
                    'Customizable messages, designs & chocolates',
                ],
            ],
            [
                'id' => 'p016',
                'title' => 'P016 15 chocolate',
                'price' => 290.00,
                'rating' => 4.8,
                'rating_count' => 180,
                'image' => 'images/products/p001.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'engagement', 'ring-ceremony', 'congratulations', 'womens-day'],
                'in_stock' => false,
                'is_trending' => true,
            ],

            // Items 17 - 34 (Catalog completeness)
            [
                'id' => 'p017',
                'title' => 'P017 18 Rose Chocolates Box',
                'price' => 450.00,
                'rating' => 4.9,
                'rating_count' => 205,
                'image' => 'images/products/p002.jpg',
                'category' => 'chocolates',
                'occasions' => ['valentines-day', 'anniversary', 'wedding', 'bride-and-groom', 'engagement', 'ring-ceremony'],
                'in_stock' => true,
                'is_trending' => true,
            ],
            [
                'id' => 'p018',
                'title' => 'P018 Grand Heart Jute Hamper',
                'price' => 750.00,
                'rating' => 4.9,
                'rating_count' => 165,
                'image' => 'images/products/p003.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['anniversary', 'birthday', 'wedding', 'wedding-hampers', 'raksha-bandhan', 'corporate-gifting'],
                'in_stock' => false,
                'is_trending' => true,
            ],
            [
                'id' => 'p019',
                'title' => 'P019 Chocolate Cane Bouquet',
                'price' => 490.00,
                'rating' => 4.7,
                'rating_count' => 112,
                'image' => 'images/products/p004.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'congratulations', 'thank-you', 'womens-day'],
                'in_stock' => false,
                'is_trending' => false,
            ],
            [
                'id' => 'p020',
                'title' => 'P020 Premium Dark Truffles 24pc',
                'price' => 620.00,
                'rating' => 4.8,
                'rating_count' => 190,
                'image' => 'images/products/p005.jpg',
                'category' => 'chocolates',
                'occasions' => ['mothers-day', 'fathers-day', 'corporate-gifting', 'new-year', 'christmas', 'eid'],
                'in_stock' => false,
                'is_trending' => true,
            ],
            [
                'id' => 'p021',
                'title' => 'P021 Teddy & Chocolate Hamper',
                'price' => 680.00,
                'rating' => 4.8,
                'rating_count' => 140,
                'image' => 'images/products/p001.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['birthday', 'valentines-day', 'baby-shower', 'childrens-day'],
                'in_stock' => false,
                'is_trending' => false,
            ],
            [
                'id' => 'p022',
                'title' => 'P022 Nutty Crunch Bites 16pc',
                'price' => 380.00,
                'rating' => 4.9,
                'rating_count' => 220,
                'image' => 'images/products/p002.jpg',
                'category' => 'chocolates',
                'occasions' => ['anniversary', 'wedding', 'reception', 'navratri', 'ganesh-chaturthi', 'janmashtami'],
                'in_stock' => false,
                'is_trending' => true,
            ],
            [
                'id' => 'p023',
                'title' => 'P023 Celebrations Combo Delight',
                'price' => 540.00,
                'rating' => 4.7,
                'rating_count' => 95,
                'image' => 'images/products/p003.jpg',
                'category' => 'combos',
                'occasions' => ['birthday', 'festive-gifting', 'holi', 'eid', 'christmas', 'new-year'],
                'in_stock' => false,
                'is_trending' => false,
            ],
            [
                'id' => 'p024',
                'title' => 'P024 Golden Hazelnut Pralines',
                'price' => 460.00,
                'rating' => 4.8,
                'rating_count' => 135,
                'image' => 'images/products/p004.jpg',
                'category' => 'chocolates',
                'occasions' => ['fathers-day', 'corporate-gifting', 'festive-gifting', 'christmas'],
                'in_stock' => false,
                'is_trending' => false,
            ],
            [
                'id' => 'p025',
                'title' => 'P025 Luxury Potli Bag Gift Set',
                'price' => 340.00,
                'rating' => 4.8,
                'rating_count' => 170,
                'image' => 'images/products/p005.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['mothers-day', 'wedding-return-gifts', 'return-gifts', 'housewarming', 'navratri', 'ganesh-chaturthi'],
                'in_stock' => false,
                'is_trending' => false,
            ],
            [
                'id' => 'p026',
                'title' => 'P026 Milk & White Swirl Bites',
                'price' => 250.00,
                'rating' => 4.6,
                'rating_count' => 84,
                'image' => 'images/products/p001.jpg',
                'category' => 'chocolates',
                'occasions' => ['birthday', 'childrens-day', 'baby-shower', 'other-occasions'],
                'in_stock' => false,
                'is_trending' => false,
            ],
            [
                'id' => 'p027',
                'title' => 'P027 Romantic Red Rose Bouquet',
                'price' => 580.00,
                'rating' => 4.9,
                'rating_count' => 210,
                'image' => 'images/products/p002.jpg',
                'category' => 'bouquets',
                'occasions' => ['valentines-day', 'anniversary', 'wedding', 'engagement', 'ring-ceremony', 'bride-and-groom', 'reception'],
                'in_stock' => false,
                'is_trending' => true,
            ],
            [
                'id' => 'p028',
                'title' => 'P028 Assorted Luxury Gift Box 20pc',
                'price' => 590.00,
                'rating' => 4.8,
                'rating_count' => 160,
                'image' => 'images/products/p003.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['birthday', 'anniversary', 'corporate-gifting', 'festive-gifting', 'wedding-hampers'],
                'in_stock' => false,
                'is_trending' => true,
            ],
            [
                'id' => 'p029',
                'title' => 'P029 Sweet Love Combo Pack',
                'price' => 420.00,
                'rating' => 4.7,
                'rating_count' => 110,
                'image' => 'images/products/p004.jpg',
                'category' => 'combos',
                'occasions' => ['valentines-day', 'anniversary', 'engagement', 'ring-ceremony', 'other-occasions'],
                'in_stock' => false,
                'is_trending' => false,
            ],
            [
                'id' => 'p030',
                'title' => 'P030 Roasted Almond Bark 200g',
                'price' => 310.00,
                'rating' => 4.9,
                'rating_count' => 195,
                'image' => 'images/products/p005.jpg',
                'category' => 'chocolates',
                'occasions' => ['fathers-day', 'corporate-gifting', 'christmas', 'new-year', 'janmashtami', 'eid'],
                'in_stock' => false,
                'is_trending' => true,
            ],
            [
                'id' => 'p031',
                'title' => 'P031 Festive Joy Chocolate Box',
                'price' => 480.00,
                'rating' => 4.8,
                'rating_count' => 145,
                'image' => 'images/products/p001.jpg',
                'category' => 'chocolates',
                'occasions' => ['birthday', 'festive-gifting', 'raksha-bandhan', 'navratri', 'ganesh-chaturthi', 'housewarming'],
                'in_stock' => false,
                'is_trending' => false,
            ],
            [
                'id' => 'p032',
                'title' => 'P032 Chocolate & Greeting Combo',
                'price' => 360.00,
                'rating' => 4.7,
                'rating_count' => 102,
                'image' => 'images/products/p002.jpg',
                'category' => 'combos',
                'occasions' => ['mothers-day', 'thank-you', 'congratulations', 'womens-day'],
                'in_stock' => false,
                'is_trending' => false,
            ],
            [
                'id' => 'p033',
                'title' => 'P033 Royal Silk Chocolate Hamper',
                'price' => 790.00,
                'rating' => 4.9,
                'rating_count' => 230,
                'image' => 'images/products/p003.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['anniversary', 'wedding', 'wedding-hampers', 'corporate-gifting', 'festive-gifting'],
                'in_stock' => false,
                'is_trending' => true,
            ],
            [
                'id' => 'p034',
                'title' => 'P034 Petite Blossom Bouquet 10pc',
                'price' => 390.00,
                'rating' => 4.8,
                'rating_count' => 125,
                'image' => 'images/products/p004.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'valentines-day', 'congratulations', 'reception', 'womens-day', 'other-occasions'],
                'in_stock' => false,
                'is_trending' => false,
            ],
            [
                'id' => 'r002',
                'title' => 'R002 12 Chocolates',
                'price' => 460.00,
                'rating' => 4.8,
                'rating_count' => 216,
                'image' => 'images/products/r002.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A handcrafted 12 Chocolates Bouquet featuring a stunning decorative presentation with assorted chocolates. Its stylish wrapping and vibrant accents make it a wonderful gift for birthdays, anniversaries and celebrations.',
                'details' => [
                    'Handcrafted chocolate bouquet',
                    'Contains 12 assorted chocolates',
                    'Elegant wrapping & ribbon bow',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries & celebrations',
                ],
            ],
            [
                'id' => 'r003',
                'title' => 'R003 One side (Matki)',
                'price' => 360.00,
                'rating' => 4.9,
                'rating_count' => 184,
                'image' => 'images/products/p001.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Make gifting memorable with this elegant One-Side Mutki Chocolate Bouquet, beautifully arranged with 15 heart-shaped chocolates in a layered presentation. Its vibrant handcrafted design makes it perfect for birthdays, anniversaries and festive occasions. The chocolates, colors and bouquet design can be customized for your special occasion.',
                'details' => [
                    'One-side multi-style chocolate bouquet',
                    'Contains 15 regular heart chocolates',
                    'Layered decorative arrangement',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, festivals & special occasions',
                ],
            ],
            [
                'id' => 'r001',
                'title' => 'R001 Volley Handy',
                'price' => 250.00,
                'rating' => 4.8,
                'rating_count' => 216,
                'image' => 'images/products/r001.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A stylish Volley Handy Chocolate Bouquet, beautifully arranged with assorted chocolates in an elegant black-and-golden presentation. Its unique handcrafted design makes it a lovely choice for birthdays, anniversaries, festive gifting and special occasions. The chocolates, colors and bouquet presentation can be customized according to your preference.',
                'details' => [
                    'Volley Handy chocolate bouquet',
                    'Contains 8 assorted chocolates + 3 heart chocolates',
                    'Elegant black & golden decorative wrapping',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, festivals & special occasions',
                ],
            ],
            [
                'id' => 'r004',
                'title' => 'R004 Uneven(Matki)',
                'price' => 360.00,
                'rating' => 4.8,
                'rating_count' => 195,
                'image' => 'images/products/r004.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A beautiful Uneven Mutki Chocolate Bouquet featuring 15 heart-shaped chocolates arranged in a stylish black-and-silver presentation. Its unique handcrafted design adds a modern touch to gifting. The chocolates, colors, wrapping and presentation can be customized according to your requirements.',
                'details' => [
                    'Uneven multi-style chocolate bouquet',
                    'Contains 15 regular heart chocolates',
                    'Black & silver decorative presentation',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, festivals & celebrations',
                ],
            ],
            [
                'id' => 'r005',
                'title' => 'R005 Cross(Matki)',
                'price' => 360.00,
                'rating' => 4.8,
                'rating_count' => 170,
                'image' => 'images/products/r005.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Brighten someone\'s special day with this attractive Cross Mutki Chocolate Bouquet, beautifully arranged with 15 heart-shaped chocolates in a vibrant presentation. Its creative design makes it a lovely choice for birthdays, anniversaries, celebrations and festive gifting. The chocolates, colors and bouquet presentation can be customized to match your occasion.',
                'details' => [
                    'Cross-style multi chocolate bouquet',
                    'Contains 15 regular heart chocolates',
                    'Vibrant decorative presentation',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, festivals & special occasions',
                ],
            ],
            [
                'id' => 'r006',
                'title' => 'R006 Volley Basket',
                'price' => 415.00,
                'rating' => 4.9,
                'rating_count' => 220,
                'image' => 'images/products/r006.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A beautiful Volley Basket Chocolate Bouquet, arranged with 15 half-round chocolates in a charming floral-style presentation. Its colorful handcrafted design makes it a lovely gift for birthdays, anniversaries, festivals and special occasions. The chocolates, colors and decoration can be customized to match your gifting needs.',
                'details' => [
                    'Small MDF basket chocolate bouquet',
                    'Contains 15 half-round chocolates',
                    'Decorative floral-style arrangement',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, festivals & celebrations',
                ],
            ],
            [
                'id' => 'r007',
                'title' => 'R007 Curl & Fun',
                'price' => 450.00,
                'rating' => 4.9,
                'rating_count' => 195,
                'image' => 'images/products/r007.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A vibrant Curl & Fan Chocolate Bouquet featuring 18 heart-shaped chocolates beautifully arranged with decorative curls and fan-style elements. Its eye-catching handcrafted presentation makes it perfect for birthdays, anniversaries and festive gifting. The chocolates, colors and bouquet design can be customized according to your preference.',
                'details' => [
                    'Big MDF chocolate bouquet',
                    'Contains 18 regular heart chocolates',
                    'Curl & fan-style decorative arrangement',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, festivals & special occasions',
                ],
            ],
            [
                'id' => 'r008',
                'title' => 'R008 Heart Bouquet',
                'price' => 600.00,
                'rating' => 4.9,
                'rating_count' => 240,
                'image' => 'images/products/r008.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'valentines-day', 'celebrations', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A stunning Heart Bouquet arranged in a beautiful layered design with a combination of heart-shaped chocolates. With 1 big heart, 7 heart chocolates and 9 regular heart chocolates, this handcrafted bouquet makes a memorable gift for birthdays, anniversaries, Valentine\'s Day and special celebrations. The chocolates, colors and presentation can be customized to suit your occasion.',
                'details' => [
                    'Big MDF heart bouquet',
                    'Contains 1 big heart + 7 heart chocolates + 9 regular heart chocolates',
                    'Heart-shaped chocolate arrangement',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, Valentine\'s Day & celebrations',
                ],
            ],
            [
                'id' => 'r009',
                'title' => 'R009 Silver golden Bouquet',
                'price' => 490.00,
                'rating' => 4.8,
                'rating_count' => 216,
                'image' => 'images/products/r009.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'An elegant Silver & Golden Chocolate Bouquet featuring 13 assorted chocolates beautifully arranged with decorative stems and shimmering accents. Its sophisticated presentation makes it suitable for birthdays, anniversaries, festive gifting and premium celebrations. The chocolates, colors and decoration can be customized according to your requirements.',
                'details' => [
                    'Silver & golden decorative chocolate bouquet',
                    'Contains 13 assorted chocolates',
                    'Elegant decorative stems and accents',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, festivals & special occasions',
                ],
            ],
            [
                'id' => 'r010',
                'title' => 'R010 Half Round Bouquet',
                'price' => 510.00,
                'rating' => 4.8,
                'rating_count' => 216,
                'image' => 'images/products/r010.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A stylish Half Round Chocolate Bouquet featuring 19 half-round chocolates arranged in an attractive decorative presentation. The combination of foam and glitter details gives it a unique and festive look. The chocolates, colors and decoration can be customized for your special occasion.',
                'details' => [
                    'Half-round chocolate bouquet',
                    'Contains 19 half-round chocolates',
                    'Foam & glitter decorative arrangement',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, festivals & celebrations',
                ],
            ],
            [
                'id' => 'r011',
                'title' => 'R011 Big Rose Bouquet',
                'price' => 350.00,
                'rating' => 4.8,
                'rating_count' => 216,
                'image' => 'images/products/r011.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'valentines-day', 'celebrations', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A beautiful Big Rose Chocolate Bouquet featuring 6 decorative chocolate roses arranged in an elegant handcrafted design. Its romantic floral presentation makes it a thoughtful choice for birthdays, anniversaries, Valentine\'s Day and special celebrations. The chocolate roses, colors and wrapping can be customized according to your preference.',
                'details' => [
                    'Big rose-style chocolate bouquet',
                    'Contains 6 big rose chocolates',
                    'Decorative floral presentation',
                    'Customizable chocolates, colors & wrapping',
                    'Ideal for birthdays, anniversaries, Valentine\'s Day & special occasions',
                ],
            ],
            [
                'id' => 'r012',
                'title' => 'R012 Acrylic Bouquet',
                'price' => 750.00,
                'rating' => 4.9,
                'rating_count' => 216,
                'image' => 'images/products/r012.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A premium Acrylic Chocolate Bouquet featuring 24 heart-shaped chocolates arranged in a beautiful decorative design. Its elegant presentation creates a stylish gifting experience for birthdays, anniversaries, festivals and special occasions. The chocolates, colors and presentation can be customized to suit your occasion.',
                'details' => [
                    'Acrylic-style chocolate bouquet',
                    'Contains 24 regular heart chocolates',
                    'Elegant decorative arrangement',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, festivals & celebrations',
                ],
            ],
            [
                'id' => 'r013',
                'title' => 'R013 Bar Bouquet',
                'price' => 500.00,
                'rating' => 4.8,
                'rating_count' => 178,
                'image' => 'images/products/r013.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'festive-gifting', 'anniversary', 'celebrations'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A colorful Bar Chocolate Bouquet filled with 12 chocolate bars and beautifully finished with decorative wrapping. Its bright and attractive presentation makes it perfect for birthdays, festive gifting, anniversaries and celebrations. The chocolates, colors and wrapping can be customized according to your preference.',
                'details' => [
                    'Small MDF bow-style chocolate bouquet',
                    'Contains 12 chocolate bars',
                    'Decorative purple & golden wrapping',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, festivals, anniversaries & special occasions',
                ],
            ],
            [
                'id' => 'r014',
                'title' => 'R014 Golden Choco Bloom',
                'price' => 820.00,
                'rating' => 4.9,
                'rating_count' => 235,
                'image' => 'images/products/r014.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'festive-gifting', 'celebrations', 'corporate-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A gorgeous Golden Choco Bloom arrangement featuring 24 individually wrapped chocolates, beautifully presented with elegant golden and silver accents and a floral base. Its premium decorative look makes it an impressive choice for special celebrations and gifting. The chocolates, colors and floral arrangement can be customized according to your requirements.',
                'details' => [
                    'Golden Choco Bloom bouquet',
                    'Contains 24 single chocolates',
                    'Wooden tray with rounded presentation and ring detail',
                    'Golden & silver decorative accents',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, festivals & premium gifting',
                ],
            ],
            [
                'id' => 'r015',
                'title' => 'R015 Double Heart Bouquet',
                'price' => 1050.00,
                'rating' => 4.9,
                'rating_count' => 264,
                'image' => 'images/products/r015.jpg',
                'category' => 'bouquets',
                'occasions' => ['birthday', 'anniversary', 'valentines-day', 'celebrations', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'A beautiful Double Heart Chocolate Bouquet arranged in a decorative Jali Basket with two big heart chocolates and 22 regular heart chocolates. Its romantic and handcrafted presentation makes it ideal for birthdays, anniversaries, Valentine\'s Day and special celebrations. The chocolates, colors and presentation can be customized according to your preference.',
                'details' => [
                    'Jali basket double-heart chocolate bouquet',
                    'Contains 2 big heart chocolates + 22 regular heart chocolates',
                    'Decorative handcrafted arrangement',
                    'Customizable chocolates, colors & presentation',
                    'Ideal for birthdays, anniversaries, Valentine\'s Day & special occasions',
                ],
            ],
            // Diwali collection — same product cards as main catalog
            [
                'id' => 'd006',
                'title' => 'Golden Metal Box',
                'price' => 770.00,
                'rating' => 4.9,
                'rating_count' => 156,
                'image' => 'images/diwali/golden-metal-box.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Elegant golden metal gift box with 500gm assorted wrapped chocolates, satin ribbon and floral finish — a premium Diwali hamper ready to gift.',
                'details' => [
                    'Golden metal box with decorative lid',
                    '500gm assorted wrapped chocolates',
                    'Satin ribbon bow with floral accent',
                    'Ideal for Diwali, corporate gifting & celebrations',
                ],
            ],
            [
                'id' => 'd007',
                'title' => '12 Cavity Paper Box',
                'price' => 215.00,
                'rating' => 4.8,
                'rating_count' => 132,
                'image' => 'images/diwali/12-cavity-paper-box.jpg',
                'category' => 'chocolates',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Festive 12-cavity paper box with a colourful mandala lid, filled with 12 dry-fruit chocolates — a bright Diwali gift at great value.',
                'details' => [
                    'Decorative paper box with 12 gold cavities',
                    '12 dry-fruit chocolates (assorted finishes)',
                    'Compact size for gifting & return favours',
                    'Ideal for Diwali, housewarming & celebrations',
                ],
            ],
            [
                'id' => 'd008',
                'title' => 'Black Leather Box',
                'price' => 1090.00,
                'rating' => 4.9,
                'rating_count' => 148,
                'image' => 'images/diwali/black-leather-box.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Premium black leather-finish gift box filled with 700gm assorted chocolates — an elegant Diwali hamper for family and corporate gifting.',
                'details' => [
                    'Black leather-style presentation box',
                    '700gm assorted chocolates',
                    'Luxury finish with secure closure',
                    'Ideal for Diwali, anniversaries & premium gifting',
                ],
            ],
            [
                'id' => 'd009',
                'title' => 'Jute Bag with 3 Jar',
                'price' => 680.00,
                'rating' => 4.9,
                'rating_count' => 121,
                'image' => 'images/diwali/jute-bag-3-jar.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Festive jute bag with a clear window showcasing three decorated jars — 12 assorted chocolates plus 150gm almonds and 150gm cashews.',
                'details' => [
                    'Jute carry bag with lace-trim window',
                    '3 glass jars with gold lids & floral décor',
                    '12 assorted chocolates',
                    '150gm almonds & 150gm cashews',
                ],
            ],
            [
                'id' => 'd010',
                'title' => '4+2 Cavity Paper Box',
                'price' => 325.00,
                'rating' => 4.8,
                'rating_count' => 109,
                'image' => 'images/diwali/4-plus-2-cavity-paper-box.jpg',
                'category' => 'chocolates',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Floral-lid paper box with four dry-fruit chocolates plus two nut sections — 80gm almonds and 80gm cashews for festive Diwali gifting.',
                'details' => [
                    '4+2 cavity paper box with floral lid',
                    '4 dry-fruit chocolates',
                    '80gm almonds & 80gm cashews',
                    'Ideal for Diwali return gifts & family hampers',
                ],
            ],
            [
                'id' => 'd011',
                'title' => 'Jute Bag with 2 Jar',
                'price' => 345.00,
                'rating' => 4.8,
                'rating_count' => 114,
                'image' => 'images/diwali/jute-bag-2-jar.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Compact jute gift bag with a window display of two decorated jars — 10 assorted chocolates with 120gm almonds, perfect for Diwali gifting.',
                'details' => [
                    'Jute bag with lace-trim clear window',
                    '2 glass jars with gold lids & pearl bands',
                    '10 assorted chocolates',
                    '120gm almonds',
                ],
            ],
            [
                'id' => 'd012',
                'title' => '24 Cavity Paper Box',
                'price' => 540.00,
                'rating' => 4.9,
                'rating_count' => 127,
                'image' => 'images/diwali/24-cavity-paper-box.jpg',
                'category' => 'chocolates',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Happy Diwali paper box with 24 gold cavities filled with dry-fruit chocolates — a vibrant festive gift for family and office sharing.',
                'details' => [
                    '24-cavity paper box with Diwali lid design',
                    '24 dry-fruit chocolates',
                    'Purple & gold wrapped assorted finishes',
                    'Ideal for Diwali hampers & bulk gifting',
                ],
            ],
            [
                'id' => 'd013',
                'title' => '24 Cavity Wooden Box',
                'price' => 540.00,
                'rating' => 4.9,
                'rating_count' => 119,
                'image' => 'images/diwali/24-cavity-wooden-box.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Premium matte black wooden-style gift box with 24 cavities of dry-fruit chocolates — elegant Ruchi presentation for Diwali.',
                'details' => [
                    '24-cavity wooden finish box with branded plaque',
                    '24 dry-fruit chocolates',
                    'Purple & patterned foil assorted finishes',
                    'Ideal for corporate Diwali & premium gifting',
                ],
            ],
            [
                'id' => 'd014',
                'title' => '12 Cavity Wooden Box',
                'price' => 315.00,
                'rating' => 4.8,
                'rating_count' => 103,
                'image' => 'images/diwali/12-cavity-wooden-box.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Dark wooden twin-lid box with 12 cavities of dry-fruit chocolates — a compact, premium Diwali gift.',
                'details' => [
                    '12-cavity wooden box with hinged lids',
                    '12 dry-fruit chocolates',
                    'Gold & festive foil assorted finishes',
                    'Ideal for Diwali return gifts & family sharing',
                ],
            ],
            [
                'id' => 'd015',
                'title' => 'Chocolate Chhab',
                'price' => 1500.00,
                'rating' => 4.9,
                'rating_count' => 88,
                'image' => 'images/diwali/chocolate-chhab.jpg',
                'category' => 'gift-hampers',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Decorative festive chhab with 1kg assorted foil-wrapped chocolates and a Happy Diwali alphabet topper — a grand centrepiece for Diwali.',
                'details' => [
                    'Ornate round chhab with festive décor',
                    '1kg assorted chocolates',
                    'Happy Diwali alphabet topper with floral accents',
                    'Ideal for home décor, pooja thali & premium gifting',
                ],
            ],
            [
                'id' => 'd016',
                'title' => '15 Cavity Box',
                'price' => 255.00,
                'rating' => 4.8,
                'rating_count' => 111,
                'image' => 'images/diwali/15-cavity-box.jpg',
                'category' => 'chocolates',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Pink floral-lid box with 15 gold cavities filled with dry-fruit chocolates — a colourful Diwali gift at great value.',
                'details' => [
                    '15-cavity box with floral art lid',
                    '15 dry-fruit chocolates',
                    'Red & gold foil assorted finishes',
                    'Ideal for Diwali return gifts & family hampers',
                ],
            ],
            [
                'id' => 'd017',
                'title' => '12 Cavity Paper Box — Kunafa',
                'price' => 390.00,
                'rating' => 4.9,
                'rating_count' => 96,
                'image' => 'images/diwali/12-cavity-kunafa-box.jpg',
                'category' => 'chocolates',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Lavender paper box with gold mandala lid and 12 kunafa chocolates — pistachio, Nutella, Biscoff & caramel flavours.',
                'details' => [
                    '12-cavity paper box with mandala lid',
                    '12 kunafa chocolates (assorted flavours)',
                    'Pistachio, Nutella, Biscoff & caramel kunafa',
                    'Ideal for Diwali gifting & premium return favours',
                ],
            ],
            [
                'id' => 'd018',
                'title' => 'Polka Bag',
                'price' => 140.00,
                'rating' => 4.8,
                'rating_count' => 134,
                'image' => 'images/diwali/polka-bag.jpg',
                'category' => 'chocolates',
                'occasions' => ['diwali', 'festive-gifting'],
                'in_stock' => true,
                'is_trending' => true,
                'description' => 'Colourful polka-dot gift bag filled with 12 assorted foil-wrapped chocolates — a fun, budget-friendly Diwali treat.',
                'details' => [
                    'Festive polka-dot paper bag with ribbon',
                    '12 assorted chocolates',
                    'Bright foil wraps in mixed colours',
                    'Ideal for Diwali return gifts & kids’ favours',
                ],
            ],
        ];
    }

    /**
     * Get a single product by ID.
     *
     * @return array<string, mixed>|null
     */
    public function getProductById(string $id): ?array
    {
        $id = strtolower($id);
        $lookupId = str_starts_with($id, 'fc-') ? substr($id, 3) : $id;
        foreach ($this->getAllProducts() as $product) {
            if (strtolower($product['id']) === $lookupId || strtolower($product['id']) === $id) {
                return $product;
            }
        }

        return null;
    }

    /**
     * Get only trending products.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getTrendingProducts(): array
    {
        return array_values(array_filter($this->getAllProducts(), function ($product) {
            return ! empty($product['is_trending']);
        }));
    }

    /**
     * Get standard category list with counts.
     *
     * @param  array<int, array<string, mixed>>|null  $scopeProducts
     * @return array<int, array<string, mixed>>
     */
    public function getCategories(?array $scopeProducts = null): array
    {
        $products = $scopeProducts ?? $this->getAllProducts();

        $counts = [];
        foreach ($products as $p) {
            $cat = strtolower($p['category']);
            $counts[$cat] = ($counts[$cat] ?? 0) + 1;
        }

        return [
            ['name' => 'Chocolates', 'slug' => 'chocolates', 'count' => $counts['chocolates'] ?? 0, 'icon' => '🍫'],
            ['name' => 'Gift Hampers', 'slug' => 'gift-hampers', 'count' => $counts['gift-hampers'] ?? 0, 'icon' => '🎁'],
            ['name' => 'Bouquets', 'slug' => 'bouquets', 'count' => $counts['bouquets'] ?? 0, 'icon' => '💐'],
            ['name' => 'Occasions', 'slug' => 'occasions', 'count' => count(array_filter($products, fn ($i) => ! empty($i['occasions']) || in_array(strtolower($i['category']), ['occasions', 'gift-hampers', 'bouquets', 'combos']))), 'icon' => '🎉'],
            ['name' => 'Combos', 'slug' => 'combos', 'count' => $counts['combos'] ?? 0, 'icon' => '✨'],
        ];
    }

    /**
     * Get the 3 main category sections with subcategories and accurate item counts.
     *
     * @param  array<int, array<string, mixed>>|null  $scopeProducts
     * @return array<int, array<string, mixed>>
     */
    public function getMainCategorySections(?array $scopeProducts = null): array
    {
        $products = $scopeProducts ?? $this->getAllProducts();

        $sections = [
            [
                'name' => 'Festivals',
                'slug' => 'festivals',
                'icon' => '🎉',
                'is_dropdown' => true,
                'subcategories' => [
                    ['name' => 'Diwali', 'slug' => 'diwali', 'type' => 'occasion', 'matches' => ['diwali'], 'coming_soon' => false],
                    ['name' => 'Rakhi', 'slug' => 'rakhi', 'type' => 'occasion', 'matches' => ['rakhi', 'raksha-bandhan'], 'coming_soon' => true],
                    ['name' => 'Holi', 'slug' => 'holi', 'type' => 'occasion', 'matches' => ['holi'], 'coming_soon' => true],
                    ['name' => 'Uttarayan', 'slug' => 'uttarayan', 'type' => 'occasion', 'matches' => ['uttarayan'], 'coming_soon' => true],
                    ['name' => 'Christmas', 'slug' => 'christmas', 'type' => 'occasion', 'matches' => ['christmas'], 'coming_soon' => true],
                    ['name' => 'New Year', 'slug' => 'new-year', 'type' => 'occasion', 'matches' => ['new-year'], 'coming_soon' => true],
                ],
            ],
            [
                'name' => 'Occasions',
                'slug' => 'occasions',
                'icon' => '🎊',
                'is_dropdown' => true,
                'subcategories' => [
                    ['name' => 'Birthday', 'slug' => 'birthday', 'type' => 'occasion', 'matches' => ['birthday']],
                    ['name' => 'Anniversary', 'slug' => 'anniversary', 'type' => 'occasion', 'matches' => ['anniversary']],
                    ['name' => 'Ring Ceremony', 'slug' => 'ring-ceremony', 'type' => 'occasion', 'matches' => ['ring-ceremony', 'engagement']],
                    ['name' => 'Valentine', 'slug' => 'valentine', 'type' => 'occasion', 'matches' => ['valentine', 'valentines-day']],
                    ['name' => 'Baby Shower', 'slug' => 'baby-shower', 'type' => 'occasion', 'matches' => ['baby-shower', 'new-born']],
                    ['name' => 'New Born', 'slug' => 'new-born', 'type' => 'occasion', 'matches' => ['new-born', 'baby-shower']],
                ],
            ],
            [
                'name' => 'Gifting',
                'slug' => 'gifting',
                'icon' => '🎁',
                'is_dropdown' => false,
                'count' => count(array_filter($products, function ($p) {
                    return in_array(strtolower($p['category']), ['chocolates', 'gift-hampers', 'bouquets', 'combos']) || ! empty($p['occasions']);
                })),
                'subcategories' => [],
            ],
        ];

        foreach ($sections as &$sec) {
            if (! empty($sec['subcategories'])) {
                foreach ($sec['subcategories'] as &$sub) {
                    if (! empty($sub['coming_soon'])) {
                        $sub['count'] = 0;

                        continue;
                    }

                    $sub['count'] = count(array_filter($products, function ($p) use ($sub) {
                        if ($sub['type'] === 'category') {
                            return in_array(strtolower($p['category']), $sub['matches']);
                        }
                        $pOccs = array_map('strtolower', $p['occasions'] ?? []);
                        foreach ($sub['matches'] as $m) {
                            if (in_array(strtolower($m), $pOccs)) {
                                return true;
                            }
                        }

                        return false;
                    }));
                }
            }
        }

        return $sections;
    }

    /**
     * Festival subcategories shown under Categories → Festivals.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getFestivalSubcategories(): array
    {
        foreach ($this->getMainCategorySections() as $section) {
            if (($section['slug'] ?? '') === 'festivals') {
                return $section['subcategories'] ?? [];
            }
        }

        return [];
    }

    /**
     * Whether a festival filter slug is marked coming soon (no catalog yet).
     */
    public function isFestivalComingSoon(string $slug): bool
    {
        $slug = strtolower(trim($slug));

        foreach ($this->getFestivalSubcategories() as $festival) {
            if (($festival['slug'] ?? '') === $slug) {
                return (bool) ($festival['coming_soon'] ?? false);
            }
        }

        return false;
    }

    /**
     * Human-readable festival name for a filter slug.
     */
    public function getFestivalDisplayName(string $slug): ?string
    {
        $slug = strtolower(trim($slug));

        foreach ($this->getFestivalSubcategories() as $festival) {
            if (($festival['slug'] ?? '') === $slug) {
                return $festival['name'] ?? null;
            }
        }

        return null;
    }

    /**
     * Get organized occasion groups for the sidebar filter.
     *
     * @return array<string, array<string, mixed>>
     */
    public function getOccasionGroups(): array
    {
        return [
            'general' => [
                'name' => 'General Occasions',
                'icon' => '🎉',
                'occasions' => [
                    ['name' => 'Birthday', 'slug' => 'birthday'],
                    ['name' => 'Anniversary', 'slug' => 'anniversary'],
                    ['name' => 'Congratulations', 'slug' => 'congratulations'],
                    ['name' => 'Thank You', 'slug' => 'thank-you'],
                    ['name' => 'Housewarming', 'slug' => 'housewarming'],
                    ['name' => 'Baby Shower', 'slug' => 'baby-shower'],
                    ['name' => 'New Born', 'slug' => 'new-born'],
                ],
            ],
            'festivals' => [
                'name' => 'Festivals',
                'icon' => '🪔',
                'occasions' => [
                    ['name' => 'Diwali', 'slug' => 'diwali'],
                    ['name' => 'Holi', 'slug' => 'holi'],
                    ['name' => 'Raksha Bandhan', 'slug' => 'raksha-bandhan'],
                    ['name' => 'Christmas', 'slug' => 'christmas'],
                    ['name' => 'New Year', 'slug' => 'new-year'],
                    ['name' => 'Ganesh Chaturthi', 'slug' => 'ganesh-chaturthi'],
                    ['name' => 'Janmashtami', 'slug' => 'janmashtami'],
                ],
            ],
            'wedding' => [
                'name' => 'Wedding',
                'icon' => '💍',
                'occasions' => [
                    ['name' => 'Wedding', 'slug' => 'wedding'],
                    ['name' => 'Wedding Hampers', 'slug' => 'wedding-hampers'],
                    ['name' => 'Engagement', 'slug' => 'engagement'],
                    ['name' => 'Reception', 'slug' => 'reception'],
                    ['name' => 'Bride & Groom', 'slug' => 'bride-and-groom'],
                    ['name' => 'Wedding Return Gifts', 'slug' => 'wedding-return-gifts'],
                ],
            ],
            'special-days' => [
                'name' => 'Special Days',
                'icon' => '💖',
                'occasions' => [
                    ['name' => "Valentine's Day", 'slug' => 'valentines-day'],
                    ['name' => "Mother's Day", 'slug' => 'mothers-day'],
                    ['name' => "Father's Day", 'slug' => 'fathers-day'],
                    ['name' => "Women's Day", 'slug' => 'womens-day'],
                    ['name' => "Children's Day", 'slug' => 'childrens-day'],
                ],
            ],
            'gifting' => [
                'name' => 'Gifting & Others',
                'icon' => '🎁',
                'occasions' => [
                    ['name' => 'Corporate Gifting', 'slug' => 'corporate-gifting'],
                    ['name' => 'Festive Gifting', 'slug' => 'festive-gifting'],
                    ['name' => 'Return Gifts', 'slug' => 'return-gifts'],
                    ['name' => 'Other Occasions', 'slug' => 'other-occasions'],
                ],
            ],
        ];
    }

    /**
     * Get flat occasions list for backward compatibility.
     *
     * @return array<int, array<string, string>>
     */
    public function getOccasions(): array
    {
        $all = [];
        foreach ($this->getOccasionGroups() as $group) {
            foreach ($group['occasions'] as $occ) {
                $all[] = $occ;
            }
        }

        return $all;
    }
}
