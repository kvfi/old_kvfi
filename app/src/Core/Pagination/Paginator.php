<?php

namespace App\Core\Pagination;

class Paginator
{
    protected $classes = ['pagination'];

    protected $total = 100;

    protected $item_per_page = 20;

    protected $current_page = 1;

    protected $key = 'page';

    protected $target;

    protected $previous;

    protected $next;

    protected $alwaysShowPagination;

    protected $options;

    public function __construct($options = null)
    {
        if (is_array($options)) {
            foreach ($options as $option => $value) {
                $this->$option = $value;
            }
        }

        if ($this->current_page > $this->calculateNumberOfPage()) {
            $this->current_page = $this->calculateNumberOfPage();
        }

        if ($this->current_page < 1) {
            $this->current_page = 1;
        }

        $this->current_page = $_GET[$this->key] ?? 1;
    }

    protected function calculateNumberOfPage()
    {
        return ceil($this->total / $this->item_per_page);
    }

    public function render()
    {
        $i = $this->current_page;
        $render = '';
        $render .= '<div class="'.implode(' ', $this->classes).'">';
        $render .= '<ul>';
        if ($i > 1 && $i <= $this->calculateNumberOfPage()) {
            $render .= 'Previous';
        }
        for ($i = 1; $i <= $this->calculateNumberOfPage(); ++$i) {
            if ($i == $this->current_page) {
                $render .= '<li class="current">'.$i.'</li>';
            } else {
                $render .= '<li><a href="?'.$this->key.'='.$i.'">'.$i.'</a></li>';
            }
        }
        $i = $this->current_page;
        if ($this->calculateNumberOfPage() > $i && $i < $this->calculateNumberOfPage()) {
            $render .= 'Next';
        }
        $render .= '</ul>';
        $render .= '</div>';

        return $render;
    }
}
