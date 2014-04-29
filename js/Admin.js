var _ = _ || {};

define(['Site','tinymce/tinymce.min','plupload/plupload.full.min'], function () {
	var Admin = function()
	{
		this.uploader = null;
		this.$current = null;
		this.translations = {};
	};
	
	Admin.prototype.initialize = function()
	{
		this.show('admin_general');
		
		tinymce.init({
			content_css: "style/stylesheets/screen.css",
			selector: "textarea",
			language : 'ca',
			plugins : 'image,link,textcolor,pagebreak,layer,table,save,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,template',
			toolbar: "undo redo | styleselect | bold italic | forecolor backcolor | fontselect |  fontsizeselect | link image"
		});

		this.uploader = new plupload.Uploader({
		    runtimes : 'html5,flash,silverlight,html4',

		    browse_button : 'pickfiles', // you can pass in id...
		    container: document.getElementById('container'), // ... or DOM Element itself
		     
		    url : _.Site.baseUrl + "admin/upload/1",
		     
		    filters : {
		        max_file_size : '10mb',
		        mime_types: [
		            {title : "Imatges", extensions : "jpg,gif,png"},
		            {title : "Zip/Rar", extensions : "zip,rar"},
		            {title : "Música", extensions : "mp3,ogg,aac"},
		        ]
		    },
		 
		    // Flash settings
		    flash_swf_url : _.Site.baseUrl + 'js/plupload/Moxie.swf',

		    // Silverlight settings
		    silverlight_xap_url : _.Site.baseUrl + 'js/plupload/Moxie.xap',
		 
		    init: {
		        PostInit: function() {
		            document.getElementById('filelist').innerHTML = '';
		 
		            document.getElementById('uploadfiles').onclick = function() {
		                _.Admin.uploader.start();
		                return false;
		            };
		        },
		        
		       FileUploaded: function(up, file, response) {
		        	var data = jQuery.parseJSON(response.response);
		        	//alert(data.result);
		        	//alert(data.error);
		        	//alert(data.filename);
		        	//alert(data.path);
		       },
		 
		        FilesAdded: function(up, files) {
		            plupload.each(files, function(file) {
		                document.getElementById('filelist').innerHTML += '<div id="' + file.id + '"><a href="javascript:void(0);" onclick="_.Admin.uploader.removeFile(\'' + file.id + '\')">&#10006;</a> ' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
		            });
		        },
		        
		        FilesRemoved: function(up){
		        	$('#filelist').html('');
		        	$.each(_.Admin.uploader.files, function(i, file){
		        		document.getElementById('filelist').innerHTML += '<div id="' + file.id + '"><a href="javascript:void(0);" onclick="_.Admin.uploader.removeFile(\'' + file.id + '\')">&#10006;</a> ' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
		        	});
		        },
		 
		        UploadProgress: function(up, file) {
		            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
		        },
		 
		        Error: function(up, err) {
		        	$('#console').show().html(err.message).animate({opacity: 0}, 'fast', function(){ 
		        		$('#console').animate({opacity: 100}, 'fast'); 
		        	});
		        }
		    }
		});

		this.uploader.init();
	};
	
	Admin.prototype.show = function(what)
	{
		if (this.$current)
			this.$current.hide();
		this.$current = $('#' + what);
		this.$current.show();
	};
	
	Admin.prototype.addTranslation = function(to)
	{
		var from = $('body').data('language');
		
		this.translations[from] = {};
		this.translations[from]['title'] = $('#news_title').val();
		this.translations[from]['text'] = tinyMCE.activeEditor.getContent();
		
		if (to !== false)
		{
			if (!(to in this.translations))
			{
				this.translations[to] = {};
				this.translations[to]['title'] = '';
				this.translations[to]['text'] = '';		
			}
			
			$('#news_title').val(this.translations[to]['title']);
			tinyMCE.activeEditor.setContent(this.translations[to]['text']);
			
			$('body').data('language', to);
		}
	};
	
	Admin.prototype.sendNews = function()
	{
		_.Site.Fade();
		
		this.addTranslation(false);
		var me = this;
		var crsf = $('#hidden_post');
		
		var json = JSON.stringify(me.translations);
		json = "&" + crsf.attr('name') + "=" + crsf.val() + "&data=" + encodeURIComponent(json);
		
		$.ajax({
		    type: 'POST',
		    url: _.Site.baseUrl + 'admin/news/add',
		    data: json,
		    success: function(msg, textStatus, jqXHR){
		    	switch(msg)
		    	{
			    	case 0:
			    		break;
			    		
			    	case 1:
			    		break;
			    		
			    	case 2:
			    		break;
		    	}
		    	_.Site.FadeOut();
		    },
		    error: function()
		    {
		    	_.Site.FadeOut();
		    },
		});
	};
	
	_.Admin = new Admin;
	return _.Admin;
});