<!DOCTYPE html>
<html>
    <head>
        <title>Dagsen - Meny</title>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
        <style>
            body {
                text-align: center;
                font-family: "Montserrat", sans-serif;
            }
            h1 {
                font-size: 4em;
            }
            div#menu {
                font-size: 2em;
            }
            div#open-time {
                font-size: 1.5em;
            }
        </style>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    </head>
    <body>
        <!-- Beautiful -->
        <br />
        <br />
        <br />

        <img src="dagsen.png" width="400px" />

        <h1 id="heading">
            <?php echo strftime('%e/%m'); ?>
        </h1>

        <div id="menu">
            <?php 
                $default_lang = 'sv';
                $langs = ['sv', 'fi', 'en'];

                $lang = $_GET['lang'];
                if (!in_array($lang, $langs))
                    $lang = $default_lang;

                $menu_string = file_get_contents('http://api.tf.fi/taffa/' . $lang . '/today/');
                $exploded = explode("\n", $menu_string);

                foreach ($exploded as $menu_item) { ?>
                    <p><?php echo $menu_item ?></p>
            <?php } ?>
        </div>

        <br />
        <div id="open-time">
            10:30 - 15:00
        </div>
    </body>
    <script>
        // Interval for when the page should update the page language, in ms
        const changeInterval = 20000;

        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        };

        $('document').ready(() => {
            const lang = getUrlParameter('lang');
            const new_lang =
                lang === 'en' ?
                    'fi' : lang === 'sv' ?
                        'en' : 'sv';

            setTimeout(() => {
               window.location.href = window.location.pathname + '?' + $.param({'lang': new_lang}); 
            }, changeInterval);

            //$('body').width(1070);
            //$('body').height(660);
        });
    </script>
</html>
