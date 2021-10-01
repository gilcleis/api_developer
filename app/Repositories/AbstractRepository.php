<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository {

    public function __construct(Model $model) {
        $this->model = $model;       
    }  

    public function filtro($filtros) {
        $filtros = explode(';', $filtros);
        
        foreach($filtros as $key => $condicao) {
            $c = explode(':', $condicao);
           
            $this->model = $this->model->where($c[0], $c[1], $c[2]);            
        }
        
    }


    /**
     * Lista todos os registros por coluna e ordem especificadas.
     * 
     * @param string $column ID da coluna. Default: 'id'.
     * @param string $order Ordem de organização. Default: 'ASC'
     * @return Collection
     */
    public function getAll(string $column = 'id', string $order = 'ASC') {
        return $this->model->orderBy($column,$order)->get();
        //return $this->model;
    }

     /**
     * Lista registros de acordo com a paginação e ordem especificada.
     * 
     * @param int $paginate Número de paginação. Default: 10
     * @param string $column ID da coluna. Default: 'id'.
     * @param string $order Ordem de organização. Default: 'ASC'
     * @return Collection
     */
    public function getResultadoPaginado(int $paginate = 10, string $column = 'id', string $order = 'ASC') {
        
        return $this->model->orderBy($column,$order)->paginate($paginate);

    }
  
    public function getResultado() {
        return $this->model->get();
        //return $this->model;
    }
}

?>