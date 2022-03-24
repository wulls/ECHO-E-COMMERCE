<!DOCTYPE html>
<html lang="en">
<head>
  <title>Trolley</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/carousel.css" rel="stylesheet" />
</head>
<body>

  <div class="carousel-container">
  <div class="carousel my-carousel carousel--translate">
    <input class="carousel__activator" type="radio" name="carousel" id="F" checked="checked"/>
    <input class="carousel__activator" type="radio" name="carousel" id="G"/>
    <input class="carousel__activator" type="radio" name="carousel" id="H"/>
    <input class="carousel__activator" type="radio" name="carousel" id="I"/>
    <input class="carousel__activator" type="radio" name="carousel" id="J"/>
    <div class="carousel__controls">
      <label class="carousel__control carousel__control--backward" for="J"></label>
      <label class="carousel__control carousel__control--forward" for="G"></label>
    </div>
    <div class="carousel__controls">
      <label class="carousel__control carousel__control--backward" for="F"></label>
      <label class="carousel__control carousel__control--forward" for="H"></label>
    </div>
    <div class="carousel__controls">
      <label class="carousel__control carousel__control--backward" for="G"></label>
      <label class="carousel__control carousel__control--forward" for="I"></label>
    </div>
    <div class="carousel__controls">
      <label class="carousel__control carousel__control--backward" for="H"></label>
      <label class="carousel__control carousel__control--forward" for="J"></label>
    </div>
    <div class="carousel__controls">
      <label class="carousel__control carousel__control--backward" for="I"></label>
      <label class="carousel__control carousel__control--forward" for="F"></label>
    </div>
    <div class="carousel__track">
      <li class="carousel__slide">
        <!--h1>F</h1-->
      </li>
      <li class="carousel__slide">
        <!--h1>G</h1-->
      </li>
      <li class="carousel__slide">
        <!--h1>H</h1-->
      </li>
      <li class="carousel__slide">
        <!--h1>I</h1-->
      </li>
      <li class="carousel__slide">
        <!--h1>J</h1-->
      </li>
    </div>
    <div class="carousel__indicators">
      <label class="carousel__indicator" for="F"></label>
      <label class="carousel__indicator" for="G"></label>
      <label class="carousel__indicator" for="H"></label>
      <label class="carousel__indicator" for="I"></label>
      <label class="carousel__indicator" for="J"></label>
    </div>
  </div>
</div>

</body>
</html>
