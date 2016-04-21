$(function () {

    $(document).ready(function () {
     var btn = document.getElementById('btn');
    
    var isSafari = /Safari/.test(navigator.userAgent) && /Apple Computer/.test(navigator.vendor);
    

    $('#cointec').submit(function (event) {
         if (isSafari) {

    var errors = false;
    $(this).find('.required').each(function () {
        
        if ($(this).val().length < 1) {

            $(this).addClass('error');
            errors = true;
        }else{
             $(this).removeClass('error');
        }
        
    });
    
    if (errors == true) {
        alert("Please fill all the required details marked with red.");
        event.preventDefault();
    }
    
    }
});


    $('#atec').submit(function (event) {
         if (isSafari) {

    var errors = false;
    $(this).find('.required').each(function () {
        
        if ($(this).val().length < 1) {

            $(this).addClass('error');
            errors = true;
        }else{
             $(this).removeClass('error');
        }
        
    });
    
    if (errors == true) {
        alert("Please fill all the required details marked with red.");
        event.preventDefault();
    }
    
    }
});

        var subtotal1 = $('#subtotal1').val();
        var sub1 = (subtotal1 * 100) / 81;
        var total1 = 100 - sub1;

         var subtotal2 = $('#subtotal2').val();
        var sub2 = (subtotal2 * 100) / 36;
        var total2 = 100 - sub2;

         var subtotal3 = $('#subtotal3').val();
        var sub3 = (subtotal3 * 100) / 45;
        var total3 = 100 - sub3;

         var subtotal4 = $('#subtotal4').val();
        var sub4 = (subtotal4 * 100) / 63;
        var total4 = 100 - sub4;

         var subtotal5 = $('#subtotal5').val();
        var sub5 = (subtotal5 * 100) / 72;
        var total5 = 100 - sub5;

         var total = $('#total').val();
        var tot = (total * 100) / 297;
        var overall = 100 - tot;
        
      
        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Neurological signs and symptoms'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Scores",
                colorByPoint: true,
                data: [{
                    name: "Total Score",
                    y: total1,
                }, {
                    name: "Neurological signs and symptoms",
                    y: sub1,
                    sliced: true,
                    selected: true
                }]
            }]
        });

        $('#container1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Cardiovascular signs and symptoms.'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Scores",
                colorByPoint: true,
                data: [{
                    name: "Total Score",
                    y: total2,
                }, {
                    name: "Cardiovascular signs and symptoms",
                    y: sub2,
                    sliced: true,
                    selected: true
                }]
            }]
        });

$('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Muscular signs and symptoms.'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Scores",
                colorByPoint: true,
                data: [{
                    name: "Total Score",
                    y: total3,
                }, {
                    name: "Muscular signs and symptoms",
                    y: sub3,
                    sliced: true,
                    selected: true
                }]
            }]
        });

        $('#container3').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Cognition signs and symptoms.'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Scores",
                colorByPoint: true,
                data: [{
                    name: "Total Score",
                    y: total4,
                }, {
                    name: "Cognition signs and symptoms",
                    y: sub4,
                    sliced: true,
                    selected: true
                }]
            }]
        });

$('#container4').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Other signs and symptoms'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Scores",
                colorByPoint: true,
                data: [{
                    name: "Total Score",
                    y: total5,
                }, {
                    name: "Other signs and symptoms",
                    y: sub5,
                    sliced: true,
                    selected: true
                }]
            }]
        });


    $('#container5').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Overall Score'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Scores",
                colorByPoint: true,
                data: [{
                    name: "Total Score",
                    y: overall,
                }, {
                    name: "Overall User Score",
                    y: tot,
                    sliced: true,
                    selected: true
                }]
            }]
        });



    


    var fbtotal1;
    var totalfeed
    var $containers = $('.containerfb'),
        chartConfig = {
            chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Overall Score'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: "Scores",
                    colorByPoint: true,
                    data: []
                }]
        };

    $containers.each(function(i, e){
        chartConfig.chart.renderTo = e;
        var fbtotal= $(this).data('total');
        var fbtotal1 = (fbtotal * 100) / 297;
        var totalfeed = 100 - fbtotal1;
        chartConfig.series = new Array();
        chartConfig.series[0] = new Object();
        chartConfig.series[0].data = new Array({
                                    name: "Total Score",
                                    y: totalfeed,
                                    },{
                                                name: "User Score",
                                                y: fbtotal1,
                                                sliced: true,
                                                selected: true
                                            });
        new Highcharts.Chart(chartConfig);
    });

 




    });
});