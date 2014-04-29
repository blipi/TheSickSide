<div id="admin_zone">
	<input type="hidden" id="hidden_post" name="{$hidden_name}" value="{$hidden_value}" />
	
	<div id="admin_links">
		<div id="admin_links_header">Administració</div>
		<div id="admin_link"><a href="javascript:void(0);" onclick="_.Admin.show('admin_news_new');">Notícies</a></div>
		<div id="admin_link"><a href="javascript:void(0);" onclick="_.Admin.show('admin_file_upload');">Arxius</a></div>
		
		<br />
		<div id="admin_links_header">Pàgines</div>
	</div>
	
	<div id="admin_content">
		<div id="admin_general" style="">
			<div id="admin_conent_header">General</div>
			
			<div id="admin_content_wrapper">
				Benvingut a la zona administrativa.
				<br />
				Des del panel esquerra pot accedir a la configuració del lloc.
				<br />
				<br />
				Sort!
			</div>
		</div>
		
		<div id="admin_news_new" style="display:none;">
			<div id="admin_conent_header">Nova noticia</div>
			
			<div id="admin_content_wrapper">
				<h2>Titol:</h2> <input type="text" name="title" id="news_title" />
				<select id="news_language" onchange="_.Admin.addTranslation($(this).val());">
					<option value="cat" {if $current_language == "cat"}selected{/if}>Català</option>
					<option value="esp" {if $current_language == "esp"}selected{/if}>Castellano</option>
					<option value="eng" {if $current_language == "eng"}selected{/if}>English</option>				
				</select>
				<br />
				<h2>Text:</h2>
				<textarea></textarea>		 
			 	<br />
			 	<div id="news_send_wrapper">
			 		<input type="button" value="Enviar" id="news_send" onclick="_.Admin.sendNews();" />
			 	</div>
			</div>
		</div>
		
		<div id="admin_file_upload" style="display:none;"> 
			<div id="admin_conent_header">Pujar arxius</div>
			
			<div id="admin_content_wrapper">
				<div id="container">
				    <a id="pickfiles" href="javascript:;">Selecionar arxius</a>
				    <a id="uploadfiles" href="javascript:;">Pujar arxius</a>
				    
				    <div id="filelist">El teu navegador no suporta la pujada de fitxers.</div>
					
				</div>
			</div>
			
			<div id="admin_content_wrapper">
				<div id="console"></div>
			</div>
		</div>
	</div>
	
	<div style="clear: both"></div>
	
</div>