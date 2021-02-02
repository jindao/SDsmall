<!DOCTYPE html>
<html>
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Invoice</title>
    <style type="text/css" media="all">
        .invoice-box {
            margin: auto;
            padding-top:20px;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: center;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: middle;
        }

        .invoice-box table tr td:nth-child(2) {
            /* text-align: right; */
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #009245;
            color:white;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/

        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
        .row {
            margin-right: -15px;
            margin-left: -15px;
            display: flex;
            
            width: 100%;
        }
        .row:before {
            display: table;
            content: " ";
        }
        .row:after {
            clear: both;
            display: table;
            content: " ";
        }
        .col-md-6 {
            width: 50%;
            float:left;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }
        .text-left {
            text-align: left;
        }

    </style>
</head>
<body>

  <div class = "row" style = " padding-top: 15px;">
    <div class="col-md-6" style = "padding-left:20px;">
      <h1 class="text-left" style = "color:#009245;font-style:bold;font-size:48px;">INVOICE</h1>

      <div class = "row" style = "width:100%;"> 
        <div class="col-md-6">
            <span style = "font-style:bold;font-size:22px;"> Invoice No:</span> <br>
            <span style = ""> Date: </span> <br>
            <span style = ""> Due Date: </span> <br>
        </div>

        <div class="col-md-6" style = "margin-left:50%;"> 
            <span style = "font-style:bold;font-size:22px;"> #INV<?php echo $order_data["order_id"];?> </span> <br>
            <span style = ""> <?php echo $order_data["datetime"];?> </span> <br>
            <span style = ""> <?php echo $order_data["datetime"];?> </span> <br>
        </div>
      </div>  


    </div>
    <div class="col-md-6" style = "padding-right:20px;padding-top:30px;">
      <div class = "row" style = "padding-right: 115px;">
        <img style = "float:right;" src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_url().'assets/media/logos/logo-green-lg.png'));?>" alt="image" >
        
        <span style = "margin-top:70px;color:#009245;float:right;padding-right:10px;"> Excelsportdata.com</span>
      </div>
      <div class = "row" >
       
      </div> 
    </div>
  </div>
<br><br>
  <div class = "row" style = "margin-top:30px;display:block;">
    <div class="col-md-6" style = "padding-left:20px;padding-right:20px;">
      <h2 class="text-left" style = "border-bottom: 1px solid #009245;color:#009245;font-style:bold;font-size:20px;margin-right:70px;">Sent To:</h2>
      
      <span style = "font-style:bold;font-size:22px;">  <?php echo ucfirst($order_data["first_name"])." ".ucfirst($order_data["last_name"]);?> </span> <br>
        <span style = ""> ATTN :  <?php echo ucfirst($order_data["first_name"])." ".ucfirst($order_data["last_name"]);?> </span> <br>
        <span style = "">  <?php echo $order_data["address"];?> </span> <br>
        <span style = ""><?php echo $order_data["town_city"]." & ".$order_data["zip_code"];?> </span> <br>
        <span style = ""> <?php echo $order_data["country_name"];?> </span> <br>
    </div>
    <div class="col-md-6" style = "padding-right:20px;">
        <h2 class="text-left" style = "border-bottom: 1px solid #009245;color:#009245;font-style:bold;font-size:20px;margin-right:70px;">Sent By:</h2>

        <span style = "font-style:bold;font-size:22px;"> Ebuildix OÜ </span> <br>
        <span style = ""> VAT ID: EE102114247 </span> <br>
        <span style = ""> Reg. no: 14603653 </span> <br>
        <span style = ""> Sepapaja tn 6 </span> <br>
        <span style = ""> 15551 Tallinn </span> <br>
        <span style = ""> Estonia </span> <br>
    </div>
  </div>
<br>
  <div class="invoice-box row">
        <table cellpadding="0" cellspacing="0">
               
            <tr class="heading" style = "">
                <td>
                    #
                </td>
                <td>
                    Description
                </td>
                <td>
                    Price
                </td>
                <td>
                    VAT Rate
                </td>

                <td>
                    Net Amount
                </td>
            </tr>

            <?php 
                $totalSum = 0.0;
                if( is_array($order_data["product_data"] ) && count($order_data["product_data"]) > 0 ){
                    $count = 0;
                    
                    foreach($order_data["product_data"] as $product){
                        $count += 1;
                        $totalSum += $product["price"] * 1.0;
                        echo '<tr class="item"><td>'.$count.'</td> <td> Excel sport data file:<br> '.$product["season_name"].' </td> <td>' .$product["price"]. ' </td> <td> 20%</td>  <td> ' .$product["price"]. ' </td> </tr>';
                    }
               
                } else {
                    echo "<tr><td style = 'text-align:center;' colspan = 5> No Product </td></tr>";
                }
            ?>
           
            <tr class="total" >
                <td></td>
                <td></td>
                <td colspan = 3 style = "padding-top:30px;">
                   <table style = "border: none;border-color: green;">
                    <tr> 
                        <td style = "text-align:left;"> Subtotal without taxes: </td>
                        <td style = "text-align:right;"> <?php echo $totalSum;?> EUR </td>
                    </tr>
                    <tr> 
                        <td style = "text-align:left;"> VAT 20%: </td>
                        <td style = "text-align:right;"> <?php echo $totalSum*0.2;?> EUR </td>
                    </tr>
                    <tr style = "border-color: green;border: none; border-collapse: collapse;background-color:#009245;border-color:#009245; color:white;"> 
                        <td style = "border-color: green;margin:0px;text-align:left;border:none;border-color:#009245;font-size:20px;"> Invoice total: </td>
                        <td style = "border-color: green;margin:0px;text-align:right;border:none;border-color:#009245;font-size:20px;"> <?php echo $totalSum*1.2;?> EUR </td>
                    </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class = "row" style = "margin-top:10px;position:relative;display:block;">
        <h2 style = "color:grey; width:100%;text-align:center;border-bottom: 1px solid #009245;padding-bottom:15px;"> Thank you for your purchase! </h2>
    </div>
    <table style = "width:100%;">
        <tr>
            <td style = "font-style:bold;"> Company contacts: </td>
            <td> </td>
            <td style = "font-style:bold;"> Bank account: </td>
        </tr>
        <tr>
            <td>Ebuildix OÜ </td>
            <td>Sepapaja tn 6 </td>
            <td>AS LHV Pank </td>
        </tr>
        <tr>
            <td>Reg. No: 14603653</td>
            <td>15551 Tallinn </td>
            <td>IBAN: EE077700771003403962 </td>
        </tr>  
        <tr>
            <td>VAT ID: EE102114247</td>
            <td>Estonia </td>
            <td>SWIFT: LHVBEE22 </td>
        </tr> 
        <tr>
            <td>help@excelsportdata.com</td>
            <td></td>
            <td>Tartu mnt 2, 10145 Tallinn, Estonia</td>
        </tr> 
    </table>




</body>
</html>