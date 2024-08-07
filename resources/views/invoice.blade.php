<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link rel="stylesheet" href="{{ public_path('invoice.css') }}" type="text/css"> 
        <style>
            body{
                font-family: system-ui, system-ui, sans-serif;
            }
            table{
                border-spacing: 0;
            }
            table td, table th, p{
                font-size: 13px !important;
            }
            img{
                border: 3px solid #F1F5F9;
                padding: 6px;
                background-color: #F1F5F9;
            }
            .table-no-border{
                width: 100%;
            }
            .table-no-border .width-50{
                width: 50%;
            }
            .table-no-border .width-70{
                width: 70%;
                text-align: left;
            }
            .table-no-border .width-30{
                width: 30%;
            }
            .margin-top{
                margin-top: 40px;
            }
            .product-table{
                margin-top: 20px;
                width: 100%;
                border-width: 0px;
            }
            .product-table thead th{
                background-color: #60A5FA;
                color: white;
                padding: 5px;
                text-align: left;
                padding: 5px 15px;
            }
            .width-20{
                width: 20%;
            }
            .width-50{
                width: 50%;
            }
            .width-25{
                width: 25%;
            }
            .width-70{
                width: 70%;
                text-align: right;
            }
            .product-table tbody td{
                background-color: #F1F5F9;
                color: black;
                padding: 5px 15px;
            }
            .product-table td:last-child, .product-table th:last-child{
                text-align: right;
            }
            .product-table tfoot td{
                color: black;
                padding: 5px 15px;
            }
            .footer-div{
                background-color: #F1F5F9;
                margin-top: 100px;
                padding: 3px 10px;
            }
        </style>
    </head>
    <body>
        <table class="table-no-border">
            <tr>
                <td class="width-70">
                    <img src="{{ public_path('download.jpg') }}" alt="" width="200" />
                </td>
                <td class="width-30">
                    <h2>Invoice ID: 9584525</h2>
                </td>
            </tr>
        </table>
    
        <div class="margin-top">
            <table class="table-no-border">
                <tr>
                    <td class="width-50">
                        <div><strong>To:</strong></div>
                        <div>Mark Gadala</div>
                        <div>1401 NW 17th Ave, Florida - 33125</div>
                        <div><strong>Phone:</strong> (305) 981-1561</div>
                        <div><strong>Email:</strong> mark@gmail.com</div>
                    </td>
                    <td class="width-50">
                        <div><strong>From:</strong></div>
                        <div>Hardik Savani</div>
                        <div>201, Styam Hills, Rajkot - 360001</div>
                        <div><strong>Phone:</strong> 84695585225</div>
                        <div><strong>Email:</strong> hardik@gmail.com</div>
                    </td>
                </tr>
            </table>
        </div>
    
        <div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th class="width-25">
                            <strong>Qty</strong>
                        </th>
                        <th class="width-50">
                            <strong>Product</strong>
                        </th>
                        <th class="width-25">
                            <strong>Price</strong>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $value)
                    <tr>
                        <td class="width-25">
                            {{ $value['quantity'] }}
                        </td>
                        <td class="width-50">
                            {{ $value['description'] }}
                        </td>
                        <td class="width-25">
                            {{ $value['price'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="width-70" colspan="2">
                            <strong>Sub Total:</strong>
                        </td>
                        <td class="width-25">
                            <strong>$1000.00</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="width-70" colspan="2">
                            <strong>Tax</strong>(10%):
                        </td>
                        <td class="width-25">
                            <strong>$100.00</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="width-70" colspan="2">
                            <strong>Total Amount:</strong>
                        </td>
                        <td class="width-25">
                            <strong>$1100.00</strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    
        <div class="footer-div">
            <p>Thank you, <br/>@ItSolutionStuff.com</p>
        </div>
    
    </body>
</html>