<?php 
class UyTreeHelper extends AppHelper{
	public $tabIndent	= "\t";
	public $newLine		= "\r\n";

	public $helpers		= array('Html', 'Form');
	// tree to html for all
	function printEcommerceCategoryTree($threaded,$conditionalData,$currentCategories = null) {
		if(sizeof($threaded)>0){
			$html = '<ul class="treeUl">';
			foreach ($threaded as $key => $node) {
				$html .= '<li>';
				foreach ($node as $type => $threaded) {
					if ($type !== 'children') {
						//add section
						if($currentCategories == null){
							if(array_key_exists($threaded['id'], $conditionalData)):
								$html .=  '<label class="checkbox"><input class="category_ids" type="checkbox" value="'.$threaded['id'].'" disabled="disabled" name="data[Type][TypeCategory][][category_id]">'.$threaded['title'].'</label>';
							else:
								$html .=  '<label class="checkbox"><input class="category_ids" type="checkbox" value="'.$threaded['id'].'" name="data[Type][TypeCategory][][category_id]">'.$threaded['title'].'</label>';
							endif;
						}else{ //edit section
							if(array_key_exists($threaded['id'],$currentCategories) == true):
								$checked = 'checked';
							else :
								$checked = '';
							endif;
							//$checked = true;
							if(array_key_exists($threaded['id'], $conditionalData)):
								if($checked == 'checked'){
									$html .=  '<label class="checkbox"><input '.$checked.' class="category_ids" type="checkbox" value="'.$threaded['id'].'" name="data[Type][TypeCategory][][category_id]">'.$threaded['title'].'</label>';
								}else{
									$html .=  '<label class="checkbox"><input '.$checked.' class="category_ids" type="checkbox" value="'.$threaded['id'].'" disabled="disabled" name="data[Type][TypeCategory][][category_id]">'.$threaded['title'].'</label>';
								}
							else:
								$html .=  '<label class="checkbox"><input '.$checked.' class="category_ids" type="checkbox" value="'.$threaded['id'].'" name="data[Type][TypeCategory][][category_id]">'.$threaded['title'].'</label>';
							endif;
						}
					} else {
						if (!empty($threaded)) {
							$html .= $this -> printEcommerceCategoryTree($threaded,$conditionalData,$currentCategories);
						}
					}
				}
				$html .= '</li>';
			}
			$html .= '</ul>';
			return $html;
		}
	}
}