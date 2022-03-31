<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Use Bing Maps REST Services with jQuery to build an autocomplete box and find a location dynamically</title>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.5.1.js" type="text/javascript"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/jquery-ui.js" type="text/javascript"></script>
    <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .ui-autocomplete-loading
        {
            background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat;
        }
        #searchBox
        {
            width: 25em;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#searchBox").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "http://dev.virtualearth.net/REST/v1/Locations",
                        dataType: "jsonp",
                        data: {
                            key: "AsPNz_1M40oJW-kxp9v9buZWe43wwkjFJmb8ZFa7v_mBwvWQ1mKMjdFe1e5-7ffP",
                            q: request.term + ", Indonesia"
                        },
                        jsonp: "jsonp",
                        success: function (data) {
                            var result = data.resourceSets[0];
                            if (result) {
                                if (result.estimatedTotal > 0) {
                                    response($.map(result.resources, function (item) {
                                        return {
                                            data: item,
                                            label: item.name + ' (' + item.address.countryRegion + ')',
                                            value: item.name
                                        }
                                    }));
                                }
                            }
                        }
                    });
                },
                minLength: 1,
                change: function (event, ui) {
                    if (!ui.item)
                        $("#searchBox").val('');
                },
                select: function (event, ui) {
                    displaySelectedItem(ui.item.data);
                }
            });
        });

        function displaySelectedItem(item) {
            $("#searchResult").empty().append('Result: ' + item.name).append(' (Latitude: ' + item.point.coordinates[0] + ' Longitude: ' + item.point.coordinates[1] + ')');
            
        }
    </script>
</head>
<body>
    <div>
        <div class="ui-widget">
            <label for="searchBox">
                Search:
            </label>
            <input id="searchBox" />
        </div>
        <div id="searchResult" class="ui-widget" style="margin-top: 1em;">
        </div>
    </div>
</body>
</html>