<?php
/**
 * Created by PhpStorm.
 * User: DREAM
 * Date: 12/14/2020
 * Time: 9:44 AM
 */
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url_helper');
    $this->load->library(array('session','ShoppingCart'));
    $this->load->model(array('Public_model',));  
  }

  public function index()
  {
    $data['title'] = "CHECKOUT";
    $data['description'] = "Last Update: 09/12/2020";
    $data['navigation'] = "";

    $this->load->view('common/header_html');
    $this->load->view('common/header');
    $this->load->view('common/sub_header', $data);
    $this->load->view('checkout');
    $this->load->view('common/footer');
    $this->load->view('common/footer_html');
  }

  public function stripePost()
    {
        require_once APPPATH.'third_party/stripe/lib/Stripe.php';
        require_once APPPATH."third_party/stripe/config.php";
     
        if ($_POST) {
          \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
      
          try {
              //if (empty($_POST['street']) || empty($_POST['city']) || empty($_POST['zip']))
              //    throw new Exception("Fill out all required fields.");
              if (!isset($_POST['stripeToken']))
              {
                  //throw new Exception("The Stripe Token was not generated correctly");
                  $successMessage = "Failed on checkout!";
                  $this->session->set_flashdata('checkoutError', $successMessage);
                  redirect("checkout/index");

              } else {

                $cartDetails = $this->shoppingcart->getCartItems();
                $itemName = 'Data of sport game.';
                $itemAmount = $cartDetails['finalSum'];
                
                $itemAmount = $itemAmount * 1; 


                $result = \Stripe\Charge::create([
                    "amount" => $itemAmount*100,         // $_POST['donateValue']*100 ,
                    "currency" => "usd",    //$_POST['currency_code'],
                    "source"   => $_POST['stripeToken'], // obtained with Stripe.js
                    "description" => $itemName  //$_POST['email']  // $_POST['item_name'], $_POST['item_number']
                ]);

                $stripeResponse = $result->jsonSerialize();
        
                $amount = $stripeResponse["amount"] /100;
                if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {

                    $customer_id = $this->Public_model->setCustomer($_POST);
                    $_POST["customer_id"] = $customer_id;
                    $_POST['paid_amount'] = $amount;
                    $_POST['payment_type'] = "CreditCard";
                    $_POST['user_id']    = $this->session->userdata("logged_data")["userid"];
                    $order_id = $this->Public_model->setOrder($_POST);
                    $successMessage = "Successfully paid!";
                    // Clear shoppingcart
                    unset($_SESSION['shopping_cart']);
                    @delete_cookie('shopping_cart');

                    $this->session->set_flashdata('checkoutError', $successMessage);
                    redirect("download/index");
                }else{
                    $successMessage = "Failed";
                    $this->session->set_flashdata('checkoutError', $successMessage);
                    redirect("checkout/index");
                  }
                }
              }
              catch (Exception $e) {
                  
                  $successMessage = "Failed";
                  $this->session->set_flashdata('checkoutError', $successMessage);
                  redirect("checkout/index");
              }
        }
    }

    public function paypalPost()
    {

        if(isset($_POST["email"]))
        {
            $enableSandbox = false;

            // PayPal settings. Change these to your account details and the relevant URLs
            // for your site.
            $paypalConfig = [
                'email' => "", // receiving paypal account
                'return_url' => base_url().'checkout/paypal_successful',
                'cancel_url' => base_url().'checkout/paypal_cancelled',
                'notify_url' => base_url().'checkout/paypal_notify'
            ];
      
            $paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
      
            // Product being purchased.

            $cartDetails = $this->shoppingcart->getCartItems();
            $itemName = 'Data of sport game.';
            $itemAmount = $cartDetails['finalSum'];
             
            $itemAmount = $itemAmount * 1; 
             //$itemAmount = 0.1;
            // Set the PayPal account.
            $data['business'] = $paypalConfig['email'];
      
            // Set the PayPal return addresses.
            $data['return'] = stripslashes($paypalConfig['return_url']);
            $data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
            $data['notify_url'] = stripslashes($paypalConfig['notify_url']);
            $data['rm'] = '2';
      
            // Set the details about the product being purchased, including the amount
            // and currency so that these aren't overridden by the form data.
            $data['item_name'] = $itemName; // payment subject
            $data['item_number'] = ''; //$id; // payment subject
      
            $data['amount'] = $itemAmount;
            $data['currency_code'] = 'USD';
            $data['payer_email'] = $_POST["email"];
      
            $data['cmd'] = '_xclick'; // _xclick,_cart,_donations
      
            // Add any custom fields for the query string.
            $data['custom_name'] = $_POST['firstname'];
            $data['custom_last_name'] = $_POST['lastname'];

            $data['custom_phone'] = $_POST['billingaddress'];
      
            // Build the query string from the data.
            $queryString = http_build_query($data);
      
            // Redirect to paypal IPN
            header('location:' . $paypalUrl . '?' . $queryString);
            exit();

        }
    }

    public function paypal_successful()
    {
        $result = "Successfully paid via PayPal.";
        $method = 'paypal';
        $this->session->set_flashdata('checkoutError', $result);
        redirect(base_url()."checkout/index");
    }
    public function paypal_cancelled()
    {
        $result = "Payment via PayPal cancelled.";
        $method = 'paypal';
        $this->session->set_flashdata('checkoutError', $result);
        redirect(base_url()."checkout/index");
    }
    public function paypal_notify()
    {
      $requestFromPaypal = $_POST;
      $req = 'cmd=_notify-validate';
      foreach ($requestFromPaypal as $key => $value) {
          $value = urlencode(stripslashes($value));
          $req .= "&$key=$value";
      }
      if(isset($requestFromPaypal["txn_id"]) && isset($requestFromPaypal["txn_type"]))
      {
          $param_type = 'sssss';
          $param_value_array = array(
              $requestFromPaypal['custom_last_name']." ".$requestFromPaypal['custom_name'],
              $requestFromPaypal["custom_name"],
              $requestFromPaypal["custom_last_name"],
            //  $requestFromPaypal["custom_phone"],
              $requestFromPaypal['payer_email'],
            );

            $input = array(
                'email' => trim($requestFromPaypal['payer_email']),
                'first_name'  => $requestFromPaypal['custom_name'],
                'last_name'  => $requestFromPaypal['custom_last_name'],
                'role_id' => 2,
            );
            if (!$this->db->insert('user', $input)) {
                //log_message('error', print_r($this->db->error(), true));
                //show_error(lang('database_error'));
            }
            $customer_id = $this->db->insert_id();

          $param_type = 'dssssssss';
          $param_value_array = array(
              $id,
              $requestFromPaypal["item_name"],
              $requestFromPaypal["txn_id"],
              $requestFromPaypal["payment_gross"],
              $requestFromPaypal["txn_type"],
              " ",
              $requestFromPaypal["mc_currency"],
              "Paypal",
              date('Y-m-d H:i:s'),
          );
          
            $input = array(
                'paid_amount' => $requestFromPaypal["payment_gross"],
                'payment_type' => "Paypal",
                'user_id'       =>  $this->session->userdata("logged_data")["userid"], 
                'customer_id' => $customer_id,
            );
            
            $order_id = $this->Public_model->setOrder($input);

          // Clear shoppingcart
          unset($_SESSION['shopping_cart']);
          @delete_cookie('shopping_cart');
      }
    }



        // Laravel Code

        /*
        $requestFromPaypal = $request->all();
        $req = 'cmd=_notify-validate';
        foreach ($requestFromPaypal as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
        }
        //Log::info($req);

        if(!isset($requestFromPaypal["txn_id"]) && !isset($requestFromPaypal["txn_type"])) 
        {
            $data = [
                        'item_name' => $requestFromPaypal['item_name'],
                        'item_number' => $requestFromPaypal['item_number'],
                        'payment_status' => $requestFromPaypal['payment_status'],
                        'payment_amount' => $requestFromPaypal['mc_gross'],
                        'payment_currency' => $requestFromPaypal['mc_currency'],
                        'txn_id' => $requestFromPaypal['txn_id'],
                        'receiver_email' => $requestFromPaypal['receiver_email'],
                        'payer_email' => $requestFromPaypal['payer_email'],
                        //'custom' => $_POST['custom'],
                        'name' => $requestFromPaypal['custom_name'],
                        'last_name' => $requestFromPaypal['custom_last_name'],
                        'phone' => $requestFromPaypal['custom_phone']
                     ];

                    // We need to verify the transaction comes from PayPal and check we've not
                    // already processed the transaction before adding the payment to our
                    // database.
                    if (verifyTransaction($requestFromPaypal) ) {   //&& checkTxnid($data['txn_id'])
                        if (addPayment($data) !== false) {
                            // Payment successfully added.
                        }
                    }
                    // return Redirect->to("donate");
            //Log::info($data);
        }
  }

  function checkTxnid($txnid) {
    global $db;

    $txnid = $db->real_escape_string($txnid);
    $results = $db->query('SELECT * FROM `payments` WHERE txnid = \'' . $txnid . '\'');

    return ! $results->num_rows;
}
function verifyTransaction($data) {

    $req = 'cmd=_notify-validate';
    foreach ($data as $key => $value) {
        $value = urlencode(stripslashes($value));
        $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
        $req .= "&$key=$value";
    }

    $enableSandbox = false;
    $paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

    $ch = curl_init($paypalUrl);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
    $res = curl_exec($ch);

    if (!$res) {
        $errno = curl_errno($ch);
        $errstr = curl_error($ch);
        curl_close($ch);
        throw new Exception("cURL error: [$errno] $errstr");
    }

    $info = curl_getinfo($ch);

    // Check the http response
    $httpCode = $info['http_code'];
    if ($httpCode != 200) {
        throw new Exception("PayPal responded with http code $httpCode");
    }

    curl_close($ch);

    return $res === 'VERIFIED';
}

function addPayment($data) {

  $id = DB::table('donator')->insertGetId([
        'full_name' => $data['last_name']." ".$data['name'],
        'first_name' => $data['name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]);


 DB::table('donates')->insert([
     'donator_id' => $id,
     'project_title' => $data['name'],
     'txn_id' => $data['last_name'],
     'price' => $data['email'],
     'payment_method' => $data['phone'],
     'payment_address' => date('Y-m-d H:i:s'),
     'currency' => date('Y-m-d H:i:s'),
     'payfunc' => date('Y-m-d H:i:s'),
 ]);
 return true;
}
  */

}

?>