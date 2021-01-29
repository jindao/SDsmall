var ThemeSwitcher = function() {
    var themeToggle;
    var default_theme;
    var theme_panel;
    var initialized = false;
    var base_url= "/";
    var switchTheme = function(theme) {
        var theme_styles = $(".theme_style", theme_panel);
        var active_theme = $("[theme-style="+theme+"]", theme_panel);
        theme_styles.removeClass("active");
        active_theme.addClass("active");
        if (theme == "light") {
            $(".theme_switcher", theme_panel).animate({left:"2px"}, 50, "linear");
        } else if (theme == "dark") {
            $(".theme_switcher", theme_panel).animate({left:"35px"}, 50, "linear");
        }
        Cookies.set("theme", theme);
    }
    return {
        init: function() {
            theme_panel = $(".theme_panel");
            themeToggle = new KTToggle('theme_panel', {
                target: 'body',
                targetState: 'theme_dark',
                togglerState: 'theme_panel--dark'
            });

            default_theme = "light";
            var theme = Cookies.get("theme");
            if (theme == undefined) {
                theme = default_theme;
            }
            // if (theme == "light")
            //     themeToggle.toggleOff();
            // else
            //     themeToggle.toggleOn();

            switchTheme(theme);
            
            initialized = true;

            themeToggle.on('toggle', function(){
                var state = themeToggle.getState();
                if (state == 'on') {
                    switchTheme("dark");
                } else if (state == 'off') {
                    switchTheme("light");
                }
            });
        },
        switch: function (theme) {
            if (!initialized) 
                this.init();
            switchTheme(theme);
        }
    }
}();

jQuery(document).ready(function() {
    ThemeSwitcher.init();

    $('#signOut').on('click', function(){
        $.post({
            url: 'logout.php',
            success: function(response, status, xhr, $form) {
                // similate 2s delay
                if(status == "success") {
                    window.location.reload();
                    return ;
                }
                setTimeout(function() {
                    btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
                    showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
                }, 2000);
            }
        });
    });
});
