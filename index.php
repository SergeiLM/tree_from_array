<?php
      $el = [
          ['id' => 1, 'parent_id' => 0],
          ['id' => 2, 'parent_id' => 1],
          ['id' => 3, 'parent_id' => 1],
          ['id' => 4, 'parent_id' => 1],
          ['id' => 5, 'parent_id' => 1],
          ['id' => 6, 'parent_id' => 1],
          ['id' => 7, 'parent_id' => 1],
          ['id' => 8, 'parent_id' => 1],
          ['id' => 9, 'parent_id' => 8],
      ];


      $tree = $el_childs = array();

      // строим массив из элементов и его дочерних элементов
      foreach ($el as $item){
            $el_childs[$item['parent_id']][] = $item;
      }

      // отсортируем массив с элементами по ключу
      ksort($el_childs);

      // находим всех самых верхних родителей
      $main_parents = $childs = array();
      foreach ($el_childs as $key => $items)
      {
            $main_parents[$key] = $key;
            foreach ($items as $item)
            {
                  $childs[] = $item['id'];
                  if(in_array($item['parent_id'], $childs))
                        unset($main_parents[$key]);
            }
      }

      foreach ($main_parents as $p)
            $tree[] = get_tree($el_childs, $el_childs[$p]);

      dp($tree);

      // рекурсивно строим дерево для одного верхнего родителя
      function get_tree(& $elements, $parent)
      {
            $tree = array();
            foreach ($parent as $key => $item )
            {
                  if(isset($elements[$item['id']]))
                  {
                        $item['children'] = get_tree($elements, $elements[$item['id']]);
                  }
                  $tree[] = $item;
            }
            return $tree;
      }

?>


<?php
function dp($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
?>
