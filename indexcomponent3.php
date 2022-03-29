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
              <form action=\"\" class=\"form-submit\">
              <input type=\"hidden\" class=\"pid\" value=\"$productid\">
              <input type=\"hidden\" class=\"pname\" value=\"$productname\">
              <input type=\"hidden\" class=\"pprice\" value=\"$productpprice\">
              <input type=\"hidden\" class=\"pimage\" value=\"$productimg\">
              <input type=\"hidden\" class=\"pamount\" value=\"$productamount\">
              <input type=\"hidden\" class=\"punit\" value=\"$productunit\">
              <input type=\"hidden\" class=\"pquantity\" value=\"$productquantity\">
              <div class=\"text-center\">
                <input type=\"submit\" id=\"add\" value=\"Add to cart\" class=\"btn mt-auto addItemBtn\">
              </div>
              </form>
          </div>
      </div>
  </div>
  ";
  echo $element;
}

/*function cartElement($productimg, $productname, $productprice, $productid){
  $element = "
  <form action=\"Cart.php?action=remove&product_id=$productid\" method=\"post\" class=\"cart-items\">
    <div class=\"\">
      <div class=\"row bg-white\">
        <div class=\"col-md-3 pl-0\">
          <img src=\"$productimg\" class=\"img-fluid\">
        </div>
        <div class=\"col-md-6\">
          <h5 class=\"pt-2\">$productname</h5>
          <small class=\"text-secondary\">Seller</small>
          <h5 class=\"pt-2\">Rp $productprice</h5>
          <button type=\"submit\" class=\"\">Buy now</button>
          <button type=\"submit\" class=\"\" name=\"remove\">Remove</button>
        </div>
        <div class=\"col-md-3 py-5\">
          <div>
            <button type=\"button\" class=\"btn spinner\"><i class=\"fas fa-minus\"></i></button>
            <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
            <button type=\"button\" class=\"btn spinner\"><i class=\"fas fa-plus\"></i></button>
          </div>
        </div>
      </div>
    </div>
  </form>
  ";
  echo $element;
}

function cartElement($productimg, $productname, $productprice, $productid){
  $element = "
  <form action=\"Cart.php?action=remove&product_id=$productid\" method=\"post\" class=\"cart-items\">
  <table>
    <tr>
      <th><img class= \"img-cart\" src=\"$productimg\"></th>
      <th><h6 class=\"pt-2\">$productname</h6></th>
      <th><h6 class=\"pt-2\">Rp $productprice</h6></th>
      <th><input class=\"input jumlah\" id=\"myNumber\" value=\"1\" type=\"number\" min=\"1\"></th>
      <th><h6 class=\"pt-2\">Rp $productprice</h6></th>
    </tr>
  </table>
  </form>
  ";
  echo $element;
}/*
