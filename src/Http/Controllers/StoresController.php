<?php

namespace Bms\Store\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//
use App\Services\Books;
use Bms\Store\Services\Printful;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Bms\Store\Models\Store;
use Bms\Store\Models\printful_transparent_images;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Services\Inventory;
use Bms\Store\Models\StoreUsers;
use Bms\Store\Models\Store_Cart_Payment;
use Bms\Store\Models\Store_User_ResetPassword;
use Bms\Store\Models\Product_List;
use Bms\Store\Models\Product_Link_Images;
use \Stripe\Stripe;
use Stripe\PaymentIntent;

use App\Mail\StoreUserResetPasswordMail;
class StoresController extends Controller
{
    /**
     * stores
     *
     * @return void
     */

    public function stores(){
        $stores = Store::get();
        return view('store::pages.stores',["stores"=>$stores ]);
    }

    public function dashboard_stores(){
        $stores = Store::get();
        $Product_List = Product_List::get();
        //dd( $Product_List );
        return view('store::pages.dashboard_stores',["stores"=>$stores, "Product_List"=>$Product_List ]);
    }

    public function product_editor()
    {
        $stores = Store::get();
        $custom_swag = DB::table('custom_swag')->select('*')
		->where('id_company', Auth::user()->id_company)
		->get()->toArray();
		$items_json = [];
		$group_items_json  = [];
		$categories = [];
		foreach($custom_swag as $allItems){
			array_push($items_json,json_decode($allItems->items_json,true));
			array_push($group_items_json,json_decode($allItems->group_items_json,true));
			array_push($categories,json_decode($allItems->subcategories_id,true));
		}
		$itemstemp = [];
		$itemsgrouptemp = [];
		$categoriesTemp = [];

		foreach($items_json as $item){
			foreach($item as $itemm){
				array_push($itemstemp,$itemm);
			}
		}

		foreach($group_items_json as $groupitem){

			foreach($groupitem as $key => $groupitemm){
				$temp=array(
					$key => $groupitemm,
				);
				array_push($itemsgrouptemp,$temp);
			}
		}

		foreach($categories as $item){
			foreach($item as $itemm){
				array_push($categoriesTemp,$itemm);
			}
		}

        return view('store::pages.product_editor',  [
			'categories_parent'=>'1316483000062685097',
			'items'=>$itemstemp,
			'itemsgroup'=>$itemsgrouptemp,
			'categories'=>$categoriesTemp,
			'category_id'=>'',
            "stores"=>$stores
		]);
    }

    /**
     * create_store
     *
     * @param  mixed $request
     * @return void
     */
    public function create_store(Request $request){
        $store = new Store();
        $already_store_name = Store::where('name', $request->name)->get()->count();
        //dd( $already_store_name );
        if( $already_store_name == 0)
        {
            $store->id_company = Auth::user()->id_company;
            $store->id_category = Auth::user()->id_category;
            $store->user_id = Auth::user()->id;
            $store->name = $request->name;
            $unique_token = time().substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
            $store->token = $unique_token;
            $store->complete_settings = '{"header":{"header_sticky":false,"logo_path":"http://localhost/dashboard/public/assets/img/blinkswaglogo_white.png","header_bg_color":"#212529","cart_icon_color":"#ffffff"},"slider":{"show_sider":true,"caption_color":"#ffffff","caption_bg_color":"#000000","slides":{"0":{"title":"What is Lorem Ipsum","description":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,","image_path":"https://blinkswag.com/img/cms/blinkswag_swag_header.jpg"},"1":{"title":"What is Lorem Ipsum","description":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,","image_path":"https://blinkswag.com/img/cms/branding-stationery-mockup-scene-copy.png"},"2":{"title":"What is Lorem Ipsum","description":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,","image_path":"https://blinkswag.com/img/cms/open-catalog-mockup-template%20(3).png"}}},"banner":{"show_banner":true,"banner_heading":"Responsive left-aligned banner with image","banner_description":"Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.","banner_cta_text":"Swag Here","banner_path":"https://blinkswag.com/img/cms/blinkswag_swagbox_1.png","banner_overlay_path":"https://blinkswag.com/img/cms/1000_F_229391806_oaIIprMsAZjlQ8OgsIA8mxkxdhUFY7nD.jpg","banner_bg_color2":"#CCCCCC","banner_text_color2":"#525f7f","banner_cta_bg_color2":"#0d6efd"},"footer":{"instagram_text":"","snapchat_text":"","twitter_text":"","facebook_text":"","company_name":"Company Name","footer_bg_color2":"#ffffff","footer_icon_color2":"#38393a","footer_text_color2":"#aaaaaa"},"item_ids":{},"item_json_fields":{}}';
            $store->all_items_json = "[]";
            $store->save();
            return redirect::back()->with('success', 'Your store has been successfully created');
        }else{
            return redirect::back()->with('error', 'Store name is already axist.');
        }
    }

