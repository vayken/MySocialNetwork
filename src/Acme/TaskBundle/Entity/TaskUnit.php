<?php

namespace Acme\TaskBundle\Entity;
/**
 * Created by PhpStorm.
 * User: vayken
 * Date: 02/08/2015
 * Time: 23:04
 */

class TaskUnit{

    protected $task;

    protected $category;

    protected $dueDate;

    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }

    public function getCategory(){
        return $this->category;
    }

}

?>