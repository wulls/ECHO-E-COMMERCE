<?php

function component($productname, $productprice, $productimg, $productamount, $productunit, $productid, $productquantity, $productpprice){
  $element="
   <div class=\"col-md-2 col-sm-6 my-3 my-md-2\">
      <div class=\"card h-100\">
          <img class=\"card-img-top\" src=\"$productimg\" alt=\"...\" />
          <div class=\"card-body p-4\">
              <div class=\"text-center\">
                  <div class=\"product\">
                  <h6 class=\"fw-bolder\">$productname</h6>
                  <small>$productamount</small>
                  <small>$productunit</small>
                  </div>
                  <div class=\"price\">
                  Rp $productprice <br>
                  </div>
              </div>
          </div>
          <div class=\"card-footer p-2 pt-0 border-top-0 bg-transparent\">
              <form action=\"action.php\" class=\"form-submit\" method=\"post\">
              <input type=\"hidden\" name=\"pid\" class=\"pid\" value=\"$productid\">
              <input type=\"hidden\" name=\"pname\" class=\"pname\" value=\"$productname\">
              <input type=\"hidden\" name=\"pprice\" class=\"pprice\" value=\"$productpprice\">
              <input type=\"hidden\" name=\"pimage\" class=\"pimage\" value=\"$productimg\">
              <input type=\"hidden\" name=\"pamount\" class=\"pamount\" value=\"$productamount\">
              <input type=\"hidden\" name=\"punit\" class=\"punit\" value=\"$productunit\">
              <input type=\"hidden\" name=\"pquantity\" class=\"pquantity\" value=\"$productquantity\">
      			  <div class=\"text-center\">
      			     <input type=\"submit\" id=\"add\" value=\"+ Keranjang\" class=\"btn mt-auto addItemBtn\">
      			  </div>
              </form>
          </div>
      </div>
  </div>
  ";
  echo $element;
}

function componentKosong()
{
  $element = "
  <div class=\"col-md-2 col-sm-6 my-3 my-md-2\">
    <div class=\"card border-0\">

    </div>
  </div>
  ";
  echo $element;
}
