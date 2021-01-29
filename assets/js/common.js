var ThemeSwitcher = function() {
    return {
        init: function() {
            var theme_panel = $(".theme-panel");
            switchTheme = function(color) {
                $("#style_color").attr("href", "layouts/layout/css/themes/" + color + ".css");
                if (color == "day")
                    $(".page-logo img").attr("src", "layouts/layout/img/" + "logo-invert.png");
                else
                    $(".page-logo img").attr("src", "layouts/layout/image/" + "logo.png")
            };

            $(".theme-colors > ul > li", theme_panel).click(function() {
                var color = $(this).attr("data-style");
                switchTheme(a);
                $("ul > li", theme_panel).removeClass("current"),
                    $(this).addClass("current")
            }),
        }
    }
}();

jQuery(document).ready(function() {
    ThemeSwitcher.init()
});


