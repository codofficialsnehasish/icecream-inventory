<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        @page { margin: 0;}
    </style>
</head>
<body style="font-family: Arial, sans-serif; width: 1.9in; margin: 0; padding: 5px;">

    <div style="text-align: center; margin-bottom: 10px;">
        <h2 style="margin: 0; font-size: 14px;">{{ $bill_settings->company_name }}</h2>
        <p style="margin: 2px 0; font-size: 10px;">{{ $bill_settings->company_address }}</p>
        <p style="margin: 0; font-size: 10px;">{{ $bill_settings->company_phone }}</p>
    </div>

    <div style="font-size: 10px; margin-bottom: 10px;">
        @if(!empty($bill_settings->gstin))
        <p style="margin: 0; text-align: center;">GSTIN: <strong>{{ $bill_settings->gstin }}</strong></p>
        @endif
        @if(!empty($bill_settings->fssai_license))
        <p style="margin: 0; text-align: center;">FSSAI License: <strong>{{ $bill_settings->fssai_license }}</strong></p>
        @endif
    </div>

    <hr style="border: 1px dashed #000; margin: 5px 0;">

    <div style="font-size: 10px; margin-bottom: 10px;">
        <p style="margin: 0; text-align: left;"><strong>Customer Details</strong></p>
        <p style="margin: 0; text-align: left;">Owner Name: <strong>{{ $customer_details->owner_name }}</strong></p>
        <p style="margin: 0; text-align: left;">Phone: <strong>{{ $customer_details->whatsapp_number }}</strong></p>
        <p style="margin: 0; text-align: left;">Address: <strong>{{ $customer_details->address }}</strong></p>
    </div>

    <hr style="border: 1px dashed #000;">

    <div style="font-size: 10px;">
        <p style="margin: 0; text-align: left;">Order #: <strong>{{ $order->order_number }}</strong></p>
        <p style="margin: 0; text-align: left;">Date: <strong>{{ format_datetime($order->created_at) }}</strong></p>
    </div>

    <hr style="border: 1px dashed #000; margin: 5px 0;">

    <div style="font-size: 10px;">
        <table style="width: 100%; font-size: 10px;">
            <tr>
                <th style="text-align: left;">Item</th>
                <th style="text-align: right;">Qty</th>
                <th style="text-align: right;">Price</th>
            </tr>
            @foreach($order_items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td style="text-align: right;">{{ $item->quantity }}</td>
                <td style="text-align: right;">{{ $item->price * $item->box_quantity * $item->quantity }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <hr style="border: 1px dashed #000; margin: 5px 0;">

    <div style="font-size: 10px;">
        <p style="margin: 0; text-align: right;">Subtotal: {{ $order->sub_total }}</p>
        <p style="margin: 0; text-align: right;">Discount: {{ $order->discount }}</p>
        @if($bill_settings->is_tax_show == 1)
        <p style="margin: 0; text-align: right;">Tax: {{ $order->gst }}</p>
        @endif
        <p style="margin: 0; text-align: right;font-size: 12px;"><strong>Total: {{ $order->grand_total }}</strong></p>
    </div>

    <hr style="border: 1px dashed #000; margin: 5px 0;">

    <div style="text-align: center; font-size: 10px; margin-top: 10px;">
        <p style="margin: 0;">Thank You</p>
        <p style="margin: 0;">Stay cool, and see you again soon!</p>
    </div>

</body>
</html>
