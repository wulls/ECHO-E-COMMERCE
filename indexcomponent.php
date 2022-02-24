<?php

/*function component($productname, $productprice, $productimg){
  $element="
  <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
    <form action=\"index.php\" method=\"post\">
      <div class=\"card shadow\">
        <div>
        <img src=\"$productimg\" alt=\"image\" class=\"card-img-top\">
        </div>
        <div class=\"card-body\">
          <h5 class=\"card-title\">$productname</h5>
          <p class=\"card-text\">
            Some text
          </p>
          <h5>
            <span class=\"price\">Rp $productprice</span>
          </h5>
          <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
        </div>
      </div>
    </form>
  </div>
  ";
  echo $element;
}*/

function component($productname, $productprice, $productimg, $productquantity, $productunit){
  $element="
  <div class=\"col-md-2 col-sm-6 my-3 my-md-2\">
      <div class=\"card h-100\">
          <img class=\"card-img-top\" src=\"$productimg\" alt=\"...\" />
          <div class=\"card-body p-4\">
              <div class=\"text-center\">
                  <div class=\"product\">
                  <h6 class=\"fw-bolder\">$productname</h6>
                  <small>$productquantity</small>
                  <small>$productunit</small>
                  </div>
                  <div class=\"price\">
                  Rp $productprice <br>
                  </div>
              </div>
          </div>
          <div class=\"card-footer p-2 pt-0 border-top-0 bg-transparent\">
              <div class=\"text-center\"><a class=\"btn mt-auto\" href=\"#\">Add to cart</a></div>
          </div>
      </div>
  </div>
  ";
  echo $element;
}
