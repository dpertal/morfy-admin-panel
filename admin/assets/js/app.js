
var app = (function() {

    'use-strict';


    /**
     *    Description:
     *    Private functions goes here
     */
    function $(element) {
        return document.querySelector(element);
    }


    return {

        /**
         *    Description:
         *    Start javascript
         *
         *    Syntax:
         *    app.init();
         */
        init: function() {
            // load navigation
            this.navigation();
            // Start loader
            this.loader();
            // table dropdown
            this.tableDropdown();
        },




        /*
         *    Description:
         *    preload on init
         *
         *    Syntax:
         *    panel.loader && this.loader();
         */
        loader: function() {
            panel.fadeIn($('#content'), 500, function() {
                $('#content').style.display = 'block';
            });
        },


        /**
         *    Description:
         *    navigation functions
         *
         *    Syntax:
         *    app.navigation && this.navigation
         */
        navigation: function() {
            // vars
            var menu = $('.menu'),
                i = $('.menu > i'),
                menuDiv = $('#menu'),
                wrapperDiv = $('#wrapper');
            // menu
            if (menu) {
                menu.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (panel.hasCls(i, 'ti-layout-sidebar-left')) {
                        panel.removeCls(i, 'ti-layout-sidebar-left');
                        panel.addCls(i, 'ti-layout-sidebar-right');
                    } else {
                        panel.addCls(i, 'ti-layout-sidebar-left');
                        panel.removeCls(i, 'ti-layout-sidebar-right');
                    }
                    panel.toggleCls(menuDiv, 'is-opened');
                    panel.toggleCls(wrapperDiv, 'menu-is-open');
                });

                // select all links of sidebar
                var navlink = document.querySelectorAll('.dropdown-link');
                // convert to array
                var toArray = Array.prototype.slice.call(navlink);
                // make forEach
                Array.prototype.forEach.call(toArray,function(selector,index){
                    // on click show drowdown and change arrow
                    selector.addEventListener('click', function(){
                        // check if has dropdown element
                        if(panel.hasCls(this.nextElementSibling,'dropdown')){
                            panel.toggleCls(this.nextElementSibling,'show_menu');
                            if(panel.hasCls(this.nextElementSibling,'show_menu')){
                                // check if get arrow
                                if(this.querySelector('i')){
                                    this.querySelector('i').className = '';
                                    this.querySelector('i').className = 'ti-angle-down';
                                }
                            }else{
                                // check if get arrow
                                if(this.querySelector('i')){
                                    this.querySelector('i').className = '';
                                    this.querySelector('i').className = 'ti-angle-right';
                                }
                            }
                        }
                    },false);
                });
            }
        },
        // get links of table dropdown
        tableDropdown: function(){
            var selectOption = document.querySelectorAll('.selectOption');
            // if exists
            if(selectOption){
                var selectOptionToArray = Array.prototype.slice.call(selectOption);
                Array.prototype.forEach.call(selectOptionToArray,function(selector,index){
                    selector.addEventListener('change',function(){
                        window.location.href= this.value;
                    },false);
                });
            }
        }
    };
})();

/*  on load
---------------------*/
window.addEventListener('load', function(){
    app.init();
});
