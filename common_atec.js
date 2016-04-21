$(function () {

    $(document).ready(function () {

        var subtotala1 = $('#subtotala1').val();
        var sub1 = (subtotala1 * 100) / 28;
        var total1 = 100 - sub1;

         var subtotala2 = $('#subtotala2').val();
        var sub2 = (subtotala2 * 100) / 40;
        var total2 = 100 - sub2;

         var subtotala3 = $('#subtotala3').val();
        var sub3 = (subtotala3 * 100) / 36;
        var total3 = 100 - sub3;

         var subtotala4 = $('#subtotala4').val();
        var sub4 = (subtotala4 * 100) / 75;
        var total4 = 100 - sub4;


         var atectotal = $('#atectotal').val();
        var tot = (atectotal * 100) / 179;
        var overall = 100 - tot;
      
        // Build the chart
        $('#containeratec').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Speech, Language and Communication '
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
                    name: "Speech, Language and Communication ",
                    y: sub1,
                    sliced: true,
                    selected: true
                }]
            }]
        });

        $('#containeratec1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Sociability Maximum .'
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
                    name: "Sociability Maximum ",
                    y: sub2,
                    sliced: true,
                    selected: true
                }]
            }]
        });

$('#containeratec2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Cognitive and sensory awareness'
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
                    name: "Cognitive and sensory awareness",
                    y: sub3,
                    sliced: true,
                    selected: true
                }]
            }]
        });

        $('#containeratec3').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Health and physical behaviour'
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
                    name: "Health and physical behaviour",
                    y: sub4,
                    sliced: true,
                    selected: true
                }]
            }]
        });



    $('#containeratec5').highcharts({
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
    var $containeratecs = $('.containeratecfb'),
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

    $containeratecs.each(function(i, e){
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