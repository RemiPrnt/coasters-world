$(document).ready(function() {
    // Init smooth Menu
    ddsmoothmenu.init({
        mainmenuid: "menu",
        orientation: 'h',
        classname: 'navigation',
        contentsource: 'markup'
    });

    // Responsive Navigation Menu
    selectnav('nav', {
        label: '- Navigation Menu - ',
        nested: true,
        indent: '-'
    });

    // Link to top Plugin
    $().UItoTop({ easingType: 'easeOutQuart' });
});

jQuery(function($){
    $(".tweet").tweet({
        join_text: false,
        username: "CoastersWorld",
        avatar_size: false,
        count: 2
    });
});
