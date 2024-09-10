<?php
global $wpdb;
$coordinator_table = $wpdb->prefix . 'coordinator';
?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/Management-System/Coordinator/coordinator.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/Management-System/Shared/navbar/navbar.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php include get_template_directory() . '/Management-System/Shared/navbar/navbar.php'; ?>

    <div class="left-half">
        <div class="inner-container">
            <!-- Add Coordinator Form -->
           
                <div class="input-box">
                    <h1 style="padding-left: 2px;">Co-Ordinator</h1>
                    <div class="input">
                        <input class="field" placeholder="Co-Ordinator Name" type="text" id="coordinator_name" name="coordinator_name" required />
                    </div>
                    <div class="input">
                        <input class="field-1" placeholder="Co-Ordinator Email" type="email" id="coordinator_email" name="coordinator_email" required />
                    </div>
                    <div class="input">
                         <button id="submit-btn" class="submit-btn">Add Co-Ordinator</button>
                    </div> 
                </div>
          
        </div>
    </div>

    <div class="right-half" id="right-half">
        <table border="1">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Coordinator Name</th>
                    <th>Coordinator Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <!-- Edit Form (Initially Hidden) -->
                <div id="update-coordinator-form" style="display: none;">
                    <h3>Edit Coordinator</h3>
                    <form id="update-coordinator-form">
                        <input type="hidden" id="edit-id">
                        <label for="edit-name">Coordinator Name:</label>
                        <input type="text" id="edit-name" required>
                        <label for="edit-email">Coordinator Email:</label>
                        <input type="email" id="edit-email" required>
                        <button type="submit">Update</button>
                    </form>
                </div>
                <?php
                $results = $wpdb->get_results("SELECT * FROM $coordinator_table");
                if ($results) {
                    $serialNo = 1;
                    foreach ($results as $row) {
                        echo '<tr>';
                        echo '<td>' . $serialNo++ . '</td>';
                        echo '<td>' . $row->name . '</td>';
                        echo '<td>' . $row->email . '</td>';
                        echo '<td><a href="#" class="edit-coordinator button" data-id="' . $row->id . '" data-name="' . $row->name . '" data-email="' . $row->email . '">Edit</a></td>';
                        echo '<td><a href="#" class="delete-coordinator button" data-id="' . $row->id . '">Delete</a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No results found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
