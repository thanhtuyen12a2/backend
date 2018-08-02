<?php
namespace backend\models;
use Aabc;
use aabc\base\Model;
use aabc\helpers\Html;
use kartik\select2\Select2;
use aabc\web\JsExpression;
use common\components\Tuyen;


class Cauhinh extends Model
{  

    public function actionController()
    {
        return [
            Cauhinh::tt.':'.Cauhinh::cauhinh1 => 'cauhinh/cauhinh1',
            Cauhinh::tt.':'.Cauhinh::cauhinh2 => 'cauhinh/cauhinh2',
            Cauhinh::tt.':'.Cauhinh::cauhinh3 => 'cauhinh/cauhinh3',
            Cauhinh::tt.':'.Cauhinh::cauhinh4 => 'cauhinh/cauhinh4',
            Cauhinh::tt.':'.Cauhinh::cauhinh5 => 'cauhinh/cauhinh5',
            Cauhinh::tt.':'.Cauhinh::cauhinh6 => 'cauhinh/cauhinh6',
            Cauhinh::tt.':'.Cauhinh::cauhinh7 => 'cauhinh/cauhinh7',
            Cauhinh::tt.':'.Cauhinh::cauhinh8 => 'cauhinh/cauhinh8',
            Cauhinh::tt.':'.Cauhinh::cauhinh10 => 'cauhinh/cauhinh10',
            Cauhinh::tt.':'.Cauhinh::moduleclone => 'cauhinh/moduleclone',
        ];
    }

    const table = 'db_cauhinh';

     //Action
    const cauhinh1 = 'c1';
    const cauhinh2 = 'c2';
    const cauhinh3 = 'c3';
    const cauhinh4 = 'c4';
    const cauhinh5 = 'c5';
    const cauhinh6 = 'c6';
    const cauhinh7 = 'c7';
    const cauhinh8 = 'c8';
    const cauhinh10 = 'o5';
    const moduleclone = 'm7';
    
    const index = 'index';
    const view = 'view';
    const update = 'update';
    const delete = 'delete';
    
    //Controller
    const tt = 'ch';
    const name = 'auhinh_fake';    
    const t = 'c'.self::name;
    const T = 'C'.self::name;
    
    //Model
    const M = 'backend\models\\'. self::T ;
    const S = 'backend\models\\'. self::T .'Search';
   

    //Field
    const ch_id = 'chid';
    const ch_key = 'chkey';
    const ch_data = 'chdata';


    //Template
     const template = 'k3';


    //Chung
     const slogan_top = 'n4';

    ////1
    const module = 'f6';
    const page = 'k4';
   

    //////// 1
    const tencongty = 'k8';
    const diachi = 'g4';
    const dienthoai = 'd7';
    const hotline = 'a8';    
    const fax = 'm6';
    const email = 'l1';

    const favicon = 'c6';
    const thetieude = 'o8';
    const thehauto = 'm8';
    const themota = 'm2';
    const logo = 'c9';
    const ngonngu = 's2';

    //2    
    // const home_slogan = 'b1';
    const home_slogan_2 = 'x6';
    // const home_menu = 'e3';
    const home_slide = 'k9';

    const home_danhmuc = 'q0';
    const home_image_dm = 'z7';
    const home_chuyenmuc = 'd5';


    //4
    // const slogan_top = 'n4';
    const banner = 'j4';
    const menu = 'f1';
    const footer_list = 'o9';
    const searchtop = 'a5';


    //5
    const sp_khuyenmai = 'g2';    
    const sp_chinhsach = 'x2';
    const sp_hotro = 'y8';

    const tientetinhgia = 'g9';

    public static function check_key($key = '')
    {
        $rel = new \ReflectionClass('backend\models\Cauhinh');
        $rel = $rel->getConstants();

        $all_template = self::get(Cauhinh::template);

        $template = preg_split('/[\n]+/', $all_template);

        $module_temp = [];
        $page_temp = [];

        if(is_array($template)) foreach ($template as $k => $v) {
            $v = trim($v);
            $module_temp[] = Cauhinh::module . $v;
            $page_temp[] = Cauhinh::page . $v;
        }

        if(in_array($key,$rel) || in_array($key,$page_temp) || in_array($key,$module_temp)){
            return true;
        }else{
            return false;
        }        
    }


    public static function template()
    {       
        // $all_template = Tuyen::_dulieu('cauhinh', Cauhinh::template);
        // if(empty($all_template))
        $all_template = self::get(Cauhinh::template);
            
        $template = preg_split('/[\n]+/', $all_template);
        if(is_array($template)) foreach ($template as $k => $v) {
            $v = trim($v);
            if(!empty($v)) return $v;
        }
        return '';
    }


    public static function get($key = '')
    {      
        $data = (Cauhinh::M)::find()
                      ->select(['ch_data'])
                      ->andWhere(['ch_key' => $key])
                      ->one();  
        if($data) return $data[Cauhinh::ch_data];
        return '';
    }

    public static function cache($model)
    {
        $cache = Aabc::$app->dulieu;        
        $cache_data = $model['ch_data']; 
        $cache->set('cauhinh'.$model['ch_key'],$cache_data); 
        return $cache_data; 
    }