    /**
     * deletestore
     *
     * @param  mixed $request
     * @return void
     */
    public function deletestore(Request $request){
        $store = Store::where('id', $request->id)->delete();
        return json_encode(["status"=>"success"]);
    }

    /**
     * editstore
     *
     * @param  mixed $id
     * @return void
     */
    public function editstore($id){
        $inventory = new Inventory('1316483000039731493');
        // $items = $inventory->getItems_ajax();
        // $item_group = $inventory->getItemGroups_ajax();
        $items = $inventory->getItems();
        //dd($items);
        $item_group = $inventory->getItemGroups();

        $printful = new Printful();
//return view('store::pages.viewstore',["store"=>$store, "all_categories_details"=>$all_categories_details,"products"=>$products, "my_editing_products"=>$my_editing_products, "my_editing"=>$my_editing, "googleuser"=>\Session::get('googleuser') ]);

        $store = Store::where("id", $id)->first();
        if($store)
        {
            $all_categories = [];
            $all_categories_details = [];
            $products = [];
            $my_editing_products = [];
            $my_editing = $store['my_editing'];
            if($my_editing!=null)
            {
                $my_editing = json_decode( $store['my_editing'] );
                foreach($my_editing as $key=>$value)
                {
                    $original_products = json_decode( $value->original_products[0] );
                    array_push($products, $original_products);

                    array_push($my_editing_products, $value->my_editing);

                    if(!in_array($original_products->product->main_category_id, $all_categories))
                    {
                        $category = $printful->getCategoryDetailsById( $original_products->product->main_category_id );
                        $all_categories_details[$original_products->product->main_category_id] = $category;
                        //array_push( $all_categories_details, $category );
                        array_push( $all_categories, $original_products->product->main_category_id );
                    }
                }
                //dd( $all_categories_details );
            }
            return view('store::pages.store',["store"=>$store, "all_categories_details"=>$all_categories_details,"products_db"=>$products, "my_editing_products"=>$my_editing_products, "my_editing"=>$my_editing, "items"=>$items, "item_group"=>$item_group ]);
        }else{
            return "No Store Found.";
        }
    }

    /**
     * uploadimage
     *
     * @param  mixed $request
     * @return void
     */
    public function uploadimage(Request $request){
        $file= $request->myimage;
        $filename = time().'.'.$file->extension();
        if (!file_exists( public_path('Image/'.Auth::user()->id_company) )) {
            mkdir( public_path('Image/'.Auth::user()->id_company) , 0777, true);
        }
        $file->move( public_path('Image/'.Auth::user()->id_company) , $filename);
        return json_encode(["status"=>"success", "filename"=>$filename]);
    }
    /**
     * uploadimage_printful
     *
     * @param  mixed $request
     * @return void
     */
    public function uploadimage_printful(Request $request){
        $file= $request->myimage;
        $product_id = $request->product_id;

        $filename = $request->filename.'.'.$file->extension();
        if (!file_exists( public_path('Image/Transparent Images/'.$product_id) )) {
            mkdir( public_path('Image/Transparent Images/'.$product_id) , 0777, true);
        }
        $file->move( public_path('Image/Transparent Images/'.$product_id) , $filename);
        return json_encode(["status"=>"success", "filename"=>$filename]);
    }

    public function save_printful_product(Request $request){
        $printful_transparent_images = new printful_transparent_images();
        $printful_transparent_images['product_id'] = $request->product_id;
        $printful_transparent_images['title'] = $request->title;
        $printful_transparent_images['images_json'] = $request->complete_json;
        $printful_transparent_images->save();
        //dd( json_decode($request->complete_json, true) );
        return ["status"=>'success', "printful_transparent_images"=>$printful_transparent_images];
    }


