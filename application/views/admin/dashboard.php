<div class="content-wrapper">
  <div class="row">
    <div class="col-sm-12">
      <div class="home-tab">
        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
          <div>
            <div class="btn-wrapper f-right">
              <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i>
                Share</a>
              <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
              <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
            </div>
          </div>
        </div>
        <div class="tab-content tab-content-basic">

          <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
              <div class="card card-rounded">
                <div class="card-body">
                  <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                      <h4 class="card-title card-title-dash">Ads</h4>
                      <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p>
                    </div>
                    <div>
                      <a href="<?= base_url('admin/page/create/ad/create') ?>"
                        class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i
                          class="mdi mdi-account-card-details"></i>Add Ad</a>
                      <a href="<?= base_url('admin/page/create/user/create') ?>"
                        class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i
                          class="mdi mdi-account-multiple"></i>Add User</a>
                      <a href="<?= base_url('admin/page/create/quote/create') ?>"
                        class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i
                          class="mdi mdi-cards"></i>Create Quote</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
            <div class="row">
              <div class="col-lg-8 d-flex flex-column">
                <div class="row flex-grow">
                  <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                          <div>
                            <h4 class="card-title card-title-dash">Performance Line Chart
                            </h4>
                          </div>
                          <div id="performance-line-legend"></div>
                        </div>
                        <div class="chartjs-wrapper mt-5">
                          <canvas id="performaneLine"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 d-flex flex-column">
                <div class="row flex-grow">
                  <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                    <div class="card bg-primary card-rounded">
                      <div class="card-body pb-0">
                        <h4 class="card-title card-title-dash text-white mb-4">Advertisment
                          Summary
                        </h4>
                        <div class="row">
                          <div class="col-sm-4">
                            <p class="status-summary-ight-white mb-1">Total # of Ads</p>
                            <h2 class="text-info"><?= count($ads) ?></h2>
                          </div>
                          <div class="col-sm-8">
                            <div class="status-summary-chart-wrapper pb-4">
                              <canvas id="status-summary"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                              <div class="circle-progress-width">
                                <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                              </div>
                              <div>
                                <p class="text-small mb-2">Total Visitors</p>
                                <h4 class="mb-0 fw-bold">26.80%</h4>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="circle-progress-width">
                                <div id="visitperday" class="progressbar-js-circle pr-2"></div>
                              </div>
                              <div>
                                <p class="text-small mb-2">Visits per day</p>
                                <h4 class="mb-0 fw-bold">9065</h4>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8 d-flex flex-column">
                <div class="row flex-grow">
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                          <div>
                            <h4 class="card-title card-title-dash">Market Overview</h4>
                            <p class="card-subtitle card-subtitle-dash">Lorem ipsum dolor
                              sit amet consectetur
                              adipisicing elit</p>
                          </div>
                          <div>
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0"
                                type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"> This month </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <h6 class="dropdown-header">Settings</h6>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else
                                  here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                          <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                            <h2 class="me-2 fw-bold">$36,2531.00</h2>
                            <h4 class="me-2">USD</h4>
                            <h4 class="text-success">(+1.37%)</h4>
                          </div>
                          <div class="me-3">
                            <div id="marketing-overview-legend"></div>
                          </div>
                        </div>
                        <div class="chartjs-bar-wrapper mt-3">
                          <canvas id="marketingOverview"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 d-flex flex-column">
                <div class="row flex-grow">
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                              <div>
                                <h4 class="card-title card-title-dash">Leave Report</h4>
                              </div>
                              <div>
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0"
                                    type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"> Month Wise </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                    <h6 class="dropdown-header">week Wise</h6>
                                    <a class="dropdown-item" href="#">Year Wise</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="mt-3">
                              <canvas id="leaveReport"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->

