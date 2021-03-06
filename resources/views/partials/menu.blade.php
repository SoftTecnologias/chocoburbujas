   <!-- Parte del menú (Que se va a generar dinamicamente) -->
    <div class="menu">
        <div class="container">
            <div class="menu_box">
                <ul class="megamenu skyblue">
                    <li class="active grid"><a class="color2" href="{{route('shop.index')}}">Inicio</a></li>
                    <li><a class="color2" href="#">Categorias</a>
                        <div class="megapanel">
                            <div class="row">
                                @foreach(array_chunk($categorias,6) as $row)
                                    <div class="col1">
                                        <div class="h_nav">
                                            <h4></h4>
                                            <ul>
                                                @foreach($row as $item)
                                                    <li><a href="{{route('shop.categoria',['id' => $item->id])}}">{{$item->nombre}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li><a class="color2" href="#">Marcas</a>
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
                    <li><a class="color2" href="#">Blog</a></li>
                    <div class="clearfix"> </div>
                </ul>
            </div>
        </div>
    </div>
   <script>
       $(".megamenu").megamenu();
   </script>
