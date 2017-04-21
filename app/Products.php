<?php


class Products
{
    protected $id;
    protected $codigo;
    protected $nombre;
    protected $descripcion;
    protected $marca;
    protected $categoria;
    protected $unidad;
    protected $stock_min;
    protected $stock_max;
    protected $stock;
    protected $precio1;
    protected $precio2;
    protected $img1;
    protected $img2;
    protected $img3;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * @param mixed $unidad
     */
    public function setUnidad($unidad)
    {
        $this->unidad = $unidad;
    }

    /**
     * @return mixed
     */
    public function getStockMin()
    {
        return $this->stock_min;
    }

    /**
     * @param mixed $stock_min
     */
    public function setStockMin($stock_min)
    {
        $this->stock_min = $stock_min;
    }

    /**
     * @return mixed
     */
    public function getStockMax()
    {
        return $this->stock_max;
    }

    /**
     * @param mixed $stock_max
     */
    public function setStockMax($stock_max)
    {
        $this->stock_max = $stock_max;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return mixed
     */
    public function getPrecio1()
    {
        return $this->precio1;
    }

    /**
     * @param mixed $precio1
     */
    public function setPrecio1($precio1)
    {
        $this->precio1 = $precio1;
    }

    /**
     * @return mixed
     */
    public function getPrecio2()
    {
        return $this->precio2;
    }

    /**
     * @param mixed $precio2
     */
    public function setPrecio2($precio2)
    {
        $this->precio2 = $precio2;
    }

    /**
     * @return mixed
     */
    public function getImg1()
    {
        return $this->img1;
    }

    /**
     * @param mixed $img1
     */
    public function setImg1($img1)
    {
        $this->img1 = $img1;
    }

    /**
     * @return mixed
     */
    public function getImg2()
    {
        return $this->img2;
    }

    /**
     * @param mixed $img2
     */
    public function setImg2($img2)
    {
        $this->img2 = $img2;
    }

    /**
     * @return mixed
     */
    public function getImg3()
    {
        return $this->img3;
    }

    /**
     * @param mixed $img3
     */
    public function setImg3($img3)
    {
        $this->img3 = $img3;
    }


}