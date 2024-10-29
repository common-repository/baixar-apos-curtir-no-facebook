<?php

/*

Plugin Name: Baixar Apos Curtir No Facebook

Plugin URI: http://ganhardinheiroblog.net/baixar-apos-curtir-facebook-plugin-wordpress

Description: Ganhe Milhares de Likes no Facebook. Exiba o botão de download após o visitante curtir sua página no Facebook

Author: Anderson Makiyama

Version: 1.0

Author URI: http://ganhardinheiroblog.net


*/


class Anderson_Makiyama_Baixar_Apos_Curtir_No_Facebook{


	const CLASS_NAME = 'Anderson_Makiyama_Baixar_Apos_Curtir_No_Facebook';

	public static $CLASS_NAME = self::CLASS_NAME;

	const PLUGIN_ID = 7;

	public static $PLUGIN_ID = self::PLUGIN_ID;

	const PLUGIN_NAME = 'Baixar Apos Curtir No Facebook';

	public static $PLUGIN_NAME = self::PLUGIN_NAME;

	const PLUGIN_PAGE = 'http://ganhardinheiroblog.net/baixar-apos-curtir-facebook-plugin-wordpress';

	public static $PLUGIN_PAGE = self::PLUGIN_PAGE;

	const PLUGIN_VERSION = '1.0';
	
	const AUTHOR_SITE = 'ganhardinheiroblog.net';

	public static $PLUGIN_VERSION = self::PLUGIN_VERSION;

	public $plugin_basename;

	public $plugin_path;

	public $plugin_url;
	
	
	//
	
	const APP_ID = '701399063250919';
	
	public $download_image = '';


	public function get_static_var($var) {

        return self::$$var;

    }


	public function activation(){
		
		$options = get_option(self::CLASS_NAME . "_options");
		
		if(!isset($options['download_image']) || empty($options['download_image'])){
		
			$options['download_image'] = WP_PLUGIN_URL . "/" . basename(dirname(__FILE__)) . "/" . 'images/baixar.png';
			
			update_option(self::CLASS_NAME . "_options", $options);
			
		}
		
	}

	
	public function Anderson_Makiyama_Baixar_Apos_Curtir_No_Facebook(){ //__construct()


		$this->plugin_basename = plugin_basename(__FILE__);

		$this->plugin_path = dirname(__FILE__) . "/";

		$this->plugin_url = WP_PLUGIN_URL . "/" . basename(dirname(__FILE__)) . "/";
		
		$this->download_image = $this->plugin_url . 'images/baixar.png';


		load_plugin_textdomain( self::CLASS_NAME, false, strtolower(str_replace(" ","-",self::PLUGIN_NAME)) . '/lang' );	


	}

	

	public function get_like_btn($attr, $content){
		
		global $anderson_makiyama;
		
		$content = explode(",",$content);
		
		if(count($content) <2) return 'Erro encontrado. Informe o url para o Like e o url do Download, separados com uma virgula!';
		
		
		$options = get_option(self::CLASS_NAME . "_options");
		
		$download_image = empty($options['download_image'])?$anderson_makiyama[self::PLUGIN_ID]->download_image:$options['download_image'];
		
		$url_to_like = $content[0];
		$url_to_file = $content[1];
		
		$full_code = "
		<div id='fb-root'></div>
		<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = '//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=". self::APP_ID ."';
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
			
		window.fbAsyncInit = function() {
			FB.init({
				appId  : '". self::APP_ID ."',
				status : true, // check login status
				cookie : true, // enable cookies to allow the server to access the session
				xfbml  : true,
				channelUrl  : '". $anderson_makiyama[self::PLUGIN_ID]->plugin_url . "channel-pt.php' // custom channel
			});
		
				FB.Event.subscribe('edge.create',
					function(response) {
						//alert('You liked the URL: ' + response); // Uncomment this line to activate javascript alert
						document.getElementById('download-apos-curtir').style.display = 'block';
					}
				);
				
				FB.Event.subscribe('edge.remove', function(href, widget) {
					//alert('You just unliked '+href);
					document.getElementById('download-apos-curtir').style.display = 'none';
				});
				
			}; 
		</script>
		
		<div class='fb-like' data-href='". $url_to_like ."' data-send='false' data-layout='button_count' data-width='50' data-show-faces='false'></div>
		
		<div id='download-apos-curtir' style='display:none;'>
			<a href='". $url_to_file ."' target='_blank'>
				<img src='". $download_image ."'/>
			</a>
		</div>";
		
		return $full_code;
				
		
	}


