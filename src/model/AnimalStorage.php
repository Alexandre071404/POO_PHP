<?php
interface AnimalStorage {
    public function read(String $id);
    public function readAll();
    public function create(Animal $a);
    public function update($id,Animal $b);
    public function delete($id);


}


?>
