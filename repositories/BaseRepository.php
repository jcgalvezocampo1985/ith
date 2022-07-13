<?php
namespace app\repositories;

use Yii;
use yii\db\Query;
use yii\data\Pagination;
use app\repositories\RepositoryBaseInterface;

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

<<<<<<< HEAD
    #region public function __construct($model)
=======
    /* #regionpublic function __construct($model) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function __construct($model)
    {
        $this->model = $model;
    }
<<<<<<< HEAD
    #endregion

    #region public function all($where = false)
=======
    /* #endregion */

    /* #regionpublic function all($where = false) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
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
<<<<<<< HEAD
    #endregion

    #region public function allQuery($where = false)
=======
    /* #endregion */

    /* #regionpublic function allQuery($where = false) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
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

<<<<<<< HEAD
       if(count($this->joins) > 0)
=======
        if(count($this->joins) > 0)
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
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
<<<<<<< HEAD
    #endregion

    #region public function getQuery($table = '', $select = [], $joins = [], $where = [], $orderBy = [], $groupBy = [], $paginate = false, $registers = 'all')
=======
    /* #endregion */

    /* #regionpublic function getQuery($table = '', $select = [], $joins = [], $where = [], $orderBy = [], $groupBy = [], $paginate = false, $registers = 'all') */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
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
<<<<<<< HEAD
    #endregion

    #region public function getView($query, array $where, $registers = 'all')
=======
    /* #endregion */

    /* #regionpublic function getView($query, array $where, $registers = 'all') */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
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
<<<<<<< HEAD
    #endregion

    #region public function get($id)
=======
    /* #endregion */

    /* #regionpublic function get($id) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function get($id)
    {
        return $this->model->findOne($id);
    }
<<<<<<< HEAD
    #endregion

    #region public function store($request)
    public function store($request)
    {
        foreach($this->campos as $row)
        {
            $this->model->$row = $request[$row];
=======
    /* #endregion */

    /* #regionpublic function store($request) */
    public function store($request)
    {
        if(is_object($request))
        {
            foreach($this->campos as $row)
            {
                $this->model->$row = $request[$row];
            }
        }
        else
        {
            foreach($this->campos as $row)
            {
                if(array_key_exists($row, $request))
                {
                    $this->model->$row = $request[$row];
                }
            }
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
        }

        return $this->model->insert();
    }
<<<<<<< HEAD
    #endregion

    #region public function update($request, $id)
=======
    /* #endregion */

    /* #regionpublic function update($request, $id) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function update($request, $id)
    {
        $query = $this->model->findOne($id);

<<<<<<< HEAD
        foreach($this->campos as $row)
        {
            $query->$row = $request[$row];
=======
        if(is_object($request))
        {
            foreach($this->campos as $row)
            {
                $query->$row = $request[$row];
            }
        }
        else
        {
            foreach($this->campos as $row)
            {
                if(array_key_exists($row, $request))
                {
                    $query->$row = $request[$row];
                }
            }
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
        }

        return $query->update();
    }
<<<<<<< HEAD
    #endregion

    #region public function destroy($id)
=======
    /* #endregion */

    /* #regionpublic function destroy($id) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function destroy($id)
    {
        $query = $this->model->findOne($id);

        return $query->delete();
    }
<<<<<<< HEAD
    #endregion

    #region public function listaRegistros(array $orderBy = [])
=======
    /* #endregion */

    /* #regionpublic function listaRegistros(array $orderBy = []) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
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
<<<<<<< HEAD
    #endregion

    #region public function maxId()
=======
    /* #endregion */

    /* #regionpublic function maxId() */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function maxId()
    {
        $query = $this->model->find()->max($this->primaryKey);

        return $query;
    }
<<<<<<< HEAD
    #endregion

    #region public function setPages($pages)
=======
    /* #endregion */

    /* #regionpublic function setPages($pages) */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function setPages($pages)
    {
        $this->pages = $pages;
    }
<<<<<<< HEAD
    #endregion

    #region public function getPages()
=======
    /* #endregion */

    /* #regionpublic function getPages() */
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
    public function getPages()
    {
        return $this->pages;
    }
<<<<<<< HEAD
    #endregion    
=======
    /* #endregion */    
>>>>>>> cc7f7fd22cc42b0f8b1bd5bf5b73511280e9f569
}