<script>
  window.onload = (event) => {
    if ($("#performaneLine").length) {
      var graphGradient = document.getElementById("performaneLine").getContext('2d');
      var graphGradient2 = document.getElementById("performaneLine").getContext('2d');
      var saleGradientBg = graphGradient.createLinearGradient(5, 0, 5, 100);
      saleGradientBg.addColorStop(0, 'rgba(26, 115, 232, 0.18)');
      saleGradientBg.addColorStop(1, 'rgba(26, 115, 232, 0.02)');
      var saleGradientBg2 = graphGradient2.createLinearGradient(100, 0, 50, 150);
      saleGradientBg2.addColorStop(0, 'rgba(0, 208, 255, 0.19)');
      saleGradientBg2.addColorStop(1, 'rgba(0, 208, 255, 0.03)');
      var salesTopData = {
        labels: ["SUN", "sun", "MON", "mon", "TUE", "tue", "WED", "wed", "THU", "thu", "FRI", "fri", "SAT"],
        datasets: [{
          label: 'This week',
          data: [50, 110, 60, 290, 200, 115, 130, 170, 90, 210, 240, 280, 200],
          backgroundColor: saleGradientBg,
          borderColor: [
            '#03989E',
          ],
          borderWidth: 1.5,
          fill: true, // 3: no fill
          pointBorderWidth: 1,
          pointRadius: [4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4],
          pointHoverRadius: [2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2],
          pointBackgroundColor: ['#03989E)', '#03989E', '#03989E', '#03989E', '#03989E)',
            '#03989E',
            '#03989E', '#03989E', '#03989E)', '#03989E', '#03989E', '#03989E', '#03989E)'
          ],
          pointBorderColor: ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff',
            '#fff',
            '#fff', '#fff', '#fff', '#fff',
          ],
        }, {
          label: 'Last week',
          data: [30, 150, 190, 250, 120, 150, 130, 20, 30, 15, 40, 95, 180],
          backgroundColor: saleGradientBg2,
          borderColor: [
            '#52CDFF',
          ],
          borderWidth: 1.5,
          fill: true, // 3: no fill
          pointBorderWidth: 1,
          pointRadius: [0, 0, 0, 4, 0],
          pointHoverRadius: [0, 0, 0, 2, 0],
          pointBackgroundColor: ['#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF', '#52CDFF)',
            '#52CDFF',
            '#52CDFF', '#52CDFF', '#52CDFF)', '#52CDFF', '#52CDFF', '#52CDFF', '#52CDFF)'
          ],
          pointBorderColor: ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff',
            '#fff',
            '#fff', '#fff', '#fff', '#fff',
          ],
        }]
      };

      var salesTopOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          yAxes: [{
            gridLines: {
              display: true,
              drawBorder: false,
              color: "#F0F0F0",
              zeroLineColor: '#F0F0F0',
            },
            ticks: {
              beginAtZero: false,
              autoSkip: true,
              maxTicksLimit: 4,
              fontSize: 10,
              color: "#6B778C"
            }
          }],
          xAxes: [{
            gridLines: {
              display: false,
              drawBorder: false,
            },
            ticks: {
              beginAtZero: false,
              autoSkip: true,
              maxTicksLimit: 7,
              fontSize: 10,
              color: "#6B778C"
            }
          }],
        },
        legend: false,
        legendCallback: function (chart) {
          var text = [];
          text.push('<div class="chartjs-legend"><ul>');
          for (var i = 0; i < chart.data.datasets.length; i++) {
            console.log(chart.data.datasets[i]); // see what's inside the obj.
            text.push('<li>');
            text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' +
              '</span>');
            text.push(chart.data.datasets[i].label);
            text.push('</li>');
          }
          text.push('</ul></div>');
          return text.join("");
        },

        elements: {
          line: {
            tension: 0.4,
          }
        },
        tooltips: {
          backgroundColor: 'rgba(31, 59, 179, 1)',
        }
      }
      var salesTop = new Chart(graphGradient, {
        type: 'line',
        data: salesTopData,
        options: salesTopOptions
      });
      document.getElementById('performance-line-legend').innerHTML = salesTop.generateLegend();
    }

  };
</script>