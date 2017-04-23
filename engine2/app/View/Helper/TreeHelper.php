<?php
define('T', "\t");
define('NL', "\r\n");
class TreeHelper extends AppHelper {
	public $helpers = array('Html','Form');
	// tree to html for all
    function tree2Html($threaded, $level = 0)
    {
        $tabs = '';
        for ($i = 0; $i<$level; ++$i) $tabs .= T;
        $html = $tabs.'<ul>'.NL;
        foreach ($threaded as $key => $node)
        {
            $html .= $tabs.T.'<li>'. NL;
            $html .= $tabs.T.T.($key+1) . ': ';
            foreach ($node as $type => $threaded)
            {
                if ($type !== 'children')
                {
                    $html .= $type . NL . $tabs.T.T.'<ul>'.NL;
                    foreach ($threaded as $key => $value)
                    {
                        $html .= $tabs.T.T.T.'<li><strong>' . $key . '</strong>: ' . $value . '</li>'.NL;
                    }
                    $html .= $tabs.T.T.'</ul>'.NL;
                }
                else
                {
                    if (!empty($threaded))
                    {
                        $html .= $this->tree2Html($threaded, $level + 2);
                    }   
                }
            }
            $html .= $tabs.T.'</li>'.NL;
        }
        $html .= $tabs.'</ul>'.NL;
        return $html;
    }
    
    //tree menu for client side
	public function menu($threaded, $level = 0, $class)
    {
      
        $html = '<ul class = "'.$class.'">';
        foreach ($threaded as $key => $node)
        {  
            $html .= '<li>';
       
            foreach ($node as $type => $threaded)
            {
                if ($type !== 'children')
                {   
                    $html .= '<a href ="#">'.$threaded['title'].'</a>' . '<ul>';
                    $html .= '</ul>';
                }
                else
                {
                    if (!empty($threaded))
                    {
                        $html .= $this->menu($threaded, $level + 2,$class);
                    }   
                }
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
    
    /*
     * sortable menu for adamin
     */
public function menuSortable($threaded, $level = 0,$sortableClass , $enable_ordering = 1) {
	        $html = '<ul class = "'.$sortableClass.'">';
	        foreach ($threaded as $key => $node){
	            $html .= '<li>'.'<p class="ui-icon-arrowthick-2-n-s" style="float:left;vertical-alignment:middle;"><img style="width:16px;height:12px; margin-right:6px;" src="../../img/right-arrow.png" ></p>'.'<input type="hidden" value="'.$node['Menu']['id'].'" name="order[]">';
	       
	            foreach ($node as $type => $threaded)
	            {
	                if ($type !== 'children')
	                {   
                		$html .= $threaded['title'].'<ul >';
	                  	$html .= '</ul>';
	                }
	                else
	                {
	                    if (!empty($threaded))
	                    {
	                        $html .= $this->menuSortable($threaded, $level + 2,$sortableClass, $enable_ordering = 1);
	                    }   
	                }
	            }
	            $html .= '</li>';
	        }
	        $html .= '</ul>';
	        return $html;
	    }


    /*
      * sortable menu for adamin
     */
     public function categorySortable($threaded, $level = 0,$sortableClass , $enable_ordering = 1)
     {
        //pr($threaded);
      $html = '<ul class = "'.$sortableClass.'">';
      foreach ($threaded as $key => $node){
       $html .= '<li><p class="ui-icon-arrowthick-2-n-s" style="vertical-alignment:middle;"><img style="width:16px;height:12px; margin-right:6px;" src="../../../img/right-arrow.png" ><input type="hidden" value="'.$node['Category']['id'].'" name="order[]">';
     
       foreach ($node as $type => $threaded)
       {
        if ($type != 'children')
        {
         $html .= $threaded['title'].'<ul>';
         $html .= '</ul></p>';
        }
        else
        {
         if (!empty($threaded))
         {
        $html .= $this->categorySortable($threaded, $level + 2,$sortableClass, $enable_ordering = 1);
         }
        }
       }
       $html .= '</li>';
    }
      $html .= '</ul></p>';
      return $html;
    }

	    
	  
 /*   
    function aroTree($threaded, $level = 0)
    {
        App::import('helper', 'Form');
        $form = new FormHelper();
        $html = '';
        foreach ($threaded as $aro)
        {
            $obj = $aro['Aro'];
            $children = $aro['children'];
            $foreign = $obj['foreign_key'];
            $model = $obj['model'];
            App::import('model', $model);
            $theModel = new $model();
            $foreignObject = $theModel->findById($foreign);
            $column = 'name';
            if ($model == 'Officer')
                $column = 'title';
            if ($model == 'User')
                $name = $foreignObject['User']['first'] . ' ' . $foreignObject['User']['last'];
            else
                $name = $foreignObject[$model][$column];
            $html .= '<div id="'.$model.'.'.$foreign.'" class="level'.$level.'">';
           
            $html .= '<input type="radio" name="data[AroSelection]" value="'.$model.'.'.$foreign.'" /> ';   
            $html .= $name.'</div>'.NL;
            if (!empty($children))
                $html .= $this->aroTree($children, $level + 1);
        }
        return $html;
    }
    
    
    function acoTree($threaded, $level = 0, $aliasPrefix = '')
    {
        $html = '';
        foreach ($threaded as $aco)
        {
            $obj = $aco['Aco'];
            $children = $aco['children'];
            $alias = $obj['alias']; 
            $html .= '<div id="'.$aliasPrefix.$alias.'" class="aco level'.$level.'">'.$alias.NL;
            $html .= '<input type="hidden" name="data[aco]['.$aliasPrefix.$alias.']" value="off" />';
            $html .= '<input onchange="checkDeep(\''
                .$aliasPrefix
                .$alias
                .'\')" id="cbox'
                .$aliasPrefix
                .$alias
                .'" type="checkbox" name="data[aco]['
                .$aliasPrefix.$alias
                .']" value="on" />';
            if (!empty($children))
                $html .= $this->acoTree($children, $level + 1, $aliasPrefix . $alias.'/');
            $html .= '</div>';
        }
        return $html;
    }
    */
}
 
?>