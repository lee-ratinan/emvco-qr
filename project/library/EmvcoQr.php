<?php

namespace EmvcoQr;

class EmvcoQr {

    // INT
    const ZERO = 0;
    const ONE = 1;
    const TWO = 2;
    const THREE = 3;
    const FOUR = 4;
    const TEN = 10;
    const TWENTY = 20;
    const TWENTY_FIVE = 25;

    // STATUS
    const STATUS_OK = 'OK';
    const STATUS_ERR = 'ERROR';
    const STATUS_NOT_YET_PROCESSED = 'NOT_YET_PROCESSED';

    // 00
    const PAYLOAD_FORMAT_INDICATOR_ID = '00';
    const PAYLOAD_FORMAT_INDICATOR_LENGTH = '02';
    const PAYLOAD_FORMAT_INDICATOR_LABEL = 'PAYLOAD_FORMAT_INDICATOR';
    const PAYLOAD_FORMAT_INDICATOR_VALUE = '01';
    // 01
    const POINT_OF_INITIATION_ID = '01';
    const POINT_OF_INITIATION_LENGTH = '02';
    const POINT_OF_INITIATION_LABEL = 'POINT_OF_INITIATION';
    const POINT_OF_INITIATION_VALUE_STATIC = '11';
    const POINT_OF_INITIATION_VALUE_DYNAMIC = '12';
    const POINT_OF_INITIATION_LABEL_STATIC = 'STATIC';
    const POINT_OF_INITIATION_LABEL_DYNAMIC = 'DYNAMIC';
    private $point_of_initiation_values = [
        self::POINT_OF_INITIATION_VALUE_STATIC,
        self::POINT_OF_INITIATION_VALUE_DYNAMIC
    ];
    private $point_of_initiation_labels = [
        self::POINT_OF_INITIATION_VALUE_STATIC  => self::POINT_OF_INITIATION_LABEL_STATIC,
        self::POINT_OF_INITIATION_VALUE_DYNAMIC => self::POINT_OF_INITIATION_LABEL_DYNAMIC
    ];
    // 52
    const MERCHANT_CATEGORY_CODE_ID = '52';
    const MERCHANT_CATEGORY_CODE_LENGTH = '04';
    const MERCHANT_CATEGORY_CODE_LABEL = 'MERCHANT_CATEGORY_CODE';
    const MERCHANT_CATEGORY_CODE_VALUE_DEFAULT = '0000';
    private $merchant_category_codes = [
        '0000' => 'Generic',
        '0742' => 'Veterinary services',
        '0763' => 'Agricultural co-operative',
        '0780' => 'Landscaping and horticultural services',
        '1520' => 'General contractors - residential & commercial',
        '1711' => 'Heating, plumbing, and air conditioning contractors',
        '1731' => 'Electrical contractors',
        '1740' => 'Masonry, stonework, tile setting, plastering & insulation contractors',
        '1750' => 'Carpentry contractors',
        '1761' => 'Roofing and siding contractors',
        '1771' => 'Concrete work contractors',
        '1799' => 'Special trade contractors (not elsewhere classified)',
        '2741' => 'Miscellaneous publishing and printing',
        '2791' => 'Typesetting, plate making, and related services',
        '2842' => 'Specialty cleaning, polishing, & sanitation preparations',
        '3357' => 'Hertz',
        '3359' => 'Payless car rental',
        '3366' => 'Budget rent-a-car',
        '3370' => 'Rent-a-wreck',
        '3385' => 'Tropical rent-a-car',
        '3389' => 'Avis rent-a-car',
        '3390' => 'Dollar rent-a-car',
        '3393' => 'National car rental',
        '3395' => 'Thrifty car rental',
        '3398' => 'Econo-car rent-a-car',
        '3501' => 'Holiday Inns',
        '3502' => 'Best Western',
        '3503' => 'Sheraton',
        '3504' => 'Hilton',
        '3506' => 'Golden Tulip',
        '3507' => 'Friendship Inns',
        '3508' => 'Quality International',
        '3509' => 'Marriott',
        '3510' => 'Days Inns',
        '3512' => 'Intercontinental',
        '3515' => 'Rodeway Inns',
        '3516' => 'La Quinta Motor Inns',
        '3517' => 'Americana Hotels',
        '3520' => 'Meridien',
        '3527' => 'Downtowner Passport',
        '3528' => 'Red Lion',
        '3535' => 'Hilton International',
        '3536' => 'AMFAC Hotels',
        '3539' => 'Summerfield Suites Hotels',
        '3542' => 'Royal Hotels',
        '3543' => 'Four Seasons Hotels',
        '3546' => 'Hotel Sierra',
        '3550' => 'Regal 8 Inns',
        '3562' => 'Comfort Hotel International',
        '3565' => 'Relax Inns',
        '3573' => 'Sandman Hotels',
        '3574' => 'Venture Inn',
        '3575' => 'Vagabond Hotels',
        '3579' => 'Hotel Mercure',
        '3588' => 'Helmsley Hotels',
        '3590' => 'Fairmont Hotels Corporation',
        '3591' => 'Sonesta International Hotels',
        '3592' => 'Omni International',
        '3595' => 'Hospitality Inns',
        '3615' => 'Travelodge Motels',
        '3631' => 'Sleep Inn',
        '3637' => 'Ramada Inns',
        '3638' => 'Howard Johnson',
        '3641' => 'Sofitel Hotels',
        '3644' => 'Econo-Travel Motor Hotel',
        '3648' => 'De Vere Hotels',
        '3649' => 'Radisson',
        '3650' => 'Red Roof Inns',
        '3652' => 'Embassy Hotels',
        '3654' => 'Loews Hotels',
        '3660' => 'Knights Inns',
        '3665' => 'Hampton Inns',
        '3681' => 'Adams Mark',
        '3684' => 'Budget Host Inn',
        '3685' => 'Budgetel',
        '3687' => 'Clarion Hotel',
        '3690' => 'Courtyard by Marriott',
        '3692' => 'Doubletree',
        '3693' => 'Drury Inn',
        '3694' => 'Economy Inns of America',
        '3695' => 'Embassy Suites',
        '3699' => 'Midway Motor Lodge',
        '3700' => 'Motel 6',
        '3703' => 'Residence Inns',
        '3704' => 'Royce Hotel',
        '3705' => 'Sandman Inns',
        '3706' => 'Shilo Inns',
        '3707' => 'Shoney’s Inns',
        '3709' => 'Super 8 Motels',
        '3715' => 'Fairfield Inns',
        '3716' => 'Carlton Hotels',
        '3722' => 'Wyndham',
        '3731' => 'Harrah’s Hotels and Casinos',
        '3738' => 'Tropicana Resort and Casino',
        '3742' => 'Club Med',
        '3747' => 'Club Corp / Club Resorts',
        '3748' => 'Wellesley Inns',
        '3750' => 'Crowne Plaza Hotels',
        '3773' => 'The Venetian Resort Hotel Casino',
        '3783' => 'Town and Country Resort',
        '4011' => 'Freight Railways',
        '4111' => 'Local passenger transportation',
        '4112' => 'Passenger railways',
        '4119' => 'Ambulance services',
        '4121' => 'Taxicabs and limousines',
        '4131' => 'Bus lines',
        '4214' => 'Motor freight carriers and trucking',
        '4215' => 'Courier services',
        '4225' => 'Public warehousing and storage',
        '4411' => 'Steamship and cruise lines',
        '4457' => 'Boat rentals and leasing',
        '4468' => 'Marinas, marine service, and supplies',
        '4511' => 'Airlines and air carriers (not elsewhere classified)',
        '4582' => 'Airports, flying fields, and airport terminals',
        '4722' => 'Travel agencies and tour operators',
        '4784' => 'Toll and bridge fees',
        '4789' => 'Transportation services (not elsewhere classified)',
        '4812' => 'Telecommunication equipment and telephone sales',
        '4814' => 'Telecommunication service',
        '4815' => 'Visaphone',
        '4816' => 'Computer network / information services',
        '4821' => 'Telegraph services',
        '4829' => 'Wire Transfer Money Orders (WTMOS)',
        '4899' => 'Cable, satellite and other pay television, and radio services',
        '4900' => 'Utilities - electric, gas, water, sanitary',
        '5013' => 'Motor vehicle supplies and new parts',
        '5021' => 'Office and commercial furniture',
        '5039' => 'Construction materials (not elsewhere classified)',
        '5044' => 'Photographic, photocopy, microfilm equipment and supplies',
        '5045' => 'Computers and computer peripheral equipment and services',
        '5046' => 'Commercial equipment (not elsewhere classified)',
        '5047' => 'Medical, dental, ophthalmic, and hospital equipment and supplies',
        '5051' => 'Metal service centers and offices',
        '5065' => 'Electrical parts and equipment',
        '5072' => 'Hardware, equipment and supplies',
        '5074' => 'Plumbing and heating equipment and supplies',
        '5085' => 'Industrial supplies (not elsewhere classified)',
        '5094' => 'Precious stones, metals, watches, and jewelry',
        '5099' => 'Durable goods (not elsewhere classified)',
        '5111' => 'Stationery, office supplies, printing, and writing paper',
        '5122' => 'Drugs, drug proprietaries, and druggist sundries',
        '5131' => 'Piece goods, notions, and other dry goods',
        '5137' => 'Men’s, women’s, and children’s uniforms, and commercial clothing',
        '5139' => 'Commercial footwear',
        '5169' => 'Chemicals and allied products (not elsewhere classified)',
        '5172' => 'Petroleum and petroleum products',
        '5192' => 'Books, periodicals, and newspapers',
        '5193' => 'Florist supplies, nursery stock, and flowers',
        '5198' => 'Paint, varnishes, and supplies',
        '5199' => 'Nondurable goods (not elsewhere classified)',
        '5200' => 'Home supply warehouse stores',
        '5211' => 'Lumber and building materials stores',
        '5231' => 'Glass, paint, and wallpaper stores',
        '5251' => 'Hardware stores',
        '5261' => 'Nurseries and lawn and garden supply stores',
        '5271' => 'Mobile home dealers',
        '5300' => 'Wholesale clubs',
        '5309' => 'Duty free stores',
        '5310' => 'Discount stores',
        '5311' => 'Department stores',
        '5331' => 'Variety stores',
        '5399' => 'Miscellaneous general merchandise',
        '5411' => 'Grocery stores and supermarkets',
        '5422' => 'Freezer and locker meat provisioners',
        '5441' => 'Candy, nut, and confectionery stores',
        '5451' => 'Dairy products stores',
        '5462' => 'Bakeries',
        '5499' => 'Miscellaneous food stores - convenience stores and specialty markets',
        '5511' => 'Car and truck dealers (new and used) sales, service, repairs, parts, and leasing',
        '5521' => 'Car and truck dealers (used only) sales, service, repairs, parts, and leasing',
        '5531' => 'Auto and home supply stores (no longer valid MCC)',
        '5532' => 'Automotive tire stores',
        '5533' => 'Automotive parts and accessories stores',
        '5541' => 'Service stations',
        '5542' => 'Automated fuel dispensers',
        '5551' => 'Boat dealers',
        '5561' => 'Camper, recreational and utility trailer dealers',
        '5571' => 'Motorcycle shops and dealers',
        '5592' => 'Motor homes dealers',
        '5598' => 'Snowmobile dealers',
        '5599' => 'Miscellaneous automotive, aircraft, and farm equipment dealers (not elsewhere classified)',
        '5611' => 'Men’s and boy’s clothing and accessories stores',
        '5621' => 'Women’s ready-to-wear stores',
        '5631' => 'Women’s accessory and specialty shops',
        '5641' => 'Children’s and infant’s wear stores',
        '5651' => 'Family clothing stores',
        '5655' => 'Sports and riding apparel stores',
        '5661' => 'Shoe stores',
        '5681' => 'Furriers and fur shops',
        '5691' => 'Men’s and women’s clothing stores',
        '5697' => 'Tailors, seamstresses, mending, and alterations',
        '5698' => 'Wig and toupee stores',
        '5699' => 'Miscellaneous apparel and accessory shops',
        '5712' => 'Furniture, home furnishings, and equipment stores, excepting appliances',
        '5713' => 'Floor covering stores',
        '5714' => 'Drapery, window covering, and upholstery store',
        '5718' => 'Fireplace, fireplace screens, and accessories stores',
        '5719' => 'Miscellaneous home furnishing specialty stores',
        '5722' => 'Household appliance stores',
        '5732' => 'Electronics stores',
        '5733' => 'Music stores - musical instruments, pianos, and sheet music',
        '5734' => 'Computer software stores',
        '5735' => 'Record stores',
        '5811' => 'Caterers',
        '5812' => 'Eating places & restaurants',
        '5813' => 'Drinking places - bars, taverns, nightclubs, cocktail lounges, and discotheques',
        '5814' => 'Fast food restaurants',
        '5815' => 'Digital Goods: Books, Movies, Music',
        '5912' => 'Drug stores and pharmacies',
        '5921' => 'Package stores - beer, wine, and liquor',
        '5931' => 'Used merchandise and secondhand stores',
        '5932' => 'Antique shops - sales, repairs, and restoration services',
        '5933' => 'Pawn shops',
        '5935' => 'Wrecking and salvage yards',
        '5937' => 'Antique reproductions',
        '5940' => 'Bicycle shops - sales and service',
        '5941' => 'Sporting goods stores',
        '5942' => 'Book stores',
        '5943' => 'Stationery stores, office and school supply stores',
        '5944' => 'Jewelry stores, watches, clocks, and silverware stores',
        '5945' => 'Hobby, toy, and game shops',
        '5946' => 'Camera and photographic supply stores',
        '5947' => 'Gift, card, novelty and souvenir shops',
        '5948' => 'Luggage and leather goods stores',
        '5949' => 'Sewing needlework, fabric, and piece goods stores',
        '5950' => 'Glassware / crystal stores',
        '5960' => 'Direct marketing - insurance services',
        '5962' => 'Direct marketing - travel-related arrangement services (high risk MCC)',
        '5963' => 'Door-to-door sales',
        '5964' => 'Direct marketing - catalog merchant',
        '5965' => 'Direct marketing - combination catalog and retail merchant',
        '5966' => 'Direct marketing - outbound telemarketing merchant (high risk MCC)',
        '5967' => 'Direct marketing - inbound tele-services merchant (high risk MCC)',
        '5968' => 'Direct marketing - continuity/subscription merch.',
        '5969' => 'Direct marketing - other direct marketers (not elsewhere classified)',
        '5970' => 'Artists supply and craft shops',
        '5971' => 'Art dealers and galleries',
        '5972' => 'Stamp and coin stores',
        '5973' => 'Religious goods stores',
        '5975' => 'Hearing aids - sales, service, and supply',
        '5976' => 'Orthopedic goods - prosthetic devices',
        '5977' => 'Cosmetic stores',
        '5978' => 'Typewriters - sales, rentals, & service',
        '5983' => 'Fuel dealers - fuel oil, wood, coal, liquefied petroleum',
        '5992' => 'Florists',
        '5993' => 'Cigar stores and stands',
        '5994' => 'News dealers and newsstands',
        '5995' => 'Pet shops, pet foods and supplies stores',
        '5996' => 'Swimming pools - sales and service',
        '5997' => 'Electric razor stores',
        '5998' => 'Tent and awning shops',
        '5999' => 'Miscellaneous and specialty retail shops',
        '6010' => 'Financial institutions - manual cash disbursements',
        '6011' => 'Financial institutions - automated cash disbursements',
        '6012' => 'Financial institutions merchandise and services',
        '6051' => 'Non-financial institutions - foreign currency, money orders, and travelers cheques',
        '6211' => 'Security brokers / dealers',
        '6300' => 'Insurance sales, underwriting, and premiums',
        '6513' => 'Real estate agents and managers - rentals',
        '7011' => 'Lodging - hotels, motels, resorts, and central reservation services (not elsewhere classified)',
        '7012' => 'Timeshares',
        '7032' => 'Sporting and recreational camps',
        '7033' => 'Trailer parks and campgrounds',
        '7210' => 'Laundry, cleaning, and garment services',
        '7211' => 'Laundries - family and commercial',
        '7216' => 'Dry cleaners',
        '7217' => 'Carpet and upholstery cleaning',
        '7221' => 'Photographic studios',
        '7230' => 'Beauty and barber shops',
        '7251' => 'Shoe repair shops, shoe shine parlors, and hat cleaning shops',
        '7261' => 'Funeral service and crematories',
        '7273' => 'Dating and escort services',
        '7276' => 'Tax preparation service',
        '7277' => 'Counseling services - debt, marriage, and personal',
        '7278' => 'Buying and shopping services and clubs',
        '7296' => 'Clothing rental - costumes, uniforms, and formal wear',
        '7297' => 'Massage parlors',
        '7298' => 'Health and beauty spas',
        '7299' => 'Miscellaneous personal services (not elsewhere classified)',
        '7311' => 'Advertising services',
        '7321' => 'Consumer credit reporting agencies',
        '7333' => 'Commercial photography, art, and graphics',
        '7338' => 'Quick copy, reproduction, and blueprinting services',
        '7339' => 'Stenographic and secretarial support',
        '7342' => 'Exterminating and disinfecting services',
        '7349' => 'Cleaning, maintenance, and janitorial services',
        '7361' => 'Employment agencies and temporary help services',
        '7372' => 'Computer programming, data processing, and integrated systems design services',
        '7375' => 'Information retrieval services',
        '7379' => 'Computer maintenance, repair, and services (not elsewhere classified)',
        '7392' => 'Management, consulting, and public relations services',
        '7393' => 'Detective agencies, protective services, and security services',
        '7394' => 'Equipment, tool, furniture, and appliance rental and leasing',
        '7395' => 'Photofinishing laboratories and photo developing',
        '7399' => 'Business services (not elsewhere classified)',
        '7512' => 'Automobile rental agency',
        '7513' => 'Truck and utility trailer rentals',
        '7519' => 'Motor home and recreational vehicle rentals',
        '7523' => 'Parking lots and garages',
        '7531' => 'Automotive body repair shops',
        '7534' => 'Tire retreading and repair shops',
        '7535' => 'Automotive paint shops',
        '7538' => 'Automotive service shops (non-dealer)',
        '7542' => 'Car washes',
        '7549' => 'Towing services',
        '7622' => 'Electronics repair shops',
        '7623' => 'Air conditioning and refrigeration repair shops',
        '7629' => 'Electrical and small appliance repair shops',
        '7631' => 'Watch, clock and jewelry repair',
        '7641' => 'Furniture - reupholstery, repair, and refinishing',
        '7692' => 'Welding services',
        '7699' => 'Miscellaneous repair shops and related services',
        '7829' => 'Motion picture and video tape production and distribution',
        '7832' => 'Motion picture theaters',
        '7841' => 'Video tape rental stores',
        '7911' => 'Dance halls, studios, and schools',
        '7922' => 'Theatrical producers and ticket agencies',
        '7929' => 'Bands, orchestras, and miscellaneous entertainers (not elsewhere classified)',
        '7932' => 'Billiard and pool establishments',
        '7933' => 'Bowling alleys',
        '7941' => 'Commercial sports, professional sports clubs, athletic fields, and sports promoters',
        '7991' => 'Tourist attractions and exhibits',
        '7992' => 'Public golf courses',
        '7993' => 'Video amusement game supplies',
        '7994' => 'Video game arcades / establishments',
        '7995' => 'Betting, including lottery tickets, casino gaming chips, off-track betting and wagers at race tracks',
        '7996' => 'Amusement parks, circuses, carnivals, and fortune tellers',
        '7997' => 'Membership clubs, country clubs, and private golf courses',
        '7998' => 'Aquariums, seaquariums, dolphinariums',
        '7999' => 'Recreation services (not elsewhere classified)',
        '8011' => 'Doctors and physicians (not elsewhere classified)',
        '8021' => 'Dentists and orthodontists',
        '8031' => 'Osteopaths',
        '8041' => 'Chiropractors',
        '8042' => 'Optometrists and ophthalmologists',
        '8043' => 'Opticians, optical goods, and eyeglasses',
        '8049' => 'Podiatrists and chiropodists',
        '8050' => 'Nursing and personal care facilities',
        '8062' => 'Hospitals',
        '8071' => 'Medical and dental laboratories',
        '8099' => 'Medical services and health practitioners (not elsewhere classified)',
        '8111' => 'Legal services and attorneys',
        '8211' => 'Elementary and secondary schools',
        '8220' => 'Colleges, universities, professional schools, and junior colleges',
        '8241' => 'Correspondence schools',
        '8244' => 'Business and secretarial schools',
        '8249' => 'Vocational and trade schools',
        '8299' => 'Schools and educational services (not elsewhere classified)',
        '8351' => 'Child care services',
        '8398' => 'Charitable and social service organizations',
        '8641' => 'Civic, social, and fraternal associations',
        '8651' => 'Political organizations',
        '8661' => 'Religious organizations',
        '8675' => 'Automobile associations',
        '8699' => 'Membership organizations (not elsewhere classified)',
        '8734' => 'Testing laboratories (non-medical testing)',
        '8911' => 'Architectural, engineering, and surveying services',
        '8931' => 'Accounting, auditing, and bookkeeping services',
        '8999' => 'Professional sevices (not elsewhere classified)',
        '9211' => 'Court costs, including alimony and child support',
        '9222' => 'Fines',
        '9223' => 'Bail and bond payments',
        '9311' => 'Tax payments',
        '9399' => 'Government services (not elsewhere classified)',
        '9402' => 'Postal services - government only',
        '9405' => 'US federal government agencies or departments'
    ];
    // 53
    const CURRENCY_ID = '53';
    const CURRENCY_LENGTH = '03';
    const CURRENCY_LABEL = 'TRANSACTION_CURRENCY';
    const CURRENCY_HKD_CODE = 'HKD';
    const CURRENCY_HKD_NUMERIC = '344';
    const CURRENCY_IDR_CODE = 'IDR';
    const CURRENCY_IDR_NUMERIC = '360';
    const CURRENCY_INR_CODE = 'INR';
    const CURRENCY_INR_NUMERIC = '356';
    const CURRENCY_MYR_CODE = 'MYR';
    const CURRENCY_MYR_NUMERIC = '458';
    const CURRENCY_SGD_CODE = 'SGD';
    const CURRENCY_SGD_NUMERIC = '702';
    const CURRENCY_THB_CODE = 'THB';
    const CURRENCY_THB_NUMERIC = '764';
    private $currency_codes = [
//        self::CURRENCY_HKD_NUMERIC => self::CURRENCY_HKD_CODE,
//        self::CURRENCY_IDR_NUMERIC => self::CURRENCY_IDR_CODE,
//        self::CURRENCY_INR_NUMERIC => self::CURRENCY_INR_CODE,
//        self::CURRENCY_MYR_NUMERIC => self::CURRENCY_MYR_CODE,
        self::CURRENCY_SGD_NUMERIC => self::CURRENCY_SGD_CODE,
//        self::CURRENCY_THB_NUMERIC => self::CURRENCY_THB_CODE
    ];
    // 54
    const AMOUNT_ID = '54';
    const AMOUNT_LENGTH_MAX = 13;
    const AMOUNT_LABEL = 'TRANSACTION_AMOUNT';
    // 55
    const TIP_OR_CONVENIENCE_FEE_INDICATOR_ID = '55';
    const TIP_OR_CONVENIENCE_FEE_INDICATOR_LENGTH = '02';
    const TIP_OR_CONVENIENCE_FEE_INDICATOR_LABEL = 'TIP_OR_CONVENIENCE_FEE_INDICATOR';
    const TIP_OR_CONVENIENCE_FEE_INDICATOR_VALUE_TIP = '01';
    const TIP_OR_CONVENIENCE_FEE_INDICATOR_VALUE_FEE_FIXED = '02';
    const TIP_OR_CONVENIENCE_FEE_INDICATOR_VALUE_FEE_PERCENTAGE = '03';
    const TIP_OR_CONVENIENCE_FEE_INDICATOR_LABEL_TIP = 'TIP';
    const TIP_OR_CONVENIENCE_FEE_INDICATOR_LABEL_FEE_FIXED = 'CONVENIENCE_FEE_FIXED';
    const TIP_OR_CONVENIENCE_FEE_INDICATOR_LABEL_FEE_PERCENTAGE = 'CONVENIENCE_FEE_PERCENTAGE';
    private $tip_or_convenience_fees = [
        self::TIP_OR_CONVENIENCE_FEE_INDICATOR_VALUE_TIP            => self::TIP_OR_CONVENIENCE_FEE_INDICATOR_LABEL_TIP,
        self::TIP_OR_CONVENIENCE_FEE_INDICATOR_VALUE_FEE_FIXED      => self::TIP_OR_CONVENIENCE_FEE_INDICATOR_LABEL_FEE_FIXED,
        self::TIP_OR_CONVENIENCE_FEE_INDICATOR_VALUE_FEE_PERCENTAGE => self::TIP_OR_CONVENIENCE_FEE_INDICATOR_LABEL_FEE_PERCENTAGE,
    ];
    // 56
    const VALUE_OF_CONVENIENCE_FEE_FIXED_ID = '56';
    const VALUE_OF_CONVENIENCE_FEE_FIXED_LENGTH_MAX = 13;
    const VALUE_OF_CONVENIENCE_FEE_FIXED_LABEL = 'VALUE_OF_CONVENIENCE_FEE_FIXED';
    // 57
    const VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_ID = '57';
    const VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_LENGTH_MAX = 5;
    const VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_LABEL = 'VALUE_OF_CONVENIENCE_FEE_PERCENTAGE';
    // 58
    const COUNTRY_ID = '58';
    const COUNTRY_LENGTH = '02';
    const COUNTRY_LABEL = 'COUNTRY_CODE';
    const COUNTRY_HK_CODE = 'HK';
    const COUNTRY_HK_NAME = 'HONG KONG';
    const COUNTRY_ID_CODE = 'ID';
    const COUNTRY_ID_NAME = 'INDONESIA';
    const COUNTRY_IN_CODE = 'IN';
    const COUNTRY_IN_NAME = 'INDIA';
    const COUNTRY_MY_CODE = 'MY';
    const COUNTRY_MY_NAME = 'MALAYSIA';
    const COUNTRY_SG_CODE = 'SG';
    const COUNTRY_SG_NAME = 'SINGAPORE';
    const COUNTRY_TH_CODE = 'TH';
    const COUNTRY_TH_NAME = 'THAILAND';
    private $country_codes = [
//        self::COUNTRY_HK_CODE => self::COUNTRY_HK_NAME,
//        self::COUNTRY_ID_CODE => self::COUNTRY_ID_NAME,
//        self::COUNTRY_IN_CODE => self::COUNTRY_IN_NAME,
//        self::COUNTRY_MY_CODE => self::COUNTRY_MY_NAME,
        self::COUNTRY_SG_CODE => self::COUNTRY_SG_NAME,
//        self::COUNTRY_TH_CODE => self::COUNTRY_TH_NAME,
    ];
    // 59
    const MERCHANT_NAME_ID = '59';
    const MERCHANT_NAME_MAX_LENGTH = 25;
    const MERCHANT_NAME_LABEL = 'MERCHANT_NAME';
    // 60
    const MERCHANT_CITY_ID = '60';
    const MERCHANT_CITY_MAX_LENGTH = 15;
    const MERCHANT_CITY_LABEL = 'MERCHANT_CITY';
    // 61
    const POSTAL_CODE_ID = '61';
    const POSTAL_CODE_MAX_LENGTH = 10;
    const POSTAL_CODE_LABEL = 'POSTAL_CODE';
    // 62
    const ADDITIONAL_DATA_ID = '62';
    const ADDITIONAL_DATA_MAX_LENGTH = 99;
    const ADDITIONAL_DATA_LABEL = 'ADDITIONAL_DATA';
    // 62-01
    const ADDITIONAL_DATA_BILL_NUMBER_ID = '01';
    const ADDITIONAL_DATA_BILL_NUMBER_MAX_LENGTH = 25;
    const ADDITIONAL_DATA_BILL_NUMBER_LABEL = 'BILL_NUMBER';
    // 62-02
    const ADDITIONAL_DATA_MOBILE_NUMBER_ID = '02';
    const ADDITIONAL_DATA_MOBILE_NUMBER_MAX_LENGTH = 25;
    const ADDITIONAL_DATA_MOBILE_NUMBER_LABEL = 'MOBILE_NUMBER';
    // 62-03
    const ADDITIONAL_DATA_STORE_LABEL_ID = '03';
    const ADDITIONAL_DATA_STORE_LABEL_MAX_LENGTH = 25;
    const ADDITIONAL_DATA_STORE_LABEL_LABEL = 'STORE_LABEL';
    // 62-04
    const ADDITIONAL_DATA_LOYALTY_NUMBER_ID = '04';
    const ADDITIONAL_DATA_LOYALTY_NUMBER_MAX_LENGTH = 25;
    const ADDITIONAL_DATA_LOYALTY_NUMBER_LABEL = 'LOYALTY_NUMBER';
    // 62-05
    const ADDITIONAL_DATA_REFERENCE_LABEL_ID = '05';
    const ADDITIONAL_DATA_REFERENCE_LABEL_MAX_LENGTH = 25;
    const ADDITIONAL_DATA_REFERENCE_LABEL_LABEL = 'REFERENCE_LABEL';
    // 62-06
    const ADDITIONAL_DATA_CUSTOMER_LABEL_ID = '06';
    const ADDITIONAL_DATA_CUSTOMER_LABEL_MAX_LENGTH = 25;
    const ADDITIONAL_DATA_CUSTOMER_LABEL_LABEL = 'CUSTOMER_LABEL';
    // 62-07
    const ADDITIONAL_DATA_TERMINAL_LABEL_ID = '07';
    const ADDITIONAL_DATA_TERMINAL_LABEL_MAX_LENGTH = 25;
    const ADDITIONAL_DATA_TERMINAL_LABEL_LABEL = 'TERMINAL_LABEL';
    // 62-08
    const ADDITIONAL_DATA_PURPOSE_OF_TRANSACTION_ID = '08';
    const ADDITIONAL_DATA_PURPOSE_OF_TRANSACTION_MAX_LENGTH = 25;
    const ADDITIONAL_DATA_PURPOSE_OF_TRANSACTION_LABEL = 'PURPOSE_OF_TRANSACTION';
    // 62-09
    const ADDITIONAL_DATA_ADDITIONAL_CONSUMER_DATA_REQUEST_ID = '09';
    const ADDITIONAL_DATA_ADDITIONAL_CONSUMER_DATA_REQUEST_MAX_LENGTH = 3;
    const ADDITIONAL_DATA_ADDITIONAL_CONSUMER_DATA_REQUEST_LABEL = 'ADDITIONAL_CONSUMER_DATA_REQUEST';
    // 62-10
    const ADDITIONAL_DATA_MERCHANT_TAX_ID_ID = '10';
    const ADDITIONAL_DATA_MERCHANT_TAX_ID_MAX_LENGTH = 10;
    const ADDITIONAL_DATA_MERCHANT_TAX_ID_LABEL = 'MERCHANT_TAX_ID';
    // 62-11
    const ADDITIONAL_DATA_MERCHANT_CHANNEL_ID = '11';
    const ADDITIONAL_DATA_MERCHANT_CHANNEL_MAX_LENGTH = 3;
    const ADDITIONAL_DATA_MERCHANT_CHANNEL_LABEL = 'MERCHANT_CHANNEL';
    // 64
    const LANGUAGE_TEMPLATE_ID = '64';
    const LANGUAGE_TEMPLATE_MAX_LENGTH = 99;
    const LANGUAGE_TEMPLATE_LABEL = 'LANGUAGE_TEMPLATE';
    // 64-00
    const LANGUAGE_TEMPLATE_LANGUAGE_CODE_ID = '00';
    const LANGUAGE_TEMPLATE_LANGUAGE_CODE_LENGTH = '02';
    const LANGUAGE_TEMPLATE_LANGUAGE_CODE_LABEL = 'LANGUAGE_CODE';
    // 64-01
    const LANGUAGE_TEMPLATE_MERCHANT_NAME_ID = '01';
    const LANGUAGE_TEMPLATE_MERCHANT_NAME_MAX_LENGTH = 25;
    const LANGUAGE_TEMPLATE_MERCHANT_NAME_LABEL = 'MERCHANT_NAME';
    // 64-02
    const LANGUAGE_TEMPLATE_CITY_ID = '02';
    const LANGUAGE_TEMPLATE_CITY_MAX_LENGTH = 15;
    const LANGUAGE_TEMPLATE_CITY_LABEL = 'CITY';
    // 63
    const CRC_ID = '63';
    const CRC_LENGTH = '04';
    const CRC_LABEL = 'CRC';

