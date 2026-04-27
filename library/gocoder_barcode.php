<html>
<head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="jquery-barcode.js"></script>
</head>
<body>

<div id="bcTarget"></div>
</body>

<script type="text/javascript">
    $("#bcTarget").barcode("1234567890128", "codabar");

    //    바코드 타입    
    //    codabar
    //    code11 (code 11)
    //    code39 (code 39)
    //    code93 (code 93)
    //    code128 (code 128)
    //    ean8 (ean 8)
    //    ean13 (ean 13)
    //    std25 (standard 2 of 5 - industrial 2 of 5)
    //    int25 (interleaved 2 of 5)
    //    msi
    //    datamatrix (ASCII + extended)
</script>

</html>