<?php
include_once "include/hedar.php";
include('db_connection.php');

?>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php
        include_once "include/sidebar.php";

        $query = "SELECT *
          FROM appoinment_type";

        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'patient') {
           
            $patientId = $_SESSION['user_id'];
            $query .= " WHERE a.patient_id = " . $patientId;
        } elseif (isset($_SESSION['user_type']) && ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'receptionist')) {
        } else {
            
            echo "Access denied.";
            exit;
        }

        $query .= " ORDER BY appoinment_type ASC";
        $result = $conn->query($query);
        ?>




        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <!-- Main content -->
            <section class="content">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Appoinment Type Management</h2>
                        <div class="form-inline">
                            <div class="input-group mr-3">
                                <input id="searchInput" type="text" class="form-control" placeholder="Search">

                                <div class="input-group-append">
                                    <button id="searchBtn" class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <button id="addUserBtn" class="btn btn-success" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-plus"></i> Add Appointment Type</button>
                        </div>
                    </div>

                    <table id="userTable" class="table table-bordered mt-3">

                        <thead class="thead-dark">
                            <tr>
                                <th>Appointment Type</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['appoinment_type'], ENT_QUOTES, 'UTF-8') . "</td>";
                                    echo "<td>" . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . "</td>";
                                    echo "<td class='text-center'>";
                                    
                                    echo "<div class='btn-group' role='group'>";
                                    if (isset($_SESSION['user_type']) && ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'receptionist')) {
                                        echo "<a href='#' class='btn btn-sm btn-primary editUserBtn' data-app-id='" . $row['app_id'] . "'><i class='fas fa-edit'></i> Edit</a>";
                                    } else {
                                        echo "N/A";
                                    }
                                    echo "</div>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No appointments found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Add Appointment Modal -->
                <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">Add Appointment Type</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addUserForm">
                                    <div class="form-group">
                                        <label for="appointment_type">Appointment Type</label>
                                        <input type="text" class="form-control" id="appointment_typeid" name="appointment_type" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" id="price" name="price" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Edit Appointment Modal -->
                <div class="modal fade" id="editAppointmentModal" tabindex="-1" aria-labelledby="editAppointmentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editAppointmentModalLabel">Edit Appointment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editAppointmentForm">
                                    <div class="form-group">
                                        <label for="editAppointmentDate">Appointment Type:</label>
                                        <input type="text" id="editAppointmentType" name="appointmenttype" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editAppointmentType">Price:</label>
                                        <input type="text" id="editAppointmentprice" name="appointmentprice" class="form-control" required>
                                    </div>
                                    <input type="hidden" id="editAppointmentid" name="appointmentId">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="submitEditAppointment()">Save Changes</button>

                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



        <!-- Main Footer -->
        <?php include_once "include/footer.php"; ?>
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
    <!-- Search Function -->
    <script>
        // function searchAppointments() {
        //     var input, filter, table, tr, i, txtValue, found;
        //     input = document.getElementById("searchInput");
        //     filter = input.value.toUpperCase();
        //     table = document.getElementById("appointmentTable");
        //     tr = table.getElementsByTagName("tr");

        //     for (i = 0; i < tr.length; i++) {
        //         td = tr[i].getElementsByTagName("td");
        //         found = false;
        //         for (let j = 0; j < td.length; j++) {
        //             if (td[j]) {
        //                 txtValue = td[j].textContent || td[j].innerText;
        //                 if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //                     found = true;
        //                     break;
        //                 }
        //             }
        //         }
        //         if (found) {
        //             tr[i].style.display = "";
        //         } else {
        //             tr[i].style.display = "none";
        //         }
        //     }
        // }

        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#userTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $("#addUserForm").submit(function(e) {
            e.preventDefault();


            var formData = $(this).serialize();


            $.post("addAppoinment.php", formData, function(response) {

                console.log(response);

                if (response.success) {

                    alert("Appointment type added successfully!");





                    $("#addUserModal").modal("hide");
                    location.reload();

                } else {

                    alert("Failed to Appointment type. Please try again.");
                }
            }, "json");
        });


        $(document).on('click', '.editUserBtn', function() {
            var app_id = $(this).data('app-id');

            $.ajax({
                url: 'getAppointmenttype.php',
                type: 'GET',
                data: {
                    app_id: app_id
                },
                dataType: 'json',
                success: function(response) {

                    $('#editAppointmentType').val(response.appointment_type);
                    $('#editAppointmentprice').val(response.price);
                    $('#editAppointmentid').val(response.app_id);

                    $('#editAppointmentModal').modal('show');
                }

            });
        });


        function submitEditAppointment() {
            // Prevent default form submission
            event.preventDefault();

            // Serialize form data
            var formData = $('#editAppointmentForm').serialize();
            console.log('Serialized form data:', formData);

            // Perform AJAX request
            $.ajax({
                url: 'updateAppoinmentType.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log('Success response:', response);
                    var data = JSON.parse(response);
                    if (data.success) {
                        alert('Appointment updated successfully.');
                        $('#editAppointmentModal').modal('hide'); // Note: Changed from editUserModal to editAppointmentModal
                        location.reload();
                    } else if (data.error) {
                        alert('Error: ' + data.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                    // Additional error handling...
                }
            });
        }


        // $('#editAppointmentForm').submit(function(e) {
        //     e.preventDefault();


        //     var formData = $(this).serialize();
        //     console.log('Serialized form data:', formData);

        //     $.ajax({
        //         url: 'updateAppoinmentType.php',
        //         type: 'POST',
        //         data: formData,
        //         success: function(response) {
        //             console.log('Success response:', response);

        //             var data = JSON.parse(response);
        //             if (data.success) {
        //                 alert('User updated successfully.');
        //                 $('#editUserModal').modal('hide');
        //                 location.reload();
        //             } else if (data.error) {
        //                 alert('Error: ' + data.error);
        //             }
        //         },

        //         error: function(xhr, status, error) {
        //             console.error('AJAX error:', error);
        //             // Error handling...
        //         }
        //     });



        //});
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>