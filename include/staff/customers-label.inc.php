<?php
if (!defined('OSTSCPINC') || !$thisstaff) die('Access Denied');
$info = Format::htmlchars(($errors && $_POST) ? $_POST : $customers_info);
?>


<html>

<head>
    <link rel="stylesheet" href="./css/scp.css" media="screen">
</head>

<body onload="window.resizeTo(500,450)">
    <div id="printableArea">
        <table style="font-family:arial; ">

            <tr>
                <td>
                    <h2 style="color: black;"><b>Deliver TO:</b></h2>
                </td>
            </tr>

            <tr>
                <td><?php echo $info['company'] ?></td>
            </tr>
            <tr>
                <td><?php echo $info['name'] ?></td>
            </tr>
            <tr>
                <td><?php echo $info['address'] ?></td>
            </tr>
            <tr>
                <td><?php echo $info['suburb'] . " " . $info['state'] . " " . $info['postcode'] ?></td>
            </tr>
        </table>

        <hr />

        <table style="font-family:arial; font-size:13px;" align="right">
                <tr>
                    <td></td>
                    <td align="left"><b>Sent From:</b></td>
                </tr>
                <tr>
                <td rowspan="5"><img src="../scp/images/uc8.png" height="80" width="100"></td>
                    <td align="left">UC8 Australia Pty Ltd</td>
                </tr>
                <tr>
                    <td align="left">Level 5</td>
                </tr>
                <tr>
                    <td align="left">131 Wickham Terrace</td>
                </tr>
                <tr>
                    <td align="left">Brisbane QLD 4000</td>
                </tr>
            </table>
    </div>
    <div style="position: absolute; bottom: 120px;margin-left:20px;" align="left">
        <input type="button" onclick="printDiv('printableArea')" value="Print Shipping Label" />
    </div>

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>