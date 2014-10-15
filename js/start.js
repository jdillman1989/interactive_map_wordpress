    var width = $('canvas').parent().width();
    $('canvas').attr("width",width);

    var options = {
    // Boolean - whether or not the chart should be responsive and resize when the browser does.
    //responsive: true,

    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    //maintainAspectRatio: false,

    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines : false,

    //Boolean - If there is a stroke on each bar
    barShowStroke : false,

    //Number - Spacing between each of the X value sets
    barValueSpacing : 5,

    //Number - Spacing between data sets within X values
    barDatasetSpacing : 1,

    inGraphDataShow : true,

    //inGraphDataVAlign : "middle",

    //inGraphDataAlign : "center",

    //inGraphDataPaddingX : -20,

    //inGraphDataFontColor : "white",

    //animationLeftToRight : true,

    graphMin : 0,

    graphTitleFontColor : "#898989",

    graphTitleFontSize : 19,

    thousandSeparator : ","
    }

    // get bar chart canvas
    var canvas = document.createElement("canvas");
    $(canvas).attr("width", "900px").attr("height", "220px");
    $("#canvas-holder").children("canvas").replaceWith(canvas);
    var bar= canvas.getContext("2d");
    //var bar= document.getElementById("bar").getContext("2d"); 

    jQuery(document).ready(function() {

        //loading animation
        var $loading = $('#loader').hide();
        $(document)
          .ajaxStart(function () {
            $loading.show();
          })
          .ajaxStop(function () {
            $loading.hide();
          });

        //Worldwide button
        var worldwide= document.getElementById("worldwide");

        worldwide.onclick = function(){

            options.graphTitle = "Scripture Distribution Goals for 2015";

            var worldData = {
                labels: ["Bibles", "New Testaments", "Scripture Materials"],
                datasets : [
                    {
                        fillColor : "#ccc",
                        data : [995332, 682921, 2674837],
                    }
                ]
            };
            new Chart(bar).HorizontalBar(worldData, options);
        };

        //deep-linking
        region = null;
        // If there is a hash, then grab it and update the page to reflect that region
        if(location.hash){

            region = location.hash.split('#')[1];

            $.ajax(get_data.ajaxurl, {
                data: {region: region, 'action': 'get_chart_data'},
                dataType: 'json',
                success: function(response) {

                    options.graphTitle = response.title;

                    var data = {
                        labels: ["Bibles", "New Testaments", "Scripture Materials"],
                        datasets: [response.data]
                    };

                    var width = $('canvas').parent().width();
                    $('canvas').attr("width",width);
                    new Chart(bar).HorizontalBar(data, options);

                    //responsiveness
                    window.onresize = function(event){
                        var width = $('canvas').parent().width();
                        $('canvas').attr("width",width);
                        new Chart(bar).HorizontalBar(data, options);
                    };

                    //location.hash = response.hash;
                } 
            });

            // Update #post with the region post info
            $.ajax(get_data.ajaxurl, {
                data: {region: region, 'action': 'get_post_data'},
                dataType: 'json',
                success: function(response) {
                    $("#post").html(response);
                }
            }); 

            $("html, body").animate({scrollTop: $("#canvas-holder").offset().top}, 2500);   
        }

        //Map config
        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: '#fff',
            borderColor: '#bbb',
            borderOpacity: 1,
            borderWidth: .1,
            color: '#bbb',
            colors: colored_regions,
            hoverOpacity: 0.6,
            selectedColor: null,
            enableZoom: false,
            showTooltip: false,
            onRegionOver : function (element, code, region)
            {
                highlightRegionOfCountry(code);
            },
            onRegionOut : function (element, code, region)
            {
                unhighlightRegionOfCountry(code);
            },
            onRegionClick: function(element, code, region)
            {
                if (location.hash) {
                    location.hash.replace("#","")+".html"
                }

                //Chart request
                $.ajax(get_data.ajaxurl, {
                    data: {region: region, 'action': 'get_chart_data'},
                    dataType: 'json',
                    success: function(response) {

                        options.graphTitle = response.title;

                        var data = {
                            labels: ["Bibles", "New Testaments", "Scripture Materials"],
                            datasets: [response.data]
                        };

                        var width = $('canvas').parent().width();
                        $('canvas').attr("width",width);
                        new Chart(bar).HorizontalBar(data, options);

                        //responsiveness
                        window.onresize = function(event){
                            var width = $('canvas').parent().width();
                            $('canvas').attr("width",width);
                            new Chart(bar).HorizontalBar(data, options);
                        };

                        //location.hash = response.hash;
                    }
                });
            
                //Post request
                $.ajax(get_data.ajaxurl, {
                    data: {region: region, 'action': 'get_post_data'},
                    dataType: 'json',
                    success: function(response) {
                        $("#post").html(response);
                        location.hash = region;
                    }
                });

            }  
        });
    });

