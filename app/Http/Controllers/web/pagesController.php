<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductImages;
use App\Models\Contact;
use App\Models\Carts;
use App\Models\Order;
use App\Models\OrderDetail;
use Validator;
use Rap2hpoutre\FastExcel\FastExcel;

class pagesController extends Controller
{
    public function index()
    {
        $data = array();
        $data['page_title'] = 'Home';
        $catData = new Categories; 
        $cat =  $catData->get_category();
        $data['Catdata']=$cat;
        $proData = new Product; 
        $product =  $proData->get_Allproduct();
        $data['productData']=$product;
        $latestProduct =  $proData->get_latest_product(5);
        $data['letProductData']=$latestProduct;
        $dealProduct =  $proData->get_latest_product(4);
        $data['dealProduct']=$dealProduct;
        $newPro =  $proData->get_NewArrivals();
        $data['newProData']=$newPro;
        return view('web.index', $data);
    }
    public function about()
    {
        $data = array();
        $data['page_title'] = 'About';
        $proreview = new ProductReview; 
        $prore =  $proreview->get_ProductWithReview();
        $data['proReview']=$prore;
        return view('web.about', $data);
    }
    public function products()
    {
        $data = array();
        $data['page_title'] = 'Products';
        $data['breadcrumb'] = 'Products';
        $proData = new Product; 
        $product =  $proData->get_Allproduct();
        $data['productData']=$product;
        $newPro =  $proData->get_NewArrivals();
        $data['newProData']=$newPro;
        return view('web.products', $data);
    }
    public function contact()
    {
        $data = array();
        $data['page_title'] = 'Contact';
        return view('web.contact', $data);
    }
    public function checkContactForm(Request $request)
    {
        $status = 0;
        $msg = "";

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
        ]);
        // check validations
        if ($validator->fails()) {
            $messages = $validator->messages();
            $status = 0;
            $msg = "";
            foreach ($messages->all() as $message) {
                $msg .= $message . "<br />";
            }
        } else {
            $contactFrm = new Contact();
            $contactFrm->firstname = $request->get('firstname');
            $contactFrm->lastname = $request->get('lastname');
            $contactFrm->phone_number = $request->get('phone_number');
            $contactFrm->email = $request->get('email');
            $contactFrm->message = $request->get('message');
            $contactFrm->save();
            $status = 1;
            $msg = "We will contact you as soon as possible.";

        }
        if ($request->isXmlHttpRequest()) {
            return ['status' => $status, 'msg' => $msg];
        } else {
            if ($status == 0) {
                session()->flash('error_message', $msg);
            }
            return redirect('contact');
        }
    }
    public function privacyPolicy()
    {
        $data = array();
        $data['page_title'] = 'Privacy Policy';
        return view('web.privacyPolicy', $data);
    }
    public function termsAndConditions()
    {
        $data = array();
        $data['page_title'] = 'Terms And Conditions';
        $data['breadcrumb'] = 'Terms And Conditions';
        return view('web.termsAndConditions', $data);
    }
    public function refundAndCancellationPolicy()
    {
        $data = array();
        $data['page_title'] = 'Refund And Cancellation Policy';
        $data['breadcrumb'] = 'Refund And Cancellation Policy';
        return view('web.refundAndCancellationPolicy', $data);
    }
    public function deliveryAndShippingPolicy()
    {
        $data = array();
        $data['page_title'] = 'Delivery And Shipping Policy';
        return view('web.deliveryAndShippingPolicy', $data);
    }
    public function categories()
    {
        $data = array();
        $data['page_title'] = 'Categories';
        $catData = new Categories; 
        $cat =  $catData->get_category();
        $data['Catdata']=$cat;
        return view('web.categories', $data);
    }
    public function productDetails($slug)
    {
        $data = array();
        $data['page_title'] = 'Product Details';
        $proData = new Product; 
        $product =  $proData->get_ProductDetail($slug);
        $data['proData']=$product;
        $productWithSize = $proData->productWithSize($product->id);
        $data['productWithSize']=$productWithSize;
        $catquery = new Categories;
        $productCategory = $catquery->get_category($product->category_id);
        $data['catData']=$productCategory;
        $proimgs = new ProductImages; 
        $proimges =  $proimgs->get_ProductImages($product->id);
        $data['proimges']=$proimges;
        $proreview = new ProductReview; 
        $prore =  $proreview->get_ProductReview($product->id);
        $data['proReview']=$prore;
        $pwr =  $proreview->get_ProductWithReview($product->id);
        $data['pwr']=$pwr;
        $avgRate =  $proreview->getAvgRating($product->id);
        $data['avgRate']=$avgRate;
        $ranProduct =  $proData->get_random_product();
        $data['ranProduct']=$ranProduct;
        return view('web.productDetails', $data);
    }
    public function productCategory()
    {
        $data = array();
        $data['page_title'] = 'Product Category';
        $catData = new Categories; 
        $cat =  $catData->get_Menucategory();
        $data['Catdata']=$cat;
        $proData = new Product; 
        $product =  $proData->get_Allproduct();
        $data['productData']=$product;
        return view('web.productCategory', $data);
    }
    public function categoryDetails($slug){
        $data = array();
        $data['page_title'] = 'Product Category';
        $catData = new Categories; 
        $cat =  $catData->get_Menucategory();
        $data['Catdata']=$cat;
        $proData = new Product; 
        $product =  $proData->get_Allproduct();
        $data['productData']=$product;
        if($slug){
            $cat=$catData->get_categoryBy_slug($slug);
            $data['Catsl'] = $cat; 
            $data['catPro'] =  $proData->get_catProduct($cat[0]->id);
        }
        return view('web.productCategory', $data);
    }
    public function cart()
    {
        $data = array();
        $data['page_title'] = 'Cart';
        $cartData = Carts::getCartData();
        $data['cartData'] = $cartData;
        $proData = new Product;
        $ranProduct =  $proData->get_random_product();
        $data['ranProduct']=$ranProduct;
        return view('web.cart', $data);
    }    
    public function gallery()
    {
        $data = array();
        $data['page_title'] = 'Gallery';
        return view('web.gallery', $data);
    }
    public function viewReceivedOrder($id,$key){
        if($id){
            $tObj = Order::where('id',$id)->where('ordkey',$key)->first();
            if($tObj){
                $data['order'] = $tObj;
                $data['orderDet'] = OrderDetail::getOrders($id);
                return view('web.orderComplete', $data);
            }
        }
        return abort(404);
    }
}
