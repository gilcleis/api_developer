<?php


namespace App\Repositories;


use App\Models\Developer;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class DeveloperRepository extends AbstractRepository
{
    //protected Developer $developer;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function getAll(string $column = 'id', string $order = 'ASC') 
    {
        return $this->model->orderBy('nome', 'asc')->paginate(6);
    }

     /**
     * @param $id
     *
     * @return Developer[]|Collection
     */
    public function getById($id)
    {
        return $this->model->where('id', $id)->get();
    }

    /**
     * @param $id
     *
     * @return Developer|null
     */
    public function findById($id): ?Developer
    {
        return $this->model->find($id);
    }

    /**
     * @param $data
     *
     * @return Developer
     */
    public function save($data)
    {
        
        try {
            $model = new Developer;
            $model->fill($data);
            $model->save();
            //print_r($model);
        } catch (Exception $e) {
            
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Não foi possível salvar o registro');
        }

        return $model;
    }

 
    public function update($id, $data): ?Developer
    {
        try {
            $model = $this->model->find($id);
            if ($model != null) {
                $model->fill($data);
                $model->update();
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Não foi possível atualizar o registro');
        }
        return $model;
    }

  
    public function delete($id)
    {
        try {
            $model = $this->model->find($id);
            if ($model != null) {
                $model->delete();
            }
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Não foi possível excluir o registro');
        }
        return $model;
    }
    


}