	public function settings_link($links) { 

		global $anderson_makiyama;

		$settings_link = '<a href="options-general.php?page='. self::CLASS_NAME .'">Configurações</a>'; 

		array_unshift($links, $settings_link); 

		return $links; 

	}	



	public function options(){


		global $anderson_makiyama, $user_level;

		get_currentuserinfo();

		if (function_exists('add_options_page')) { //Adiciona pagina na seção Configurações

			add_options_page(self::PLUGIN_NAME, self::PLUGIN_NAME, 1, self::CLASS_NAME, array(self::CLASS_NAME,'options_page'));

		}

		if (function_exists('add_submenu_page')){ //Adiciona pagina na seção plugins

			add_submenu_page( "plugins.php",self::PLUGIN_NAME,self::PLUGIN_NAME,1, self::CLASS_NAME, array(self::CLASS_NAME,'options_page'));			  

		}

  		 add_menu_page(self::PLUGIN_NAME, self::PLUGIN_NAME,1, self::CLASS_NAME,array(self::CLASS_NAME,'options_page'), plugins_url('/images/icon.png', __FILE__));

		 
		 add_submenu_page(self::CLASS_NAME, self::PLUGIN_NAME,'Página de Ajuda',1, self::CLASS_NAME . "_Help", array(self::CLASS_NAME,'help_page'));
		 
		  global $submenu;
		 if ( isset( $submenu[self::CLASS_NAME] ) )
			$submenu[self::CLASS_NAME][0][0] = 'Configure a Imagem';

	}	


	public function options_page(){


		global $anderson_makiyama, $wpdb, $user_ID, $user_level, $user_login;

		get_currentuserinfo();


		if ($user_level < 10) { //Limita acesso para somente administradores

			return;

		}	

		$options = get_option(self::CLASS_NAME . "_options");


		if ($_POST['submit']) {
			
			if(!wp_verify_nonce( $_POST[self::CLASS_NAME], 'update' ) && !wp_verify_nonce( $_POST[self::CLASS_NAME], 'reset' )){
				
				print 'Sorry, your nonce did not verify.';
  				exit;
   
			}

			$_POST['download_image'] = trim($_POST['download_image']);

			if( empty($_POST['download_image']) ){
				
				echo '<div id="message" class="error">';
	
				echo '<p><strong>O url da imagem de download tem que ser preenchido</strong></p>';
	
				echo '</div>';	
			
				
			}else{
				
				
				$options['download_image'] = $_POST['download_image'];
	
				update_option(self::CLASS_NAME . "_options", $options);
			
				
				echo '<div id="message" class="updated">';
	
				echo '<p><strong>As alterações foram salvas com sucesso!</strong></p>';
	
				echo '</div>';	
				
				
			}

		}

		include("templates/options.php");

	}		


	public function help_page(){

		global $anderson_makiyama;

		include("templates/help.php");

	}	


	public static function make_data($data, $anoConta,$mesConta,$diaConta){


	   $ano = substr($data,0,4);

	   $mes = substr($data,5,2);

	   $dia = substr($data,8,2);

	   return date('Y-m-d',mktime (0, 0, 0, $mes+($mesConta), $dia+($diaConta), $ano+($anoConta)));	

	}



	

	public static function get_data_array($data,$part=''){


	   $data_ = array();

	   $data_["ano"] = substr($data,0,4);

	   $data_["mes"] = substr($data,5,2);

	   $data_["dia"] = substr($data,8,2);

	   if(empty($part))return $data_;

	   return $data_[$part];

	}	



	public static function is_checked($vl1,$vl2){

		if($vl1==$vl2) return " checked=checked ";

		return "";

	}	


	public static function is_selected($vl1, $vl2){

		if($vl1==$vl2) return " selected=selected ";

		return "";

	}	


}



if(!isset($anderson_makiyama)) $anderson_makiyama = array();

$anderson_makiyama_indice = Anderson_Makiyama_Baixar_Apos_Curtir_No_Facebook::PLUGIN_ID;

$anderson_makiyama[$anderson_makiyama_indice] = new Anderson_Makiyama_Baixar_Apos_Curtir_No_Facebook();

add_filter("plugin_action_links_". $anderson_makiyama[$anderson_makiyama_indice]->plugin_basename, array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'settings_link') );

add_filter("admin_menu", array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'options'),30);

register_activation_hook( __FILE__, array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'activation') );

add_shortcode('aposcurtir', array($anderson_makiyama[$anderson_makiyama_indice]->get_static_var('CLASS_NAME'), 'get_like_btn') );


?>