<?php
namespace app\repositories;

interface RepositoryBaseInterface
{
    public function all();

    public function allQuery($where = false);

    public function getQuery($tabla = '', array $select, array $joins, array $where, array $orderBy, array $groupBy, $paginate = false);

    public function getView($query, array $where);

    public function get($id);

    public function store(array $request);

    public function update(array $request, $id);

    public function destroy($id);

    public function listaRegistros(array $where);

    public function maxId();

    public function getPages();

    public function setPages($pages);
}