    public static function IconOptions(){
         $data = [
            "" => "--- Chọn ---",
            "fab fa-accessible-icon" => "Accessible Icon",
            "fab fa-accusoft" => "Accusoft",
            "fas fa-address-book" => "Address Book",
            "fas fa-address-card" => "Address Card",
            "fas fa-adjust" => "Adjust",
            "fab fa-adn" => "Adn",
            "fab fa-adversal" => "Adversal",
            "fab fa-affiliatetheme" => "Affiliatetheme",
            "fab fa-algolia" => "Algolia",
            "fas fa-align-center" => "Align Center",
            "fas fa-align-justify" => "Align Justify",
            "fas fa-align-left" => "Align Left",
            "fas fa-align-right" => "Align Right",
            "fas fa-allergies" => "Allergies",
            "fab fa-amazon" => "Amazon",
            "fab fa-amazon-pay" => "Amazon Pay",
            "fas fa-ambulance" => "Ambulance",
            "fas fa-american-sign-language-interpreting" => "American Sign Language Interpreting",
            "fab fa-amilia" => "Amilia",
            "fas fa-anchor" => "Anchor",
            "fab fa-android" => "Android",
            "fab fa-angellist" => "Angellist",
            "fas fa-angle-double-down" => "Angle Double Down",
            "fas fa-angle-double-left" => "Angle Double Left",
            "fas fa-angle-double-right" => "Angle Double Right",
            "fas fa-angle-double-up" => "Angle Double Up",
            "fas fa-angle-down" => "Angle Down",
            "fas fa-angle-left" => "Angle Left",
            "fas fa-angle-right" => "Angle Right",
            "fas fa-angle-up" => "Angle Up",
            "fab fa-angrycreative" => "Angrycreative",
            "fab fa-angular" => "Angular",
            "fab fa-apper" => "Apper",
            "fab fa-apple" => "Apple",
            "fab fa-apple-pay" => "Apple Pay",
            "fab fa-app-store" => "App Store",
            "fab fa-app-store-ios" => "App Store Ios",
            "fas fa-archive" => "Archive",
            "fas fa-arrow-alt-circle-down" => "Arrow Alt Circle Down",
            "fas fa-arrow-alt-circle-left" => "Arrow Alt Circle Left",
            "fas fa-arrow-alt-circle-right" => "Arrow Alt Circle Right",
            "fas fa-arrow-alt-circle-up" => "Arrow Alt Circle Up",
            "fas fa-arrow-circle-down" => "Arrow Circle Down",
            "fas fa-arrow-circle-left" => "Arrow Circle Left",
            "fas fa-arrow-circle-right" => "Arrow Circle Right",
            "fas fa-arrow-circle-up" => "Arrow Circle Up",
            "fas fa-arrow-down" => "Arrow Down",
            "fas fa-arrow-left" => "Arrow Left",
            "fas fa-arrow-right" => "Arrow Right",
            "fas fa-arrows-alt" => "Arrows Alt",
            "fas fa-arrows-alt-h" => "Arrows Alt H",
            "fas fa-arrows-alt-v" => "Arrows Alt V",
            "fas fa-arrow-up" => "Arrow Up",
            "fas fa-assistive-listening-systems" => "Assistive Listening Systems",
            "fas fa-asterisk" => "Asterisk",
            "fab fa-asymmetrik" => "Asymmetrik",
            "fas fa-at" => "At",
            "fab fa-audible" => "Audible",
            "fas fa-audio-description" => "Audio Description",
            "fab fa-autoprefixer" => "Autoprefixer",
            "fab fa-avianex" => "Avianex",
            "fab fa-aviato" => "Aviato",
            "fab fa-aws" => "Aws",                        
            "fas fa-backward" => "Backward",
            "fas fa-balance-scale" => "Balance Scale",
            "fas fa-ban" => "Ban",
            "fas fa-band-aid" => "Band Aid",
            "fab fa-bandcamp" => "Bandcamp",
            "fas fa-barcode" => "Barcode",
            "fas fa-bars" => "Bars",
            "fas fa-baseball-ball" => "Baseball Ball",
            "fas fa-basketball-ball" => "Basketball Ball",
            "fas fa-bath" => "Bath",
            "fas fa-battery-empty" => "Battery Empty",
            "fas fa-battery-full" => "Battery Full",
            "fas fa-battery-half" => "Battery Half",
            "fas fa-battery-quarter" => "Battery Quarter",
            "fas fa-battery-three-quarters" => "Battery Three Quarters",
            "fas fa-bed" => "Bed",
            "fas fa-beer" => "Beer",
            "fab fa-behance" => "Behance",
            "fab fa-behance-square" => "Behance Square",
            "fas fa-bell" => "Bell",
            "fas fa-bell-slash" => "Bell Slash",
            "fas fa-bicycle" => "Bicycle",
            "fab fa-bimobject" => "Bimobject",
            "fas fa-binoculars" => "Binoculars",
            "fas fa-birthday-cake" => "Birthday Cake",
            "fab fa-bitbucket" => "Bitbucket",
            "fab fa-bitcoin" => "Bitcoin",
            "fab fa-bity" => "Bity",
            "fab fa-blackberry" => "Blackberry",
            "fab fa-black-tie" => "Black Tie",
            "fas fa-blender" => "Blender",
            "fas fa-blind" => "Blind",
            "fab fa-blogger" => "Blogger",
            "fab fa-blogger-b" => "Blogger B",
            "fab fa-bluetooth" => "Bluetooth",
            "fab fa-bluetooth-b" => "Bluetooth B",
            "fas fa-bold" => "Bold",
            "fas fa-bolt" => "Bolt",
            "fas fa-bomb" => "Bomb",
            "fas fa-book" => "Book",
            "fas fa-bookmark" => "Bookmark",
            "fas fa-book-open" => "Book Open",            
            "fas fa-bowling-ball" => "Bowling Ball",
            "fas fa-box" => "Box",
            "fas fa-boxes" => "Boxes",
            "fas fa-box-open" => "Box Open",
            "fas fa-braille" => "Braille",
            "fas fa-briefcase" => "Briefcase",
            "fas fa-briefcase-medical" => "Briefcase Medical",
            "fas fa-broadcast-tower" => "Broadcast Tower",
            "fas fa-broom" => "Broom",
            "fab fa-btc" => "Btc",
            "fas fa-bug" => "Bug",
            "fas fa-building" => "Building",
            "fas fa-bullhorn" => "Bullhorn",
            "fas fa-bullseye" => "Bullseye",
            "fas fa-burn" => "Burn",
            "fab fa-buromobelexperte" => "Buromobelexperte",
            "fas fa-bus" => "Bus",
            "fab fa-buysellads" => "Buysellads",
            "fas fa-calculator" => "Calculator",
            "fas fa-calendar" => "Calendar",
            "fas fa-calendar-alt" => "Calendar Alt",
            "fas fa-calendar-check" => "Calendar Check",
            "fas fa-calendar-minus" => "Calendar Minus",
            "fas fa-calendar-plus" => "Calendar Plus",
            "fas fa-calendar-times" => "Calendar Times",
            "fas fa-camera" => "Camera",
            "fas fa-camera-retro" => "Camera Retro",
            "fas fa-capsules" => "Capsules",
            "fas fa-car" => "Car",
            "fas fa-caret-down" => "Caret Down",
            "fas fa-caret-left" => "Caret Left",
            "fas fa-caret-right" => "Caret Right",
            "fas fa-caret-square-down" => "Caret Square Down",
            "fas fa-caret-square-left" => "Caret Square Left",
            "fas fa-caret-square-right" => "Caret Square Right",
            "fas fa-caret-square-up" => "Caret Square Up",
            "fas fa-caret-up" => "Caret Up",
            "fas fa-cart-arrow-down" => "Cart Arrow Down",
            "fas fa-cart-plus" => "Cart Plus",
            "fab fa-cc-amazon-pay" => "Cc Amazon Pay",
            "fab fa-cc-amex" => "Cc Amex",
            "fab fa-cc-apple-pay" => "Cc Apple Pay",
            "fab fa-cc-diners-club" => "Cc Diners Club",
            "fab fa-cc-discover" => "Cc Discover",
            "fab fa-cc-jcb" => "Cc Jcb",
            "fab fa-cc-mastercard" => "Cc Mastercard",
            "fab fa-cc-paypal" => "Cc Paypal",
            "fab fa-cc-stripe" => "Cc Stripe",
            "fab fa-cc-visa" => "Cc Visa",
            "fab fa-centercode" => "Centercode",
            "fas fa-certificate" => "Certificate",
            "fas fa-chalkboard" => "Chalkboard",
            "fas fa-chalkboard-teacher" => "Chalkboard Teacher",
            "fas fa-chart-area" => "Chart Area",
            "fas fa-chart-bar" => "Chart Bar",
            "fas fa-chart-line" => "Chart Line",
            "fas fa-chart-pie" => "Chart Pie",
            "fas fa-check" => "Check",
            "fas fa-check-circle" => "Check Circle",
            "fas fa-check-square" => "Check Square",
            "fas fa-chess" => "Chess",
            "fas fa-chess-bishop" => "Chess Bishop",
            "fas fa-chess-board" => "Chess Board",
            "fas fa-chess-king" => "Chess King",
            "fas fa-chess-knight" => "Chess Knight",
            "fas fa-chess-pawn" => "Chess Pawn",
            "fas fa-chess-queen" => "Chess Queen",
            "fas fa-chess-rook" => "Chess Rook",
            "fas fa-chevron-circle-down" => "Chevron Circle Down",
            "fas fa-chevron-circle-left" => "Chevron Circle Left",
            "fas fa-chevron-circle-right" => "Chevron Circle Right",
            "fas fa-chevron-circle-up" => "Chevron Circle Up",
            "fas fa-chevron-down" => "Chevron Down",
            "fas fa-chevron-left" => "Chevron Left",
            "fas fa-chevron-right" => "Chevron Right",
            "fas fa-chevron-up" => "Chevron Up",
            "fas fa-child" => "Child",
            "fab fa-chrome" => "Chrome",
            "fas fa-church" => "Church",
            "fas fa-circle" => "Circle",
            "fas fa-circle-notch" => "Circle Notch",
            "fas fa-clipboard" => "Clipboard",
            "fas fa-clipboard-check" => "Clipboard Check",
            "fas fa-clipboard-list" => "Clipboard List",
            "fas fa-clock" => "Clock",
            "fas fa-clone" => "Clone",
            "fas fa-closed-captioning" => "Closed Captioning",
            "fas fa-cloud" => "Cloud",
            "fas fa-cloud-download-alt" => "Cloud Download Alt",
            "fab fa-cloudscale" => "Cloudscale",
            "fab fa-cloudsmith" => "Cloudsmith",
            "fas fa-cloud-upload-alt" => "Cloud Upload Alt",
            "fab fa-cloudversify" => "Cloudversify",
            "fas fa-code" => "Code",
            "fas fa-code-branch" => "Code Branch",
            "fab fa-codepen" => "Codepen",
            "fab fa-codiepie" => "Codiepie",
            "fas fa-coffee" => "Coffee",
            "fas fa-cog" => "Cog",
            "fas fa-cogs" => "Cogs",
            "fas fa-coins" => "Coins",
            "fas fa-columns" => "Columns",
            "fas fa-comment" => "Comment",
            "fas fa-comment-alt" => "Comment Alt",
            "fas fa-comment-dots" => "Comment Dots",
            "fas fa-comments" => "Comments",
            "fas fa-comment-slash" => "Comment Slash",
            "fas fa-compact-disc" => "Compact Disc",
            "fas fa-compass" => "Compass",
            "fas fa-compress" => "Compress",
            "fab fa-connectdevelop" => "Connectdevelop",
            "fab fa-contao" => "Contao",
            "fas fa-copy" => "Copy",
            "fas fa-copyright" => "Copyright",
            "fas fa-couch" => "Couch",
            "fab fa-cpanel" => "Cpanel",
            "fab fa-creative-commons" => "Creative Commons",
            "fab fa-creative-commons-by" => "Creative Commons By",
            "fab fa-creative-commons-nc" => "Creative Commons Nc",
            "fab fa-creative-commons-nc-eu" => "Creative Commons Nc Eu",
            "fab fa-creative-commons-nc-jp" => "Creative Commons Nc Jp",
            "fab fa-creative-commons-nd" => "Creative Commons Nd",
            "fab fa-creative-commons-pd" => "Creative Commons Pd",
            "fab fa-creative-commons-pd-alt" => "Creative Commons Pd Alt",
            "fab fa-creative-commons-remix" => "Creative Commons Remix",
            "fab fa-creative-commons-sa" => "Creative Commons Sa",
            "fab fa-creative-commons-sampling" => "Creative Commons Sampling",
            "fab fa-creative-commons-sampling-plus" => "Creative Commons Sampling Plus",
            "fab fa-creative-commons-share" => "Creative Commons Share",
            "fas fa-credit-card" => "Credit Card",
            "fas fa-crop" => "Crop",
            "fas fa-crosshairs" => "Crosshairs",
            "fas fa-crow" => "Crow",
            "fas fa-crown" => "Crown",
            "fab fa-css3" => "Css3",
            "fab fa-css3-alt" => "Css3 Alt",
            "fas fa-cube" => "Cube",
            "fas fa-cubes" => "Cubes",
            "fas fa-cut" => "Cut",
            "fab fa-cuttlefish" => "Cuttlefish",
            "fab fa-d-and-d" => "D And D",
            "fab fa-dashcube" => "Dashcube",
            "fas fa-database" => "Database",
            "fas fa-deaf" => "Deaf",
            "fab fa-delicious" => "Delicious",
            "fab fa-deploydog" => "Deploydog",
            "fab fa-deskpro" => "Deskpro",
            "fas fa-desktop" => "Desktop",
            "fab fa-deviantart" => "Deviantart",
            "fas fa-diagnoses" => "Diagnoses",
            "fas fa-dice" => "Dice",
            "fas fa-dice-five" => "Dice Five",
            "fas fa-dice-four" => "Dice Four",
            "fas fa-dice-one" => "Dice One",
            "fas fa-dice-six" => "Dice Six",
            "fas fa-dice-three" => "Dice Three",
            "fas fa-dice-two" => "Dice Two",
            "fab fa-digg" => "Digg",
            "fab fa-digital-ocean" => "Digital Ocean",
            "fab fa-discord" => "Discord",
            "fab fa-discourse" => "Discourse",
            "fas fa-divide" => "Divide",
            "fas fa-dna" => "Dna",
            "fab fa-dochub" => "Dochub",
            "fab fa-docker" => "Docker",
            "fas fa-dollar-sign" => "Dollar Sign",
            "fas fa-dolly" => "Dolly",
            "fas fa-dolly-flatbed" => "Dolly Flatbed",
            "fas fa-donate" => "Donate",
            "fas fa-door-closed" => "Door Closed",
            "fas fa-door-open" => "Door Open",
            "fas fa-dot-circle" => "Dot Circle",
            "fas fa-dove" => "Dove",
            "fas fa-download" => "Download",
            "fab fa-draft2digital" => "Draft2Digital",
            "fab fa-dribbble" => "Dribbble",
            "fab fa-dribbble-square" => "Dribbble Square",
            "fab fa-dropbox" => "Dropbox",
            "fab fa-drupal" => "Drupal",
            "fas fa-dumbbell" => "Dumbbell",
            "fab fa-dyalog" => "Dyalog",
            "fab fa-earlybirds" => "Earlybirds",
            "fab fa-ebay" => "Ebay",
            "fab fa-edge" => "Edge",
            "fas fa-edit" => "Edit",
            "fas fa-eject" => "Eject",
            "fab fa-elementor" => "Elementor",
            "fas fa-ellipsis-h" => "Ellipsis H",
            "fas fa-ellipsis-v" => "Ellipsis V",
            "fab fa-ember" => "Ember",
            "fab fa-empire" => "Empire",
            "fas fa-envelope" => "Envelope",
            "fas fa-envelope-open" => "Envelope Open",
            "fas fa-envelope-square" => "Envelope Square",
            "fab fa-envira" => "Envira",
            "fas fa-equals" => "Equals",
            "fas fa-eraser" => "Eraser",
            "fab fa-erlang" => "Erlang",
            "fab fa-ethereum" => "Ethereum",
            "fab fa-etsy" => "Etsy",
            "fas fa-euro-sign" => "Euro Sign",
            "fas fa-exchange-alt" => "Exchange Alt",
            "fas fa-exclamation" => "Exclamation",
            "fas fa-exclamation-circle" => "Exclamation Circle",
            "fas fa-exclamation-triangle" => "Exclamation Triangle",
            "fas fa-expand" => "Expand",
            "fas fa-expand-arrows-alt" => "Expand Arrows Alt",
            "fab fa-expeditedssl" => "Expeditedssl",
            "fas fa-external-link-alt" => "External Link Alt",
            "fas fa-external-link-square-alt" => "External Link Square Alt",
            "fas fa-eye" => "Eye",
            "fas fa-eye-dropper" => "Eye Dropper",
            "fas fa-eye-slash" => "Eye Slash",
            "fab fa-facebook" => "Facebook",
            "fab fa-facebook-f" => "Facebook F",
            "fab fa-facebook-messenger" => "Facebook Messenger",
            "fab fa-facebook-square" => "Facebook Square",
            "fas fa-fast-backward" => "Fast Backward",
            "fas fa-fast-forward" => "Fast Forward",
            "fas fa-fax" => "Fax",
            "fas fa-feather" => "Feather",
            "fas fa-female" => "Female",
            "fas fa-fighter-jet" => "Fighter Jet",
            "fas fa-file" => "File",
            "fas fa-file-alt" => "File Alt",
            "fas fa-file-archive" => "File Archive",
            "fas fa-file-audio" => "File Audio",
            "fas fa-file-code" => "File Code",
            "fas fa-file-excel" => "File Excel",
            "fas fa-file-image" => "File Image",
            "fas fa-file-medical" => "File Medical",
            "fas fa-file-medical-alt" => "File Medical Alt",
            "fas fa-file-pdf" => "File Pdf",
            "fas fa-file-powerpoint" => "File Powerpoint",
            "fas fa-file-video" => "File Video",
            "fas fa-file-word" => "File Word",
            "fas fa-film" => "Film",
            "fas fa-filter" => "Filter",
            "fas fa-fire" => "Fire",
            "fas fa-fire-extinguisher" => "Fire Extinguisher",
            "fab fa-firefox" => "Firefox",
            "fas fa-first-aid" => "First Aid",
            "fab fa-firstdraft" => "Firstdraft",
            "fab fa-first-order" => "First Order",
            "fab fa-first-order-alt" => "First Order Alt",
            "fas fa-flag" => "Flag",
            "fas fa-flag-checkered" => "Flag Checkered",
            "fas fa-flask" => "Flask",
            "fab fa-flickr" => "Flickr",
            "fab fa-flipboard" => "Flipboard",            
            "fab fa-fly" => "Fly",
            "fas fa-folder" => "Folder",
            "fas fa-folder-open" => "Folder Open",
            "fas fa-font" => "Font",
            "fab fa-font-awesome" => "Font Awesome",
            "fab fa-font-awesome-alt" => "Font Awesome Alt",
            "fab fa-font-awesome-flag" => "Font Awesome Flag",            
            "fab fa-fonticons" => "Fonticons",
            "fab fa-fonticons-fi" => "Fonticons Fi",
            "fas fa-football-ball" => "Football Ball",
            "fab fa-fort-awesome" => "Fort Awesome",
            "fab fa-fort-awesome-alt" => "Fort Awesome Alt",
            "fab fa-forumbee" => "Forumbee",
            "fas fa-forward" => "Forward",
            "fab fa-foursquare" => "Foursquare",
            "fab fa-freebsd" => "Freebsd",
            "fab fa-free-code-camp" => "Free Code Camp",
            "fas fa-frog" => "Frog",
            "fas fa-frown" => "Frown",
            "fab fa-fulcrum" => "Fulcrum",
            "fas fa-futbol" => "Futbol",            
            "fab fa-galactic-republic" => "Galactic Republic",
            "fab fa-galactic-senate" => "Galactic Senate",
            "fas fa-gamepad" => "Gamepad",
            "fas fa-gas-pump" => "Gas Pump",
            "fas fa-gavel" => "Gavel",
            "fas fa-gem" => "Gem",
            "fas fa-genderless" => "Genderless",
            "fab fa-get-pocket" => "Get Pocket",
            "fab fa-gg" => "Gg",
            "fab fa-gg-circle" => "Gg Circle",
            "fas fa-gift" => "Gift",
            "fab fa-git" => "Git",
            "fab fa-github" => "Github",
            "fab fa-github-alt" => "Github Alt",
            "fab fa-github-square" => "Github Square",
            "fab fa-gitkraken" => "Gitkraken",
            "fab fa-gitlab" => "Gitlab",
            "fab fa-git-square" => "Git Square",
            "fab fa-gitter" => "Gitter",
            "fas fa-glasses" => "Glasses",
            "fas fa-glass-martini" => "Glass Martini",
            "fab fa-glide" => "Glide",
            "fab fa-glide-g" => "Glide G",
            "fas fa-globe" => "Globe",
            "fab fa-gofore" => "Gofore",
            "fas fa-golf-ball" => "Golf Ball",
            "fab fa-goodreads" => "Goodreads",
            "fab fa-goodreads-g" => "Goodreads G",
            "fab fa-google" => "Google",
            "fab fa-google-drive" => "Google Drive",
            "fab fa-google-play" => "Google Play",
            "fab fa-google-plus" => "Google Plus",
            "fab fa-google-plus-g" => "Google Plus G",
            "fab fa-google-plus-square" => "Google Plus Square",
            "fab fa-google-wallet" => "Google Wallet",
            "fas fa-graduation-cap" => "Graduation Cap",
            "fab fa-gratipay" => "Gratipay",
            "fab fa-grav" => "Grav",
            "fas fa-greater-than" => "Greater Than",
            "fas fa-greater-than-equal" => "Greater Than Equal",
            "fab fa-gripfire" => "Gripfire",
            "fab fa-grunt" => "Grunt",
            "fab fa-gulp" => "Gulp",
            "fab fa-hacker-news" => "Hacker News",
            "fab fa-hacker-news-square" => "Hacker News Square",
            "fas fa-hand-holding" => "Hand Holding",
            "fas fa-hand-holding-heart" => "Hand Holding Heart",
            "fas fa-hand-holding-usd" => "Hand Holding Usd",
            "fas fa-hand-lizard" => "Hand Lizard",
            "fas fa-hand-paper" => "Hand Paper",
            "fas fa-hand-peace" => "Hand Peace",
            "fas fa-hand-point-down" => "Hand Point Down",
            "fas fa-hand-pointer" => "Hand Pointer",
            "fas fa-hand-point-left" => "Hand Point Left",
            "fas fa-hand-point-right" => "Hand Point Right",
            "fas fa-hand-point-up" => "Hand Point Up",
            "fas fa-hand-rock" => "Hand Rock",
            "fas fa-hands" => "Hands",
            "fas fa-hand-scissors" => "Hand Scissors",
            "fas fa-handshake" => "Handshake",
            "fas fa-hands-helping" => "Hands Helping",
            "fas fa-hand-spock" => "Hand Spock",
            "fas fa-hashtag" => "Hashtag",
            "fas fa-hdd" => "Hdd",
            "fas fa-heading" => "Heading",
            "fas fa-headphones" => "Headphones",
            "fas fa-heart" => "Heart",
            "fas fa-heartbeat" => "Heartbeat",
            "fas fa-helicopter" => "Helicopter",
            "fab fa-hips" => "Hips",
            "fab fa-hire-a-helper" => "Hire A Helper",
            "fas fa-history" => "History",
            "fas fa-hockey-puck" => "Hockey Puck",
            "fas fa-home" => "Home",
            "fab fa-hooli" => "Hooli",
            "fas fa-hospital" => "Hospital",
            "fas fa-hospital-alt" => "Hospital Alt",
            "fas fa-hospital-symbol" => "Hospital Symbol",
            "fab fa-hotjar" => "Hotjar",
            "fas fa-hourglass" => "Hourglass",
            "fas fa-hourglass-end" => "Hourglass End",
            "fas fa-hourglass-half" => "Hourglass Half",
            "fas fa-hourglass-start" => "Hourglass Start",
            "fab fa-houzz" => "Houzz",
            "fas fa-h-square" => "H Square",
            "fab fa-html5" => "Html5",
            "fab fa-hubspot" => "Hubspot",
            "fas fa-i-cursor" => "I Cursor",
            "fas fa-id-badge" => "Id Badge",
            "fas fa-id-card" => "Id Card",
            "fas fa-id-card-alt" => "Id Card Alt",
            "fas fa-image" => "Image",
            "fas fa-images" => "Images",
            "fab fa-imdb" => "Imdb",
            "fas fa-inbox" => "Inbox",
            "fas fa-indent" => "Indent",
            "fas fa-industry" => "Industry",
            "fas fa-infinity" => "Infinity",
            "fas fa-info" => "Info",
            "fas fa-info-circle" => "Info Circle",
            "fab fa-instagram" => "Instagram",
            "fab fa-internet-explorer" => "Internet Explorer",
            "fas fa-inverse" => "Inverse",
            "fab fa-ioxhost" => "Ioxhost",
            "fas fa-italic" => "Italic",
            "fab fa-itunes" => "Itunes",
            "fab fa-itunes-note" => "Itunes Note",
            "fab fa-java" => "Java",
            "fab fa-jedi-order" => "Jedi Order",
            "fab fa-jenkins" => "Jenkins",
            "fab fa-joget" => "Joget",
            "fab fa-joomla" => "Joomla",
            "fab fa-js" => "Js",
            "fab fa-jsfiddle" => "Jsfiddle",
            "fab fa-js-square" => "Js Square",
            "fas fa-key" => "Key",
            "fab fa-keybase" => "Keybase",
            "fas fa-keyboard" => "Keyboard",
            "fab fa-keycdn" => "Keycdn",
            "fab fa-kickstarter" => "Kickstarter",
            "fab fa-kickstarter-k" => "Kickstarter K",
            "fas fa-kiwi-bird" => "Kiwi Bird",
            "fab fa-korvue" => "Korvue",            
            "fas fa-language" => "Language",
            "fas fa-laptop" => "Laptop",
            "fab fa-laravel" => "Laravel",
            "fab fa-lastfm" => "Lastfm",
            "fab fa-lastfm-square" => "Lastfm Square",
            "fas fa-leaf" => "Leaf",
            "fab fa-leanpub" => "Leanpub",
            "fas fa-lemon" => "Lemon",
            "fab fa-less" => "Less",
            "fas fa-less-than" => "Less Than",
            "fas fa-less-than-equal" => "Less Than Equal",
            "fas fa-level-down-alt" => "Level Down Alt",
            "fas fa-level-up-alt" => "Level Up Alt",            
            "fas fa-life-ring" => "Life Ring",
            "fas fa-lightbulb" => "Lightbulb",
            "fab fa-line" => "Line",
            "fas fa-link" => "Link",
            "fab fa-linkedin" => "Linkedin",
            "fab fa-linkedin-in" => "Linkedin In",
            "fab fa-linode" => "Linode",
            "fab fa-linux" => "Linux",
            "fas fa-lira-sign" => "Lira Sign",
            "fas fa-list" => "List",
            "fas fa-list-alt" => "List Alt",
            "fas fa-list-ol" => "List Ol",
            "fas fa-list-ul" => "List Ul",
            "fas fa-location-arrow" => "Location Arrow",
            "fas fa-lock" => "Lock",
            "fas fa-lock-open" => "Lock Open",
            "fas fa-long-arrow-alt-down" => "Long Arrow Alt Down",
            "fas fa-long-arrow-alt-left" => "Long Arrow Alt Left",
            "fas fa-long-arrow-alt-right" => "Long Arrow Alt Right",
            "fas fa-long-arrow-alt-up" => "Long Arrow Alt Up",
            "fas fa-low-vision" => "Low Vision",
            "fab fa-lyft" => "Lyft",
            "fab fa-magento" => "Magento",
            "fas fa-magic" => "Magic",
            "fas fa-magnet" => "Magnet",
            "fas fa-male" => "Male",
            "fab fa-mandalorian" => "Mandalorian",
            "fas fa-map" => "Map",
            "fas fa-map-marker" => "Map Marker",
            "fas fa-map-marker-alt" => "Map Marker Alt",
            "fas fa-map-pin" => "Map Pin",
            "fas fa-map-signs" => "Map Signs",
            "fas fa-mars" => "Mars",
            "fas fa-mars-double" => "Mars Double",
            "fas fa-mars-stroke" => "Mars Stroke",
            "fas fa-mars-stroke-h" => "Mars Stroke H",
            "fas fa-mars-stroke-v" => "Mars Stroke V",
            "fab fa-mastodon" => "Mastodon",
            "fab fa-maxcdn" => "Maxcdn",
            "fab fa-medapps" => "Medapps",
            "fab fa-medium" => "Medium",
            "fab fa-medium-m" => "Medium M",
            "fas fa-medkit" => "Medkit",
            "fab fa-medrt" => "Medrt",
            "fab fa-meetup" => "Meetup",
            "fas fa-meh" => "Meh",
            "fas fa-memory" => "Memory",
            "fas fa-mercury" => "Mercury",
            "fas fa-microchip" => "Microchip",
            "fas fa-microphone" => "Microphone",
            "fas fa-microphone-alt" => "Microphone Alt",
            "fas fa-microphone-alt-slash" => "Microphone Alt Slash",
            "fas fa-microphone-slash" => "Microphone Slash",
            "fab fa-microsoft" => "Microsoft",
            "fas fa-minus" => "Minus",
            "fas fa-minus-circle" => "Minus Circle",
            "fas fa-minus-square" => "Minus Square",
            "fab fa-mix" => "Mix",
            "fab fa-mixcloud" => "Mixcloud",
            "fab fa-mizuni" => "Mizuni",
            "fas fa-mobile" => "Mobile",
            "fas fa-mobile-alt" => "Mobile Alt",
            "fab fa-modx" => "Modx",
            "fab fa-monero" => "Monero",
            "fas fa-money-bill" => "Money Bill",
            "fas fa-money-bill-alt" => "Money Bill Alt",
            "fas fa-money-bill-wave" => "Money Bill Wave",
            "fas fa-money-bill-wave-alt" => "Money Bill Wave Alt",
            "fas fa-money-check" => "Money Check",
            "fas fa-money-check-alt" => "Money Check Alt",
            "fas fa-moon" => "Moon",
            "fas fa-motorcycle" => "Motorcycle",
            "fas fa-mouse-pointer" => "Mouse Pointer",
            "fas fa-music" => "Music",
            "fab fa-napster" => "Napster",
            "fas fa-neuter" => "Neuter",
            "fas fa-newspaper" => "Newspaper",
            "fab fa-nintendo-switch" => "Nintendo Switch",
            "fab fa-node" => "Node",
            "fab fa-node-js" => "Node Js",
            "fas fa-not-equal" => "Not Equal",
            "fas fa-notes-medical" => "Notes Medical",
            "fab fa-npm" => "Npm",
            "fab fa-ns8" => "Ns8",
            "fab fa-nutritionix" => "Nutritionix",
            "fas fa-object-group" => "Object Group",
            "fas fa-object-ungroup" => "Object Ungroup",
            "fab fa-odnoklassniki" => "Odnoklassniki",
            "fab fa-odnoklassniki-square" => "Odnoklassniki Square",
            "fab fa-old-republic" => "Old Republic",
            "fab fa-opencart" => "Opencart",
            "fab fa-openid" => "Openid",
            "fab fa-opera" => "Opera",
            "fab fa-optin-monster" => "Optin Monster",
            "fab fa-osi" => "Osi",
            "fas fa-outdent" => "Outdent",
            "fab fa-page4" => "Page4",
            "fab fa-pagelines" => "Pagelines",
            "fas fa-paint-brush" => "Paint Brush",
            "fas fa-palette" => "Palette",
            "fab fa-palfed" => "Palfed",
            "fas fa-pallet" => "Pallet",
            "fas fa-paperclip" => "Paperclip",
            "fas fa-paper-plane" => "Paper Plane",
            "fas fa-parachute-box" => "Parachute Box",
            "fas fa-paragraph" => "Paragraph",
            "fas fa-parking" => "Parking",
            "fas fa-paste" => "Paste",
            "fab fa-patreon" => "Patreon",
            "fas fa-pause" => "Pause",
            "fas fa-pause-circle" => "Pause Circle",
            "fas fa-paw" => "Paw",
            "fab fa-paypal" => "Paypal",
            "fas fa-pencil-alt" => "Pencil Alt",
            "fas fa-pen-square" => "Pen Square",
            "fas fa-people-carry" => "People Carry",
            "fas fa-percent" => "Percent",
            "fas fa-percentage" => "Percentage",
            "fab fa-periscope" => "Periscope",
            "fab fa-phabricator" => "Phabricator",
            "fab fa-phoenix-framework" => "Phoenix Framework",
            "fab fa-phoenix-squadron" => "Phoenix Squadron",
            "fas fa-phone" => "Phone",
            "fas fa-phone-slash" => "Phone Slash",
            "fas fa-phone-square" => "Phone Square",
            "fas fa-phone-volume" => "Phone Volume",
            "fab fa-php" => "Php",
            "fab fa-pied-piper" => "Pied Piper",
            "fab fa-pied-piper-alt" => "Pied Piper Alt",
            "fab fa-pied-piper-hat" => "Pied Piper Hat",
            "fab fa-pied-piper-pp" => "Pied Piper Pp",
            "fas fa-piggy-bank" => "Piggy Bank",
            "fas fa-pills" => "Pills",
            "fab fa-pinterest" => "Pinterest",
            "fab fa-pinterest-p" => "Pinterest P",
            "fab fa-pinterest-square" => "Pinterest Square",
            "fas fa-plane" => "Plane",
            "fas fa-play" => "Play",
            "fas fa-play-circle" => "Play Circle",
            "fab fa-playstation" => "Playstation",
            "fas fa-plug" => "Plug",
            "fas fa-plus" => "Plus",
            "fas fa-plus-circle" => "Plus Circle",
            "fas fa-plus-square" => "Plus Square",
            "fas fa-podcast" => "Podcast",
            "fas fa-poo" => "Poo",
            "fas fa-portrait" => "Portrait",
            "fas fa-pound-sign" => "Pound Sign",
            "fas fa-power-off" => "Power Off",
            "fas fa-prescription-bottle" => "Prescription Bottle",
            "fas fa-prescription-bottle-alt" => "Prescription Bottle Alt",
            "fas fa-print" => "Print",
            "fas fa-procedures" => "Procedures",
            "fab fa-product-hunt" => "Product Hunt",
            "fas fa-project-diagram" => "Project Diagram",            
            // "fas fa-pulse" => "Pulse",
            "fab fa-pushed" => "Pushed",
            "fas fa-puzzle-piece" => "Puzzle Piece",
            "fab fa-python" => "Python",
            "fab fa-qq" => "Qq",
            "fas fa-qrcode" => "Qrcode",
            "fas fa-question" => "Question",
            "fas fa-question-circle" => "Question Circle",
            "fas fa-quidditch" => "Quidditch",
            "fab fa-quinscape" => "Quinscape",
            "fab fa-quora" => "Quora",
            "fas fa-quote-left" => "Quote Left",
            "fas fa-quote-right" => "Quote Right",            
            "fas fa-random" => "Random",
            "fab fa-ravelry" => "Ravelry",
            "fab fa-react" => "React",
            "fab fa-readme" => "Readme",
            "fab fa-rebel" => "Rebel",
            "fas fa-receipt" => "Receipt",
            "fas fa-recycle" => "Recycle",
            "fab fa-reddit" => "Reddit",
            "fab fa-reddit-alien" => "Reddit Alien",
            "fab fa-reddit-square" => "Reddit Square",
            "fas fa-redo" => "Redo",
            "fas fa-redo-alt" => "Redo Alt",
            "fab fa-red-river" => "Red River",
            "fas fa-registered" => "Registered",
            "fab fa-rendact" => "Rendact",
            "fab fa-renren" => "Renren",
            "fas fa-reply" => "Reply",
            "fas fa-reply-all" => "Reply All",
            "fab fa-replyd" => "Replyd",
            "fab fa-researchgate" => "Researchgate",
            "fab fa-resolving" => "Resolving",
            "fas fa-retweet" => "Retweet",
            "fas fa-ribbon" => "Ribbon",
            "fas fa-road" => "Road",
            "fas fa-robot" => "Robot",
            "fas fa-rocket" => "Rocket",
            "fab fa-rocketchat" => "Rocketchat",
            "fab fa-rockrms" => "Rockrms",            
            "fab fa-r-project" => "R Project",
            "fas fa-rss" => "Rss",
            "fas fa-rss-square" => "Rss Square",
            "fas fa-ruble-sign" => "Ruble Sign",
            "fas fa-ruler" => "Ruler",
            "fas fa-ruler-combined" => "Ruler Combined",
            "fas fa-ruler-horizontal" => "Ruler Horizontal",
            "fas fa-ruler-vertical" => "Ruler Vertical",
            "fas fa-rupee-sign" => "Rupee Sign",            
            "fab fa-safari" => "Safari",
            "fab fa-sass" => "Sass",
            "fas fa-save" => "Save",
            "fab fa-schlix" => "Schlix",
            "fas fa-school" => "School",
            "fas fa-screwdriver" => "Screwdriver",
            "fab fa-scribd" => "Scribd",
            "fas fa-search" => "Search",
            "fab fa-searchengin" => "Searchengin",
            "fas fa-search-minus" => "Search Minus",
            "fas fa-search-plus" => "Search Plus",
            "fas fa-seedling" => "Seedling",
            "fab fa-sellcast" => "Sellcast",
            "fab fa-sellsy" => "Sellsy",
            "fas fa-server" => "Server",
            "fab fa-servicestack" => "Servicestack",
            "fas fa-share" => "Share",
            "fas fa-share-alt" => "Share Alt",
            "fas fa-share-alt-square" => "Share Alt Square",
            "fas fa-share-square" => "Share Square",
            "fas fa-shekel-sign" => "Shekel Sign",
            "fas fa-shield-alt" => "Shield Alt",
            "fas fa-ship" => "Ship",
            "fas fa-shipping-fast" => "Shipping Fast",
            "fab fa-shirtsinbulk" => "Shirtsinbulk",
            "fas fa-shoe-prints" => "Shoe Prints",
            "fas fa-shopping-bag" => "Shopping Bag",
            "fas fa-shopping-basket" => "Shopping Basket",
            "fas fa-shopping-cart" => "Shopping Cart",
            "fas fa-shower" => "Shower",
            "fas fa-sign" => "Sign",
            "fas fa-signal" => "Signal",
            "fas fa-sign-in-alt" => "Sign In Alt",
            "fas fa-sign-language" => "Sign Language",
            "fas fa-sign-out-alt" => "Sign Out Alt",
            "fab fa-simplybuilt" => "Simplybuilt",
            "fab fa-sistrix" => "Sistrix",
            "fas fa-sitemap" => "Sitemap",
            "fab fa-sith" => "Sith",
            "fas fa-skull" => "Skull",
            "fab fa-skyatlas" => "Skyatlas",
            "fab fa-skype" => "Skype",
            "fab fa-slack" => "Slack",
            "fab fa-slack-hash" => "Slack Hash",
            "fas fa-sliders-h" => "Sliders H",
            "fab fa-slideshare" => "Slideshare",            
            "fas fa-smile" => "Smile",
            "fas fa-smoking" => "Smoking",
            "fas fa-smoking-ban" => "Smoking Ban",
            "fab fa-snapchat" => "Snapchat",
            "fab fa-snapchat-ghost" => "Snapchat Ghost",
            "fab fa-snapchat-square" => "Snapchat Square",
            "fas fa-snowflake" => "Snowflake",
            "fas fa-sort" => "Sort",
            "fas fa-sort-alpha-down" => "Sort Alpha Down",
            "fas fa-sort-alpha-up" => "Sort Alpha Up",
            "fas fa-sort-amount-down" => "Sort Amount Down",
            "fas fa-sort-amount-up" => "Sort Amount Up",
            "fas fa-sort-down" => "Sort Down",
            "fas fa-sort-numeric-down" => "Sort Numeric Down",
            "fas fa-sort-numeric-up" => "Sort Numeric Up",
            "fas fa-sort-up" => "Sort Up",
            "fab fa-soundcloud" => "Soundcloud",
            "fas fa-space-shuttle" => "Space Shuttle",
            "fab fa-speakap" => "Speakap",
            // "fas fa-spin" => "Spin",
            "fas fa-spinner" => "Spinner",
            "fab fa-spotify" => "Spotify",
            "fas fa-square" => "Square",
            "fas fa-square-full" => "Square Full",           
            "fab fa-stack-exchange" => "Stack Exchange",
            "fab fa-stack-overflow" => "Stack Overflow",
            "fas fa-star" => "Star",
            "fas fa-star-half" => "Star Half",
            "fab fa-staylinked" => "Staylinked",
            "fab fa-steam" => "Steam",
            "fab fa-steam-square" => "Steam Square",
            "fab fa-steam-symbol" => "Steam Symbol",
            "fas fa-step-backward" => "Step Backward",
            "fas fa-step-forward" => "Step Forward",
            "fas fa-stethoscope" => "Stethoscope",
            "fab fa-sticker-mule" => "Sticker Mule",
            "fas fa-sticky-note" => "Sticky Note",
            "fas fa-stop" => "Stop",
            "fas fa-stop-circle" => "Stop Circle",
            "fas fa-stopwatch" => "Stopwatch",
            "fas fa-store" => "Store",
            "fas fa-store-alt" => "Store Alt",
            "fab fa-strava" => "Strava",
            "fas fa-stream" => "Stream",
            "fas fa-street-view" => "Street View",
            "fas fa-strikethrough" => "Strikethrough",
            "fab fa-stripe" => "Stripe",
            "fab fa-stripe-s" => "Stripe S",
            "fas fa-stroopwafel" => "Stroopwafel",
            "fab fa-studiovinari" => "Studiovinari",
            "fab fa-stumbleupon" => "Stumbleupon",
            "fab fa-stumbleupon-circle" => "Stumbleupon Circle",
            "fas fa-subscript" => "Subscript",
            "fas fa-subway" => "Subway",
            "fas fa-suitcase" => "Suitcase",
            "fas fa-sun" => "Sun",
            "fab fa-superpowers" => "Superpowers",
            "fas fa-superscript" => "Superscript",
            "fab fa-supple" => "Supple",
            "fas fa-sync" => "Sync",
            "fas fa-sync-alt" => "Sync Alt",
            "fas fa-syringe" => "Syringe",
            "fas fa-table" => "Table",
            "fas fa-tablet" => "Tablet",
            "fas fa-tablet-alt" => "Tablet Alt",
            "fas fa-table-tennis" => "Table Tennis",
            "fas fa-tablets" => "Tablets",
            "fas fa-tachometer-alt" => "Tachometer Alt",
            "fas fa-tag" => "Tag",
            "fas fa-tags" => "Tags",
            "fas fa-tape" => "Tape",
            "fas fa-tasks" => "Tasks",
            "fas fa-taxi" => "Taxi",
            "fab fa-teamspeak" => "Teamspeak",
            "fab fa-telegram" => "Telegram",
            "fab fa-telegram-plane" => "Telegram Plane",
            "fab fa-tencent-weibo" => "Tencent Weibo",
            "fas fa-terminal" => "Terminal",
            "fas fa-text-height" => "Text Height",
            "fas fa-text-width" => "Text Width",
            "fas fa-th" => "Th",
            "fab fa-themeisle" => "Themeisle",
            "fas fa-thermometer" => "Thermometer",
            "fas fa-thermometer-empty" => "Thermometer Empty",
            "fas fa-thermometer-full" => "Thermometer Full",
            "fas fa-thermometer-half" => "Thermometer Half",
            "fas fa-thermometer-quarter" => "Thermometer Quarter",
            "fas fa-thermometer-three-quarters" => "Thermometer Three Quarters",
            "fas fa-th-large" => "Th Large",
            "fas fa-th-list" => "Th List",
            "fas fa-thumbs-down" => "Thumbs Down",
            "fas fa-thumbs-up" => "Thumbs Up",
            "fas fa-thumbtack" => "Thumbtack",
            "fas fa-ticket-alt" => "Ticket Alt",
            "fas fa-times" => "Times",
            "fas fa-times-circle" => "Times Circle",
            "fas fa-tint" => "Tint",
            "fas fa-toggle-off" => "Toggle Off",
            "fas fa-toggle-on" => "Toggle On",
            "fas fa-toolbox" => "Toolbox",
            "fab fa-trade-federation" => "Trade Federation",
            "fas fa-trademark" => "Trademark",
            "fas fa-train" => "Train",
            "fas fa-transgender" => "Transgender",
            "fas fa-transgender-alt" => "Transgender Alt",
            "fas fa-trash" => "Trash",
            "fas fa-trash-alt" => "Trash Alt",
            "fas fa-tree" => "Tree",
            "fab fa-trello" => "Trello",
            "fab fa-tripadvisor" => "Tripadvisor",
            "fas fa-trophy" => "Trophy",
            "fas fa-truck" => "Truck",
            "fas fa-truck-loading" => "Truck Loading",
            "fas fa-truck-moving" => "Truck Moving",
            "fas fa-tshirt" => "Tshirt",
            "fas fa-tty" => "Tty",
            "fab fa-tumblr" => "Tumblr",
            "fab fa-tumblr-square" => "Tumblr Square",
            "fas fa-tv" => "Tv",
            "fab fa-twitch" => "Twitch",
            "fab fa-twitter" => "Twitter",
            "fab fa-twitter-square" => "Twitter Square",
            "fab fa-typo3" => "Typo3",
            "fab fa-uber" => "Uber",
            "fab fa-uikit" => "Uikit",            
            "fas fa-umbrella" => "Umbrella",
            "fas fa-underline" => "Underline",
            "fas fa-undo" => "Undo",
            "fas fa-undo-alt" => "Undo Alt",
            "fab fa-uniregistry" => "Uniregistry",
            "fas fa-universal-access" => "Universal Access",
            "fas fa-university" => "University",
            "fas fa-unlink" => "Unlink",
            "fas fa-unlock" => "Unlock",
            "fas fa-unlock-alt" => "Unlock Alt",
            "fab fa-untappd" => "Untappd",
            "fas fa-upload" => "Upload",
            "fab fa-usb" => "Usb",
            "fas fa-user" => "User",
            "fas fa-user-alt" => "User Alt",
            "fas fa-user-alt-slash" => "User Alt Slash",
            "fas fa-user-astronaut" => "User Astronaut",
            "fas fa-user-check" => "User Check",
            "fas fa-user-circle" => "User Circle",
            "fas fa-user-clock" => "User Clock",
            "fas fa-user-cog" => "User Cog",
            "fas fa-user-edit" => "User Edit",
            "fas fa-user-friends" => "User Friends",
            "fas fa-user-graduate" => "User Graduate",
            "fas fa-user-lock" => "User Lock",
            "fas fa-user-md" => "User Md",
            "fas fa-user-minus" => "User Minus",
            "fas fa-user-ninja" => "User Ninja",
            "fas fa-user-plus" => "User Plus",
            "fas fa-users" => "Users",
            "fas fa-users-cog" => "Users Cog",
            "fas fa-user-secret" => "User Secret",
            "fas fa-user-shield" => "User Shield",
            "fas fa-user-slash" => "User Slash",
            "fas fa-user-tag" => "User Tag",
            "fas fa-user-tie" => "User Tie",
            "fas fa-user-times" => "User Times",
            "fab fa-ussunnah" => "Ussunnah",
            "fas fa-utensils" => "Utensils",
            "fas fa-utensil-spoon" => "Utensil Spoon",
            "fab fa-vaadin" => "Vaadin",
            "fas fa-venus" => "Venus",
            "fas fa-venus-double" => "Venus Double",
            "fas fa-venus-mars" => "Venus Mars",
            "fab fa-viacoin" => "Viacoin",
            "fab fa-viadeo" => "Viadeo",
            "fab fa-viadeo-square" => "Viadeo Square",
            "fas fa-vial" => "Vial",
            "fas fa-vials" => "Vials",
            "fab fa-viber" => "Viber",
            "fas fa-video" => "Video",
            "fas fa-video-slash" => "Video Slash",
            "fab fa-vimeo" => "Vimeo",
            "fab fa-vimeo-square" => "Vimeo Square",
            "fab fa-vimeo-v" => "Vimeo V",
            "fab fa-vine" => "Vine",
            "fab fa-vk" => "Vk",
            "fab fa-vnv" => "Vnv",
            "fas fa-volleyball-ball" => "Volleyball Ball",
            "fas fa-volume-down" => "Volume Down",
            "fas fa-volume-off" => "Volume Off",
            "fas fa-volume-up" => "Volume Up",
            "fab fa-vuejs" => "Vuejs",
            "fas fa-walking" => "Walking",
            "fas fa-wallet" => "Wallet",
            "fas fa-warehouse" => "Warehouse",
            "fab fa-weibo" => "Weibo",
            "fas fa-weight" => "Weight",
            "fab fa-weixin" => "Weixin",
            "fab fa-whatsapp" => "Whatsapp",
            "fab fa-whatsapp-square" => "Whatsapp Square",
            "fas fa-wheelchair" => "Wheelchair",
            "fab fa-whmcs" => "Whmcs",
            "fas fa-wifi" => "Wifi",
            "fab fa-wikipedia-w" => "Wikipedia W",
            "fas fa-window-close" => "Window Close",
            "fas fa-window-maximize" => "Window Maximize",
            "fas fa-window-minimize" => "Window Minimize",
            "fas fa-window-restore" => "Window Restore",
            "fab fa-windows" => "Windows",
            "fas fa-wine-glass" => "Wine Glass",
            "fab fa-wolf-pack-battalion" => "Wolf Pack Battalion",
            "fas fa-won-sign" => "Won Sign",
            "fab fa-wordpress" => "Wordpress",
            "fab fa-wordpress-simple" => "Wordpress Simple",
            "fab fa-wpbeginner" => "Wpbeginner",
            "fab fa-wpexplorer" => "Wpexplorer",
            "fab fa-wpforms" => "Wpforms",
            "fas fa-wrench" => "Wrench",
            "fab fa-xbox" => "Xbox",
            "fab fa-xing" => "Xing",
            "fab fa-xing-square" => "Xing Square",
            "fas fa-x-ray" => "X Ray",            
            "fab fa-yahoo" => "Yahoo",
            "fab fa-yandex" => "Yandex",
            "fab fa-yandex-international" => "Yandex International",
            "fab fa-y-combinator" => "Y Combinator",
            "fab fa-yelp" => "Yelp",
            "fas fa-yen-sign" => "Yen Sign",
            "fab fa-yoast" => "Yoast",
            "fab fa-youtube" => "Youtube",
            "fab fa-youtube-square" => "Youtube Square",

        ];
        return $data;
    }


   
    public static function UrlOptions(){
         $data = [
            '0' => '--- Chọn link đến ---',
            '1' => 'Trang chủ',
            // '2' => 'Link đến: Trang tĩnh',
            '3' => 'Danh mục sản phẩm',
            '4' => 'Sản phẩm chi tiết',
            '5' => 'Chuyên mục bài viết',
            '6' => 'Bài viết',
            '7' => 'Đường dẫn cụ thể ',
        ];
        return $data;
    }


