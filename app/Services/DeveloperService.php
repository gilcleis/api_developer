<?php


namespace App\Services;


use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;
use App\Repositories\DeveloperRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Throwable;


class DeveloperService
{
    protected DeveloperRepository $developerRepository;

    /**
     * DeveloperService constructor.
     *
     * @param  DeveloperRepository  $developerRepository
     */
    public function __construct(DeveloperRepository $developerRepository)
    {
        $this->developerRepository = $developerRepository;
    }

    /**
     * @return Developer[]|Collection
     */
    public function getAll()
    {

        return $this->developerRepository->getAll();
    }

    /**
     * @param $id
     *
     * @return Developer|null
     */
    public function findById($id)
    {
        return $this->developerRepository->findById($id);
    }

    /**
     * @param $data
     *
     * @return Developer|null
     */
    public function save($data)
    {
        DB::beginTransaction();
        try {
            $model = $this->developerRepository->save($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Não foi possível cadastrar o registro');
        }
        DB::commit();
        return $model;
    }

    /**
     * @param $data
     * @param $id
     *
     * @return Developer
     * @throws Throwable
     */
    public function update($id, $data)
    {

        // $rules     = new DeveloperRequest();
        //$validator = Validator::make($data->all(), $data->rules());
        //dd($data);
        // if ($validator->fails()) {
        //     throw new InvalidArgumentException($validator->errors()->first());
        // }

        DB::beginTransaction();
        try {
            $model = $this->developerRepository->update($id, $data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Não foi possível atualizar o registro');
        }
        DB::commit();
        return $model;
    }

    /**
     * @param $id
     *
     * @return Developer
     * @throws Throwable
     */
    public function deleteById($id)
    {

        $model = $this->developerRepository->delete($id);
        return $model;
    }

    /**
     * @return Developer[]|Collection
     */
    public function getResultado()
    {
        return $this->developerRepository->getResultado();
    }

    public function filtro($filtro)
    {
        
    }

    public function getResultadoPaginado(int $paginate = 10, string $column = 'id', string $order = 'ASC') {
        
        return $this->developerRepository->getResultadoPaginado($paginate,$column,$order);
    }

   
}
