<?php
namespace app\repositories;

use Yii;
use yii\db\Query;
use yii\data\Pagination;
use app\Repositories\RepositoryBaseInterface;

abstract class BaseRepository implements RepositoryBaseInterface
{
    protected $model;
    protected $primaryKey;
    protected $table = [];
    protected $campos = [];
    protected $select = [];
    protected $joins = [];
    protected $where = [];
    protected $orderBy = [];//SORT_DESC o SORT_ASC
    protected $paginate = 5;
    public $search;

    #region public function __construct($model)
    public function __construct($model)
    {
        $this->model = $model;
    }
    #endregion

    #region public function all($where = false)
    public function all($where = false)
    {
        $query = $this->model->find();

        if(count($this->orderBy) > 0)
        {
            $query = $query->orderBy($this->orderBy);
        }

        if($where)
        {
            $where = [
                'OR',
            ];

            for($i = 0; $i < count($this->where); $i++)
            {
                $where[] = ['like', $this->where[$i], $this->search];
            }
            $query = $query->where($where);
        }

        $count = clone $query;
        $pages = new Pagination([
                    "pageSize" => $this->paginate,
                    "totalCount" => $count->count(),
                ]);

        $query = $query->offset($pages->offset)
                       ->limit($pages->limit)
                       ->all();

        $this->setPages($pages);

        return $query;
    }
    #endregion

    #region public function allQuery($where = false)
    public function allQuery($where = false)
    {
        if(count($this->table) == 0 && count($this->select) == 0)
        {
            return;
        }

        $table = new Query();
        $query = $table
                    ->from($this->table)
                    ->select($this->select);

        if(count($this->orderBy) > 0)
        {
            $query = $query->orderBy($this->orderBy);
        }

       if(count($this->joins) > 0)
        {
            foreach($this->joins as $item => $key)
            {
                $query = $query->innerJoin($key[0],$key[1]);
            }
        }

        if($where)
        {
            $where = [
                    'OR',
            ];

            for($i = 0; $i < count($this->where); $i++)
            {
                $where[] = ['like', $this->where[$i], $this->search];
            }
            $query = $query->where($where);
        }

        $count = clone $query;
        $pages = new Pagination([
                    "pageSize" => $this->paginate,
                    "totalCount" => $count->count(),
                ]);

        $query = $query->offset($pages->offset)
                       ->limit($pages->limit)
                       ->all();

        $this->setPages($pages);

        return $query;
    }
    #endregion

    #region public function getQuery($table = '', $select = [], $joins = [], $where = [], $orderBy = [], $groupBy = [], $paginate = false, $registers = 'all')
    public function getQuery($table = '', $select = [], $joins = [], $where = [], $orderBy = [], $groupBy = [], $paginate = false, $registers = 'all')
    {
        if($table != '' && count($select) == 0)
        {
            return;
        }

        $instancia = new Query();
        $query = $instancia
                    ->from($table)
                    ->select($select);

        if(count($orderBy) > 0)
        {
            $query = $query->orderBy($orderBy);
        }

        if(count($groupBy) > 0)
        {
            $query = $query->groupBy($groupBy);
        }

        if(count($joins) > 0)
        {
            foreach($joins as $item => $key)
            {
                $query = $query->innerJoin($key[0],$key[1]);
            }
        }

        if(count($where) > 0)
        {
            $i = 0;
            foreach($where as $keys)
            {
                $wheres =[$keys[0], $keys[1], $keys[2]];
                if($i == 0)
                {
                    $query = $query->where($wheres);
                }
                else if($i >= 1)
                {
                    $query = $query->andWhere($wheres);
                }
                $i++;
            }
        }

        if($paginate)
        {
            $count = clone $query;
            $pages = new Pagination([
                        "pageSize" => $this->paginate,
                        "totalCount" => $count->count(),
                    ]);

            $query = $query->offset($pages->offset)
                        ->limit($pages->limit)
                        ->all();

            $this->setPages($pages);
        }
        else
        {
            $query = $query->$registers();
        }

        return $query;
    }
    #endregion

    #region public function getView($query, array $where, $registers = 'all')
    public function getView($query = '', array $where = [], $registers = 'all')
    {
        $model = Yii::$app->db->createCommand($query);

        foreach($where as $campo => $value)
        {
            $model = $model->bindValue(':'.$campo, $value);
        }

        if($registers == 'all'){
            $tipo = 'queryAll';
        }else if($registers == 'one'){
            $tipo = 'queryOne';
        }

        $model = $model->$tipo();

        return $model;
    }
    #endregion

    #region public function get($id)
    public function get($id)
    {
        return $this->model->findOne($id);
    }
    #endregion

    #region public function store($request)
    public function store($request)
    {
        foreach($this->campos as $row)
        {
            $this->model->$row = $request[$row];
        }

        return $this->model->insert();
    }
    #endregion

    #region public function update($request, $id)
    public function update($request, $id)
    {
        $query = $this->model->findOne($id);

        foreach($this->campos as $row)
        {
            $query->$row = $request[$row];
        }

        return $query->update();
    }
    #endregion

    #region public function destroy($id)
    public function destroy($id)
    {
        $query = $this->model->findOne($id);

        return $query->delete();
    }
    #endregion

    #region public function listaRegistros(array $orderBy = [])
    public function listaRegistros(array $orderBy = [])
    {
        $query = $this->model->find();

        if(count($orderBy) > 0)
        {
            $query = $query->orderBy($orderBy);
        }

        $query = $query->all();

        return $query;
    }
    #endregion

    #region public function maxId()
    public function maxId()
    {
        $query = $this->model->find()->max($this->primaryKey);

        return $query;
    }
    #endregion

    #region public function setPages($pages)
    public function setPages($pages)
    {
        $this->pages = $pages;
    }
    #endregion

    #region public function getPages()
    public function getPages()
    {
        return $this->pages;
    }
    #endregion    
}