    /**
     * uploadimage
     *
     * @param  mixed $request
     * @return void
     */
    public function uploadimage_mockup(Request $request){
        $file= $request->myimage;
        $file_name = $request->file_name;
        $product_list_id = $request->product_list_id;
        //dd( $product_list_id );

        $file = str_replace('data:image/png;base64,', '', $file);
        $file = str_replace(' ', '+', $file);
        $fileData = base64_decode($file);
        //saving
        $filename = 'front.png';

        //$filename = time().'.'.$file->extension();
        if (!file_exists( public_path('Image/'.Auth::user()->id_company).'/mockups\/'.$product_list_id )) {
            mkdir( public_path('Image/'.Auth::user()->id_company.'/mockups\/'.$product_list_id) , 0777, true);
        }
        //$file->move( public_path('Image/'.Auth::user()->id_company) , $filename);
        file_put_contents(public_path('Image/'.Auth::user()->id_company.'/mockups\/'.$product_list_id.'/'.$file_name), $fileData);

        return json_encode(["status"=>"success", "filename"=>$file_name]);
    }

    /**
     * deleteuploadimage
     *
     * @param  mixed $request
     * @return void
     */
    public function deleteuploadimage(Request $request){
        $filename = $request->filename;
        unlink( public_path('Image/'.Auth::user()->id_company)."/".$filename);
        return json_encode(["status"=>"success", "filename"=>$filename]);
    }

    /**
     * updatestore
     *
     * @param  mixed $request
     * @return void
     */
    public function updatestore(Request $request){
        $id = $request->store_id;
        $complete_settings = $request->complete_settings;
        $complete_settings_decode = json_decode($complete_settings, true);

        $all_items = [];
        $inventory = new Inventory();
        foreach($complete_settings_decode['item_ids'] as $value)
        {
            $item_array = explode("_", $value);
            if($item_array[1]==0)
            {
                array_push( $all_items, $inventory->getItembyId( $item_array[0] ) );
            }else{
                array_push( $all_items, $inventory->getGroupItemById( $item_array[0] ) );
            }
        }
       // dd($all_items);
        $affectedRows = Store::where("id", $id)->update(["complete_settings" => $complete_settings, "all_items_json"=> json_encode($all_items)]);
        return json_encode(["status"=>"success", "id"=>$id]);
    }

    /**
     * viewstore
     *
     * @param  mixed $storename
     * @return void
     */
    public function viewstore($storename)
    {
        $printful = new Printful();

        $store = Store::where(["name"=>$storename])->get()->first();
        if( $store )
        {
            $all_categories = [];
            $all_categories_details = [];
            $products = [];
            $my_editing_products = [];
            $my_editing = $store['my_editing'];
            if($my_editing!=null)
            {
                $my_editing = json_decode( $store['my_editing'] );
                foreach($my_editing as $key=>$value)
                {
                    $original_products = json_decode( $value->original_products[0] );
                    array_push($products, $original_products);

                    array_push($my_editing_products, $value->my_editing);

                    if(!in_array($original_products->product->main_category_id, $all_categories))
                    {
                        $category = $printful->getCategoryDetailsById( $original_products->product->main_category_id );
                        $all_categories_details[$original_products->product->main_category_id] = $category;
                        //array_push( $all_categories_details, $category );
                        array_push( $all_categories, $original_products->product->main_category_id );
                    }
                }
                //dd( $all_categories_details );
            }
            //dd( $products );

            if( \Session::get('googleuser') )
            {
                return view('store::pages.viewstore',["store"=>$store, "all_categories_details"=>$all_categories_details,"products"=>$products, "my_editing_products"=>$my_editing_products, "my_editing"=>$my_editing, "googleuser"=>\Session::get('googleuser') ]);
            }else{
                return view('store::pages.viewstore',["store"=>$store, "all_categories_details"=>$all_categories_details,"products"=>$products, "my_editing_products"=>$my_editing_products, "my_editing"=>$my_editing ]);
            }
        }else{
            echo 'No Store Found.';
        }
    }

