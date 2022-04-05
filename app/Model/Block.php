<?php

namespace App\Model;

class Block extends Database
{
    public function add($data)
    {
        return $this->getContent()
            ->insert($data);
    }

    public function update($id, $data)
    {
        return $this->getContent()
            ->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->getContent()
            ->where('id', $id)
            ->delete();
    }

    public function getContentByName($page)
    {
        return $this->getContent()
            ->select('*')
            ->where('page', $page)
            ->fetchAssoc('name');
    }

    public function getAllBloky()
    {
        return $this->getContent()
            ->select('*')
            ->fetchAssoc('id');
    }

    public function getContentById($id)
    {
        return $this->getContent()
            ->select('*')
            ->where('id', $id)
            ->fetch();
    }

    public function getContent()
    {
        return $this->database->table('content');
    }
}