    private $error_codes = [
        'D001' => 'THE FIELD IS INVALID',
        'D002' => 'THE FIELD IS INVALID OR NOT SUPPORTED',
        'D003' => 'THE CRC IS NOT VALID - THE QR CODE WAS ALTERED',
        'D004' => '',
        'D005' => '',
        'D006' => '',
        'D007' => '',
        'D008' => '',
        'D009' => '',
        'D010' => '',
        'D011' => '',
        'D012' => '',
        'D013' => '',
        'D014' => '',
        'D015' => '',
        'D016' => '',
        'D017' => '',
        'D018' => '',
        'D019' => '',
        'D020' => '',
    ];

    public $content = [
        'qr_string' => NULL,
        'fields'    => [
            // 00
            self::PAYLOAD_FORMAT_INDICATOR_ID            => [
                'label'       => self::PAYLOAD_FORMAT_INDICATOR_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 01
            self::POINT_OF_INITIATION_ID                 => [
                'label'       => self::POINT_OF_INITIATION_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 02-51
            'accounts'                                   => [
                'label' => 'ACCOUNTS',
                'data'  => []
            ],
            // 52
            self::MERCHANT_CATEGORY_CODE_ID              => [
                'label'       => self::MERCHANT_CATEGORY_CODE_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 53
            self::CURRENCY_ID                            => [
                'label'       => self::CURRENCY_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 54
            self::AMOUNT_ID                              => [
                'label'       => self::AMOUNT_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 55
            self::TIP_OR_CONVENIENCE_FEE_INDICATOR_ID    => [
                'label'       => self::TIP_OR_CONVENIENCE_FEE_INDICATOR_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 56
            self::VALUE_OF_CONVENIENCE_FEE_FIXED_ID      => [
                'label'       => self::VALUE_OF_CONVENIENCE_FEE_FIXED_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 57
            self::VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_ID => [
                'label'       => self::VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 58
            self::COUNTRY_ID                             => [
                'label'       => self::COUNTRY_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 59
            self::MERCHANT_NAME_ID                       => [
                'label'       => self::MERCHANT_NAME_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 60
            self::MERCHANT_CITY_ID                       => [
                'label'       => self::MERCHANT_CITY_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 61
            self::POSTAL_CODE_ID                         => [
                'label'       => self::POSTAL_CODE_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
            // 62
            self::ADDITIONAL_DATA_ID                     => [
                'label' => self::ADDITIONAL_DATA_LABEL,
                'data'  => [
                    self::ADDITIONAL_DATA_BILL_NUMBER_ID                      => [
                        'label'       => self::ADDITIONAL_DATA_BILL_NUMBER_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::ADDITIONAL_DATA_MOBILE_NUMBER_ID                    => [
                        'label'       => self::ADDITIONAL_DATA_MOBILE_NUMBER_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::ADDITIONAL_DATA_STORE_LABEL_ID                      => [
                        'label'       => self::ADDITIONAL_DATA_STORE_LABEL_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::ADDITIONAL_DATA_LOYALTY_NUMBER_ID                   => [
                        'label'       => self::ADDITIONAL_DATA_LOYALTY_NUMBER_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::ADDITIONAL_DATA_REFERENCE_LABEL_ID                  => [
                        'label'       => self::ADDITIONAL_DATA_REFERENCE_LABEL_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::ADDITIONAL_DATA_CUSTOMER_LABEL_ID                   => [
                        'label'       => self::ADDITIONAL_DATA_CUSTOMER_LABEL_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::ADDITIONAL_DATA_TERMINAL_LABEL_ID                   => [
                        'label'       => self::ADDITIONAL_DATA_TERMINAL_LABEL_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::ADDITIONAL_DATA_PURPOSE_OF_TRANSACTION_ID           => [
                        'label'       => self::ADDITIONAL_DATA_PURPOSE_OF_TRANSACTION_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::ADDITIONAL_DATA_ADDITIONAL_CONSUMER_DATA_REQUEST_ID => [
                        'label'       => self::ADDITIONAL_DATA_ADDITIONAL_CONSUMER_DATA_REQUEST_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::ADDITIONAL_DATA_MERCHANT_TAX_ID_ID                  => [
                        'label'       => self::ADDITIONAL_DATA_MERCHANT_TAX_ID_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::ADDITIONAL_DATA_MERCHANT_CHANNEL_ID                 => [
                        'label'       => self::ADDITIONAL_DATA_MERCHANT_CHANNEL_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ]
                ]
            ],
            // 64
            self::LANGUAGE_TEMPLATE_ID                   => [
                'label' => self::LANGUAGE_TEMPLATE_LABEL,
                'data'  => [
                    self::LANGUAGE_TEMPLATE_LANGUAGE_CODE_ID => [
                        'label'       => self::LANGUAGE_TEMPLATE_LANGUAGE_CODE_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::LANGUAGE_TEMPLATE_MERCHANT_NAME_ID => [
                        'label'       => self::LANGUAGE_TEMPLATE_MERCHANT_NAME_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                    self::LANGUAGE_TEMPLATE_CITY_ID          => [
                        'label'       => self::LANGUAGE_TEMPLATE_CITY_LABEL,
                        'value'       => NULL,
                        'status'      => self::STATUS_NOT_YET_PROCESSED,
                        'description' => NULL
                    ],
                ]
            ],
            // 63
            self::CRC_ID                                 => [
                'label'       => self::CRC_LABEL,
                'value'       => NULL,
                'status'      => self::STATUS_NOT_YET_PROCESSED,
                'description' => NULL
            ],
        ],
        'errors'    => []
    ];

    /* | --------------------------------------------------------------------------------------------------------
       | phpCrc16 v1.1 -- CRC16/CCITT implementation
       |
       | By Matteo Beccati <matteo@beccati.com>
       |
       | Original code by:
       | Ashley Roll
       | Digital Nemesis Pty Ltd
       | www.digitalnemesis.com
       | ash@digitalnemesis.com
       |
       | Test Vector: "123456789" (character string, no quotes)
       | Generated CRC: 0x29B1
       |
       | -------------------------------------------------------------------------------------------------------- */
    /**
     * Returns CRC16 of a string as int value
     * @param string $str The string to digest
     * @return string
     */
    private function CRC16($str)
    {
        static $CRC16_Lookup = array(
            0x0000, 0x1021, 0x2042, 0x3063, 0x4084, 0x50A5, 0x60C6, 0x70E7,
            0x8108, 0x9129, 0xA14A, 0xB16B, 0xC18C, 0xD1AD, 0xE1CE, 0xF1EF,
            0x1231, 0x0210, 0x3273, 0x2252, 0x52B5, 0x4294, 0x72F7, 0x62D6,
            0x9339, 0x8318, 0xB37B, 0xA35A, 0xD3BD, 0xC39C, 0xF3FF, 0xE3DE,
            0x2462, 0x3443, 0x0420, 0x1401, 0x64E6, 0x74C7, 0x44A4, 0x5485,
            0xA56A, 0xB54B, 0x8528, 0x9509, 0xE5EE, 0xF5CF, 0xC5AC, 0xD58D,
            0x3653, 0x2672, 0x1611, 0x0630, 0x76D7, 0x66F6, 0x5695, 0x46B4,
            0xB75B, 0xA77A, 0x9719, 0x8738, 0xF7DF, 0xE7FE, 0xD79D, 0xC7BC,
            0x48C4, 0x58E5, 0x6886, 0x78A7, 0x0840, 0x1861, 0x2802, 0x3823,
            0xC9CC, 0xD9ED, 0xE98E, 0xF9AF, 0x8948, 0x9969, 0xA90A, 0xB92B,
            0x5AF5, 0x4AD4, 0x7AB7, 0x6A96, 0x1A71, 0x0A50, 0x3A33, 0x2A12,
            0xDBFD, 0xCBDC, 0xFBBF, 0xEB9E, 0x9B79, 0x8B58, 0xBB3B, 0xAB1A,
            0x6CA6, 0x7C87, 0x4CE4, 0x5CC5, 0x2C22, 0x3C03, 0x0C60, 0x1C41,
            0xEDAE, 0xFD8F, 0xCDEC, 0xDDCD, 0xAD2A, 0xBD0B, 0x8D68, 0x9D49,
            0x7E97, 0x6EB6, 0x5ED5, 0x4EF4, 0x3E13, 0x2E32, 0x1E51, 0x0E70,
            0xFF9F, 0xEFBE, 0xDFDD, 0xCFFC, 0xBF1B, 0xAF3A, 0x9F59, 0x8F78,
            0x9188, 0x81A9, 0xB1CA, 0xA1EB, 0xD10C, 0xC12D, 0xF14E, 0xE16F,
            0x1080, 0x00A1, 0x30C2, 0x20E3, 0x5004, 0x4025, 0x7046, 0x6067,
            0x83B9, 0x9398, 0xA3FB, 0xB3DA, 0xC33D, 0xD31C, 0xE37F, 0xF35E,
            0x02B1, 0x1290, 0x22F3, 0x32D2, 0x4235, 0x5214, 0x6277, 0x7256,
            0xB5EA, 0xA5CB, 0x95A8, 0x8589, 0xF56E, 0xE54F, 0xD52C, 0xC50D,
            0x34E2, 0x24C3, 0x14A0, 0x0481, 0x7466, 0x6447, 0x5424, 0x4405,
            0xA7DB, 0xB7FA, 0x8799, 0x97B8, 0xE75F, 0xF77E, 0xC71D, 0xD73C,
            0x26D3, 0x36F2, 0x0691, 0x16B0, 0x6657, 0x7676, 0x4615, 0x5634,
            0xD94C, 0xC96D, 0xF90E, 0xE92F, 0x99C8, 0x89E9, 0xB98A, 0xA9AB,
            0x5844, 0x4865, 0x7806, 0x6827, 0x18C0, 0x08E1, 0x3882, 0x28A3,
            0xCB7D, 0xDB5C, 0xEB3F, 0xFB1E, 0x8BF9, 0x9BD8, 0xABBB, 0xBB9A,
            0x4A75, 0x5A54, 0x6A37, 0x7A16, 0x0AF1, 0x1AD0, 0x2AB3, 0x3A92,
            0xFD2E, 0xED0F, 0xDD6C, 0xCD4D, 0xBDAA, 0xAD8B, 0x9DE8, 0x8DC9,
            0x7C26, 0x6C07, 0x5C64, 0x4C45, 0x3CA2, 0x2C83, 0x1CE0, 0x0CC1,
            0xEF1F, 0xFF3E, 0xCF5D, 0xDF7C, 0xAF9B, 0xBFBA, 0x8FD9, 0x9FF8,
            0x6E17, 0x7E36, 0x4E55, 0x5E74, 0x2E93, 0x3EB2, 0x0ED1, 0x1EF0
        );
        $crc16 = 0xFFFF; // the CRC
        $len = strlen($str);
        for ($i = 0; $i < $len; $i++)
        {
            $t = ($crc16 >> 8) ^ ord($str[$i]); // High byte Xor Message Byte to get index
            $crc16 = (($crc16 << 8) & 0xffff) ^ $CRC16_Lookup[$t]; // Update the CRC from table
        }
        // crc16 now contains the CRC value
        return $crc16;
    }

    /**
     * Returns CRC16 of a string as hexadecimal string
     * @param string $str The string to digest
     * @return string
     */
    private function CRC16HexDigest($str)
    {
        return sprintf('%04X', $this->CRC16($str));
    }

    /**
     * This function decodes the QR code string.
     * @param string $qr_string
     * @return bool
     */
    public function decoder ($qr_string)
    {
        if (empty($qr_string) || ! is_string($qr_string))
        {
            return FALSE;
        }
        // CLEAN
        $string = str_replace("\u{c2a0}", ' ', $qr_string);
        // PRESERVE ORIGINAL STRING
        $this->content['qr_string'] = $string;
        // PROCESS STRING
        while ( ! empty($string))
        {
            $strId = substr($string, self::ZERO, self::TWO);
            $intId = intval($strId);
            $intLength = intval(substr($string, self::TWO, self::TWO));
            $strValue = substr($string, self::FOUR, $intLength);
            echo $strId . ' / ' . $intLength . ' / ' . $strValue . '<br>';
            $this->content['fields'][$strId]['value'] = $strValue;
            switch ($strId)
            {
                case self::PAYLOAD_FORMAT_INDICATOR_ID:
                    $this->payload_format_indicator_verify($strValue);
                    break;
                case self::POINT_OF_INITIATION_ID:
                    $this->point_of_initiation_verify($strValue);
                    break;
                case self::MERCHANT_CATEGORY_CODE_ID:
                    $this->merchant_category_code_verify($strValue);
                    break;
                case self::CURRENCY_ID:
                    $this->currency_verify($strValue);
                    break;
                case self::AMOUNT_ID:
                    $this->amount_verify($strValue);
                    break;
                case self::TIP_OR_CONVENIENCE_FEE_INDICATOR_ID:
                    $this->tip_or_convenience_fee_verify($strValue);
                    break;
                case self::VALUE_OF_CONVENIENCE_FEE_FIXED_ID:
                    $this->convenience_fee_fixed_verify($strValue);
                    break;
                case self::VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_ID:
                    $this->convenience_fee_percentage_verify($strValue);
                    break;
                case self::COUNTRY_ID:
                    $this->country_code_verify($strValue);
                    break;
                case self::MERCHANT_NAME_ID:
                    $this->merchant_name_verify($strValue);
                    break;
                case self::MERCHANT_CITY_ID:
                    $this->merchant_city_verify($strValue);
                    break;
                case self::POSTAL_CODE_ID:
                    $this->postal_code_verify($strValue);
                    break;
                case self::ADDITIONAL_DATA_ID:
                    $this->additional_data_process($strValue);
                    break;
                case self::LANGUAGE_TEMPLATE_ID:
                    $this->language_template_process($strValue);
                    break;
                case self::CRC_ID:
                    $this->crc_verify($strValue);
                    break;
//                default:
//                    $this->process_accounts($intId, $strValue);
            }
            $string = substr($string, self::FOUR + $intLength);
        }
        return TRUE;
    }

    public function generator_sg ()
    {
        //
    }

    public function generator_th_promptpay ()
    {
        //
    }

    /********************************************************************************
     * ID: 00
     * LENGTH: 02
     * VALUE: Only accepts '01'
     * MANDATORY
     * FORMAT: N(2)
     */

    /**
     * VERIFY 00
     * @param $value
     */
    private function payload_format_indicator_verify($value)
    {
        echo 'payload_format_indicator_verify(' . $value . ')<br>';
        if ($value == self::PAYLOAD_FORMAT_INDICATOR_VALUE)
        {
            $this->content['fields'][self::PAYLOAD_FORMAT_INDICATOR_ID]['status'] = self::STATUS_OK;
        } else
        {
            $this->content['fields'][self::PAYLOAD_FORMAT_INDICATOR_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::PAYLOAD_FORMAT_INDICATOR_ID]['error']['code'] = 'D001';
            $this->content['fields'][self::PAYLOAD_FORMAT_INDICATOR_ID]['error']['message'] = $this->error_codes['D001'];
        }
    }

    /********************************************************************************
     * ID: 01
     * LENGTH: 02
     * VALUE: Only accepts '11', '12'
     * OPTIONAL
     * FORMAT: N(2)
     */

    /**
     * VERIFY 01
     * @param $value
     */
    private function point_of_initiation_verify ($value)
    {
        echo 'point_of_initiation_verify(' . $value . ')<br>';
        if (in_array($value, $this->point_of_initiation_values))
        {
            $this->content['fields'][self::POINT_OF_INITIATION_ID]['status'] = self::STATUS_OK;
            $this->content['fields'][self::POINT_OF_INITIATION_ID]['description'] = $this->point_of_initiation_labels[$value];
        } else
        {
            $this->content['fields'][self::POINT_OF_INITIATION_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::POINT_OF_INITIATION_ID]['error']['code'] = 'D001';
            $this->content['fields'][self::POINT_OF_INITIATION_ID]['error']['message'] = $this->error_codes['D001'];
        }
    }

    /********************************************************************************
     * ID: 52
     * LENGTH: 04
     * VALUE: 4-digit Merchant Category Code
     * MANDATORY
     * FORMAT: N(4)
     */

    /**
     * VERIFY 52
     * @param $value
     */
    private function merchant_category_code_verify ($value)
    {
        echo 'merchant_category_code_verify(' . $value . ')<br>';
        if (isset($this->merchant_category_codes[$value]))
        {
            $this->content['fields'][self::MERCHANT_CATEGORY_CODE_ID]['status'] = self::STATUS_OK;
            $this->content['fields'][self::MERCHANT_CATEGORY_CODE_ID]['description'] = $this->merchant_category_codes[$value];
        } else
        {
            $this->content['fields'][self::MERCHANT_CATEGORY_CODE_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::MERCHANT_CATEGORY_CODE_ID]['error']['code'] = 'D001';
            $this->content['fields'][self::MERCHANT_CATEGORY_CODE_ID]['error']['message'] = $this->error_codes['D001'];
        }
    }

    /********************************************************************************
     * ID: 53
     * LENGTH: 03
     * VALUE: 3-digit currency code
     * MANDATORY
     * FORMAT: N(3)
     */

    /**
     * VERIFY 53
     * @param $value
     */
    private function currency_verify ($value)
    {
        echo 'currency_verify(' . $value . ')<br>';
        $this->content['fields'][self::CURRENCY_ID]['value'] = $value;
        if (isset($this->currency_codes[$value]))
        {
            $this->content['fields'][self::CURRENCY_ID]['status'] = self::STATUS_OK;
            $this->content['fields'][self::CURRENCY_ID]['description'] = $this->currency_codes[$value];
        } else
        {
            $this->content['fields'][self::CURRENCY_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::CURRENCY_ID]['error']['code'] = 'D002';
            $this->content['fields'][self::CURRENCY_ID]['error']['message'] = $this->error_codes['D002'];
        }
    }

    /********************************************************************************
     * ID: 54
     * LENGTH: <= 13
     * VALUE: Transaction amount
     * CONDITIONAL
     * FORMAT: ANS(<=13)
     */

    /**
     * VERIFY 54
     * @param $value
     */
    private function amount_verify ($value)
    {
        echo 'amount_verify(' . $value . ')<br>';
        if (self::AMOUNT_LENGTH_MAX >= strlen($value) && preg_match('/^(\d+|\d+\.|\d+\.\d+)$/', $value))
        {
            $value = floatval($value);
            $this->content['fields'][self::AMOUNT_ID]['status'] = self::STATUS_OK;
            $this->content['fields'][self::AMOUNT_ID]['description'] = $value;
        } else
        {
            $this->content['fields'][self::AMOUNT_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::AMOUNT_ID]['error']['code'] = 'D001';
            $this->content['fields'][self::AMOUNT_ID]['error']['message'] = $this->error_codes['D001'];
        }
    }

    /********************************************************************************
     * ID: 55
     * LENGTH: 02
     * VALUE: Tip of convenience fee
     * OPTIONAL
     * FORMAT: N(2)
     */

    /**
     * VERIFY 55
     * @param $value
     */
    private function tip_or_convenience_fee_verify ($value)
    {
        echo 'tip_or_convenience_fee_verify(' . $value . ')<br>';
        if (isset($this->tip_or_convenience_fees[$value]))
        {
            $this->content['fields'][self::TIP_OR_CONVENIENCE_FEE_INDICATOR_ID]['status'] = self::STATUS_OK;
            $this->content['fields'][self::TIP_OR_CONVENIENCE_FEE_INDICATOR_ID]['description'] = $this->tip_or_convenience_fees[$value];
        } else
        {
            $this->content['fields'][self::TIP_OR_CONVENIENCE_FEE_INDICATOR_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::TIP_OR_CONVENIENCE_FEE_INDICATOR_ID]['error']['code'] = 'D001';
            $this->content['fields'][self::TIP_OR_CONVENIENCE_FEE_INDICATOR_ID]['error']['message'] = $this->error_codes['D001'];
        }
    }

    /********************************************************************************
     * ID: 56
     * LENGTH: 13
     * VALUE: Convenience fee (fixed)
     * CONDITIONAL
     * FORMAT: ANS(<= 13)
     */

    /**
     * VERIFY 56
     * @param $value
     */
    private function convenience_fee_fixed_verify ($value)
    {
        echo 'convenience_fee_fixed_verify(' . $value . ')<br>';
        if (self::VALUE_OF_CONVENIENCE_FEE_FIXED_LENGTH_MAX >= strlen($value) && preg_match('/^(\d+|\d+\.|\d+\.\d+)$/', $value))
        {
            $value = floatval($value);
            $this->content['fields'][self::VALUE_OF_CONVENIENCE_FEE_FIXED_ID]['status'] = self::STATUS_OK;
            $this->content['fields'][self::VALUE_OF_CONVENIENCE_FEE_FIXED_ID]['description'] = $value;
        } else
        {
            $this->content['fields'][self::VALUE_OF_CONVENIENCE_FEE_FIXED_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::VALUE_OF_CONVENIENCE_FEE_FIXED_ID]['error']['code'] = 'D001';
            $this->content['fields'][self::VALUE_OF_CONVENIENCE_FEE_FIXED_ID]['error']['message'] = $this->error_codes['D001'];
        }
    }

    /********************************************************************************
     * ID: 57
     * LENGTH: 5
     * VALUE: Convenience fee (percentage)
     * CONDITIONAL
     * FORMAT: ANS(<= 5)
     */

    /**
     * VERIFY 57
     * @param $value
     */
    private function convenience_fee_percentage_verify ($value)
    {
        echo 'convenience_fee_percentage_verify(' . $value . ')<br>';
        if (self::VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_LENGTH_MAX >= strlen($value) && preg_match('/^(\d+|\d+\.|\d+\.\d+)$/', $value))
        {
            $value = floatval($value);
            $this->content['fields'][self::VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_ID]['status'] = self::STATUS_OK;
            $this->content['fields'][self::VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_ID]['description'] = $value;
        } else
        {
            $this->content['fields'][self::VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_ID]['error']['code'] = 'D001';
            $this->content['fields'][self::VALUE_OF_CONVENIENCE_FEE_PERCENTAGE_ID]['error']['message'] = $this->error_codes['D001'];
        }
    }

    /********************************************************************************
     * ID: 58
     * LENGTH: 2
     * VALUE: Country code
     * MANDATORY
     * FORMAT: ANS(2)
     */

    /**
     * VERIFY 58
     * @param $value
     */
    private function country_code_verify ($value)
    {
        echo 'country_code_verify(' . $value . ')<br>';
        if (isset($this->country_codes[$value]))
        {
            $this->content['fields'][self::COUNTRY_ID]['status'] = self::STATUS_OK;
            $this->content['fields'][self::COUNTRY_ID]['description'] = $this->country_codes[$value];
        } else
        {
            $this->content['fields'][self::COUNTRY_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::COUNTRY_ID]['error']['code'] = 'D001';
            $this->content['fields'][self::COUNTRY_ID]['error']['message'] = $this->error_codes['D001'];
        }
    }

    /********************************************************************************
     * ID: 59
     * LENGTH: <= 25
     * VALUE: Merchant name
     * MANDATORY
     * FORMAT: ANS(<= 25)
     */

    /**
     * VERIFY 59
     * @param $value
     */
    private function merchant_name_verify ($value)
    {
        echo 'merchant_name_verify(' . $value . ')<br>';
        if (self::MERCHANT_NAME_MAX_LENGTH >= strlen($value))
        {
            $this->content['fields'][self::MERCHANT_NAME_ID]['status'] = self::STATUS_OK;
        } else
        {
            $this->content['fields'][self::MERCHANT_NAME_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::MERCHANT_NAME_ID]['error']['code'] = 'D001';
            $this->content['fields'][self::MERCHANT_NAME_ID]['error']['message'] = $this->error_codes['D001'];
        }
    }

    /********************************************************************************
     * ID: 60
     * LENGTH: <= 15
     * VALUE: Merchant city
     * MANDATORY
     * FORMAT: ANS(<= 15)
     */

    /**
     * VERIFY 60
     * @param $value
     */
    private function merchant_city_verify ($value)
    {
        echo 'merchant_city_verify(' . $value . ')<br>';
        if (self::MERCHANT_CITY_MAX_LENGTH >= strlen($value))
        {
            $this->content['fields'][self::MERCHANT_CITY_ID]['status'] = self::STATUS_OK;
        } else
        {
            $this->content['fields'][self::MERCHANT_CITY_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::MERCHANT_CITY_ID]['error']['code'] = 'D001';
            $this->content['fields'][self::MERCHANT_CITY_ID]['error']['message'] = $this->error_codes['D001'];
        }
    }

    /********************************************************************************
     * ID: 61
     * LENGTH: <= 10
     * VALUE: Merchant postal code
     * MANDATORY
     * FORMAT: ANS(<= 10)
     */

    /**
     * VERIFY 61
     * @param $value
     */
    private function postal_code_verify ($value)
    {
        echo 'postal_code_verify(' . $value . ')<br>';
        if (self::POSTAL_CODE_MAX_LENGTH >= strlen($value))
        {
            $this->content['fields'][self::POSTAL_CODE_ID]['status'] = self::STATUS_OK;
        } else
        {
            $this->content['fields'][self::POSTAL_CODE_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::POSTAL_CODE_ID]['error']['code'] = 'D001';
            $this->content['fields'][self::POSTAL_CODE_ID]['error']['message'] = $this->error_codes['D001'];
        }
    }

    /********************************************************************************
     * ID: 63
     * LENGTH: 4
     * VALUE: CRC
     * MANDATORY
     * FORMAT: ANS(4)
     */

    /**
     * VERIFY 63
     * @param $value
     */
    private function crc_verify ($value)
    {
        echo 'crc_verify(' . $value . ')<br>';
        $length_minus_crc = strlen($this->content['qr_string']) - self::FOUR;
        $the_string = substr($this->content['qr_string'], self::ZERO, $length_minus_crc);
        $crc = $this->CRC16HexDigest($the_string);
        if ($crc == $value)
        {
            $this->content['fields'][self::CRC_ID]['status'] = self::STATUS_OK;
        } else
        {
            $this->content['fields'][self::CRC_ID]['status'] = self::STATUS_ERR;
            $this->content['fields'][self::CRC_ID]['description'] = $crc;
            $this->content['fields'][self::CRC_ID]['error']['code'] = 'D003';
            $this->content['fields'][self::CRC_ID]['error']['message'] = $this->error_codes['D003'];
        }
    }

    /********************************************************************************
     * ID: 62
     * LENGTH: <= 99
     * OPTIONAL
     * FORMAT: ANS(<= 99)
     */

    /**
     * PROCESS 62
     * @param $value
     */
    private function additional_data_process ($value)
    {
        // PROCESS STRING
        echo 'additional_data_process(' . $value . ')<br>';
        while ( ! empty($value))
        {
            $strId = substr($value, self::ZERO, self::TWO);
            $intLength = intval(substr($value, self::TWO, self::TWO));
            $strValue = substr($value, self::FOUR, $intLength);
            echo '62-' . $strId . ' / ' . $intLength . ' / ' . $strValue . '<br>';
            $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['value'] = $strValue;
            switch ($strId)
            {
                case self::ADDITIONAL_DATA_BILL_NUMBER_ID:
                case self::ADDITIONAL_DATA_MOBILE_NUMBER_ID:
                case self::ADDITIONAL_DATA_STORE_LABEL_ID:
                case self::ADDITIONAL_DATA_LOYALTY_NUMBER_ID:
                case self::ADDITIONAL_DATA_REFERENCE_LABEL_ID:
                case self::ADDITIONAL_DATA_CUSTOMER_LABEL_ID:
                case self::ADDITIONAL_DATA_TERMINAL_LABEL_ID:
                case self::ADDITIONAL_DATA_PURPOSE_OF_TRANSACTION_ID:
                    if (strlen($strValue) <= self::TWENTY_FIVE)
                    {
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['status'] = self::STATUS_OK;
                    } else
                    {
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['status'] = self::STATUS_ERR;
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['error']['code'] = 'D001';
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['error']['message'] = $this->error_codes['D001'];
                    }
                    break;
                case self::ADDITIONAL_DATA_ADDITIONAL_CONSUMER_DATA_REQUEST_ID:
                    if (strlen($strValue <= self::THREE))
                    {
                        $need = [];
                        if (FALSE != strpos($strValue, 'A'))
                        {
                            $need[] = 'ADDRESS';
                        }
                        if (FALSE != strpos($strValue, 'E'))
                        {
                            $need[] = 'EMAIL';
                        }
                        if (FALSE != strpos($strValue, 'M'))
                        {
                            $need[] = 'MOBILE PHONE';
                        }
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['status'] = self::STATUS_OK;
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['description'] = implode(', ', $need);
                    } else
                    {
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['status'] = self::STATUS_ERR;
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['error']['code'] = 'D001';
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['error']['message'] = $this->error_codes['D001'];
                    }
                    break;
                case self::ADDITIONAL_DATA_MERCHANT_TAX_ID_ID:
                    if (strlen($strValue) >= self::TWENTY)
                    {
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['status'] = self::STATUS_OK;
                    } else
                    {
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['status'] = self::STATUS_ERR;
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['error']['code'] = 'D001';
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['error']['message'] = $this->error_codes['D001'];
                    }
                    break;
                case self::ADDITIONAL_DATA_MERCHANT_CHANNEL_ID:
                    $media = substr($strValue, self::ZERO, self::ONE);
                    $location = substr($strValue, self::ONE, self::ONE);
                    $presence = substr($strValue, self::TWO, self::ONE);
                    $channel = [];
                    $error = 0;
                    switch ($media)
                    {
                        case '0': $channel['MEDIA'] = 'PRINT - MERCHANT STICKER'; break;
                        case '1': $channel['MEDIA'] = 'PRINT - BILL/INVOICE'; break;
                        case '2': $channel['MEDIA'] = 'PRINT - MAGAZINE/POSTER'; break;
                        case '3': $channel['MEDIA'] = 'PRINT - OTHER'; break;
                        case '4': $channel['MEDIA'] = 'SCREEN/ELECTRONIC - MERCHANT POS/POI'; break;
                        case '5': $channel['MEDIA'] = 'SCREEN/ELECTRONIC - WEBSITE'; break;
                        case '6': $channel['MEDIA'] = 'SCREEN/ELECTRONIC - APP'; break;
                        case '7': $channel['MEDIA'] = 'SCREEN/ELECTRONIC - OTHER'; break;
                        default: $error++;
                    }
                    switch ($location)
                    {
                        case '0': $channel['LOCATION'] = 'AT MERCHANT PREMISES'; break;
                        case '1': $channel['LOCATION'] = 'NOT AT MERCHANT PREMISES'; break;
                        case '2': $channel['LOCATION'] = 'REMOTE COMMERCE'; break;
                        case '3': $channel['LOCATION'] = 'OTHER'; break;
                        default: $error++;
                    }
                    switch ($presence)
                    {
                        case '0': $channel['PRESENCE'] = 'ATTENDED POI'; break;
                        case '1': $channel['PRESENCE'] = 'UNATTENDED'; break;
                        case '2': $channel['PRESENCE'] = 'SEMI-ATTENDED (SELF-CHECKOUT)'; break;
                        case '3': $channel['PRESENCE'] = 'OTHER'; break;
                        default: $error++;
                    }
                    if (self::ZERO < $error)
                    {
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['status'] = self::STATUS_ERR;
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['error']['code'] = 'D001';
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['error']['message'] = $this->error_codes['D001'];
                    } else
                    {
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['status'] = self::STATUS_OK;
                        $this->content['fields'][self::ADDITIONAL_DATA_ID]['data'][$strId]['description'] = $channel;
                    }
                    break;
                default:
                    $this->content['fields'][self::ADDITIONAL_DATA_ID]['status'] = self::STATUS_ERR;
                    $this->content['fields'][self::ADDITIONAL_DATA_ID]['error']['code'] = 'D001';
                    $this->content['fields'][self::ADDITIONAL_DATA_ID]['error']['message'] = $this->error_codes['D001'];
            }
            $value = substr($value, self::FOUR + $intLength);
        }
    }

    /********************************************************************************
     * ID: 64
     * LENGTH: <= 99
     * OPTIONAL
     * FORMAT: ANS(<= 99)
     */

    /**
     * PROCESS 64
     * @param $value
     */
    private function language_template_process ($value)
    {
        // PROCESS STRING
        echo 'additional_data_process(' . $value . ')<br>';
        while ( ! empty($value))
        {
            $strId = substr($value, self::ZERO, self::TWO);
            $intLength = intval(substr($value, self::TWO, self::TWO));
            $strValue = substr($value, self::FOUR, $intLength);
            echo '64-' . $strId . ' / ' . $intLength . ' / ' . $strValue . '<br>';
            $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['value'] = $strValue;
            switch ($strId)
            {
                case self::LANGUAGE_TEMPLATE_LANGUAGE_CODE_ID:
                    if (strlen($strValue) >= self::TWO)
                    {
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['status'] = self::STATUS_OK;
                    } else
                    {
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['status'] = self::STATUS_ERR;
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['error']['code'] = 'D002';
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['error']['message'] = $this->error_codes['D002'];
                    }
                    break;
                case self::LANGUAGE_TEMPLATE_MERCHANT_NAME_ID:
                    if (strlen($strValue) >= self::TWENTY_FIVE)
                    {
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['status'] = self::STATUS_OK;
                    } else
                    {
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['status'] = self::STATUS_ERR;
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['error']['code'] = 'D001';
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['error']['message'] = $this->error_codes['D001'];
                    }
                    break;
                case self::LANGUAGE_TEMPLATE_CITY_ID:
                    if (strlen($strValue) >= self::TEN)
                    {
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['status'] = self::STATUS_OK;
                    } else
                    {
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['status'] = self::STATUS_ERR;
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['error']['code'] = 'D001';
                        $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['data'][$strId]['error']['message'] = $this->error_codes['D001'];
                    }
                    break;
                default:
                    $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['status'] = self::STATUS_ERR;
                    $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['error']['code'] = 'D001';
                    $this->content['fields'][self::LANGUAGE_TEMPLATE_ID]['error']['message'] = $this->error_codes['D001'];
            }
            $value = substr($value, self::FOUR + $intLength);
        }
    }

}