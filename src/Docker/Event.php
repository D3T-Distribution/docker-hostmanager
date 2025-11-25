<?php

namespace DockerHostManager\Docker;

class Event
{
    /** @var string */
    protected $status;

    /** @var string */
    protected $id;

    /** @var string */
    protected $from;

    /** @var string */
    protected $time;

    /** @var string */
    protected $type;

    /** @var string */
    protected $action;

    /** @var array */
    protected $actor;

    /**
     * @param array $raw
     */
    public function __construct($raw)
    {
        $this->type = isset($raw['Type']) ? $raw['Type'] : null;
        $this->action = isset($raw['Action']) ? $raw['Action'] : null;
        $this->actor = isset($raw['Actor']) ? $raw['Actor'] : null;

        $this->status = isset($raw['status']) ? $raw['status'] : null;
        $this->id = isset($raw['id']) ? $raw['id'] : null;
        $this->from = isset($raw['from']) ? $raw['from'] : null;
        $this->time = isset($raw['time']) ? $raw['time'] : null;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->action !== null ? $this->action : $this->status;
    }

    /**
     * @return string
     */
    public function getId()
    {
        if ($this->actor !== null && isset($this->actor['ID'])) {
            return $this->actor['ID'];
        }
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->type !== null ? $this->type : $this->from;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return array|null
     */
    public function getActor()
    {
        return $this->actor;
    }
}
