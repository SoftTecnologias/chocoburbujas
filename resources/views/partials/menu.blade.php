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
                                        <ul>
                                            @foreach($categorias as $categoria)
                                                <li><a href="{{route('shop.categoria',['id' > $categoria->id])}}">{{$categoria->nombre}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                    <li><a class="color3" href="404.html">Promociones</a></li>
                    <li><a class="color7" href="#">Marcas</a>
                        <div class="megapanel">
                            <div class="row">
                                @foreach(array_chunk($marcas,6) as $row)
                                    <div class="col1">
                                    <div class="h_nav">
                                        <h4></h4>
                                        <ul>
                                            @foreach($row as $item)
                                                <li><a href="{{route('shop.marca',['id' => $item->id])}}">{{$item->nombre}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
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
