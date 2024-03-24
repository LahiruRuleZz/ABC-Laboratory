<?php
include_once "include/hedar.php";
include('db_connection.php');


// Query to get sum of payments by month
$query = "SELECT SUM(amount) AS total_amount, MONTH(payment_date) AS month, YEAR(payment_date) AS year
          FROM payments
          WHERE payment_date BETWEEN '2024-01-01' AND '2024-12-31'
          GROUP BY MONTH(payment_date), YEAR(payment_date)
          ORDER BY payment_date ASC";

$result = mysqli_query($conn, $query);

$paymentData = [];
while ($row = mysqli_fetch_assoc($result)) {
  $paymentData[] = $row;
}


$totalGoal = 200;

// Query to count paid appointments
$queryPaid = "SELECT COUNT(*) AS paid_count FROM appointments WHERE status = 'paid'";
$resultPaid = mysqli_query($conn, $queryPaid);
$paidAppointmentsCount = $resultPaid ? mysqli_fetch_assoc($resultPaid)['paid_count'] : 0;

// Query to count canceled appointments
$queryCanceled = "SELECT COUNT(*) AS canceled_count FROM appointments WHERE status = 'canceled'";
$resultCanceled = mysqli_query($conn, $queryCanceled);
$canceledAppointmentsCount = $resultCanceled ? mysqli_fetch_assoc($resultCanceled)['canceled_count'] : 0;

// Query to count scheduled appointments
$queryScheduled = "SELECT COUNT(*) AS scheduled_count FROM appointments WHERE status = 'scheduled'";
$resultScheduled = mysqli_query($conn, $queryScheduled);
$scheduledAppointmentsCount = $resultScheduled ? mysqli_fetch_assoc($resultScheduled)['scheduled_count'] : 0;

// Query to count confirmed appointments
$queryConfirmed = "SELECT COUNT(*) AS confirmed_count FROM appointments WHERE status = 'confirm'";
$resultConfirmed = mysqli_query($conn, $queryConfirmed);
$confirmedAppointmentsCount = $resultConfirmed ? mysqli_fetch_assoc($resultConfirmed)['confirmed_count'] : 0;


$query = "SELECT report_name, COUNT(report_name) AS count FROM test_reports GROUP BY report_name ORDER BY count DESC";
$result = mysqli_query($conn, $query);

$reportNames = [];
$reportCounts = [];

while ($row = mysqli_fetch_assoc($result)) {
  $reportNames[] = $row['report_name'];
  $reportCounts[] = $row['count'];
}


?>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <?php
    include_once "include/sidebar.php";
    ?>




    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">


          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Monthly Recap Report</h5>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>

                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <p class="text-center">
                        <strong>Sales Complete Appoinment: 1 Jan, 2024 - 1 Jan, 2025</strong>
                      </p>

                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="salesChart" height="180" style="height: 180px;">
                          <?php
                          // Prepare labels and data for the chart
                          $labels = array();
                          $data = array();
                          foreach ($paymentData as $payment) {
                            $labels[] = date('F', mktime(0, 0, 0, $payment['month'], 10));
                            $data[] = (float) $payment['total_amount'];
                          }
                          ?>



                        </canvas>

                      </div>
                      <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                      <p class="text-center">
                        <strong>Status Of Appoinment</strong>
                      </p>


                      <!-- Progress bar for Paid Appointments -->
                      <div class="progress-group">
                        Paid Appointments
                        <span class="float-right"><b><?php echo $paidAppointmentsCount; ?></b>/<?php echo $totalGoal; ?></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-primary" style="width: <?php echo ($paidAppointmentsCount / $totalGoal) * 100; ?>%"></div>
                        </div>
                      </div>

                      <!-- Progress bar for Canceled Appointments -->
                      <div class="progress-group">
                        Canceled Appointments
                        <span class="float-right"><b><?php echo $canceledAppointmentsCount; ?></b>/<?php echo $totalGoal; ?></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-danger" style="width: <?php echo ($canceledAppointmentsCount / $totalGoal) * 100; ?>%"></div>
                        </div>
                      </div>

                      <!-- Progress bar for Scheduled Appointments -->
                      <div class="progress-group">
                        Pending Appointments
                        <span class="float-right"><b><?php echo $scheduledAppointmentsCount; ?></b>/<?php echo $totalGoal; ?></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-warning" style="width: <?php echo ($scheduledAppointmentsCount / $totalGoal) * 100; ?>%"></div>
                        </div>
                      </div>

                      <!-- Progress bar for Confirmed Appointments -->
                      <div class="progress-group">
                        Confirmed Appointments
                        <span class="float-right"><b><?php echo $confirmedAppointmentsCount; ?></b>/<?php echo $totalGoal; ?></span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-success" style="width: <?php echo ($confirmedAppointmentsCount / $totalGoal) * 100; ?>%"></div>
                        </div>
                      </div>

                      <!-- /.progress-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>

              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left Column: US-Visitors Report -->
            <div class="col-md-6">
              <div class="card">
                <canvas id="monthlySummaryChart" height="200"></canvas>
              </div>
            </div>

            <!-- Right Column: Latest Orders -->
            <div class="col-md-6">
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">Confirm Panding Appointment</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0">
                      <thead>
                        <tr>
                          <th>Full Name</th>
                          <th>Phone Number</th>
                          <th>Reprot Type</th>
                          <th>Report Do Date</th>
                        </tr>
                      </thead>
                      <?php

                      $query = "SELECT us.full_name, us.phone_number, appt.appoinment_type, ap.appointment_date
                        FROM appoinment_type appt
                        JOIN appointments ap ON appt.app_id = ap.app_id
                        JOIN users us ON us.user_id = ap.patient_id
                        WHERE ap.status = 'scheduled'
                        AND YEAR(ap.appointment_date) = YEAR(CURRENT_DATE())
                        AND MONTH(ap.appointment_date) = MONTH(CURRENT_DATE());";

                      $result = mysqli_query($conn, $query);
                      ?>
                      <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                          <tr>
                            <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['appoinment_type']); ?></td>
                            <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($row['appointment_date']))); ?></td>
                          </tr>
                        <?php endwhile; ?>
                      </tbody>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <!-- /.row -->
        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

 

    <!-- Main Footer -->
  <?php  include_once "include/footer.php"; ?>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="plugins/raphael/raphael.min.js"></script>
  <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>

  <script>
    var labels = <?php echo json_encode($labels); ?>;
    var data = <?php echo json_encode($data); ?>;

    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Total Payments',
          data: data,
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    document.addEventListener('DOMContentLoaded', function() {
      var ctx = document.getElementById('monthlySummaryChart').getContext('2d');
      var monthlySummaryChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($reportNames); ?>,
          datasets: [{
            label: 'Confirm Number Of Reports',
            data: <?php echo json_encode($reportCounts); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    });
  </script>

</body>

</html>