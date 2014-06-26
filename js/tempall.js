$(document).ready(function() {
    adres = "/index/temp-pokoj";
    $('select').change(function(event) {
        alert();
        switch (event.target.value) {
            case "pokoj":
                adres = "/index/temp-pokoj";
                break;
            case "garaz":
                adres = "/index/temp-garaz";
                break;
            case "salon":
                adres = "/index/temp-salon";
                break;
            case "lazienka":
                adres = "/index/temp-lazienka";
                break;
            case "kuchnia":
                adres = "/index/temp-kuchnia";
                break;
            default:
                adres = "/index/temp-pokoj";
        }
    });
    $(function() {

        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        // Create the chart
        $('#tempall').highcharts('StockChart', {
            chart: {
                events: {
                    load: function() {

                        // set up the updating of the chart each second
                        var series = this.series[0];
                        setInterval(function() {
                            $.getJSON(adres, function(data) {
                            }).done(function(data) {
                                var x = (new Date()).getTime(); // current time
                                series.addPoint([x, data[0]], true, true);
                            })
                        }, 3000);
                    }
                }
            },
            rangeSelector: {
                buttons: [{
                        count: 1,
                        type: 'minute',
                        text: '1M'
                    }, {
                        count: 5,
                        type: 'minute',
                        text: '5M'
                    }, {
                        type: 'all',
                        text: 'All'
                    }],
                inputEnabled: false,
                selected: 0
            },
            title: {
                text: 'Live random data'
            },
            exporting: {
                enabled: false
            },
            series: [{
                    name: 'Random data',
                    data: (function() {
                        // generate an array of random data
                        var data = [], time = (new Date()).getTime(), i;
                        for (i = -999; i <= 0; i++) {
                            data.push([
                                time + i * 1000,
                                0
                            ]);
                        }
                        return data;
                    })()
                }]
        });
    });

});