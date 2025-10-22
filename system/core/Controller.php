<?php
// Simplified base controller resembling CodeIgniter 3's CI_Controller.

class CI_Controller
{
    /** @var Loader */
    public $load;

    public function __construct()
    {
        require_once BASEPATH . 'core/Loader.php';
        $this->load = new Loader($this);
        $this->initController();
    }

    protected function initController(): void
    {
        // Hook for child classes.
    }
}
