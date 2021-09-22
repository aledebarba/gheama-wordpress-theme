<?php
      //render menus and navs based on wordpress menus contents
      
      function nav_slide_down($menu, $showextrabutton = true, $button = ['Read More', 'https://weather.com','_blank'], $imageurl='https://images.unsplash.com/photo-1523049673857-eb18f1d7b578?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=60'){

          $btn = $showextrabutton ? "<a class='btn btn-extra mx-1' role='button' href='{$button[1]}' style='margin: 0!important; transform: translate(-8px, -4px)'>{$button[0]}</a>" : "";
          $menu_items = wp_get_nav_menu_items( $menu );
          $output = "
          <div class='fixed-elements'>
            $btn
            <div class='hambuger-menu-controler mx-2' id='menu-controler'>
                <input type='checkbox'></input>
                <span class='menu-icon'></span>
            </div>'
          </div>
          <nav class='slide-down-panel' id='slide_down_menu'>
            <div class='brand'>
              <img src='$imageurl' alt=''>
            </div>
            <div class='menu-items'>";
         
          // add each element from menu to output string
          // TODO check if item is valid

          foreach($menu_items as $item) {
              $title = $item->title;
              $url = $item->url;
              $output .= "<a href='$url'>$title</a>";
            }  
          
          // and continue mounting the output string

        $output .="</div>
        </nav>
         
        <script>
            window.onload = () => {
                // defines menu-height css variable
                const getMenuSize = () => {
                const el = document.getElementById('slide_down_menu');
                const size = el.offsetHeight;
                el.style.top = size * -1 + 'px';
                return size + 'px';
                };
                window.addEventListener('resize', () => {
                document.documentElement.style.setProperty(
                    '--slide-down-menu-height',
                    getMenuSize()
                );
                });
                getMenuSize();
            
                // handle click over menu
                document.body
                .querySelector('#menu-controler input')
                .addEventListener('click', function (e) {
                    var el = document.getElementById('slide_down_menu');
                    el.classList.toggle('slide-down-isopened');
                });
            };
          
        </script>";

        return $output;
      }

      function render_nav($menu) {
        $menu_items = wp_get_nav_menu_items( $menu );
        $classname = "nav__".strtolower( str_replace(' ','_', $menu) );
        $output = "<nav class='$classname'>";
        foreach($menu_items as $item) {
          $title = $item->title;
            $url = $item->url;
            $output .= "<a href='$url'>$title</a>";
        }
        $output .= "</nav>";
        return $output;
      }
?>