    /**
     * userstore_signup
     *
     * @param  mixed $request
     * @return void
     */
    public function userstore_signup(Request $request)
    {
        $user = StoreUsers::where(["email"=>$request->email, "google_id"=>0])->get();
        if( !count($user) )
        {
            $user = StoreUsers::Create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'google_token' => null,
                'google_refresh_token' => null,
                'google_id' => 0,
                'store_name' => $request->store_name,
                'address' => "{}",
            ]);
            \Session::put("googleuser1", $user);
            //return $user;
            return json_encode(['status' => 'success', 'user'=>$user]);
        }else{
            return json_encode(['status' => 'error', 'message' => "Email already axists."]);
        }
    }

    /**
     * storeuseraddress
     *
     * @param  mixed $request
     * @return void
     */
    public function storeuseraddress(Request $request)
    {
        $affectedRows = StoreUsers::where("id", $request->storeuserid)->update(["address" => $request->address_array]);
        $user = StoreUsers::find($request->storeuserid);
        \Session::put("googleuser1", $user);
        return $user;
    }

    /**
     * checkout_create_php
     *
     * @param  mixed $request
     * @return void
     */
    public function checkout_create_php( Request $request )
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY_LIVE'));

        try {

            $jsonObj = json_decode( $request->body );
            $paymentIntent = PaymentIntent::create([
                'amount' => $this->calculateOrderAmount($jsonObj->items),
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            echo  json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo  json_encode(['error' => $e->getMessage()]);
        }

    }

    /**
     * calculateOrderAmount
     *
     * @param  mixed $items
     * @return int
     */
    public function calculateOrderAmount(array $items): int {
        //return 1234;
        return $items[0]->price;
    }

    /**
     * store_order
     *
     * @param  mixed $request
     * @return void
     */
    public function store_order(Request $request)
    {
        $payment_intent_value = $request->payment_intent; // "some_value"
        $payment_intent_client_secret_value = $request->payment_intent_client_secret;
        $redirect_status = $request->redirect_status;
        //echo '<pre>';
        //echo $payment_intent_value."<br>";
        //echo $payment_intent_client_secret_value."<br>";
        //echo $redirect_status."<br>";
        //dd( "{'payment_intent_value': '".$request->payment_intent."', 'payment_intent_client_secret_value': '".$request->payment_intent_client_secret."', 'redirect_status': '".$request->redirect_status."'}" );


        if( \Session::get('googleuser1') )
        {
            $googleuser1 = \Session::get('googleuser1');
            $store_name = $googleuser1['store_name'];
        }

        if( \Session::get('cart')  )
        {
            $cart = \Session::get('cart');
        }
        $product_for_shirt = [];
        if( \Session::get("product_for_shirt")  )
        {
            $product_for_shirt = \Session::get("product_for_shirt");
        }
        if( \Session::get("cart_name")  )
        {
            $cart_name = \Session::get("cart_name");
        }
        if( \Session::get("cart_desc")  )
        {
            $cart_desc = \Session::get("cart_desc");
        }

        /**
         * check if Sales order already submited.
         */
        $old_SO = Store_Cart_Payment::Where('stripe_payment_json', 'like', '%' . $request->payment_intent . '%')->get()->count();
        if($old_SO>0)
        {
            return view('store::pages.store_order_success',['status' => 'already submited', 'message'=>"Salesorder is already submited.", 'store_name'=>$store_name]);
        }

        //get store to get id_company
        //echo $store_name;
        if( isset($googleuser1) && isset($store_name) && isset($cart) )
        {
            // check into customer_address if id_company present get id_address else insert the
            //address into zoho and get id_address save into DB table customer_address
            $store = Store::select("id", "name", "id_company")->where("name", $store_name)->get()->first();
            $address = DB::table('customer_address')->where('id_company', $store->id_company)->first();
            if($address!=null)
            {
                $call = Books::UpdateAddressById( $store->id_company, $address->id_address, json_decode($googleuser1['address'],true));
                $id_address = $address->id_address;

            }else{
                $call = Books::createAddress3( $store->id_company, json_decode($googleuser1['address'],true) );
                $id_address = $call["address_info"]["address_id"];
            }

             //Then Create the SO with this address id.

            //$jsonData = file_get_contents('https://files.cdn.printful.com/products/553/14002_1643377639.jpg');

            $imagefiles = [];
            // foreach($product_for_shirt as $key=>$val)
            // {
            //     $image_array = [];
            //     $image_array['file_name'] = $val['product_name'];
            //     $image_array['content'] = file_get_contents($val['Product_Image_URL']);
            //     $image_array['extension'] = pathinfo( parse_url($val['Product_Image_URL'], PHP_URL_PATH), PATHINFO_EXTENSION);
            //     array_push($imagefiles,$image_array);
            // }
            //dd( $imagefiles );

            $total_amount = 0;
            //dd( $cart );

            $my_line_items = [];
            foreach( $cart as $k=>$c )
            {
                if( array_key_exists("isprintful", $c) )
                {
                    $inner_item = [];
                    $inner_item["name"] = $c['name'];
                    $inner_item["description"] = $c['description'];
                    $inner_item["rate"] = $c['total_product_price'];
                    $inner_item["quantity"] = $c['quantity'];
                    array_push($my_line_items, $inner_item);

                    $image_array = [];
                    $image_array['file_name'] = $c['edit_name'];
                    $image_array['content'] = file_get_contents($c['image']);
                    $image_array['extension'] = pathinfo( parse_url($c['image'], PHP_URL_PATH), PATHINFO_EXTENSION);
                    array_push($imagefiles,$image_array);

                    $total_amount += $c['total_product_price'];
                }else{
                    $total_amount += $c['rate'];
                }
            }
            $items = json_encode($my_line_items);

            //$items = json_encode($cart);
            //dd( $items );

            $shirts = json_encode($product_for_shirt);
            $address = $id_address;

            $delivery_date = array( array("api_name"=>"cf_internal_notes", "placeholder"=>"cf_internal_notes", "value"=>"Payment $".$total_amount." has been recieved via stripe: ".$payment_intent_value) );
            $delivery_date = json_encode($delivery_date);
            $shipment_cost = 0;
            $InventoryController = new InventoryController();
            $response = $InventoryController->createSalesOrderBystore($items, $address,$shirts,$delivery_date,$shipment_cost,$imagefiles, $store->id_company);

            $salesorder_id = json_decode($response)->salesorder->salesorder_id;

            //save into DB in table Store_Cart_Payment
            $Store_Cart_Payment = new Store_Cart_Payment;
            $Store_Cart_Payment->id_company             = $store->id_company;
            $Store_Cart_Payment->store_name             = $store_name;
            $Store_Cart_Payment->cart_items_json        = $items;
            $Store_Cart_Payment->product_for_shirt      = $shirts;
            $Store_Cart_Payment->address_id             = $address;
            $Store_Cart_Payment->delivery_date          = $delivery_date;
            $Store_Cart_Payment->shipment_cost          =  $shipment_cost;
            $Store_Cart_Payment->salesorder_id          =  $salesorder_id;
            $Store_Cart_Payment->stripe_payment_json    =  "{'payment_intent_value': '".$request->payment_intent."', 'payment_intent_client_secret_value': '".$request->payment_intent_client_secret."', 'redirect_status': '".$request->redirect_status."'}";
            $Store_Cart_Payment->save();

            //return json_encode(['status' => 'success', 'message'=>"Salesorder created and payment saved into Database."]);
             //remove all session except login
            \Session::forget('cart');
            \Session::forget('product_for_shirt');
            \Session::forget('cart_name');
            \Session::forget('cart_desc');
            //$index = $request->input('index');

            return view('store::pages.store_order_success',['status' => 'success', 'message'=>"Salesorder created and payment saved into Database.", 'store_name'=>$store_name]);
        }else{
            return 'Cart is empty Nothing.';
        }
    }

    /**
     * storeUserLogin
     *
     * @param  mixed $request
     * @return void
     */
    public function storeUserLogin(Request $request)
    {
        $user = StoreUsers::where(["email"=> $request->email, "password"=> $request->password])->get();
        if(count($user))
        {
            \Session::put("googleuser1", $user[0]);
            return json_encode(['status' => 'success', 'user'=>$user[0]]);
        }else{
            return json_encode(['status' => 'error']);
        }
    }

    /**
     * storeUserLogout
     *
     * @param  mixed $request
     * @return void
     */
    public function storeUserLogout(Request $request)
    {
        \Session::forget('googleuser1');
        return 1;
    }

    /**
     * forgetPassword
     *
     * @param  mixed $request
     * @return void
     */
    public function forgetPassword( Request $request)
    {
        //return $request->email;
        $user = StoreUsers::where(["email"=> $request->email, 'google_id'=>0])->get()->count();
        if($user == 0)
        {
            return json_encode([ 'status' => 'error', 'message' => 'Invalid Email.' ]);
        }else{
            //generate random token and save into DB
            //Send mail to user to reset password through this token
            $unique_token = time().substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
            $Store_User_ResetPassword = new Store_User_ResetPassword;
            $Store_User_ResetPassword->email             = $request->email;
            $Store_User_ResetPassword->token             = $unique_token;
            $Store_User_ResetPassword->save();

            $title = "Reset Password";
            Mail::to($request->email)->send( new StoreUserResetPasswordMail($title, $unique_token));

            return json_encode([ 'status' => 'success', 'message' => 'To reset the password please check you\'r email inbox.' ]);
        }
    }

    /**
     * reset_password
     *
     * @param  mixed $request
     * @return void
     */
    public function reset_password(Request $request)
    {
        $token = $request->token;
        $isToken = Store_User_ResetPassword::where(["token"=>$token])->count();
        if($isToken>0)
        {
            $resetpassword = Store_User_ResetPassword::where(["token"=>$token])->get()->first();
            //Change Password view
            $store_user = StoreUsers::where(['email'=>$resetpassword['email'], 'google_id'=>0])->get()->first();
            //dd( $store_user  );
            return view('store::pages.store_resetpassword',["store_user"=>$store_user]);

        }else{
            //Token not present
            echo "Token is not present.";
        }
    }

    /**
     * userstore_resetpassword
     *
     * @param  mixed $request
     * @return void
     */
    public function userstore_resetpassword(Request $request)
    {
        $StoreUsers = StoreUsers::find($request->user_id);
        $StoreUsers->password = $request->password;
        $StoreUsers->save();
        return json_encode([ 'status' => 'success', 'message' => 'You\'r Password has been changed.' ]);
    }

    /**
     * product_printful
     *
     * @return void
     */
    public function product_printful()
    {
        $printful = new Printful();
        $categories = $printful->getAllCategories();

        $parent_categories = [];
        $child_categories = [];
        $firstCatid = 0;
        foreach($categories as $key=>$category)
        {
            if( $category['parent_id']==0 )
            {
                if($firstCatid==0)
                {
                    $firstCatid = $category['id'];
                }
                $parent_categories[ $category['id'] ] = $category;
                $parent_categories[ $category['id'] ]['child_categories'] = array();
                //array_push($parent_categories, $category);
            }else{
                $child_categories[ $category['id'] ] = $category;
                //array_push($child_categories, $category);
            }
        }
        //usort($parent_categories, fn($a, $b) => $a['catalog_position'] <=> $b['catalog_position']);
        //usort($child_categories, fn($a, $b) => $a['catalog_position'] <=> $b['catalog_position']);
        foreach($child_categories as $key=>$category)
        {
            if (array_key_exists( $category['parent_id'] ,$parent_categories))
            {
                array_push($parent_categories[$category['parent_id']]['child_categories'], $category);
            }
        }

        //$products = $printful->getAllProductsByCategory( $firstCatid );
        $products = $printful->getAllProducts();
        return view('store::pages.product_printful',  [
			'parent_categories'=>$parent_categories,
            'products'=>$products
		]);
    }

    /**
     * getProductDetails
     *
     * @param  mixed $request
     * @return void
     */
    public function getProductDetails(Request $request)
    {
        $product_id = $request->product_id;
        $printful = new Printful();
        $product_details = $printful->getProductDetailsById($product_id);
        return view('store::pages.productDetails',  [
            'product_details'=>$product_details
		]);
        //return $product_details;
    }

    /**
     * getProductDetails_popup
     *
     * @param  mixed $request
     * @return void
     */
    public function getProductDetails_popup(Request $request)
    {
        //dd( $request->id_company );
        return view('store::pages.getProductDetails_popup',  [
            'product_details'=>$request->selected_product,
            'selected_editing'=>$request->selected_editing,
            'general_my_editing_single'=>$request->general_my_editing_single,
            'product_list_id'=>$request->product_list_id,
            'id_company'=> $request->id_company
		]);
    }

    public function getProductmockups_popup(Request $request)
    {
        return view('store::pages.getProductmockups_popup',  [
            'variant_id'=>$request->variant_id,
            'product_id'=>$request->product_id,
            'id_company'=>$request->id_company
		]);
    }

    /**
     * getProductDetails_popup
     *
     * @param  mixed $request
     * @return void
     */
    public function getProductDetails_popup_edit(Request $request)
    {
        //dd( $request->selected_product );
        return view('store::pages.getProductDetails_popup_edit',  [
            'product_details'=>$request->selected_product,
            'selected_editing'=>$request->selected_editing,
            'general_my_editing_single'=>$request->general_my_editing_single
		]);
    }

    /**
     * getProductDetails_edit
     *
     * @param  mixed $request
     * @return void
     */
    public function getProductDetails_edit(Request $request)
    {
        $product_list_id = $request->product_list_id;
        $Product_List = Product_List::find($product_list_id);
        $stores = Store::get();

        return view('store::pages.productDetails_edit',  [
            'Product_List'=>$Product_List,
            "stores"=>$stores
		]);
    }

    /**
     * getAllProductsByCategoryId
     *
     * @param  mixed $request
     * @return void
     */
    public function getAllProductsByCategoryId(Request $request)
    {
        $printful = new Printful();
        $products = $printful->getAllProductsByCategory( $request->category_id );
        return view('store::pages.printful_inner_products_view',  [
            'products'=>$products
		]);

    }

    /**
     * saveProductintoProductList
     *
     * @param  mixed $request
     * @return void
     */
    public function saveProductintoProductList(Request $request)
    {
        $printful = new Printful();
        $product_details = $printful->getProductDetailsById($request->product_id);
        $Product_List = new Product_List();
        $Product_List->product = json_encode($product_details, true);
        $Product_List->selected_variants = json_encode($request->selected_variants, true);
        $Product_List->save();
        return json_encode([ 'status' => 'success', 'message' => 'Product has been Created  into Product List.', 'product_list' =>  $Product_List ]);
    }

    /**
     * deleteproductlist
     *
     * @param  mixed $request
     * @return void
     */
    public function deleteproductlist(Request $request)
    {
        $Product_List = Product_List::where('id', $request->id)->delete();
        return json_encode(["status"=>"success"]);
    }

    /**
     * edit_product_list
     *
     * @param  mixed $id
     * @return void
     */
    public function edit_product_list($id)
    {
        $Product_List = Product_List::find($id);
        $Product = json_decode($Product_List['product'], true);
        $Product_id = $Product['product']['id'];
        $Product_Link_Images = Product_Link_Images::where('product_id',$Product_id)->first();
        $stores = Store::get();

        //dd( $Product_id );
        $ismockups = 0;
        $printful_transparent_images = "";

        $dir = public_path('Image/Transparent Images/'.$Product_id);
        if (is_dir($dir)) {
            $ismockups = 1;
            $printful_transparent_images = printful_transparent_images::where("product_id", $Product_id)->get()->first();
            //dd( $printful_transparent_images );
        }

        return view('store::pages.edit_product_list',  [
            'Product_List'=>$Product_List,
            "stores"=>$stores,
            "Product_Link_Images"=>$Product_Link_Images,
            "Product"=>$Product,
            "ismockups"=>$ismockups,
            "printful_transparent_images"=>$printful_transparent_images
		]);
    }

    /**
     * edit_printful_product
     *
     * @param  mixed $id
     * @return void
     */
    public function edit_printful_product($id)
    {
        $product_id = $id;
        $printful = new Printful();
        $product_details = $printful->getProductDetailsById($product_id);
        return view('store::pages.productDetails_new',  [
            'product_details'=>$product_details
		]);
        //return $id;
    }

    /**
     * addproductlist_store
     *
     * @param  mixed $request
     * @return void
     */
    public function addproductlist_store(Request $request)
    {
        $product_id             = $request->product_id;
        $product_list_id        = $request->product_list_id;

        $Product_List = Product_List::find($product_list_id);

        $original_products = array();
        $selected_sizes = array();
        $selected_variants_id = array();
        array_push($original_products, $Product_List->product);
        array_push($selected_sizes, $Product_List->selected_sizes);
        array_push($selected_variants_id, $Product_List->selected_variants_id);

        //$my_editings = array();
        $my_editing = array();
        $my_editing['product_name'] = $request->product_name;
        $my_editing['profit_price'] = $request->modal_product_price;
        $my_editing['product_description'] = $request->product_description;
        //array_push($my_editings, $my_editing);

        $stores                 = $request->stores;
        foreach($stores as $key=>$store)
        {
            $Store = Store::where("name", $store)->get()->first();
            if($Store->product_lists==null)
            {
                $Product_Lists = array();
                array_push($Product_Lists, $product_list_id);

                $my_editings = array();

                $org = array();
                $org['id'] = $product_list_id;
                $org['my_editing'] = $my_editing;

                $original_products = array();
                $selected_variants = array();
                array_push($original_products, $Product_List->product);
                $org['original_products'] = $original_products;

                array_push($selected_variants, $Product_List->selected_variants);
                $org['selected_variants'] = $selected_variants;

                array_push( $my_editings, $org);
            }else{
                //dd( "Always add as new item" );
                $Product_Lists = json_decode($Store->product_lists, true);
                array_push($Product_Lists, $product_list_id);
                $my_editings = json_decode( $Store->my_editing, true );

                $org = array();
                $org['id'] = $product_list_id;
                $org['my_editing'] = $my_editing;

                $original_products = array();
                $selected_variants = array();
                array_push($original_products, $Product_List->product);
                $org['original_products'] = $original_products;

                array_push($selected_variants, $Product_List->selected_variants);
                $org['selected_variants'] = $selected_variants;

                array_push( $my_editings, $org);
            }
            $Store->my_editing = json_encode($my_editings);
            $Store->product_lists = json_encode($Product_Lists);
            $Store->save();
        }
        return json_encode(["status"=>"success"]);
    }

    public function getShippingrateTaxrate(Request $request)
    {
        $printful = new Printful();
        $shippingrate = $printful->getShippingRate($request->cart, $request->address);
        $taxrate = $printful->getTaxRate($request->address);

        if($shippingrate==0 || $taxrate==0)
        {
            return 0;
        }else{
            $shippingrate['tax'] = $taxrate;
            //dd( $shippingrate );
            return $shippingrate;
        }
    }

    public function getmockupsdesign(Request $request)
    {
        $Product_List = Product_List::find($request->product_list);
        $Product = json_decode($Product_List['product'], true);
        $Product_id = $Product['product']['id'];
        $Product_Link_Images = Product_Link_Images::where('product_id',$Product_id)->first();
        $stores = Store::get();

        $variant_first = $Product['variants'][0]['id'];

        return view('store::pages.getmockupsdesign',  [
            'Product_List'=>$Product_List,
            "stores"=>$stores,
            "Product_Link_Images"=>$Product_Link_Images,
            "Product"=>$Product,
            "variant_first"=>$variant_first
		]);
    }

    public function upload_products(){

        if(Auth::user()->id_company!=1316483000044705915)
        {
            dd("Your are not Authorized.");
        }

        $printful = new Printful();
        $categories = $printful->getAllCategories();
        // dd($categories);
        $parent_categories = [];
        $child_categories = [];
        $firstCatid = 0;
        foreach($categories as $key=>$category)
        {
            if( $category['parent_id']==0 )
            {
                if($firstCatid==0)
                {
                    $firstCatid = $category['id'];
                }
                $parent_categories[ $category['id'] ] = $category;
                $parent_categories[ $category['id'] ]['child_categories'] = array();
                //array_push($parent_categories, $category);
            }else{
                $child_categories[ $category['id'] ] = $category;
                //array_push($child_categories, $category);
            }
        }
        //usort($parent_categories, fn($a, $b) => $a['catalog_position'] <=> $b['catalog_position']);
        //usort($child_categories, fn($a, $b) => $a['catalog_position'] <=> $b['catalog_position']);
        foreach($child_categories as $key=>$category)
        {
            if (array_key_exists( $category['parent_id'] ,$parent_categories))
            {
                array_push($parent_categories[$category['parent_id']]['child_categories'], $category);
            }
        }

        //$products = $printful->getAllProductsByCategory( $firstCatid );
        $products = $printful->getAllProducts();
        return view('store::pages.upload_products',  [
			'parent_categories'=>$parent_categories,
            'products'=>$products
		]);
    }

    public function upload_images_printful_product($id)
    {
        if(Auth::user()->id_company!=1316483000044705915)
        {
            dd("Your are not Authorized.");
        }

        $product_id = $id;
        $printful = new Printful();
        $product_details = $printful->getProductDetailsById($product_id);

        return view('store::pages.productDetails_uploadImages',  [
            'product_details'=>$product_details,
            'product_id'=>$product_id
		]);
        //return $id;
    }

    public function view_uploaded_products()
    {
        if(Auth::user()->id_company!=1316483000044705915)
        {
            dd("Your are not Authorized.");
        }

        $printful_transparent_images = printful_transparent_images::get()->all();

        return view('store::pages.view_uploaded_products',  [
            'printful_transparent_images'=>$printful_transparent_images
		]);

    }


}
