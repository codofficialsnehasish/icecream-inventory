<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .receipt-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt-details {
            margin-bottom: 20px;
        }
        .receipt-details th, .receipt-details td {
            padding: 8px 12px;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="m-5">
    <button class="btn btn-success print-button" onclick="window.print();">Print</button>
</div>
<div class="container receipt-container">
    <div class="receipt-header">
        <h4>Payment Receipt</h4><br>
        <p><strong>Receipt #: </strong>{{ $receipt_number }}</p>
        <p><strong>Date: </strong>{{ formated_date($policyPaymentMode->payment_date) }}</p>
    </div>
    <div class="receipt-details">
        <table class="table table-bordered">
            <tr>
                <th>Customer ID</th>
                <td>{{ $customers->customer_id }}</td>
            </tr>
            <tr>
                <th>Customer Name</th>
                <td>{{ $customers->name }}</td>
            </tr>
            <tr>
                <th>Policy Number</th>
                <td>{{$policyPaymentMode->policy_number}}</td>
            </tr>
            <tr>
                <th>Premium Amount</th>
                <td>{{ $policyPaymentMode->amount }}</td>
            </tr>
            <tr>
                <th>Payment Mode</th>
                <td>{{ get_name('payment_modes',$policyPaymentMode->payment_mode) }} @if(get_name('payment_modes',$policyPaymentMode->payment_mode) == 'Cheque' || get_name('payment_modes',$policyPaymentMode->payment_mode) == 'Online') (Ref - {{$policyPaymentMode->refference_number}}) @endif</td>
            </tr>
            <tr>
                <th>Remarks</th>
                <td>{{ $policyPaymentMode->remarks }}</td>
            </tr>
        </table>
    </div>
    <div class="receipt-footer text-center">
        <p>Thank you for your payment!</p>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>