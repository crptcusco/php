<?php 

// funciones
function existe_usuario() {
    if( isset($_SESSION['usuario']) ) {
	return True;
    } else {
	return False;
    }
}

function get_user_id() {
    return $_SESSION["user_id"];
}

function usuario_logeado($modulo, $url_exit) {
    $exit = False;
    if( isset($_SESSION['usuario']) ) {
	$lista = explode(",", $_SESSION['resources'] );
	/* var_dump($modulo); */
	/* echo '<br>'; */
	/* var_dump($lista); */
	/* echo '<br>'; */
	/* print_r( array_search($modulo, $lista ) ); */
	if ( array_search($modulo, $lista ) == False ) {
	    $exit = True;
	}
    } else {
	$exit = True;
    }
    if ( $exit==True ) {
	header('Location: '.$url_exit);
    }
}

function logOut() {
    session_destroy(); 
}

function logIn( $login, $pass ) {
    global $q;
 
    $q->fields = array(
		       "resource" => ""
    		       );
    $q->sql = '
    SELECT 
    r.full_name as "resource"
    FROM login_profile p
    JOIN login_user_has_profile up ON up.profile_id = p.id
    JOIN login_profile_has_resource pr ON pr.profile_id = p.id
    JOIN login_user u ON u.id = up.user_id
    JOIN login_resource r ON r.id = pr.resource_id
    WHERE  u.login="%s" AND u.pass="%s"
    ';
    $q->sql = sprintf( $q->sql, $login, md5($pass) );
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array($data) ) {
	$_SESSION["usuario"] = $login;
	$resources ='';
	foreach ($data as $row) {
	    $resources.= ','. $row['resource'];
	}
	$resources= 'Claudio'.$resources;
	$_SESSION["resources"] = $resources;
    }

    $q->fields = array(
		       "user_id" => ""
    		       );
    $q->sql = '
    SELECT 
    u.id
    FROM login_user u
    WHERE  u.login="%s" AND u.pass="%s"
    ';
    $q->sql = sprintf( $q->sql, $login, md5($pass) );
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array($data) ) {
	$_SESSION["user_id"] = $data[0]['user_id'];
    }
}

function test() {
    global $q;
 
    $q->fields = array(
    		        "" => ""
    			,""=>""
    		       );
    $q->sql = '
    ';
    $q->data = NULL;
    $data = $q->exe();
    var_dump($data);
    return $id;
}
?>