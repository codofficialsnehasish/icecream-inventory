<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Receipt</title>
    <style type="text/css"> 
        *{
            margin:0; 
            padding:0; 
            text-indent:0; 
        }
        .s1 { 
            color: #E82DB5; 
            font-family:Cambria, serif; 
            font-style: italic; 
            font-weight: normal; 
            text-decoration: none; 
            font-size: 12.5pt; 
        }
        p { 
            color: black; 
            font-family:Cambria, serif; 
            font-style: italic; 
            font-weight: normal; 
            text-decoration: none; 
            font-size: 9pt; 
            margin:0pt; 
        }
        .s8 { 
            color: #DD1D44; 
            font-family:Cambria, serif; 
            font-style: italic; 
            font-weight: normal; 
            text-decoration: none; 
            font-size: 8.5pt; 
        }
        .s9 { 
            color: #CD0E44; 
            font-family:Cambria, serif; 
            font-style: italic; 
            font-weight: normal; 
            text-decoration: none; 
            font-size: 8.5pt; 
        }
        .s11 { 
            color: #E2365E; 
            font-family:Cambria, serif; 
            font-style: normal; 
            font-weight: normal; 
            text-decoration: none; 
            font-size: 8pt; 
        }
        .s15 { 
            color: #D42B54; 
            font-family:Cambria, serif; 
            font-style: italic; 
            font-weight: normal; 
            text-decoration: none; 
            font-size: 8.5pt; 
        }
        .s20 { 
            color: #CD233D; 
            font-family:Cambria, serif; 
            font-style: italic; 
            font-weight: normal; 
            text-decoration: none; 
            font-size: 8pt; 
        }
        table, tbody {
            vertical-align: top; 
            overflow: visible; 
        }
        .frds {
            float: left;
            width: 50%;
        }
        .frdss {
            width: 60%;
            margin: 0 auto;
            padding-left: 120px;
        }

        table.ae img {
            width: 100px;
        }
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <center>
        <table style="border-collapse:collapse;margin-left:6.055pt" cellspacing="0" width="800px;">
            <tbody>
                <tr>
                    <td colspan="5">
                        <p style="padding-top: 3pt;text-indent: 0pt;text-align: left;"><br></p>
                        <p class="s1" style="padding-left: 1pt;text-indent: 0pt;text-align: center;position: relative;">
                            <strong>SBI LIFE PREMIUM POINT</strong>
                            <span class="pr_int print-button" onclick="window.print();" style="position: absolute;right: 0;color: #000;text-transform: uppercase;font-style: normal;font-weight: bold;border: 1px solid #000;font-size: 12px;padding: 6px 10px;cursor: pointer;">Print</span>
                        </p>
                        <p style="padding-top: 13pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                            <b>KASHINAGAR BAS STAND, SOUTH 24 PGS , PIN 743349</b>
                        </p>
                        <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;"><br></p>
                        <p style="padding-left: 1pt;text-indent: 0pt;text-align: center;"></p>
                        <div class="frdss">
                            <div class="frds">
                                NAME — {{ $customer_name }}
                            </div>
                            <div class="frds">
                                CUSTOMER ID — {{ $customer_id }}
                            </div>
                        </div>
                        <p style="float: left;width: 100%;padding: 10px 0;text-align: center;font-size: 16px;color: #ff0000;">Money Recived</p>
                    </td>
                </tr>
                <tr style="height:12pt">
                    <td style="width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        <p class="s8" style="padding-left: 2pt;text-indent: 0pt;line-height: 9pt;text-align: center;">DATE</p>
                    </td>
                    <td style="width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        <p class="s9" style="padding-left: 28pt;text-indent: 0pt;line-height: 9pt;text-align: left;">NARATION</p>
                    </td>
                    <td style="width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        <p class="s11" style="padding-left: 4pt;text-indent: 0pt;line-height: 9pt;text-align: center;">DEBIT</p>
                    </td>
                    <td style="width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        <p class="s15" style="padding-left: 4pt;text-indent: 0pt;line-height: 9pt;text-align: center;">CERDIT</p>
                    </td>
                    <td style="width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        <p class="s20" style="padding-left: 14pt;text-indent: 0pt;line-height: 9pt;text-align: left;">CLOSING BALANCE</p>
                    </td>
                </tr>
                @foreach($statements as $statement)
                <tr style="height:11pt">
                    <td style="padding:10px;width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        {{ formated_date($statement['date']) }}
                    </td>
                    <td style="padding:10px;width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        {{ $statement['narration'] }}
                    </td>
                    <td style="padding:10px;width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        {{ $statement['debit'] }}
                    </td>
                    <td style="padding:10px;width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        {{ $statement['credit'] }}
                    </td>
                    <td style="padding:10px;width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        {{ $statement['closing_balance'] }}
                    </td>
                </tr>
                @endforeach
                <!-- <tr style="height:82pt">
                    <td style="width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        <p style="text-indent: 0pt;text-align: left;"><br></p>
                    </td>
                    <td style="width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        <p style="text-indent: 0pt;text-align: left;"><br></p>
                    </td>
                    <td style="width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        <p style="text-indent: 0pt;text-align: left;"><br></p>
                    </td>
                    <td style="width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        <p style="text-indent: 0pt;text-align: left;"><br></p>
                    </td>
                    <td style="width:20%; border-top-style:solid;border-top-width:1pt;border-top-color:#382F3B;border-left-style:solid;border-left-width:1pt;border-left-color:#382F3B;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#382F3B;border-right-style:solid;border-right-width:1pt;border-right-color:#382F3B">
                        <p style="text-indent: 0pt;text-align: left;"><br></p>
                    </td>
                </tr> -->
            </tbody>
        </table>
        <table class="ae" cellspacing="0" style="width: 800px;padding-top: 20px;">  
            <tbody>
                <tr>
                    <td style="text-align: left;padding: 10px;"><p>CUSTOMER SIGNATURE</p></td>
                    <td style="text-align: right;padding: 10px;font-size: 11px;font-style: italic;">RECIVING SIGNATURE</td>
                </tr>
            </tbody>
        </table>
    </center>
</body>
</html>