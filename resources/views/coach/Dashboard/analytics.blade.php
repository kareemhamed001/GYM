@extends('layouts.app-blog-create')
@section('styles')
    <link href="{{asset('assets/src/plugins/src/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/plugins/css/light/apex/custom-apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/src/plugins/css/dark/apex/custom-apexcharts.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')

            <div class="container">

                <!-- BREADCRUMB -->
                <div class="page-meta">
                    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">User Interface</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Charts</li>
                        </ol>
                    </nav>
                </div>
                <!-- /BREADCRUMB -->

                <div id="navSection" data-bs-spy="affix" class="nav sidenav">
                    <div class="sidenav-content">
                        <a href="#chartLine" class="active nav-link">Line</a>
                        <a href="#chartArea" class="nav-link">Area</a>
                        <a href="#chartColumn" class="nav-link">Column</a>
                        <a href="#chartColumnStacked" class="nav-link">Column Stacked</a>
                        <a href="#chartBar" class="nav-link">Bar</a>
                        <a href="#chartMixed" class="nav-link">Mixed</a>
                        <a href="#chartDonut" class="nav-link">Donut</a>
                        <a href="#chartRadial" class="nav-link">Radial</a>
                    </div>
                </div>

                <div class="row" id="cancel-row">
                    <div id="chartLine" class="col-xl-12 layout-top-spacing layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Apex (Simple)</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div id="s-line" class=""></div>

                                <div class="code-section-container show-code">

                                    <button class="btn toggle-code-snippet"><span>Code</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down toggle-code-icon"><polyline points="6 9 12 15 18 9"></polyline></svg></button>

                                    <div class="code-section text-left">
                                                <pre>
var sline = {
  chart: {
    height: 350,
    type: 'line',
    zoom: {
      enabled: false
    },
    toolbar: {
      show: false,
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight'
  },
  series: [{
    name: "Desktops",
    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
  }],
  title: {
    text: 'Product Trends by Month',
    align: 'left'
  },
  grid: {
    row: {
      colors: ['#f1f2f3', 'transparent'], // takes an array which will be repeated on columns
      opacity: 0.5
    },
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
  }
}

var chart = new ApexCharts(
  document.querySelector("#s-line"),
  sline
);

chart.render();</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="chartArea" class="col-xl-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Simple Area</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div id="s-line-area" class=""></div>

                                <div class="code-section-container">

                                    <button class="btn toggle-code-snippet"><span>Code</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down toggle-code-icon"><polyline points="6 9 12 15 18 9"></polyline></svg></button>

                                    <div class="code-section text-left">
                                                <pre>
var sLineArea = {
    chart: {
        height: 350,
        type: 'area',
        toolbar: {
          show: false,
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    series: [{
        name: 'series1',
        data: [31, 40, 28, 51, 42, 109, 100]
    }, {
        name: 'series2',
        data: [11, 32, 45, 32, 34, 52, 41]
    }],

    xaxis: {
        type: 'datetime',
        categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T06:30:00"],
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    }
}

var chart = new ApexCharts(
    document.querySelector("#s-line-area"),
    sLineArea
);

chart.render();</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="chartColumn" class="col-xl-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Simple Column</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div id="s-col" class=""></div>

                                <div class="code-section-container">

                                    <button class="btn toggle-code-snippet"><span>Code</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down toggle-code-icon"><polyline points="6 9 12 15 18 9"></polyline></svg></button>

                                    <div class="code-section text-left">
                                                <pre>
var sCol = {
    chart: {
        height: 350,
        type: 'bar',
        toolbar: {
          show: false,
        }
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    series: [{
        name: 'Net Profit',
        data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
    }, {
        name: 'Revenue',
        data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
    }],
    xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    },
    yaxis: {
        title: {
            text: '$ (thousands)'
        }
    },
    fill: {
        opacity: 1

    },
    tooltip: {
        y: {
            formatter: function (val) {
                return "$ " + val + " thousands"
            }
        }
    }
}

var chart = new ApexCharts(
    document.querySelector("#s-col"),
    sCol
);

chart.render();
</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="chartColumnStacked" class="col-xl-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Simple Column Stacked</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div id="s-col-stacked" class=""></div>

                                <div class="code-section-container">

                                    <button class="btn toggle-code-snippet"><span>Code</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down toggle-code-icon"><polyline points="6 9 12 15 18 9"></polyline></svg></button>

                                    <div class="code-section text-left">
                                                <pre>
var sColStacked = {
    chart: {
        height: 350,
        type: 'bar',
        stacked: true,
        toolbar: {
          show: false,
        }
    },
    responsive: [{
        breakpoint: 480,
        options: {
            legend: {
                position: 'bottom',
                offsetX: -10,
                offsetY: 0
            }
        }
    }],
    plotOptions: {
        bar: {
            horizontal: false,
        },
    },
    series: [{
        name: 'PRODUCT A',
        data: [44, 55, 41, 67, 22, 43]
    },{
        name: 'PRODUCT B',
        data: [13, 23, 20, 8, 13, 27]
    },{
        name: 'PRODUCT C',
        data: [11, 17, 15, 15, 21, 14]
    },{
        name: 'PRODUCT D',
        data: [21, 7, 25, 13, 22, 8]
    }],
    xaxis: {
        type: 'datetime',
        categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT', '01/05/2011 GMT', '01/06/2011 GMT'],
    },
    legend: {
        position: 'right',
        offsetY: 40
    },
    fill: {
        opacity: 1
    },
}

var chart = new ApexCharts(
    document.querySelector("#s-col-stacked"),
    sColStacked
);

chart.render();</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="chartBar" class="col-xl-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Simple Bar</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div id="s-bar" class=""></div>

                                <div class="code-section-container">

                                    <button class="btn toggle-code-snippet"><span>Code</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down toggle-code-icon"><polyline points="6 9 12 15 18 9"></polyline></svg></button>

                                    <div class="code-section text-left">
                                                <pre>
var sBar = {
    chart: {
        height: 350,
        type: 'bar',
        toolbar: {
          show: false,
        }
    },
    plotOptions: {
        bar: {
            horizontal: true,
        }
    },
    dataLabels: {
        enabled: false
    },
    series: [{
        data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
    }],
    xaxis: {
        categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan', 'United States', 'China', 'Germany'],
    }
}

var chart = new ApexCharts(
    document.querySelector("#s-bar"),
    sBar
);

chart.render();</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="chartMixed" class="col-xl-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Mixed</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div id="mixed-chart" class=""></div>
                            </div>
                        </div>
                    </div>

                    <div id="chartRadial" class="col-xl-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Radial</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div id="radial-chart" class=""></div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        <!--  BEGIN FOOTER  -->
        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © <span class="dynamic-year">2022</span> <a target="_blank" href="https://designreset.com/cork-admin/">DesignReset</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
            </div>
        </div>
        <!--  END FOOTER  -->

@endsection
@section('scripts')
    <script src="{{asset('assets/src/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/src/plugins/src/apex/custom-apexcharts.js')}}"></script>
@endsection



