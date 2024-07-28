$.extend( theme.PluginCarouselLight.prototype, {
    owlDots: function(){
        var self = this,
            $owlDot = self.$el.find('.owl-dot');

        $owlDot.on('click', function(e){
            $this = $(this);

            e.preventDefault();

            if( self.options.disableAutoPlayOnClick ) {
                window.clearInterval(self.autoPlayInterval);
            }

            if( self.avoidMultipleClicks() ) {
                return false;
            }

            var dotIndex = $(this).index();

            // Do nothing if respective dot slide is active/showing
            if( $this.hasClass('active') ) {
                return false;
            }

            self.changeSlide( self.$el.find('.owl-item').eq( dotIndex ) );
        });

        return this;
    }
} )