    public static function UrlHtml($name = '', $id = '', $data = ''){
        $check = '';
        $value = '';
        if(!empty($data)){
            $check = empty($data['s'])?'':$data['s'];
            $value = empty($data['c'])?'':$data['c'];
        }

        $html = '';
        $url_tvbkt = '/ad/'.Sanpham::tt.'/'.Sanpham::search;
        $data = [];
        switch ($check) {
            case 3:
                $sp = (Sanpham::M)::findOne(['sp_id' => $value]);
                if($sp){
                    $data = [
                        $sp->sp_id => $sp->sp_tensp,
                    ];
                }
            case 4:
                $sp = (Sanpham::M)::findOne(['sp_id' => $value]);
                if($sp){
                    $data = [
                        $sp->sp_id => $sp->sp_tensp,
                    ];
                }
                break;
            default:
                $data = [];
                break;
        }

        // echo '<pre>';
        // print_r($data);

      
        $html .= '<div class="sttip '.($check == 3?'':'hide').' '.$id.'" id="'.$id.'-3'.'">'.
                '<i class="sttip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="Chọn một sản phẩm mà bạn muốn trỏ link đến." aria-invalid="false"></i>'.
                Select2::widget([
                    'name' => $name.'[3]',
                    'value' => $value,
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Chọn Danh mục sản phẩm...'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 3, 
                        'ajax' => [
                            'url' => $url_tvbkt,
                            'dataType' => 'json',
                            'method' => 'POST',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],   
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(model) {
                            if(model.img !== ""){
                                return "<img src=\'" + model.img + "\' />"  + " "  +  model.text;
                            }else{
                                return model.text;
                            }
                        }'),
                        'templateSelection' => new JsExpression('function (model) { return model.text; }'),           
                    ],
                ])
            .'</div>' ;


