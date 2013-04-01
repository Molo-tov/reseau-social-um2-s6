(function($){

	$.fn.notif = function(options){
		var options = $.extend({
			html : '<div class="notification">\
                        <div class="left">\
                           <div class="icon">\
                           &#9873;\
                           </div> \
                        </div>\
                    <div class="right">\
                        <h2>Titre</h2>\
                        <p>Une petite description</p>\
                    </div>\
                 </div>'

		}, options);

		return this.each(function(){

			var $this = $(this);
			var $notifs = $('> .notifications', this);
			if($notifs.length == 0){ //si la class "notifications" n'existe pas dans mon code html
				//alors on crée une div "notifications"
				$notifs = $('<div class="notifications"/>');
				$this.append($notifs);
			}
			$notifs.append(options.html);
		})
	}

	//les parametres qu l'on rajoute au fur et a mesure des qu'on a une nouvelle notifications
	//donc ici qui correspond a 3 parties, le titre de la notification, son descriptif
	//et l'icone correspondante 
	$('body').notif({title: 'Mon titre', content:'Mon contenu', icon:'&#128165;'})

})(jQuery);