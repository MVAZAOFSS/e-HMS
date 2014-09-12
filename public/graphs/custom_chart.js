


function graph(gtitle,gsubtitle,xAxisData,yAxisTitle,yAxisData,gname,chartType){



        $('#container').highcharts({
        	chart : chartType,
            title: {
                text: gtitle,
                x: -20 //center
            },
            subtitle: {
                text: gsubtitle,
                x: -20
            },
            xAxis: {
                categories: xAxisData
            },
            yAxis: {
                title: {
                    text: yAxisTitle
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: gname,
                data: yAxisData
            }]
        });

}