        $html .= '<div class="sttip '.($check == 4?'':'hide').' '.$id.'" id="'.$id.'-4'.'">'.
                '<i class="sttip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="Chọn một sản phẩm mà bạn muốn trỏ link đến." aria-invalid="false"></i>'.
                Select2::widget([
                    'name' => $name.'[4]',
                    'value' => $value,
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Chọn sản phẩm...'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 3, 
                        'ajax' => [
                            'url' => $url_tvbkt,
                            'dataType' => 'json',
                            'method' => 'POST',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],  
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(model) {
                            if(model.img !== ""){
                                return "<img src=\'" + model.img + "\' />"  + " "  +  model.text;
                            }else{
                                return model.text;
                            }
                        }'),
                        'templateSelection' => new JsExpression('function (model) { return model.text; }'),            
                    ],
                ])
            .'</div>' ;



        $html .= '<div class="sttip '.($check == 5?'':'hide').' '.$id.'" id="'.$id.'-5'.'">'.
                '<i class="sttip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="Chọn một sản phẩm mà bạn muốn trỏ link đến." aria-invalid="false"></i>'.
                Select2::widget([
                    'name' => $name.'[5]',
                    'value' => $value,
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Chọn chuyên mục...'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 3, 
                        'ajax' => [
                            'url' => $url_tvbkt,
                            'dataType' => 'json',
                            'method' => 'POST',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],  
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(model) {
                            if(model.img !== ""){
                                return "<img src=\'" + model.img + "\' />"  + " "  +  model.text;
                            }else{
                                return model.text;
                            }
                        }'),
                        'templateSelection' => new JsExpression('function (model) { return model.text; }'),            
                    ],
                ])
            .'</div>' ;


            $html .= '<div class="sttip '.($check == 6?'':'hide').' '.$id.'" id="'.$id.'-6'.'">'.
                '<i class="sttip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="Chọn một sản phẩm mà bạn muốn trỏ link đến." aria-invalid="false"></i>'.
                Select2::widget([
                    'name' => $name.'[6]',
                    'value' => $value,
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Chọn bài viết...'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 3, 
                        'ajax' => [
                            'url' => $url_tvbkt,
                            'dataType' => 'json',
                            'method' => 'POST',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],   
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(model) {
                            if(model.img !== ""){
                                return "<img src=\'" + model.img + "\' /> "  + " "  +  model.text;
                            }else{
                                return model.text;
                            }
                        }'),
                        'templateSelection' => new JsExpression('function (model) { return model.text; }'),           
                    ],
                ])
            .'</div>' ;


             $html .= '<div class="sttip '.($check == 7?'':'hide').' '.$id.'" id="'.$id.'-7'.'">'.
                '<i class="sttip glyphicon glyphicon-info-sign" data-trigger="hover" data-placement="top" data-html="true" data-toggle="tooltip" data-original-title="Chọn một sản phẩm mà bạn muốn trỏ link đến." aria-invalid="false"></i>
                <textarea placeholder="Nhập link cụ thể..." aria-invalid="false" class="tsp form-control" rows="" type="text" name="'.$name.'[7]">'.$value.'</textarea>
            </div>' ;


        $html .= '
                <script type="text/javascript">
                    $("#'.$id.'-pa").change(function(){
                        var value = parseInt($(this).find(".ichecked input").val())
                        $(".'.$id.'").addClass("hide")

                        $(".sttip select").val("").change();
                        

                        if(value > 0){
                            $("#'.$id.'-"+value).removeClass("hide")
                        }                        
                    })
                </script>';

        return '<div>'.$html.'</div>';        
    }

    public static function LabelHtml($name = ''){
        $return = '<textarea placeholder="Nhập nội dung" aria-invalid="false" class="tsp form-control" rows="" type="text" name="'.Cauhinh::T.'['.$name.']"></textarea>';
        return '<div>'.$return.'</div>';
    }

    public static function IconHtml($name = ''){
        $return = '<textarea placeholder="Nhập icon" aria-invalid="false" class="tsp form-control" rows="" type="text" name="'.Cauhinh::T.'['.$name.']"></textarea>';
        return '<div>'.$return.'</div>';
    }

    public static function BackgroundHtml($name = ''){
        $return = '<textarea placeholder="Nhập hình nền" aria-invalid="false" class="tsp form-control" rows="" type="text" name="'.Cauhinh::T.'['.$name.']"></textarea>';
        return '<div>'.$return.'</div>';
    }

    public static function EmailHtml($name = ''){
        $return = '<textarea placeholder="Nhập email" aria-invalid="false" class="tsp form-control" rows="" type="text" name="'.Cauhinh::T.'['.$name.']"></textarea>';
        return '<div>'.$return.'</div>';
    }

     public static function PhoneHtml($name = ''){
        $return = '<textarea placeholder="Nhập số điện thoại" aria-invalid="false" class="tsp form-control" rows="" type="text" name="'.Cauhinh::T.'['.$name.']"></textarea>';
        return '<div>'.$return.'</div>';
    }
    
}
