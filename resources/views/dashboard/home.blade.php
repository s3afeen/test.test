@extends('layouts.app')
@section('content')
 <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">Visit And Sales Statistics</h4>
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Traffic Sources</h4>
                    <canvas id="traffic-chart"></canvas>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                </div>
              </div>
            </div>
          </div>

          <script>
            const visitSaleChart = document.getElementById('visit-sale-chart').getContext('2d');
            const trafficChart = document.getElementById('traffic-chart').getContext('2d');

            const salesData = {
              labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
              datasets: [
                {
                  label: 'Sales',
                  data: [120, 150, 100, 200, 170, 220, 300, 250],
                  backgroundColor: 'rgba(75, 192, 192, 0.6)',
                },
                {
                  label: 'Visits',
                  data: [200, 250, 220, 300, 350, 400, 450, 500],
                  backgroundColor: 'rgba(153, 102, 255, 0.6)',
                },
              ],
            };

            const trafficData = {
              labels: ['Search Engines', 'Direct Clicks', 'Bookmarks Clicks'],
              datasets: [{
                data: [30, 30, 40],
                backgroundColor: ['#4bc0c0', '#ff6384', '#ffce56'],
              }],
            };

            const visitSaleChartInstance = new Chart(visitSaleChart, {
              type: 'bar',
              data: salesData,
              options: {
                scales: {
                  y: {
                    beginAtZero: true,
                  },
                },
              },
            });

            const trafficChartInstance = new Chart(trafficChart, {
              type: 'pie',
              data: trafficData,
            });
          </script>
@endsection
