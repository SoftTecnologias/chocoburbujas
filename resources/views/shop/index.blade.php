@extends('layouts.master')

@section('title')
  Chocoburbujas: Estetica Canina, Boutique y Veterinaria 
@endsection
@section('content')
 <!-- Esta parte es la que siempre va a variar 
      Pero por ahora dejaré el index fijo 
 -->
    <div id="contenido">
      <div class="index_slider">
          <div class="container">
              <div class="callbacks_container">
                  <ul class="rslides" id="slider">
                      <li><img src="images/accesorios.png" class="img-responsive" alt="" /></li>
                      <li><img src="images/alimento.png" class="img-responsive" alt="" /></li>
                      <li><img src="images/pug.png" class="img-responsive" alt="" /></li>
                  </ul>
              </div>
          </div>
      </div>
      <div class="content_top">
          <div class="container">
              <div class="grid_1">
                  <div class="col-md-3">
                      <div class="box2">
                          <ul class="list1">
                              <i class="lock"> </i>
                              <li class="list1_right">
                                  <p>Hasta 5% en productos para perros</p>
                              </li>
                              <div class="clearfix"> </div>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="box3">
                          <ul class="list1">
                              <i class="clock1"> </i>
                              <li class="list1_right">
                                  <p>abierto de 8 am a 8 pm</p>
                              </li>
                              <div class="clearfix"> </div>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="box4">
                          <ul class="list1">
                              <i class="vehicle"> </i>
                              <li class="list1_right">
                                  <p>Servicio de recoleccion y entrega</p>
                              </li>
                              <div class="clearfix"> </div>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="box5">
                          <ul class="list1">
                              <i class="dollar"> </i>
                              <li class="list1_right">
                                  <p>Los mejores productos y servicios al mejor precio</p>
                              </li>
                              <div class="clearfix"> </div>
                          </ul>
                      </div>
                  </div>
                  <div class="clearfix"> </div>
              </div>  
              <div class="sellers_grid">
                  <ul class="sellers">
                      <i class="star"> </i>
                      <li class="sellers_desc">
                          <h2>Lo mas vendido</h2></li>
                      <div class="clearfix"> </div>
                  </ul>
              </div>
              <div class="grid_2">
                  <div class="col-md-3 span_6">
                      <div class="box_inner">
                          <img src="images/logo.png" class="img-responsive" alt="" />
                          <div class="sale-box"> </div>
                          <div class="desc">
                              <h3>Ullamcorper suscipit</h3>
                              <h4>178,90 $</h4>
                              <ul class="list2">
                                  <li class="list2_left"><span class="m_1"><a href="#" class="link">Añadir al carrito</a></span></li>
                                  <li class="list2_right"><span class="m_2"><a href="#" class="link1">ver más</a></span></li>
                                  <div class="clearfix"> </div>
                              </ul>
                              <div class="heart"> </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3 span_6">
                      <div class="box_inner">
                          <img src="images/logo.png" class="img-responsive" alt="" />
                          <div class="sale-box"> </div>
                          <div class="desc">
                              <h3>Ullamcorper suscipit</h3>
                              <h4>178,90 $</h4>
                              <ul class="list2">
                                  <li class="list2_left"><span class="m_1"><a href="#" class="link">Añadir al carrito</a></span></li>
                                  <li class="list2_right"><span class="m_2"><a href="#" class="link1">ver más</a></span></li>
                                  <div class="clearfix"> </div>
                              </ul>
                              <div class="heart"> </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3 span_6">
                      <div class="box_inner">
                          <img src="images/logo.png" class="img-responsive" alt="" />
                          <div class="sale-box"> </div>
                          <div class="desc">
                              <h3>Ullamcorper suscipit</h3>
                              <h4>178,90 $</h4>
                              <ul class="list2">
                                  <li class="list2_left"><span class="m_1"><a href="#" class="link">Añadir al carrito</a></span></li>
                                  <li class="list2_right"><span class="m_2"><a href="#" class="link1">ver más</a></span></li>
                                  <div class="clearfix"> </div>
                              </ul>
                              <div class="heart"> </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3 span_6">
                      <div class="box_inner">
                          <img src="images/logo.png" class="img-responsive" alt="" />
                          <div class="sale-box"> </div>
                          <div class="desc">
                              <h3>Ullamcorper suscipit</h3>
                              <h4>178,90 $</h4>
                              <ul class="list2">
                                  <li class="list2_left"><span class="m_1"><a href="#" class="link">Añadir al carrito</a></span></li>
                                  <li class="list2_right"><span class="m_2"><a href="#" class="link1">ver más</a></span></li>
                                  <div class="clearfix"> </div>
                              </ul>
                              <div class="heart"> </div>
                          </div>
                      </div>
                  </div>
                  <div class="clearfix"> </div>
              </div>
          </div>
      </div>
      <div class="content_middle">
          <div class="container">
              <ul class="promote">
                  <i class="promote_icon"> </i>
                  <li class="promote_head">
                      <h3>Promociones</h3></li>
              </ul>
              <ul id="flexiselDemo3">
                  <li><img src="images/logo.png" class="img-responsive" />
                      <div class="grid-flex">
                          <h4>Contrary to popular </h4>
                          <p>589,90 $</p>
                          <div class="m_3"><a href="#" class="link2">Añadir al carrito</a></div>
                          <div class="ticket"> </div>
                      </div>
                  </li>
                  <li><img src="images/logo.png" class="img-responsive" />
                      <div class="grid-flex">
                          <h4>Contrary to popular </h4>
                          <p>589,90 $</p>
                          <div class="m_3"><a href="#" class="link2">Añadir al carrito</a></div>
                          <div class="ticket"> </div>
                      </div>
                  </li>
                  <li><img src="images/logo.png" class="img-responsive" />
                      <div class="grid-flex">
                          <h4>Contrary to popular </h4>
                          <p>589,90 $</p>
                          <div class="m_3"><a href="#" class="link2">Añadir al carrito</a></div>
                          <div class="ticket"> </div>
                      </div>
                  </li>
                  <li><img src="images/logo.png" class="img-responsive" />
                      <div class="grid-flex">
                          <h4>Contrary to popular </h4>
                          <p>589,90 $</p>
                          <div class="m_3"><a href="#" class="link2">Añadir al carrito</a></div>
                          <div class="ticket"> </div>
                      </div>
                  </li>
                  <li><img src="images/logo.png" class="img-responsive" />
                      <div class="grid-flex">
                          <h4>Contrary to popular </h4>
                          <p>589,90 $</p>
                          <div class="m_3"><a href="#" class="link2">Añadir al carrito</a></div>
                          <div class="ticket"> </div>
                      </div>
                  </li>
              </ul>

              <script type="text/javascript" src="js/plugins/jquery.flexisel.js"></script>
              <script type="text/javascript">
                  $(window).on('load',function() {
                      $("#flexiselDemo3").flexisel({
                          visibleItems: 6,
                          animationSpeed: 1000,
                          autoPlay: true,
                          autoPlaySpeed: 3000,
                          pauseOnHover: true,
                          enableResponsiveBreakpoints: true,
                          responsiveBreakpoints: {
                              portrait: {
                                  changePoint: 480,
                                  visibleItems: 1
                              },
                              landscape: {
                                  changePoint: 640,
                                  visibleItems: 2
                              },
                              tablet: {
                                  changePoint: 768,
                                  visibleItems: 3
                              }
                          }
                      });

                  });
              </script>
          </div>
      </div>
      <div class="container">
          <div class="content_middle_bottom">
              <div class="col-md-4">
                  <ul class="spinner">
                      <i class="spinner_icon"> </i>
                      <li class="spinner_head">
                          <h3>Promoción del mes</h3></li>
                      <div class="clearfix"> </div>
                  </ul>
                  <div class="timer_box">
                      <div class="thumb"> </div>
                      <div class="timer_grid">
                          <ul id="countdown">
                          </ul>
                          <ul class="navigation">
                              <li>
                                  <p class="timeRefDays">DAYS</p>
                              </li>
                              <li>
                                  <p class="timeRefHours">HOURS</p>
                              </li>
                              <li>
                                  <p class="timeRefMinutes">MINUTES</p>
                              </li>
                              <li>
                                  <p class="timeRefSeconds">SECONDS</p>
                              </li>
                          </ul>
                      </div>
                      <div class="thumb_desc">
                          <h3> totam rem aperiam</h3>
                          <div class="price">
                              <span class="reducedfrom">$140.00</span>
                              <span class="actual">$120.00</span>
                          </div>
                      </div>
                      <a href="#">
                          <div class="m_3 deal">
                              <div class="link3">Adquirir esta promoción</div>
                          </div>
                      </a>
                  </div>
              </div>
              <div class="col-md-8">
                  <ul class="spinner">
                      <i class="paperclip"> </i>
                      <li class="spinner_head">
                          <h3>Recomendaciones Chocoburbujas</h3></li>
                      <div class="clearfix"> </div>
                  </ul>
                  <div class="a-top">
                      <div class="left-grid">
                          <img src="images//logo.png" class="img-responsive" alt="" />
                      </div>
                      <div class="right-grid">
                          <h4><a href="#">Duis autem vel eum iriure dolor in hendrerit</a></h4>
                          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat</p>
                      </div>
                      <div class="but">
                          <a class="arrow" href="#"> </a>
                      </div>
                      <div class="clearfix"></div>
                  </div>
                  <div class="a-top">
                      <div class="left-grid">
                          <img src="images//logo.png" class="img-responsive" alt="" />
                      </div>
                      <div class="right-grid">
                          <h4><a href="#">Duis autem vel eum iriure dolor in hendrerit</a></h4>
                          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat</p>
                      </div>
                      <div class="but">
                          <a class="arrow" href="#"> </a>
                      </div>
                      <div class="clearfix"></div>
                  </div>
                  <div class="a-top">
                      <div class="left-grid">
                          <img src="images//logo.png" class="img-responsive" alt="" />
                      </div>
                      <div class="right-grid">
                          <h4><a href="#">Duis autem vel eum iriure dolor in hendrerit</a></h4>
                          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat</p>
                      </div>
                      <div class="but">
                          <a class="arrow" href="#"> </a>
                      </div>
                      <div class="clearfix"></div>
                  </div>
                  <div class="a-top">
                      <div class="left-grid">
                          <img src="images//logo.png" class="img-responsive" alt="" />
                      </div>
                      <div class="right-grid">
                          <h4><a href="#">Duis autem vel eum iriure dolor in hendrerit</a></h4>
                          <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat</p>
                      </div>
                      <div class="but">
                          <a class="arrow" href="#"> </a>
                      </div>
                      <div class="clearfix"></div>
                  </div>
              </div>
              <div class="clearfix"></div>
          </div>
          <div class="content_bottom">
              <div class="col-md-3 span_1">
                  <ul class="spinner">
                      <i class="box_icon"> </i>
                      <li class="spinner_head">
                          <h3>mazim pla</h3></li>
                      <div class="clearfix"> </div>
                  </ul>
                  <img src="images//logo.png" class="img-responsive" alt="" />
              </div>
              <div class="col-md-3 span_1">
                  <ul class="spinner">
                      <i class="bubble"> </i>
                      <li class="spinner_head">
                          <h3>About Us</h3></li>
                      <div class="clearfix"> </div>
                  </ul>
                  <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl
                      ut aliquip ex ea commodo consequat</p>
              </div>
              <div class="col-md-3 span_1">
                  <ul class="spinner">
                      <i class="mail"> </i>
                      <li class="spinner_head">
                          <h3>Contact Us</h3></li>
                      <div class="clearfix"> </div>
                  </ul>
                  <ul class="social">
                      <li>
                          <a href=""> <i class="fb"> </i> </a>
                      </li>
                      <li><a href=""><i class="tw"> </i> </a></li>
                      <li><a href=""><i class="google"> </i> </a></li>
                      <li><a href=""><i class="linkedin"> </i> </a></li>
                      <li><a href=""><i class="skype"> </i> </a></li>
                  </ul>
              </div>
              <div class="col-md-3 span_1">
                  <ul class="spinner">
                      <i class="mail"> </i>
                      <li class="spinner_head">
                          <h3>Contact Us</h3></li>
                      <div class="clearfix"> </div>
                  </ul>
                  <p>500 Lorem Ipsum Dolor Sit,</p>
                  <p>22-56-2-9 Sit Amet, Lorem,</p>
                  <p>Phone:(00) 222 666 444</p>
                  <p><a href="mailto:info@demo.com"> info(at)gifty.com</a></p>
              </div>
              <div class="clearfix"> </div>
          </div>
      </div>
    </div>
@endsection
@section('partials.footer')

