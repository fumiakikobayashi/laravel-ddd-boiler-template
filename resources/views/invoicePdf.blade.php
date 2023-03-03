<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>請求書</title>
    <style>
        @font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/ipag.ttf')}}');
        }

        body {
            font-family: ipag !important;
        }

        /* 要素の初期化 */
        * {
            /* マージン・パディングをリセットした方がデザインしやすい */
            margin: 0;
            padding: 0;
            /* デフォルトのフォント */
            color: #151515;
            font-size: 11pt;
            font-weight: normal;
            /* 背景色・背景画像を印刷する（Chromeのみで有効） */
            -webkit-print-color-adjust: exact;
        }

        /* ページレイアウト (section.sheet を１ページとする) */
        .sheet {
            overflow: visible;
            position: relative;
            box-sizing: border-box;
            page-break-after: always;

            /* 用紙サイズ A4 */
            height: 297mm;
            width: 210mm;

            /* 余白サイズ */
            padding-top: 32mm;
            padding-left: 20mm;
            padding-right: 20mm;
        }

        .flex-container {
            display: flex;
        }

        ul {
            list-style: none;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .title-background {
            background-color: black;
        }

        .title {
            font-size: 1.4rem;
            color: white;
            margin-bottom: 30px;
        }

        .client {
            width: 55%;
            border-bottom: 1px black solid;
            margin-bottom: 5px;
        }

        .subject {
            width: 55%;
            border-bottom: 1px black dotted;
            margin-bottom: 60px;
        }

        .billing-date {
            border-bottom: 1px black solid;
            margin-bottom: 10px;
        }

        .delivery-date {
            border-bottom: 1px black solid;
            margin-bottom: 10px;
        }

        .total {
            border-bottom: 1px black solid;
            margin-bottom: 10px;
        }

        .client-name {
            text-align: center;
            font-size: 1.1rem;
        }

        .client-name {
            width: 90%;
        }

        .base {
            width: 45%;
            margin-bottom: 50px;
        }

        .base-title {
            width: 40%;
            display: flex;
            align-items: center;
        }

        .total-price {
            font-size: 1.4rem;
        }

        .myself-company {
            flex-grow: 1;
        }

        .myself-company-items {
            margin-left: 100px;
        }

        .myself-company-item {
            margin-bottom: 5px;
        }

        .item-table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .item-table th {
            border-bottom: 2px black solid;
        }

        .item-table td {
            border-bottom: 1px #a1a1a1 solid;
            text-align: right;
            padding-right: 10px;
        }

        .item-table .product-name {
            text-align: left;
            padding-left: 10px;
        }

        .item-table tr {
            height: 30px;
        }

        .remark {
            margin-top: 20px;
            min-width: 50%;
        }

        .item-table-tail {
            border-collapse: collapse;
            width: 100%;
        }

        .item-table-tail {
            border-collapse: collapse;
            width: 100%;
        }

        .item-table-tail td {
            border-bottom: 1px black solid;
            height: 25px;
        }

        .item-table-tail-title {
            padding-left: 10px;
        }

        .item-table-tail-price {
            text-align: right;
            padding-right: 10px;
        }

    </style>
    <link href="../css/pdfInvoice.css" rel="stylesheet" type="text/css">
</head>
<body>
<section class="sheet">
    <div class="title-background">
        <h1 class="text-center title">請求書</h1>
    </div>
    <div>
        <div class="client">
            <div class="flex-container">
                <div class="client-name flex-item">{{$client['client_name']}}</div>
                <div class="flex-item">御中</div>
            </div>
        </div>
        <div class="subject">
            <div class="flex-container">
                <div class="flex-item">内容：</div>
                <div class="flex-item">{{$subject}}</div>
            </div>
        </div>
    </div>

    <div class="flex-container">
        <div class="flex-item base">
            <div class="billing-date">
                <div class="flex-container">
                    <div class="base-title flex-item">請求日：</div>
                    <div style="flex-grow: 1;" class="flex-item text-center">{{$billing_date}}</div>
                </div>
            </div>
            <div class="delivery-date">
                <div class="flex-container">
                    <div class="base-title flex-item">お支払期限：</div>
                    <div style="flex-grow: 1;" class="flex-item text-center">{{$payment_due}}</div>
                </div>
            </div>
            <div class="total">
                <div class="flex-container">
                    <div class="base-title flex-item">税込合計金額：</div>
                    <div style="flex-grow: 1;" class="flex-item text-center total-price">￥{{ number_format($sum) }}</div>
                </div>
            </div>
        </div>
        <div class="flex-item myself-company">
            <ul class="myself-company-items">
                <li class="text-right myself-company-item">株式会社廣箸</li>
                <li class="text-right myself-company-item">中磯まき子</li>
                <li class="text-left myself-company-item">〒 638-0045</li>
                <li class="text-left myself-company-item">奈良県吉野郡下市町新住558</li>
                <li class="text-left myself-company-item">Tel 0747-52-1684</li>
            </ul>
        </div>
    </div>

    <p>下記のとおりご請求申し上げます。</p>

    <div>
        <table class="item-table">
            <thead>
            <tr>
                <th class="item">品名</th>
                <th class="unit_price">単価</th>
                <th class="amount">数量</th>
                <th class="subtotal">金額</th>
            </tr>
            </thead>
            <tbody>
            @foreach($trading_details as $trading_detail)
                <tr class="data-line">
                    <td class="product-name">{{$trading_detail['item']['product_name']}}</td>
                    <td>{{$trading_detail['quantity']}}</td>
                    <td>{{ number_format($trading_detail['item']['unit_price']) }}</td>
                    <td>{{ number_format($trading_detail['actual_unit_price'] * $trading_detail['quantity']) }}</td>
                </tr>
            @endforeach
            @if(count($trading_details) < 10)
                @for($i= 0; $i < (10 - count($trading_details)); $i++)
                    <tr class="data-line">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endfor
            @endif
            </tbody>
        </table>
    </div>

    <div class="flex-container">
        <div class="flex-item remark">
            {!! nl2br(e($remark)) !!}
        </div>
        <div style="flex-grow: 1;" class="flex-item">
            <table class="item-table-tail">
                <tr>
                    <td class="item-table-tail-title">小計</td>
                    <td class="item-table-tail-price">{{ number_format($subtotal) }}</td>
                </tr>
                <tr>
                    <td class="item-table-tail-title">消費税額</td>
                    <td class="item-table-tail-price">{{ number_format($consumption_tax) }}</td>
                </tr>
                <tr>
                    <td class="item-table-tail-title">合計</td>
                    <td class="item-table-tail-price">{{ number_format($sum) }}</td>
                </tr>
            </table>
        </div>
    </div>
</section>
</body>
</html>
