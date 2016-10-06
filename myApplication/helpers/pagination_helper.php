<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function pagination($count, $page = 1, $recordsPerPage = 30, $adjacents = 4, $url)
    {
        $page = ($page == 0 ? 1 : $page);
        $start = ($page-1) * $recordsPerPage;

        $prev = $page - 1;
        $next = $page + 1;
        $lastpage = ceil($count/$recordsPerPage);
        $lpm1 = $lastpage - 1;   
        $pagination = "";
        if($lastpage > 1)
        {   
            $pagination .= '<ul class="pagination">';
            if ($page > 1)
                $pagination.= '<li><a href="' . $url . $prev . '">&raquo;</a></li>';
            else
                $pagination.= '<li class="disabled"><a href="#">&raquo;</a></li>';   
            if ($lastpage < 7 + ($adjacents * 2))
            {   
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= '<li class="active"><span>' . $counter . ' <span class="sr-only">(current)</span></span></li>';
                    else
                        $pagination.= '<li><a href="' . $url . $counter . '">' . $counter . '</a></li>';

                }
            }   

            elseif($lastpage > 5 + ($adjacents * 2))
            {
                if($page < 1 + ($adjacents * 2))
                {
                    for($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if($counter == $page)
                            $pagination.= '<li class="active"><span>' . $counter . ' <span class="sr-only">(current)</span></span></li>';
                        else
                            $pagination.= '<li><a href="' . $url . $counter . '">' . $counter . '</a></li>';
                    }
                    $pagination.= '<li class="disabled"><a href="#">...</a></li>';
                    $pagination.= '<li><a href="' . $url . $lpm1 . '">' . $lpm1 . '</a></li>';
                    $pagination.= '<li><a href="' . $url . $lastpage . '">' . $lastpage . '</a></li>';

                }
                elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
                    $pagination.= '<li><a href="' . $url . '1">1</a></li>';
                    $pagination.= '<li><a href="' . $url . '2">2</a></li>';
                    $pagination.= '<li class="disabled"><a href="#">...</a></li>';
                    for($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if($counter == $page)
                            $pagination.= '<li class="active"><span>' . $counter . ' <span class="sr-only">(current)</span></span></li>';
                        else
                            $pagination.= '<li><a href="' . $url . $counter . '">' . $counter . '</a></li>';
                    }
                    $pagination.= '<li class="disabled"><a href="#">...</a></li>';
                    $pagination.= '<li><a href="' . $url . $lpm1 . '">' . $lpm1 . '</a></li>';
                    $pagination.= '<li><a href="' . $url . $lastpage . '">' . $lastpage . '</a></li>';
                }
                else
                {
                    $pagination.= '<li><a href="' . $url . '1">1</a></li>';
                    $pagination.= '<li><a href="' . $url . '2">2</a></li>';
                    $pagination.= '<li class="disabled"><a href="#">...</a></li>';;
                    for($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                    {
                        if($counter == $page)
                            $pagination.= '<li class="active"><span>' . $counter . ' <span class="sr-only">(current)</span></span></li>';
                        else
                            $pagination.= '<li><a href="' . $url . $counter . '">' . $counter . '</a></li>';
                    }
                }
            }
            if($page < $counter - 1)
                $pagination.= '<li><a href="' . $url . $next . '">&laquo;</a></li>';
            else
                $pagination.= '<li class="disabled"><a href="#">&laquo;</a></li>';   

            $pagination.= '</ul>';       
        }
        
        return $pagination;
        
    }


?>
