<?php

namespace BoxCheckout\Models;

class BoxModel
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Retrieves boxes data from boxes table.
     *
     * @return array $results is the array of BoxEntities.
     */
    public function getAllBoxes()
    {
        $query = $this->db->prepare(
            'SELECT `id`, `size`, `strength`, `price` FROM `boxes` WHERE `deleted` = 0;'
        );
        $query->setFetchMode(\PDO::FETCH_CLASS, 'BoxCheckout\Entities\BoxEntity');
        $query->execute();
        $results = $query->fetchAll();
        return $results;
    }

}