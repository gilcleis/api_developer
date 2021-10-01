<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeveloperRequest;
use App\Models\Developer;
use App\Repositories\DeveloperRepository;
use App\Services\DeveloperService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * @var DeveloperService
     */
    protected Developer $developer;

    /**
     *
     * @param  DeveloperService  $developerService
     *
     */
    public function __construct(Developer $developer)
    {
        $this->developer = $developer;
    }

    public function index(Request $request)
    {
        $result = ['status' => Response::HTTP_OK];
        $developerRepository = new DeveloperRepository($this->developer);
        $page = $request->get('per_page', '10');
        $order = $request->get('order', 'ASC');
        $orderColumn = $request->get('orderColumn', 'id');
        try {
            if ($request->has('filtro')) {
                $developerRepository->filtro($request->filtro);
            }
            $developers = $developerRepository->getResultadoPaginado($page, $orderColumn, $order);
            if ($developers === null) {
                $result =  ['status' => Response::HTTP_NOT_FOUND];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($developers, $result['status']);
    }

    public function show($id)
    {
        $developerRepository = new DeveloperRepository($this->developer);
        $result = ['status' => Response::HTTP_OK];
        try {
            $developer = $developerRepository->findById($id);
            if ($developer === null) {
                $result =  ['status' => Response::HTTP_NOT_FOUND];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($developer, $result['status']);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\DeveloperRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeveloperRequest $request)
    {
        $result = ['status' => Response::HTTP_CREATED];
        $developer = null;
        $developerRepository = new DeveloperRepository($this->developer);
        try {
            $developer = $developerRepository->save($request->validated()); 
           
            if ($developer === null) {                
                $result =  ['status' => Response::HTTP_BAD_REQUEST];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($developer, $result['status']);
    }


    public function update($id, DeveloperRequest $request)
    {
        $result = ['status' => Response::HTTP_OK];
        $developerRepository = new DeveloperRepository($this->developer);
        try {
            $developer = $developerRepository->update($id, $request->validated());
            if ($developer === null) {
                $result =  ['status' => Response::HTTP_BAD_REQUEST];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($developer, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ['status' => Response::HTTP_OK];
        $developerRepository = new DeveloperRepository($this->developer);
        try {
            $developer = $developerRepository->delete($id);

            if ($developer === null) {
                $result =  ['status' => Response::HTTP_BAD_REQUEST];
            }
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json(null, $result['status']);
    }
}
