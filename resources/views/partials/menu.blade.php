   <!-- Parte del menú (Que se va a generar dinamicamente) -->
    <div class="menu">
        <div class="container">
            <div class="menu_box">
                <ul class="megamenu skyblue">
                    <li class="active grid"><a class="color2" href="{{route('shop.index')}}">Inicio</a></li>
                    <li><a class="color10" href="#">Categorias</a>
                        <div class="megapanel">
                            <div class="row">
                                <div class="col1">
                                    <div class="h_nav">
                                        @foreach($categorias as $categoria)
                                            <ul>
                                                <li><a href="{{route('shop.categoria',['id' > $categoria->id])}}">{{$categoria->nombre}}</a></li>
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                    <li><a class="color3" href="404.html">Promociones</a></li>
                    <li><a class="color7" href="#">Marcas</a>
                        <div class="megapanel">
                            <div class="row">
                                <div class="col1">
                                    <div class="h_nav">
                                        <h4>Men</h4>
                                        <ul>
                                            <li><a href="men.html">Jackets</a></li>
                                            <li><a href="men.html">Blazers</a></li>
                                            <li><a href="men.html">Suits</a></li>
                                            <li><a href="men.html">Trousers</a></li>
                                            <li><a href="men.html">Jeans</a></li>
                                            <li><a href="men.html">Shirts</a></li>
                                            <li><a href="men.html">Sweatshirts & Hoodies</a></li>
                                            <li><a href="men.html">Swem Wear</a></li>
                                            <li><a href="men.html">Accessories</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col1">
                                    <div class="h_nav">
                                        <h4>Women</h4>
                                        <ul>
                                            <li><a href="men.html">Outerwear</a></li>
                                            <li><a href="men.html">Dresses</a></li>
                                            <li><a href="men.html">Handbags</a></li>
                                            <li><a href="men.html">Trousers</a></li>
                                            <li><a href="men.html">Jeans</a></li>
                                            <li><a href="men.html">T-Shirts</a></li>
                                            <li><a href="men.html">Shoes</a></li>
                                            <li><a href="men.html">Coats</a></li>
                                            <li><a href="men.html">Accessories</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a class="color8" href="blog.html">Blog</a></li>
                    <div class="clearfix"> </div>
                </ul>
            </div>
        </div>
    </div>
   <script>
       $(".megamenu").megamenu();
   </script>
