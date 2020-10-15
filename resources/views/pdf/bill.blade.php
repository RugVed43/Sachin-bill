<?php 
set_time_limit(0);
ini_set("memory_limit",-1);
ini_set('max_execution_time', 0);
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bill</title>
    <link rel="stylesheet" href="">
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <?php 
	$i= time();
	?>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%">
        <tr>
            <td colspan="3" style='text-align: center; padding: 5px; margin: 5px;'>
                <img src="{{ URL::to('public/EBS-logo.jpg') }}" alt="" style='width:inherit;text-align: center'>
            </td>
            <td style="text-align: center; padding: 0px;margin: 0px;">
                <p style="font-size: 12px;font-weight: bold;padding: 0px;margin: 0px;">PAYTM</p>
                <img src="{{ URL::to('public/qr.jpg') }}" alt=""
                    style='width:80px;height: 80px;text-align: center; margin: 0px; padding: 0px;'>
            </td>
        <tr>
            <td colspan="">RECEIPT (Client Copy)</td>
            <td style='font-weight: bold;'>SRV.: 3 </td>
            <td style="background-color: #DCDCDC">BILL Date.:

                {{ $bill_date }}

                <br>
                <b>DUE DATE.: </b>


                {{ $due_date }}
            </td>
            <td style="background-color: #DCDCDC">Bill No.: {{ $i }}</td>
        </tr>
        <tr style="height: 100px; vertical-align:top ">
            <td colspan="2" style="height: 80px; vertical-align:top; ">Paid by:
                <br>
                <b>{{ $name }}</b>
            </td>
            <td colspan="2" style="height: 80px; vertical-align:top ">Address:<br>
                {{ $address }},<br>
                [{{ $numbers }}],<br>
            </td>
        </tr>

        <tr>
            <td colspan="2">Broadband Package Details</td>
            <td colspan="2">Bill Details</td>
        </tr>
        <tr>
            <td>Plan Name:</td>
            <td>{{ $plan_name }}</td>
            <td>Sub Total</td>
            <td>Rs. {{ $mrp }} /-</td>
        </tr>
        <tr>
            <td>Expiration Date</td>
            <td>
                &nbsp;
                {{ $expiry }}
            </td>
            <td>Previous Due</td>
            <td> Rs {{ $balance  }} /-
            </td>
        </tr>
        <tr>
            <td colspan="2">Notes: {{ $notes }}</td>
            <td colspan="1">Total</td>
            <td><b style="text-align: center; text-align: right"> Rs {{ $total }} /-</b></td>
        </tr>
    </table>
    <hr>
    <ul style="margin:0">
        <li><b style="margin:0 0 2px 0;padding:0;font-size:1.5em">Helpline Number :
                8454965547
            </b>[Send Payment Screenshot Here]</li>
        <li style="margin:5px 0;"><b>Please avoid calling / delete any other numbers as some are wrong or belong to
                person who has left the firm</b></li>
        <li style="margin:5px 0;">For any grievance regarding staff please WhatsApp on 9773991234 </li>
        <li style="margin:5px 0;">For Billing Queries / to submit proof of payment / Request Cash Pickup -> WhatsApp on
            8454965547 </li>
        <li style="margin:5px 0;"><b>PLEASE PAY ONLINE ONLY, If any billing issue please inform via WhatsApp on
                8454965547 </b></li>
        <li style="margin:5px 0;">For Online Payment Details see below or visit http://pay.exits.in</li>
        <li style="margin:5px 0;"><b>Pay USD/Euro get 5% discount</b></li>
        {{-- <li style="margin:5px 0;"><b>WhatsApp Numbers have incoming blocked, kindly use WhatsApp only to message</b></li> --}}
        <li style="margin:5px 0;">
            <h2 style="margin: 2px 0 2px 0;padding:0;">
                PAYMENT DUE DATE >>>
                {{ $due_date }}
            </h2>
        </li>
    </ul>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%">
        <tr style="height: 200px;vertical-align: top;">
            <td colspan="" style="height: 60px;vertical-align: top;background-color: #fff; text-align: center">
                <b>PAYTM:</b> <br><br>
                <img src="{{ url('public/paytm.jpg') }}" style="width: 200px; height: 200px; ">
            </td>
            <td colspan="" style="height: 60px;vertical-align: top;background-color: #fff; text-align: center"><b>BHIM
                    UPI:</b> <br> <br>
                <img src="{{ url('public/bhim.jpg') }}" style="width: 200px; height: 240px; "></td>
            <td colspan="" style="height: 60px;vertical-align: top;background-color: #fff; text-align: center"><b> NEFT
                    IMPS: </b><br><br> UNION BANK OF INDIA
                <hr>
                SAVINGS A/C:<br> Antonius Carvalho
                <hr>
                A/C No:<br> 623302010005145
                <hr>
                Branch:<br> Vartak Nagar Thane
                <hr>
                IFSC:<br> UBIN0562335</td>
        </tr>
    </table>
    <div class="page-break"></div>
    <?php $i++; ?>