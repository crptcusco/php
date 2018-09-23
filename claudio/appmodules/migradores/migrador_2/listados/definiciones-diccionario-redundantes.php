<?php 

class Sinonimos extends TablaSimple {

  protected function ini_table() {
    print '<ul>';
  }

  protected function end_table() {
    print '</ul>';
  }

  protected function ini_tr($args) {
    printf(''
          . '<li>'
           );
  }
  
  protected function end_tr($args) {
    print '</li>';
  }
  
  protected function td($args) {
    printf(''
          . '%s (<a class="delete-bad" href="#" table="%s" bad="%s">eliminar</a>)'
           , utf8_encode( $args['nombre'] )
	   , $this->name
           , $args['id']
           );
  }
  
}//end-class

class Good_and_bad extends TablaDoble {
    protected function ini_table() {
        print '';
    }
    protected function end_table() {
        print '';
    }
    protected function ini_tr($args) {
        printf(''
                . '<h4>%s</h4><ul>'
                , $args['good_nombre']
        );
    }
    protected function end_tr($args) {
        printf(''
                . '</ul>'
        );
    }
    protected function td($args) {
        printf(''
                . '<li>%s (<a class="delete-bad" href="#" table="%s" bad="%s">eliminar</a>)</li>'
               , utf8_encode($args['bad_nombre'])
	       , $this->name
	       , $args['bad_id']
        );
    }
} // end-class


?>