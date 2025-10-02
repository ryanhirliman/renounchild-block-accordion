(function($){
    
    /**
     * 
     * 
     * @version 1.0.0
     */

    const EsTabs = function(el) {
        this.tabs = el;
        this.$tabs = $(el);
        this.select = el.querySelector('select');
        this.tabTitles = el.querySelector('.tabs');
        this.select.addEventListener( 'change', this.syncTabs.bind(this) );
        this.$tabs.on( 'change.zf.tabs', this.syncSelect.bind(this) );
        this.doingChange = false;
    }

    EsTabs.prototype.init = function() {
        if ( document.querySelector('.wp-admin') ) return;
        
        const esTabs = document.querySelectorAll('.es-tabs');
        esTabs.forEach( tabs => {
            new EsTabs( tabs );
        });
    }


    EsTabs.prototype.syncSelect = function(e, title, panel) {
        // console.log( 'syncSelect Firing');
        if ( this.doingChange || ! title ) return;

        let index = this.getIndex( title[0] );
        if ( index > -1 ) {
            this.select.selectedIndex = index;
        }
    }
    
    EsTabs.prototype.syncTabs = function(e) {
        // console.log( 'syncTabs Firing');
        let id = this.select.value;
        let index = this.select.selectedIndex;
        this.doingChange = true;

        // $( this.tabTitles ).foundation('_openTab', $(this.tabTitles).children(`:eq( ${index} )`) );
        $( this.tabTitles ).foundation('selectTab', `#${id}` );
        this.doingChange = false;
    }    

    EsTabs.prototype.getIndex = function(childElement) {
        const parent = childElement.parentNode;
        if (!parent) {
          return -1;
        }
        return Array.from(parent.children).indexOf(childElement);
    }

    $(document).ready(function(){
        EsTabs.prototype.init();

        if ( $('.wp-admin').length ) {
            setTimeout( EsTabs.prototype.init, 2000 );
        }
    });
    
    if( window.acf ) {
        // window.acf.addAction( 'render_block_preview/type=renoun/button', disableButtons )
    }
})(jQuery);