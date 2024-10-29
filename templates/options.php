<div class="wrap">

<div class="icon32"><img src='<?php echo plugins_url('/images/icon-32.png', dirname(__FILE__))?>' /></div>

        

<h2><?php echo self::PLUGIN_NAME?>: Configurações</h2>




  		<table width="100%"><tr>

        <td style="vertical-align:top">

        

        <div class="metabox-holder">         

		<div class="postbox" >

        

        	<h3>Url da Imagem do Botão de Download: (Você pode usar a imagem padrão ou usar outra.)</h3>

        

        	<div class="inside">


                 <p>

                <table>
                <tr>
                
                <td>
                <form action="" method="post">
                <?php
                 wp_nonce_field('update',self::CLASS_NAME);
				?>
                	<input type="text" name="download_image" class="regular-text" value="<?php echo $options['download_image'];?>" /> <input type="submit" name="submit" value="Salvar" class="button-primary" />
                </form>    
                    <center><h3>Imagem Atual:</h3></center>
                    <center><img src='<?php echo $options['download_image'];?>'/></center>
                    
                </td>
                
                </tr>
                </table>

               

                </p> 
                            

                <p>
				Url da Imagem Original: 
                <form action="" method="post">
                <?php
                 wp_nonce_field('reset',self::CLASS_NAME);
				?>
                <input type="text" readonly="readonly" class="regular-text" name="download_image" onfocus="javascript:this.select();" onclick="javascript:this.select();" value="<?php echo  $anderson_makiyama[self::PLUGIN_ID]->plugin_url . 'images/baixar.png';?>" /> <input type="submit" name="submit" value="Usar a Original" class="button-primary"  />
				</form>
				</p>



			</div>

		</div>

        </div>
     

        <div class="metabox-holder">         

		<div class="postbox" >

        	<div class="inside">
            
            	<h3 style="font-size:24px; text-transform:uppercase;color:#F00;">
                	Não tem InfoProdutos para dar como Brinde? 
                </h3>
                
            	<a href="http://revenda.org" target="_blank"><img src="http://ganhardinheiroblog.net/wp-content/uploads/2013/11/infoprodutos-com-direitos-de-revenda.jpg" style="border:0px;"></a>
                
            </div>
        </div>
        </div>
        
   		</td>

        <td style="vertical-align:top; width:410px">

        

        <div class="metabox-holder">

		<div class="postbox" >

        

        	<h3 style="font-size:24px; text-transform:uppercase;color:#F00;">

        	Dê uma Olhada!

            </h3>

            

             <h3>Melhores Temas Wordpress: <a href="http://plugin-wp.net/aff_elegantthemes" target="_blank">Elegant Themes</a></h3>

             

        	<div class="inside">

                <p>

                <a href="http://plugin-wp.net/aff_elegantthemes" target="_blank"><img src="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_url?>images/elegantthemes.jpg" ></a>

				</p>



			</div>

 
 		</div>
        </div>
        
         <div class="metabox-holder">

		<div class="postbox" >           

            <h3>Melhor Autoresponder para Email Marketing: <a href="http://plugin-wp.net/aff_trafficwave" target="_blank">TrafficWave</a></h3>

            

        	<div class="inside">

                <p>

                <a href="http://plugin-wp.net/aff_trafficwave" target="_blank"><img src="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_url?>images/trafficwave.jpg"></a>

				</p>



			</div> 

                        

		</div>

        </div>

              

       </td>

       </tr>

       </table>





<hr />





<table>

<tr>

<td>

<img src="<?php echo $anderson_makiyama[self::PLUGIN_ID]->plugin_url?>images/anderson-makiyama.png" />

</td>

<td>

<ul>

<li>Autor: <strong>Anderson Makiyama</strong>

</li>

<li>Email do Autor: <a href="mailto:andersonmaki@gmail.com" target="_blank">andersonmaki@gmail.com</a>

</li>

<li>Visite a Página do Plugin: <a href="<?php echo self::PLUGIN_PAGE?>" target="_blank"><?php echo self::PLUGIN_PAGE?></a>


</li>

<li>

Visite o Site do Autor: <a href="http://<?php echo self::AUTHOR_SITE;?>" target="_blank"><?php echo self::AUTHOR_SITE;?></a>

</li>

</ul>

</td>

</tr>

</table>



</div>