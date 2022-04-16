<?php
function history($day, $month, $monthnum, $yearr, $invoiceId, $invoiceStatus, $merchantName, $productImage, $productName, $quantity, $productPrice, $itemAmount, $totalCost, $invoiceId1, $invoiceId2){
    $element1="
    <div class=\"card\" style=\"box-shadow:0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);border:0;\">
                        <div class=\"card-body list-address\" style=\"padding-left:35px;padding-top:30px;\">
                            <div class=\"row\">
                                <div class=\"col-sm-9\"> 
                                    <p>
                                        <img src=\"image/small icons/invoice.png\" style=\"height:20px;width:20px;\">
                                        <b style=\"padding-left:10px;padding-right:10px;\">$day $month $yearr</b>
                                        ID: INV/TRE/$yearr$monthnum$day/000$invoiceId
                                        <small style=\"background-color:#2F86A6;color:white;padding:1px;border-radius:5px;margin-left:3px;padding-left:4px;padding-right:4px;\">$invoiceStatus</small>
                                    </p>
                                    <p>
                                        <img src=\"image/small icons/store.png\" style=\"height:20px;width:20px;\">
                                        <b style=\"padding-left:10px;padding-right:10px;\">$merchantName</b>
                                    </p>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"d-flex align-items-start\">
                                    <div class=\"frame\">
                                        <img src=\"$productImage\" class=\"mb-0 product-display\">
                                    </div>
                                    <p class=\"float-left\" style=\"padding-left:25px;\">
                                        <b>$productName</b> $quantity
                                        <br>
                                        Rp. ".number_format($productPrice). "
                                        <br><br>
                                        + $itemAmount Other Products
                                    </p>
                                    <div class=\"ml-auto p-2\">
                                        <p class=\"text-secondary\" style=\"padding-right:2rem;\">
                                            Total Harga
                                        </p>
                                        <p style=\"padding-right:2rem;\">
                                            <b>Rp. ".number_format($totalCost). "</b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class=\"row\">
                                <div class=\"align-items-end text-center\" style=\"padding-right:2rem;\">
                                    <div class=\"float-right\">
                                        <form action=\"order again.php\" method=\"post\">
                                            <input type=\"hidden\" name=\"invoiceID\" value=\"$invoiceId1\" >
                                            <input type=\"submit\" value=\"Pesan Ulang\" data-toggle=\"modal\" class=\"but-ton\">
                                        </form>
                                    </div>
                                    <div class=\"float-right\" style=\"padding-right:8px;\">
                                        <button type=\"button\" data-target=\"#myModal$invoiceId2\" data-toggle=\"modal\" class=\"but-ton detail\">
                                            Detail Transaksi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>";
                    echo $element1;
}

function detail_up($historyId){
    $element_up="
    <div class=\"modal fade\" id=\"myModal$historyId\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">
        <div class=\"modal-dialog modal-dialog-centered\" role=\"document\" style=\"max-width:40rem;\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <h5 class=\"modal-title\" id=\"exampleModalLongTitle\">Detail Transaksi</h5>
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                <div class=\"modal-body\">
            </div>
    ";
    echo $element_up;
}

function detail1($productImage, $productName, $productQuantity, $productUnit, $productPrice, $totalPrice){
    $element_detail1="
    <!--************TRANSACTION DETAIL START************-->
    <div class=\"modal-body\" style=\"padding-left:30px;padding-right:35px;\">
        <div class=\"card w-85\" style=\"box-shadow:0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);border:0;padding:10px;\">
            <div class=\"card-body\">
                <div class=\"row\">
                    <div class=\"d-flex align-items-start\">
                        <div class=\"frame-det\">
                            <img src=\"$productImage\" class=\"mb-0 product-display\">
                        </div>
                        <p class=\"float-left\" style=\"padding-left:25px;\">
                            <b>$productName</b> <i>$productQuantity $productUnit</i>
                            <br>
                            Rp. ".number_format($productPrice). "
                        </p>
                        <div class=\"ml-auto p-2\">
                            <p class=\"text-secondary\" style=\"padding-right:0.5rem;\">
                                Total Harga
                            </p>
                            <p style=\"padding-right:2rem;\">
                                <b>Rp. ".number_format($totalPrice). "</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>";
    echo $element_detail1;
}
function detail2($invoiceKurir, $invoiceNama, $invoiceHp, $invoiceAlamat, $invoiceProvinsi, $invoiceKabupaten, $totalCost, $invoiceOngkir, $totalPurchase, $invoiceStatus){
    $element_detail2="
    <hr style=\"border: 5px solid lightgrey;background-color:lightgrey;\">
    <div class=\"modal-body\" style=\"padding-left:30px;padding-right:35px;height:16rem;\">
        <h5>Status dan Pengiriman</h5>
        <div class=\"row\">
            <div class=\"col-sm-3\">
                Kurir  :
            </div>
            <div class=\"col-sm-9\">
                $invoiceKurir
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-sm-3\">
                Alamat :
            </div>
            <div class=\"col-sm-9\">
                <p>
                    <b>$invoiceNama</b><br>
                    $invoiceHp<br>
                    $invoiceAlamat $invoiceProvinsi<br>
                    $invoiceKabupaten
                </p>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-sm-3\">
                Status Pesanan :
            </div>
            <div class=\"col-sm-9\">
                $invoiceStatus
            </div>
        </div>
    </div>
    <hr style=\"border: 5px solid lightgrey;background-color:lightgrey;\">
    <div class=\"modal-body\" style=\"padding-left:30px;padding-right:35px;\">
        <h5>Detail Pembayaran</h5>
        <div class=\"row\">
            <div class=\"col-sm-3\">
                Metode Pembayaran                                        
            </div>
            <div class=\"col-sm-9 d-flex justify-content-end\">
                Bank Transfer
            </div>
        </div>
        <hr style=\"height:1px;background-color:lightGrey;\">
        <div class=\"row\">
            <div class=\"col-sm-3\">
                Total Harga                                          
            </div>
            <div class=\"col-sm-9 d-flex justify-content-end\">
                Rp. ".number_format($totalCost). "
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-sm-3\">
                <h7>Ongkos Kirim</h7>                                            
            </div>
            <div class=\"col-sm-9 d-flex justify-content-end\">
                Rp. ".number_format($invoiceOngkir). "
            </div>
        </div> 
        <hr style=\"height:.5px;background-color:lightGrey;\">                                   
        <div class=\"row\">
            <div class=\"col-sm-3\">
                <b>Total Belanja</b>                                           
            </div>
            <div class=\"col-sm-9 d-flex justify-content-end\">
                <b>Rp. ".number_format($totalPurchase). "</b>
            </div>
        </div>
    </div>
    <!--***********TRANSACTION DETAIL END***********-->
    ";
    echo $element_detail2;
}
function detail_down(){
    $element_down="</div></div></div>";
    echo $element_down;
}

?>